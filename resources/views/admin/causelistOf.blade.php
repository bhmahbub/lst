@extends('admin.layouts.app')

@section('adminpagename')
কজ্বলিস্ট যুক্তকরণ
@endsection

@section('adminmain')


<div class="widget widget-content-area mx-auto mb-3">
  <div class="widget-one">


        <div class="card p-4">
            <form method="POST" action="{{ route('causelistOf') }}" class="col-md-6 mx-auto">
              @csrf
                      <div class="input-group input-group-sm">

                        <div class="input-group-prepend">
                          <span class="input-group-text px-5 text-white" style="background: darkgreen; border: 1px solid darkgreen;" id="inputGroup-sizing-sm" > তারিখ ভিত্তিক কজ্বলিস্ট</span>
                        </div>
                        <select class="form-control text-center" name="cl_date" onchange="this.form.submit();" style="border: 1px solid darkgreen;">
                          <option class="my-1" selected>তারিখ</option>
                          @php
                            $dd_cl_dates = DB::table('cl_dates')
                                ->orderby('cl_date', 'DESC')
                                ->get();
                          @endphp
                          @foreach ($dd_cl_dates as $i => $dd_cl_date)
                          <option value="{{ $dd_cl_date->cl_date }}">{{ trans2bn(date('d/m/Y', strtotime(str_replace("-", "/", $dd_cl_date->cl_date)))) }}</option>
                          @endforeach
                        </select>
                      </div>

            </form>
        </div>

</div>
</div>
<div class="widget widget-content-area mb-2">


    <div class="widget-one">

      <div class="card">
                    <div class="card-header">

                        <div class="col-md-12 mb-0"><h6 class="mb-0"><b>{{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($cl_date)))))) }} ইং তারিখ এর কজ্বলিস্ট</b></h6>
                        </div>

                    </div>
      <div class="card-body">
        <table class="table table-striped table-bordered table-responsive-sm text-center mb-0">
              <thead class="" style="">
                <th class="bg-success font-weight-normal text-white">ক্রমিক নং</th>
                <th class="bg-success font-weight-normal text-white">মামলার নম্বর</th>
                <th class="bg-success font-weight-normal text-white">কার্যক্রম</th>
                <th class="bg-success font-weight-normal text-white">পরবর্তী তারিখ</th>
                <th class="bg-success font-weight-normal text-white">সংক্ষিপ্ত আদেশ</th>
                <th class="bg-success font-weight-normal text-white">মন্তব্য</th>
              </thead>
              <tbody>
           @foreach ($cl as $i => $dt)
               <tr class="">
                  <td>{{ trans2bn($i+1) }}</td>
                  <td>{{ trans2bn($dt->caseno) }}</td>
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
                <td>{{ $dt->n_for }}</td>
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
