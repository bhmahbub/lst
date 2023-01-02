@extends('admin.layouts.app')


@section('adminpagename')
    সকল মামলার তালিকা
@endsection

@section('adminmain')
    <div class="widget widget-content-area mb-3">
        <div class="widget-one">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 mb-0">
                        <h6 class="mb-0"><b>সকল মামলার তালিকা</b></h6>
                    </div>
                </div>
                <div class="card-body ">
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'lst_laravel');

                    $cases = mysqli_query($conn, 'SELECT * FROM cases WHERE status = "Disposed" ORDER BY date_final_result DESC');
                    // $cases = DB::table('cases')->where('status', '=', 'Disposed')->orderby('date_final_result', 'DESC')->orderBy('caseno')->get();
                    $count = mysqli_num_rows($cases);
                    while ($case = mysqli_fetch_assoc($cases)) {
                        $id = $case['id'];
                        $fr = $case['n_for'];

                        // $update =  mysqli_query($conn, "UPDATE cases SET final_result='$fr' WHERE id=$id");
                    }

                    ?>
                    <div class="card text-center mb-3">
                        <h5 class="mb-0 py-3">বিচারাধীন মোট মামলা : <span class="text-bold">{{ $count }}</span></h5>
                    </div>

                    <table id="example" class="table table-striped table-bordered mb-0" style="width:100%">
                        <thead style="background-color: darkgreen;">
                            <tr>
                                <td class="text-center text-white" style="width: 8%">SL</td>
                                <td class="text-center text-white" style="width: 17%">Case ID</td>
                                <td class="text-center text-white" style="width: 17%">Case NO</td>
                                <td class="text-center text-white" style="width: 20%">Next For</td>
                                <td class="text-center text-white" style="width: 20%">Disposal Date</td>
                                <td class="text-center text-white" style="width: 20%">Final Result</td>
                                <td class="text-center text-white" style="width: 17%">status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cases as $case)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $case['id'] }}</td>
                                    <td>{{ $case['caseno'] }}</td>
                                    <td>{{ $case['n_for'] }}</td>
                                    <td>{{ $case['date_final_result'] }}</td>
                                    <td>{{ $case['final_result'] }}</td>
                                    <td>{{ $case['status'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
