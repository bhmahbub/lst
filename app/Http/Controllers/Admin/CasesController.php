<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cases;
use App\Models\data;
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



class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cases');
    }

    public function allcases()
    {
        $cases = DB::table('cases')->where('status', '=', 'Under Trial')->orderby('filing_date')->orderBy('caseno')->get();

        return view('admin.allcases')->with('cases', $cases);
    }


    //n_for edit
    // public function all()
    // {
    //     return view('admin.all');
    // }

    //Final result edit
    // public function alldis()
    // {
    //     return view('admin.alldis');
    // }

    public function alldisposed()
    {
        $cases = DB::table('cases')->where('status', '=', 'Disposed')->orderby('date_final_result', 'DESC')->orderBy('caseno')->get();

        return view('admin.alldisposed')->with('cases', $cases);
    }






    public function all_cases(Request $request)
    {


        if ($request->filing_year != null) {

            $year = $request->filing_year;
        } else {
            $year = date("Y");
        }
        $cases = DB::table('cases')->whereYear('filing_date', '=', $year)->orderby('filing_date')->orderBy('caseno')->get();


        return view('admin.all-cases')->with('cases', $cases);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([]);

        $cases = new cases();
        $num = $cases->num = bn2enNumber($request['num']);
        $year = $cases->year = bn2enNumber($request['year']);
        $caseno = $cases->caseno = 'LST ' . $num . '/' . $year;
        $filing_date = $cases->filing_date = date('Y-m-d', strtotime(str_replace("/", "-", bn2enNumber($request['filing_date']))));
        $n_date =  $cases->n_date = date('Y-m-d', strtotime(str_replace("/", "-", bn2enNumber($request['n_date']))));
        $n_for = $cases->n_for = $request['n_for'];

        $save1 = $cases->save();

        $insertedId = $cases->id;

        if ($save1) {

            $data = new data();
            $data->cases_id = $insertedId;
            $data->c_date = $filing_date;
            $data->c_for = 'First filing';
            $data->n_date = $n_date;
            $data->n_for = $n_for;

            $save2 = $data->save();
        }


        return redirect()->back()->with('status', 'সফলভাবে যুক্ত হয়েছে!');




        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
