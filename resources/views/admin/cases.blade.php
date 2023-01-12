@extends('admin.layouts.app')

@section('adminpagename')
মামলা যুক্তকরণ
@endsection

@section('adminmain')

<div class="widget widget-content-area mx-auto mb-3">
  <div class="widget-one">
    <div class="card px-3 pt-3">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-new-case-tab" data-toggle="tab" data-target="#nav-new-case" type="button" role="tab" aria-controls="nav-new-case" aria-selected="true"><b>মামলা দায়ের</b></button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-new-case" role="tabpanel" aria-labelledby="nav-new-case-tab">
        <div class="card-body px-0 pt-3 mb-0">

            <form class="mb-0" method="POST" action="{{ route('cases.store') }}">
              @csrf
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">মামলা নং</span>
                </div>
                <input class="form-control" type="text" name="num" placeholder="নম্বর" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

                <input class="form-control" type="text" name="year" placeholder="বছর" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

                <div class="input-group-prepend ml-2">
                  <span class="input-group-text" id="inputGroup-sizing-sm">দায়েরের তারিখ</span>
                </div>

                <input type="text" class="form-control" name="filing_date" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">


              </div>

              <div class="input-group input-group-sm">
                <div class="input-group-prepend" >
                  <span class="input-group-text" id="inputGroup-sizing-sm">পরবর্তী তারিখ</span>
                </div>
                <input type="text" class="form-control " name="n_date" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <div class="input-group-prepend ml-2" >
                  <span class="input-group-text" id="inputGroup-sizing-sm">কী জন্য ধার্য</span>
                </div>
                <input type="text" class="form-control " name="n_for" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <button class="btn btn-sm btn-outline-success rounded px-5 py-0" style="margin-left: 10px;" type="submit"><b>যুক্ত করুন</b></button>
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
</div>
</div>

@if (session('status'))
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ session('status') }}</strong>
</div>
@elseif (session('message'))
<div class="alert alert-warning" id="warning-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ session('message') }}</strong>
</div>
@endif

<div class="widget widget-content-area mb-2">


    <div class="widget-one">

        <div class="card">
                    <div class="card-header">

                        <div class="col-md-12 mb-0"><h6 class="mb-0"><b>সর্বশেষ সংযুক্ত মামলা সমূহ</b></h6>
                        </div>

                  </div>
      <div class="card-body ">


    <table class="table table-striped table-bordered mb-0" style="width:100%">
        <thead style="background-color: darkgreen;">
            <tr>
              <td class="text-center text-white" style="width: 8%">SL</td>
              <td class="text-center text-white" style="width: 17%">Case no</td>
              <td class="text-center text-white" style="width: 20%">Filing Date</td>
              <td class="text-center text-white" style="width: 20%">Next Date</td>
              <td class="text-center text-white" style="width: 35%">Fixed for</td>
            </tr>
        </thead>
        <tbody>
@php
    function trans2bn($number){
      $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
      $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");

      $bn_number = str_replace($search_array, $replace_array, $number);

      return $bn_number;
    }

              $cases = DB::table('cases')->orderby('id', 'DESC')->limit(5)->get();
            @endphp
          @foreach($cases as $i => $case)
            <tr class="text-center">
                <td>{{ trans2bn($i+1) }}</td>
                <td>{{ trans2bn($case->caseno) }}</td>
                <td> @if($case->filing_date == "1970-01-01" || $case->filing_date=="0000-00-00") {{ '' }} @else {{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($case->filing_date)))))) }} @endif </td>
                <td> @if($case->n_date == "1970-01-01" || $case->n_date=="0000-00-00") {{ '' }} @else {{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($case->n_date)))))) }} @endif </td>
                <td>{{ $case->n_for }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
    </div>

    </div>
</div>

@endsection
