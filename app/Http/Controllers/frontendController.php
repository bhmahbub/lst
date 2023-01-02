<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\cases;
use App\Models\data;
use App\Models\cl_date;



function en2bnNumber ($number){
      $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST");
      $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি");

      $bn_number = str_replace($search_array, $replace_array, $number);

      return $bn_number;
    }
    function bn2enNumber ($number){

      $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি");
      $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST");

      $en_number = str_replace($search_array, $replace_array, $number);

      return $en_number;
    }






class frontendController extends Controller
{
    public function index()
    {
        // reports (current month)
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month  = date('Y-m-t');
        $filing_current_month = DB::table('cases')
            ->whereBetween('filing_date', [$first_day_this_month, $last_day_this_month])
            ->count();
        $disposal_current_month = DB::table('cases')
            ->whereBetween('date_final_result', [$first_day_this_month, $last_day_this_month])
            ->count();

        // reports (last month)
        $first_day_last_month = date('Y-m-d', strtotime('first day of last month'));
        $last_day_last_month  = date('Y-m-d', strtotime('last day of last month'));
        $filing_last_month = DB::table('cases')
            ->whereBetween('filing_date', [$first_day_last_month, $last_day_last_month])
            ->count();
        $disposal_last_month = DB::table('cases')
            ->whereBetween('date_final_result', [$first_day_last_month, $last_day_last_month])
            ->count();

        //total under trial
        $total_under_trial = DB::table('cases')
            ->where('status', '=', 'Under Trial')
            ->count();



        $cl_date = cl_date::max('cl_date');
        $cl = DB::table('data')
            ->where('c_date', '=', $cl_date)
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno')
            ->get();

        return view('welcome', compact('cl', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month', 'total_under_trial'));




        // $cl = DB::table('data')->where('c_date', '=', 'Under Trial')->orderby('filing_date')->orderBy('caseno')->get();

        // return view('admin.allcases')->with('cases', $cases);

    }



    public function causelist()
    {
                // reports (current month)
                $first_day_this_month = date('Y-m-01');
                $last_day_this_month  = date('Y-m-t');
                $filing_current_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_this_month, $last_day_this_month])
                    ->count();
                $disposal_current_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_this_month, $last_day_this_month])
                    ->count();

                // reports (last month)
                $first_day_last_month = date('Y-m-d', strtotime('first day of last month'));
                $last_day_last_month  = date('Y-m-d', strtotime('last day of last month'));
                $filing_last_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_last_month, $last_day_last_month])
                    ->count();
                $disposal_last_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_last_month, $last_day_last_month])
                    ->count();

        $cl_date = cl_date::max('cl_date');
        $cl = DB::table('data')
            ->where('c_date', '=', $cl_date)
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno')
            ->get();
        return view('causelist', compact('cl', 'cl_date', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month'));
    }




    public function search_causelist(Request $request)
    {
                // reports (current month)
                $first_day_this_month = date('Y-m-01');
                $last_day_this_month  = date('Y-m-t');
                $filing_current_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_this_month, $last_day_this_month])
                    ->count();
                $disposal_current_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_this_month, $last_day_this_month])
                    ->count();

                // reports (last month)
                $first_day_last_month = date('Y-m-d', strtotime('first day of last month'));
                $last_day_last_month  = date('Y-m-d', strtotime('last day of last month'));
                $filing_last_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_last_month, $last_day_last_month])
                    ->count();
                $disposal_last_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_last_month, $last_day_last_month])
                    ->count();


        $cl_date = date('Y-m-d', strtotime(str_replace("/", "-",bn2enNumber($request['cl_date']))));
        $cl = DB::table('data')
            ->where('c_date', '=', $cl_date)
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno')
            ->get();
        return view('causelist', compact('cl', 'cl_date', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month'));
    }



    // public function details()
    // {
    //     return view('details');
    // }


    public function details(Request $request)
    {
                // reports (current month)
                $first_day_this_month = date('Y-m-01');
                $last_day_this_month  = date('Y-m-t');
                $filing_current_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_this_month, $last_day_this_month])
                    ->count();
                $disposal_current_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_this_month, $last_day_this_month])
                    ->count();

                // reports (last month)
                $first_day_last_month = date('Y-m-d', strtotime('first day of last month'));
                $last_day_last_month  = date('Y-m-d', strtotime('last day of last month'));
                $filing_last_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_last_month, $last_day_last_month])
                    ->count();
                $disposal_last_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_last_month, $last_day_last_month])
                    ->count();


        $no = bn2enNumber($request['no']);
        $year = bn2enNumber($request['year']);
        $cn = 'LST '.$no.'/'.$year;
        $caseno = en2bnNumber($cn);


        $Details = DB::table('data')
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno', 'cases.id as caseid')
            ->where('caseno', $cn)
            ->orderBy('id', 'DESC')
            ->get();
            return view('details', compact('caseno', 'Details', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month'));

    }


    public function detailOrder(Request $request)
    {
                // reports (current month)
                $first_day_this_month = date('Y-m-01');
                $last_day_this_month  = date('Y-m-t');
                $filing_current_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_this_month, $last_day_this_month])
                    ->count();
                $disposal_current_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_this_month, $last_day_this_month])
                    ->count();

                // reports (last month)
                $first_day_last_month = date('Y-m-d', strtotime('first day of last month'));
                $last_day_last_month  = date('Y-m-d', strtotime('last day of last month'));
                $filing_last_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_last_month, $last_day_last_month])
                    ->count();
                $disposal_last_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_last_month, $last_day_last_month])
                    ->count();


        $no = bn2enNumber($request['no']);
        $year = bn2enNumber($request['year']);
        $cn = 'LST '.$no.'/'.$year;
        $caseno = en2bnNumber($cn);


        $detailOrder = DB::table('cases')
            ->where('caseno', $cn)
            ->where('status', 'Disposed')
            ->get();


            return view('detailOrder', compact('caseno', 'detailOrder', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month'));

    }



    public function detail_Order()
    {
                // reports (current month)
                $first_day_this_month = date('Y-m-01');
                $last_day_this_month  = date('Y-m-t');
                $filing_current_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_this_month, $last_day_this_month])
                    ->count();
                $disposal_current_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_this_month, $last_day_this_month])
                    ->count();

                // reports (last month)
                $first_day_last_month = date('Y-m-d', strtotime('first day of last month'));
                $last_day_last_month  = date('Y-m-d', strtotime('last day of last month'));
                $filing_last_month = DB::table('cases')
                    ->whereBetween('filing_date', [$first_day_last_month, $last_day_last_month])
                    ->count();
                $disposal_last_month = DB::table('cases')
                    ->whereBetween('date_final_result', [$first_day_last_month, $last_day_last_month])
                    ->count();

                    $caseno = '...';
                    $detailOrder = '';

            return view('detailOrder', compact('caseno', 'detailOrder', 'filing_current_month', 'disposal_current_month', 'filing_last_month', 'disposal_last_month'));

    }



}
