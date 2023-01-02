@extends('admin.layouts.app')

@section('adminpagename')
এডমিন ড্যাশবোর্ড
@endsection

@section('adminmain')

<div class="widget widget-content-area mb-3">
    <div class="card text-center mb-3">
        <h5 class="text-center mb-0 py-3"><b>বিগত মাসের মামলার সারসংক্ষেপ</b></h5>
    </div>
    
    <div class="row justify-content-between">
        <div class="widget-one col-4">
            @php
                $date = date('Y-m-d');
                $last_month_year = date("Y", strtotime ( '-1 month' , strtotime ( $date ) )) ;
                $last_month = date("m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
                $filing_last_month = DB::table('cases')
                    ->whereYear('filing_date', '=', $last_month_year)
                    ->whereMonth('filing_date', '=', $last_month)
                    ->get();
            @endphp
            <div class="card text-center">
                <h6 class="pt-3 px-3"><b>দায়ের</b></h6> <h5 class="mb-0 pb-3">{{ $filing_last_month->count() }}</h5>
            </div>


        </div>
        <div class="widget-one col-4">

        @php
            $disposal_last_month = DB::table('cases')
                ->whereYear('date_final_result', '=', $last_month_year)
                ->whereMonth('date_final_result', '=', $last_month)
                ->get(); 
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>নিষ্পত্তি</b></h6> <h5 class="mb-0 pb-3"> {{$disposal_last_month->count()}}</h5>
        </div>
    </div>
            <div class="widget-one col-4">

        @php
            $first_day = date('Y-m-01');
            $total_cases_last_month = DB::table('cases')
                ->where('filing_date', '<', $first_day)
                ->where('status', '=', 'Under Trial')
                ->get(); 
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>বিচারাধীন</b></h6> <h5 class="mb-0 pb-3"> {{$total_cases_last_month->count()}}</h5>
        </div>
    </div>
    </div>
</div>

<div class="widget widget-content-area mb-3">
    <div class="card text-center mb-3">
        <h5 class="text-center mb-0 py-3"><b>বর্তমান মাসের মামলার সারসংক্ষেপ</b></h5>
    </div>
    <div class="row justify-content-between">

        <div class="widget-one col-4">

        @php
            $this_year = date('Y');
            $this_month = date('m');
            $filing_this_month = DB::table('cases')
                ->whereYear('filing_date', '=', $this_year)
                ->whereMonth('filing_date', '=', $this_month)
                ->get(); 
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>দায়ের</b></h6> <h5 class="mb-0 pb-3"> {{$filing_this_month->count()}}</h5>
        </div>


    </div>
        <div class="widget-one col-4">

        @php
            $disposal_this_month = DB::table('cases')
                ->whereYear('date_final_result', '=', $this_year)
                ->whereMonth('date_final_result', '=', $this_month)
                ->get(); 
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>নিষ্পত্তি</b></h6> <h5 class="mb-0 pb-3"> {{$disposal_this_month->count()}}</h5>
        </div>
    </div>
            <div class="widget-one col-4">

        @php
            $under_trial_cases = DB::table('cases')
                ->where('status', '=', 'Under Trial')
                ->get(); 
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>বিচারাধীন</b></h6> <h5 class="mb-0 pb-3"> {{$under_trial_cases->count()}}</h5>
        </div>
    </div>
    </div>
</div>

<div class="widget widget-content-area mb-3">
    <div class="card text-center mb-3">
        <h5 class="text-center mb-0 py-3"><b>কজ্বলিস্ট সংক্রান্ত সারসংক্ষেপ</b></h5>
    </div>
    <div class="row justify-content-between">

        <div class="widget-one col-4">

        @php
        $last_cl_date = DB::table('cl_dates')->max('cl_date');
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>সর্বশেষ কজ্বলিস্টের তারিখ</b></h6> <h5 class="mb-0 pb-3"> {{  date('d/m/Y', strtotime(str_replace("-", "/", $last_cl_date)))}}</h5>
        </div>


    </div>
        <div class="widget-one col-4">

        @php
            $disposal_this_month = DB::table('cases')
                ->whereYear('date_final_result', '=', $this_year)
                ->whereMonth('date_final_result', '=', $this_month)
                ->get(); 
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>আপডেট অপেক্ষমাণ (দিন)</b></h6> <h5 class="mb-0 pb-3"> {{$disposal_this_month->count()}}</h5>
        </div>
    </div>
            <div class="widget-one col-4">

        @php
            $under_trial_cases = DB::table('cases')
                ->where('status', '=', 'Under Trial')
                ->get(); 
        @endphp
        @php
            $pending = DB::table('data')
            ->get();
        @endphp
        <div class="card text-center">
            <h6 class="pt-3 px-3"><b>আপডেট অপেক্ষমাণ (সংখ্যা)</b></h6> <h5 class="mb-0 pb-3"> {{$pending->count()}}</h5>
        </div>
    </div>
    </div>
</div>




@endsection
