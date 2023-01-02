<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\cases;
use App\Models\data;
use App\Models\cl_date;
use Illuminate\Support\Carbon;


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

class causelistController extends Controller
{
    public function index()
    {
        return view('admin.causelist');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cl_date' => ['required', 'string', 'min:10', 'max:10', 'unique:cl_dates'],
        ]);

        $cl_date = date('Y-m-d', strtotime(str_replace("/", "-", bn2enNumber($request['cl_date']))));
        //$cl_date = date('Y-m-d', strtotime(str_replace("/", "-", bn2enNumber($request->cl_date))));

        $find_cl = DB::table('cl_dates')->where('cl_date', '=', $cl_date)->get();
        if (count($find_cl) == 0) {
            $cases = DB::table('data')->where('n_date', '=', $cl_date)->orderby('n_for')->orderBy('cases_id')->get();

            foreach ($cases as $key => $case) {
                data::create([
                    'cases_id' => $case->cases_id,
                    'c_date' => $case->n_date,
                    'c_for' => $case->n_for,
                    'n_for' => '',
                    'remark' => $case->remark,
                ]);
            }

            cl_date::create([
                'cl_date'  =>   $cl_date
            ]);
            $msg = '<div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">x</button>
                              <strong>সফলভাবে যুক্ত হয়েছে!</strong>
                            </div>';
            return redirect()->back()->with('status', $msg);
        } else {
            $msg = '<div class="alert alert-warning">
                              <button type="button" class="close" data-dismiss="alert">x</button>
                              <strong>' . $request['cl_date'] . ' তারিখ ইতিমধ্যে কজ্বলিস্টে যুক্ত আছে!</strong>
                            </div>';
            return redirect()->back()->with('status', $msg);
        }
    }

    public function view_search(Request $request)
    {
        $cl_date = date('Y-m-d', strtotime(str_replace("/", "-", $request['cl_date'])));

        $cl = DB::table('data')
            ->where('c_date', '=', $cl_date)
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno')
            ->get();
        return view('admin.causelistOf', ['cl' => $cl], ['cl_date' => $cl_date]);
        // return view('admin.causelistOf')->with('cl_date', $cl_date)->with('cl' , $cl);
    }

    public function view()
    {
        $cl_date = cl_date::max('cl_date');
        $cl = DB::table('data')
            ->where('c_date', '=', $cl_date)
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno')
            ->get();
        return view('admin.causelistOf', ['cl' => $cl], ['cl_date' => $cl_date]);
    }

    public function pending()
    {
        $cl = DB::table('data')
            ->where('data.n_for', '')
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno', 'cases.status')
            ->get();

        $count = $cl->count();
        // return view('admin.causelist-pending')->with('cl', $cl);
        return view('admin.causelist-pending', compact('cl', 'count'));
    }


    public function update_view_search()
    {
        $search = $_GET['cl_date'] ?? "";


        if ($search != "") {
            $cl_date = date('Y-m-d', strtotime(str_replace("/", "-", $search)));
        } else {
            $cl_date = cl_date::max('cl_date');
        }

        $cl = DB::table('data')
            ->where('c_date', '=', $cl_date)
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno', 'cases.id as caseid')
            ->get();
        return view('admin.causelist-update', ['cl' => $cl], ['cl_date' => $cl_date]);
    }

    public function updateAction(Request $request)
    {

        $id = $request->id;
        $caseid = $request->caseid;
        $n_date = date('Y-m-d', strtotime(str_replace("/", "-", bn2enNumber($request->n_date))));
        $n_for = $request->n_for;
        $remark = $request->remark;

        // dd($n_date);
        $data = array(
            'id'        =>  $id,
            'n_date'    =>  $n_date,
            'n_for'     =>  $n_for,
            'remark'    =>  $remark
        );


        DB::table('data')
            ->where('id', $id)
            ->update($data);


        $case = array(
            'id'        =>  $caseid,
            'n_date'    =>  $n_date,
            'n_for'     =>  $n_for
        );
        DB::table('cases')
            ->where('id', $caseid)
            ->update($case);


        $msg = 'সফলভাবে আপডেট হয়েছে!';
        return redirect()->back()->with('status', $msg);
    }

    // disposal management

    public function disposedList()
    {
        $year = $_GET['year'] ?? "";
        $month = $_GET['month'] ?? "";


        if ($year != "" and $month != "") {
            $date = $year . "-" . $month . "-" . "01";
            $my = $month . "/" .$year;

        } else {
            $date = date('Y-m-d');
            $my = date('m/Y');
        }

        $fd = date('Y-m-01', strtotime($date));

        $ed = date('Y-m-t', strtotime($date));

        $disposedcases = data::Where(function ($query) use ($fd, $ed) {
            $query->whereBetween('c_date', [$fd, $ed])
                  ->where('data.n_for', 'LIKE', '%Decreed%');
        })
            ->orWhere(function ($query) use ($fd, $ed) {
                $query->whereBetween('c_date', [$fd, $ed])
                      ->where('data.n_for', 'LIKE', '%Dismissed%');
            })
            ->join('cases', 'data.cases_id', '=', 'cases.id')
            ->select('data.*', 'cases.caseno', 'cases.status', 'final_result', 'cases.pdf', 'cases.date_final_result', 'cases.id as caseid')
            ->orderby('c_date', 'DESC')
            ->get();

        $count = $disposedcases->count();

        return view('admin.manage-disposed', compact('disposedcases', 'count', 'my'));
    }




    public function disposalupdateAction(Request $request)
    {

        $cases = cases::find($request->caseid);
        $cases->id                = $request->caseid;
        $cases->final_result      = $request->final_result;
        $cases->date_final_result = $request->date_final_result;
        $cases->status            = $request->status;

        if ($request->file('pdf')) {

            if (File::exists('uploads/PDF/' . $cases->pdf)) {
                File::delete('uploads/PDF/' . $cases->pdf);
            }

            $file = $request->file('pdf');
            $filename = date('YmdHis').'.'. $file->getClientOriginalExtension();
            $file->move(('uploads/PDF/'), $filename);
            $cases->pdf = $filename;

        }
        $cases->update();

        $msg = 'সফলভাবে আপডেট হয়েছে!';
        return redirect()->back()->with('status', $msg);
    }


    // public function disposalupdateAction(Request $request)
    // {

    //     $pdfname = $request->pdf;
    //     $cases->id                = $request->caseid;
    //     $cases->final_result      = $request->final_result;
    //     $cases->date_final_result = $request->date_final_result;
    //     $cases->status            = $request->status;

    //     if ($request->file('pdf')) {

    //         if (File::exists('uploads/PDF/' . $cases->pdf)) {
    //             File::delete('uploads/PDF/' . $cases->pdf);
    //         }

    //         $file = $request->file('pdf');
    //         $filename = date('YmdHis').'.'. $file->getClientOriginalExtension();
    //         $file->move(('uploads/PDF/'), $filename);
    //         $cases->pdf = $filename;

    //     }
    //     $cases->update();

    //     return response()->file($pathToFile);
    // }



    public function download(Request $request, $pdf)
        {


            return response()->download(public_path('uploads/PDF/'.$pdf));
        }



    public function viewpdf($pdf)
        {

            $pathToFile = public_path('uploads/PDF/'.$pdf);

            return response()->file($pathToFile);


        }


}
