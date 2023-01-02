<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\casesByUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


function en2bnNumber($number)
{
    $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST");
    $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি");

    $bn_number = str_replace($search_array, $replace_array, $number);

    return $bn_number;
}
function bn2enNumber($number)
{

    $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি");
    $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST");

    $en_number = str_replace($search_array, $replace_array, $number);

    return $en_number;
}




class casesByUserController extends Controller
{
    public function index()
    {
        $user_id     = Auth::user()->id;
        $listOfCases = DB::table('cases_by_users')
            ->where('user_id', '=', $user_id)
            ->join('cases', 'cases_by_users.cases_id', '=', 'cases.id')
            // ->select('cases.*', 'cases_by_users.*')
            ->get();
        return view('dashboard', compact('listOfCases'));

        // return view('welcome', compact('cl', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month', 'total_under_trial'));

    }


    public function store(Request $request)
    {

        $request->validate([]);

        $num = bn2enNumber($request['num']);
        $year = bn2enNumber($request['year']);
        $caseno = 'LST ' . $num . '/' . $year;

        $search = DB::table('cases')
            ->where('caseno', $caseno)
            ->first();

            if ($search) {
            $user_id   = Auth::user()->id;
            $cases_id = $search->id;
            // dd($cases_id);

            $casesByUser            = new casesByUser();
            $casesByUser->user_id   = $user_id;
            $casesByUser->cases_id  = $cases_id;
            $casesByUser->caseno    = $caseno;
            $casesByUser->save();
            return redirect()->back()->with('status', 'সফলভাবে যুক্ত হয়েছে!');
        }
            else{
                return redirect()->back()->with('error', 'এই মামলা সংক্রান্ত কোন তথ্য পাওয়া যায়নি!');
            }




    }
}
