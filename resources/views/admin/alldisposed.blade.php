@extends('admin.layouts.app')


@section('adminpagename')
নিষ্পত্তিকৃত মামলা
@endsection

@section('adminmain')

<div class="widget widget-content-area mb-3">


    <div class="widget-one">

        <div class="card">
                    <div class="card-header">

                        <div class="col-md-12 mb-0"><h6 class="mb-0"><b>নিষ্পত্তিকৃত সকল মামলার তালিকা</b></h6>
                        </div>

                  </div>
      <div class="card-body ">

     <!-- <table class="table table-striped table-bordered mb-0" style="width:100%"> -->
<table id="example" class="table table-striped table-bordered mb-0" style="width:100%">
        <thead style="background-color: darkgreen;">
            <tr>
              <td class="text-center text-white" style="width: 8%">SL</td>
              <td class="text-center text-white" style="width: 17%">Case no</td>
              <!-- <td class="text-center text-white" style="width: 20%">Filing Date</td> -->
              <td class="text-center text-white" style="width: 20%">Disposal Date</td>
              <td class="text-center text-white" style="width: 35%">Final Result</td>
              <td class="text-center text-white" style="width: 35%">Month/Year</td>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $sl => $case)
                <tr class="text-center">
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $case->caseno }}</td>
                    <!-- <td> @if($case->filing_date == "1970-01-01" || $case->filing_date=="0000-00-00") {{ '' }} @else {{ str_replace("-", "/",(date("d-m-Y",(strtotime($case->filing_date))))) }} @endif </td> -->
                    <td> @if($case->date_final_result == "1970-01-01" || $case->date_final_result=="0000-00-00") {{ '' }} @else {{ str_replace("-", "/",(date("d-m-Y",(strtotime($case->date_final_result))))) }} @endif </td>
                    <td>{{ $case->final_result }}</td>
                    <td>{{ date('M/Y', strtotime($case->date_final_result) )}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
  </div>
    </div>

    </div>
</div>
<!-- <div class="widget widget-content-area mb-3 br-4">
    <div class="widget-one">

        <h6>Kick Start you new project with ease!</h6>

        <p class="mb-0 mt-3">With CORK starter kit, you can begin your work without any hassle. The starter page is highly optimized which gives you freedom to start with minimal code and add only the desired components and plugins required for your project.</p>

    </div>
</div>
 -->

@php

@endphp


@endsection
