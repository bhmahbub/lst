@extends('admin.layouts.app')

@section('adminpagename')
    কজ্বলিস্ট আপডেট
@endsection

@section('adminmain')
    <div class="widget widget-content-area mx-auto mb-3">
        <div class="widget-one">


            <div class="card p-4">
                <form method="get" action="{{ route('causelist-update') }}" class="col-md-6 mx-auto">
                    <div class="input-group input-group-sm">

                        <div class="input-group-prepend">
                            <span class="input-group-text px-5 text-white"
                                style="background: darkgreen; border: 1px solid darkgreen;" id="inputGroup-sizing-sm"> তারিখ
                                ভিত্তিক কজ্বলিস্ট</span>
                        </div>

                        <select class="form-control text-center" name="cl_date" onchange="this.form.submit();"
                            style="border: 1px solid darkgreen;">
                            <option class="my-1" selected>তারিখ</option>
                            @php
                                $dd_cl_dates = DB::table('cl_dates')
                                    ->orderby('cl_date', 'DESC')
                                    ->get();
                            @endphp
                            @foreach ($dd_cl_dates as $i => $dd_cl_date)
                                <option value="{{ $dd_cl_date->cl_date }}">
                                    {{ trans2bn(date('d/m/Y', strtotime(str_replace('-', '/', $dd_cl_date->cl_date)))) }}</option>
                            @endforeach
                        </select>

                    </div>

                </form>
            </div>

        </div>
    </div>




    @if (session('status'))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('status') }}</strong>
        </div>
    @endif

    <!-- cl-record-update -->

    <div class="widget widget-content-area mb-2">


        <div class="widget-one">

            <div class="card">
                <div class="card-header">

                    <div class="col-md-12 mb-0 pl-0">
                        <h6 class="mb-0"><b>{{ trans2bn(str_replace('-', '/', date('d-m-Y', strtotime($cl_date)))) }} ইং তারিখ এর কজ্বলিস্ট</b></h6>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center table-responsive-sm mb-0">
                        <thead class="text-dark" style="">
                            <th class="text-dark">ক্রমিক নং</th>
                            <th class="text-dark">মামলার নম্বর</th>
                            <th class="text-dark">কার্যক্রম</th>
                            <th class="text-dark">পরবর্তী তারিখ</th>
                            <th class="text-dark">সংক্ষিপ্ত আদেশ</th>
                            <th class="text-dark">মন্তব্য</th>
                            <th class="text-dark">এডিট/ডিলিট</th>
                        </thead>
                        <tbody>
                            @foreach ($cl as $i => $dt)
                                <tr class="">
                                    <td>{{ trans2bn($i + 1) }}</td>
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
                                    <td>{{ $dt->n_for }} </td>
                                    <td>{{ $dt->remark }}</td>
                                    <td>
                                        <div class="d-flex"><button class="btn btn-sm btn-link m-1 px-2" data-toggle="modal" data-target="{{'#cl_edit'.$dt->id.'Modal'}}"><i
                                                    class="fa-solid fa-pencil text-success"></i></button><button
                                                class="btn btn-sm btn-link m-1 px-2"><i
                                                    class="fa-solid fa-trash text-danger"></i></button></div>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <form action="{{ route('causelistUpdate.action')}}" method="post">
                                @csrf
                                <div class="modal fade" id="{{'cl_edit'.$dt->id.'Modal'}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header mx-5 mt-2">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ trans2bn($dt->caseno) }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body mx-5">
                                                <div class="row mb-3" hidden>
                                                    <div class="col-md-4">
                                                        <h6>ডাটা আইডি:</h6>
                                                    </div>
                                                    <div class="col-md-8"><input name="id" class="form-control form-control-sm" type="text" value="{{ $dt->id }}"></div>
                                                </div>
                                                <div class="row my-3" hidden>
                                                    <div class="col-md-4">
                                                        <h6>কেইস আইডি:</h6>
                                                    </div>
                                                    <div class="col-md-8"><input name="caseid" class="form-control form-control-sm" type="text" value="{{ $dt->caseid }}"></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <h6>বর্তমান তারিখ:</h6>
                                                    </div>
                                                    <div class="col-md-8">{{ trans2bn(date('d/m/Y', strtotime(str_replace('-', '/', $dt->c_date)))) }}</div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-md-4">
                                                        <h6>কী জন্য ধার্য:</h6>
                                                    </div>
                                                    <div class="col-md-8">{{ $dt->c_for }}</div>
                                                </div>
                                                <div class="row my-1">
                                                    <div class="col-md-4">
                                                        <h6>পরবর্তী তারিখ:</h6>
                                                    </div>
                                                    <div class="col-md-8"><input name="n_date" class="form-control form-control-sm px-2" type="text" value="{{ trans2bn(date('d/m/Y', strtotime(str_replace('-', '/', $dt->n_date)))) }}"></div>
                                                </div>
                                                <div class="row my-1">
                                                    <div class="col-md-4">
                                                        <h6>সংক্ষিপ্ত আদেশ:</h6>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-control-sm px-1" name="n_for"
                                                        >
                                                        <option class="my-1" selected>{{ $dt->n_for }}</option>
                                                        @php
                                                            $stages = DB::table('stages')
                                                                ->orderby('stage_id')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($stages as $stage)
                                                            <option value="{{ $stage->stage_name }}">
                                                                {{ $stage->stage_name_bn }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-4">
                                                        <h6>মন্তব্য:</h6>
                                                    </div>
                                                    <div class="col-md-8"><input name="remark" class="form-control form-control-sm px-2" type="text"
                                                            value="{{ $dt->remark }}"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer mx-5 mb-2">
                                                <button type="button" class="btn btn-link"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
