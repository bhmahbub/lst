@extends('admin.layouts.app')

@section('adminpagename')
আপডেট পেন্ডিং
@endsection

@section('adminmain')


@if(session('status'))
  {!! session('status') !!}
@endif
<div class="widget widget-content-area mb-2">


    <div class="widget-one">

<div class="card">
                    <div class="card-header">

                        <div class="col-md-12 mb-0 pl-0"><h6 class="mb-0"><b>কজ্বলিস্ট এর আপডেট পেন্ডিং</b> <span class="ml-2">({{ trans2bn($count) }} টি এন্ট্রি)</span></h6>
                        </div>

                  </div>
      <div class="card-body">
        <table class="table table-striped table-bordered table-responsive-sm text-center mb-0">
              <thead class="" style="">
                <th class="bg-success font-weight-normal text-white" style="width: 10%">ক্রমিক নং</th>
                <th class="bg-success font-weight-normal text-white" style="width: 20%">মামলার নম্বর</th>
                <th class="bg-success font-weight-normal text-white" style="width: 15%">বর্তমান তারিখ</th>
                <th class="bg-success font-weight-normal text-white" style="width: 15%">কার্যক্রম</th>
                <th class="bg-success font-weight-normal text-white" style="width: 10%">পরবর্তী তারিখ</th>
                <th class="bg-success font-weight-normal text-white" style="width: 15%">সংক্ষিপ্ত আদেশ</th>
                <th class="bg-success font-weight-normal text-white" style="width: 15%">মন্তব্য</th>
              </thead>
              <tbody>
           @foreach ($cl as $i => $dt)
                                <tr class="">
                                    <td>{{ trans2bn($loop->iteration) }}</td>


                  <td>{{ trans2bn($dt->caseno) }}</td>
                  <td>
                    @if ($dt->c_date == '0000-00-00')
                        {{ '' }}
                    @elseif($dt->c_date == '1970-01-01')
                        {{ '' }}
                    @elseif($dt->c_date != '')
                        {{ trans2bn(date('d/m/Y', strtotime(str_replace('-', '/', $dt->c_date)))) }}
                    @endif
                </td>
                  <td>{{ $dt->c_for }}</td>
                  <td>
                    @if ($dt->n_date == '0000-00-00')
                        {{ '' }}
                    @elseif($dt->n_date == '1970-01-01')
                        {{ '' }}
                    @elseif($dt->n_date != '')
                        {{ trans2bn(date('d/m/Y', strtotime(str_replace('-', '/', $dt->n_date)))) }}
                    @endif
                </td>
                  <td>@if($dt->n_for = '') {{ '' }}

                    @else {{ $dt->n_for }}
                    @endif
                   </td>
                  <td>{{ $dt->remark }}</td>
                </tr>

            @endforeach


              </tbody>

            </table>
  </div>
    </div>

    </div>
</div>

@php
function trans2bn($number)
{
    $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'LST', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'এলএসটি', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];

    $bn_number = str_replace($search_array, $replace_array, $number);

    return $bn_number;
}

@endphp

@endsection

