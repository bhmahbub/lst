@extends('admin.layouts.app')

@section('adminpagename')
কজ্বলিস্ট যুক্তকরণ
@endsection

@section('adminmain')

<div class="widget widget-content-area mx-auto mb-3">
  <div class="widget-one">


        <div class="card p-4">
            <form method="POST" action="{{ route('causelist.store') }}" class="col-md-6 mx-auto">
              @csrf
                      <div class="input-group input-group-sm">

                        <div class="input-group-prepend">
                          <span class="input-group-text px-5 text-white" style="background: darkgreen; border: 1px solid darkgreen;" id="inputGroup-sizing-sm" > কজ্বলিস্ট যুক্তকরণ</span>
                        </div>
                        <input type="text" class="form-control text-center @error('cl_date') is-invalid @enderror" name="cl_date" placeholder="তারিখ"  value="{{ old('cl_date') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required onchange="this.form.submit();" style="border: 1px solid darkgreen;">
                        @error('cl_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

            </form>
        </div>

</div>
</div>

@if(session('status'))
  {!! session('status') !!}
@endif
<div class="widget widget-content-area mb-2">


    <div class="widget-one">

<div class="card">
                    <div class="card-header">

                        <div class="col-md-12 mb-0"><h6 class="mb-0"><b>সর্বশেষ কজ্বলিস্ট এর তারিখ সমূহ</b></h6>
                        </div>

                  </div>
      <div class="card-body">
        <div class="row mx-1">
            @php
              $cl_dates = DB::table('cl_dates')->orderby('cl_date', 'DESC')->limit(18)->get();
            @endphp
            @foreach($cl_dates as $i => $cl_date)

              <div class="card col-md-2 p-3 text-center my-1"><form method="POST" action="{{ 'causelistOf' }}">@csrf <input hidden type="text" name="cl_date" value="{{ $cl_date->cl_date }}"><b class="text-dark">{{ trans2bn(str_replace("-", "/",(date("d-m-Y",(strtotime($cl_date->cl_date)))))) }}</b>
              <button class="btn btn-link border-0 bg-transparent" type="submit">(
                @php
                  $total = DB::table('data')->where('c_date','=', $cl_date->cl_date)->get();
                @endphp
            {{ trans2bn($total->count()) }} টি মামলা)</button></form></div>
            @endforeach
        </div>
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
