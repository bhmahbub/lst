@extends('layouts.app')

@section('pagename')
ইউজার ড্যাশবোর্ড
@endsection

@section('main')

<div class="widget widget-content-area mx-auto mb-3">
    <div class="widget-one">
      <div class="card px-3 pt-3">
        <div class="card col-md-6 mx-auto p-1 mb-3">

<div class="card px-3 pt-3 ">
              <form class="mb-0" method="POST" action="{{ route('dashboard.store') }}">
                @csrf

                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="input-group-text px-3" style="border: 1px solid #c4c7cb" for="inputGroupSelect01">মামলা নং</label>

                    </div>
                    <input class="form-control text-center" style="border: 1px solid #c4c7cb" type="text" name="num" placeholder="নম্বর" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <select class="custom-select text-center" style="border: 1px solid #c4c7cb " id="inputGroupSelect01" name="year" required>
                        <option selected disabled>বছর</option>
                        @for ($i = date('Y'); $i >= 2013; $i--)
                            <option value="{{ $i }}">{{ trans2bn($i) }}</option>
                        @endfor
                    </select>
                </div>
                <div class="input-group input-group-sm my-3">
                      <div class="input-group-append  mx-auto">
                        <button class="btn px-4" style="border: 1px solid #c4c7cb" type="submit">আপনার মামলা যোগ করুন</button>
                    </div>
                </div>
              </form>
            </div>


      </div>
    </div>
  </div>
  </div>

  @if(session('status'))
  <div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ session('status') }}</strong>
  </div>
  @elseif(session('error'))
  <div class="alert alert-warning" id="warning-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ session('error') }}</strong>
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
                <td class="text-center text-white" style="width: 20%">Next Date</td>
                <td class="text-center text-white" style="width: 35%">Order</td>
                <td class="text-center text-white" style="width: 35%">Status</td>
                <td class="text-center text-white" style="width: 35%">View</td>
                <td class="text-center text-white" style="width: 35%">Download</td>
              </tr>
          </thead>
          <tbody>
    @php
      function trans2bn($number){
        $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", 'Under Trial', 'Disposed');
        $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", 'বিচারাধীন', 'নিষ্পত্তিকৃত');

        $bn_number = str_replace($search_array, $replace_array, $number);

        return $bn_number;
      }
     @endphp
            @foreach($listOfCases as $i => $case)
              <tr class="text-center">
                  <td>{{ trans2bn($i+1) }}</td>
                  <td>{{ trans2bn($case->caseno) }}</td>
                  <td> @if($case->n_date == "1970-01-01" || $case->n_date=="0000-00-00") {{ '' }} @else {{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($case->n_date)))))) }} @endif </td>
                  <td>{{ $case->n_for }}</td>
                  <td>{{ trans2bn($case->status) }}</td>
                  <td>
                    @if ($case->pdf != '')
                    <a href="{{url('/viewpdf', $case->pdf)}}"><i class="fa-solid fa-tv"></i></a>
                        @else
                        {{ '' }}
                    @endif</td>
                    <td>
                        @if ($case->pdf != '')
                        <a href="{{url('/download', $case->pdf)}}"><i class="fa-solid fa-download"></i></a>
                            @else
                            {{ '' }}
                        @endif</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
      </div>

      </div>
  </div>
@endsection
