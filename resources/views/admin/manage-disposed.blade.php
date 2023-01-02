@extends('admin.layouts.app')

@section('adminpagename')
    নিষ্পত্তি ব্যবস্থাপনা
@endsection

@section('adminmain')
    <div class="widget widget-content-area mx-auto mb-3">
        <div class="widget-one">


            <div class="card p-4">
                <form method="get" action="" class="col-md-6 mx-auto">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label class="input-group-text px-3 text-white" for="inputGroupSelect01"
                                style="background: darkgreen; border: 1px solid darkgreen;">মাস ভিত্তিক</label>

                        </div>
                        <select class="custom-select text-center" id="inputGroupSelect01" name="month" required
                            style="border: 1px solid darkgreen;">
                            <option selected disabled>মাস</option>
                            <option value="01">জানুয়ারী</option>
                            <option value="02">ফেব্রুয়ারী</option>
                            <option value="03">মার্চ</option>
                            <option value="04">এপ্রিল</option>
                            <option value="05">মে</option>
                            <option value="06">জুন</option>
                            <option value="07">জুলাই</option>
                            <option value="08">আগস্ট</option>
                            <option value="09">সেপ্টেম্বর</option>
                            <option value="10">অক্টোবর</option>
                            <option value="11">নভেম্বর</option>
                            <option value="12">ডিসেম্বর</option>
                        </select>
                        <select class="custom-select text-center" id="inputGroupSelect01" name="year" required
                            style="border: 1px solid darkgreen;">
                            <option selected disabled>বছর</option>
                            @for ($i = date('Y'); $i >= 2022; $i--)
                                <option value="{{ $i }}">{{ trans2bn($i) }}</option>
                            @endfor
                        </select>
                        <div class="input-group-append">
                            <button class="btn text-white px-3" type="submit"
                                style="background: darkgreen; border: 1px solid darkgreen;">সাবমিট</button>
                        </div>
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

    <div class="widget widget-content-area mb-2">


        <div class="widget-one">

            <div class="card">
                <div class="card-header">

                    <div class="col-md-12 mb-0 pl-0 d-flex">
                        <div class="col-md-9 d-flex align-items-center">
                            <h5 class="mb-0"><b>{{ trans2bn($my) }} মাসের নিষ্পত্তি</b> (মোট {{ trans2bn($count) }} টি)
                            </h5>
                        </div>

                        <div class="col-md-3"><input type="search" class="form-control form-control-sm text-center"
                                id="search" placeholder="খুঁজুন"></div>


                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered text-center table-responsive mb-0">
                        <thead class="text-dark" style="">
                            <th class="text-dark">ক্রমিক নং</th>
                            <th class="text-dark">মামলার নম্বর</th>
                            <th class="text-dark">তারিখ</th>
                            <th class="text-dark">সংক্ষিপ্ত আদেশ</th>
                            <th class="text-dark">অবস্থা</th>
                            <th class="text-dark">আদেশ দেখুন</th>
                            <th class="text-dark">আদেশ ডাউনলোড</th>
                            <th class="text-dark">এডিট</th>
                        </thead>

                        <tbody id="table">

                            @foreach ($disposedcases as $sl => $case)
                                <tr class="text-center">
                                    <td>{{ trans2bn($sl + 1) }}</td>
                                    <td>{{ trans2bn($case->caseno) }}</td>
                                    <td>
                                        @if ($case->c_date == '1970-01-01' || $case->c_date == '0000-00-00')
                                            {{ '' }}
                                        @else
                                            {{ trans2bn(str_replace('-', '/', date('d-m-Y', strtotime($case->c_date)))) }}
                                        @endif
                                    </td>

                                    <td>{{ trans2bn($case->n_for) }}</td>
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
                                    <td><button class="btn btn-link" type="submit" data-toggle="modal"
                                            data-target="{{ '#disposal_edit' . $case->caseid . 'Modal' }}"><i
                                                class="fa-solid fa-marker"></i></button></td>
                                </tr>


                                <!-- Modal -->
                                <form action="{{ route('disposalUpdate.action') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal fade" id="{{ 'disposal_edit' . $case->caseid . 'Modal' }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header mx-5 mt-2">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans2bn($case->caseno) }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body mx-5">
                                                    <div class="row my-3" hidden>
                                                        <div class="col-md-5">
                                                            <h6>কেইস আইডি:</h6>
                                                        </div>
                                                        <div class="col-md-7"><input name="caseid"
                                                                class="form-control form-control-sm" type="text"
                                                                value="{{ $case->caseid }}"></div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">
                                                            <h6>রায়/আদেশের তারিখ:</h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ trans2bn(date('d/m/Y', strtotime(str_replace('-', '/', $case->c_date)))) }}
                                                        </div>
                                                        <input type="text" name="date_final_result" value="{{ $case->c_date }}" hidden>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">
                                                            <h6>সংক্ষিপ্ত আদেশ:</h6>
                                                        </div>
                                                        <div class="col-md-7">{{ trans2bn($case->n_for) }}</div>
                                                        <input type="text" name="final_result" value="{{ $case->n_for }}" hidden>
                                                    </div>
                                                    <div class="row my-1">
                                                        <div class="col-md-5">
                                                            <h6>মামলার অবস্থা:</h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control form-control-sm px-1"
                                                                name="status">
                                                                <option value="{{ $case->status }}" class="my-1" selected>{{ trans2bn($case->status) }}
                                                                </option>
                                                                <option value="Disposed">
                                                                    নিষ্পত্তিকৃত</option>
                                                                <option value="Under Trial">
                                                                    বিচারাধীন</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col-md-5">
                                                            <h6>পূর্ণাঙ্গ আদেশ:</h6>
                                                        </div>
                                                        <div class="col-md-7 text-danger">@if ($case->pdf != '')
                                                             {{ trans2bn($case->pdf) }}
                                                            @else
                                                            {{ 'রায়/আদেশ আপলোড করুন' }}
                                                        @endif</div>
                                                    </div>
                                                    <div class="row my-1">
                                                        <div class="col-md-5">
                                                            <h6>রায়/আদেশ আপলোড:</h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{-- <select class="form-control form-control-sm px-1"
                                                                name="status">
                                                            </select> --}}
                                                            <input type="file" name="pdf">
                                                            {{-- <span>{{ trans2bn($case->pdf) }}</span> --}}
                                                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


    @php
        function trans2bn($number)
        {
            $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'LST', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Under Trial', 'Disposed'];
            $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'এলএসটি', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'বিচারাধীন', 'নিষ্পত্তিকৃত'];

            $bn_number = str_replace($search_array, $replace_array, $number);

            return $bn_number;
        }

    @endphp
@endsection
