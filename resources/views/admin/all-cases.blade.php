@extends('admin.layouts.app')


@section('adminpagename')
সকল মামলার তালিকা
@endsection

@section('adminmain')

<div class="widget widget-content-area mb-3">


    <div class="widget-one">

        <div class="card p-4 mb-3">
            <form method="GET" action="" class="col-md-6 mx-auto">

                      <div class="input-group input-group-sm">

                        <div class="input-group-prepend">
                          <span class="input-group-text px-5 text-white" style="background: darkgreen; border: 1px solid darkgreen;" id="inputGroup-sizing-sm" > বছর ভিত্তিক মামলা অনুসন্ধান</span>
                        </div>
                        <!-- <input type="text" class="form-control text-center" name="filing_year" placeholder="বছর" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required> -->
                        <select class="form-control form-select form-select-sm text-center" aria-label=".form-select-sm example" name="filing_year" required onchange="this.form.submit();" style="border: 1px solid darkgreen;">
                          <option selected disabled>বছর</option>
                            @for ($i = date('Y'); $i >= 2013; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                      </div>

            </form>
        </div>





            <div class="card">
                    <div class="card-header mb-0">
   
                        <div class="col-md-12 mb-0"><h6 class="mb-0"><b>বছর ভিত্তিক মামলার তালিকা</b></h6>
                        </div>

                  </div>




      <div class="card-body ">
        <div class="card p-3 mt-0 mb-3 text-center">


                <h5 class="mb-0">@php

                if(isset($_GET['filing_year'])){
                    $filing_year = $_GET['filing_year'];
                }else{
                    $filing_year = date('Y');
                }

                @endphp

                {{ trans2bn($filing_year) }}ইং সালে দায়েরী বিচারাধীন মোট মামলাঃ {{trans2bn($cases->count())}} </h5>

        </div>

     <!-- <table class="table table-striped table-bordered mb-0" style="width:100%"> -->
<table id="example" class="table table-striped table-bordered mb-0" style="width:100%">
        <thead style="background-color: darkgreen;">
            <tr>
              <td class="text-center text-white" style="width: 8%">SL</td>
              <td class="text-center text-white" style="width: 17%">Case no</td>
              <td class="text-center text-white" style="width: 20%">Filing Date</td>
              <td class="text-center text-white" style="width: 20%">Next Date</td>
              <td class="text-center text-white" style="width: 35%">Fixed for</td>
              <td class="text-center text-white" style="width: 35%">Month/Year</td>
            </tr>
        </thead>
        <tbody>
            
            @foreach($cases as $sl => $case)
                <tr class="text-center">
                    <td>{{ $sl+1 }}</td>
                    <td>{{ trans2bn($case->caseno) }}</td>
                    <td> @if($case->filing_date == "1970-01-01" || $case->filing_date=="0000-00-00") {{ '' }} @else {{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($case->filing_date)))))) }} @endif </td>
                    <td> @if($case->n_date == "1970-01-01" || $case->n_date=="0000-00-00") {{ '' }} @else {{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($case->n_date)))))) }} @endif </td>
                    <td>{{ trans2bn($case->n_for) }}</td>
                    <td>{{ trans2bn(date('M/Y', strtotime($case->filing_date)) )}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
  </div>
    </div>

    </div>
</div>
@php
    function trans2bn($number){
      $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
      $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");

      $bn_number = str_replace($search_array, $replace_array, $number);

      return $bn_number;
    }
@endphp
@endsection

