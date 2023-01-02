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

                    $cases = mysqli_query($conn, 'SELECT d.*,c.caseno FROM data d LEFT OUTER JOIN cases c ON c.id=d.cases_id WHERE d.id IN (SELECT MAX(id) FROM data GROUP BY cases_id) order by d.cases_id');
                    $count = mysqli_num_rows($cases);
                    while ($case = mysqli_fetch_assoc($cases)) {
                        $cid = $case['cases_id'];
                        $nd = $case['n_date'];
                        $nf = $case['n_for'];
                        $fr = $case['n_for'];
                        $fd = $case['c_date'];

                        // $update =  mysqli_query($conn, "UPDATE cases SET n_date=$nd, n_for=$nf,final_result=$fr,date_final_result=$fd WHERE id=$cid");
                    }

                    ?>
                    <div class="card text-center mb-3">
                        <h5 class="mb-0 py-3">বিচারাধীন মোট মামলা : <span class="text-bold">{{ $count }}</span></h5>
                    </div>

                    <table id="example" class="table table-striped table-bordered mb-0" style="width:100%">
                        <thead style="background-color: darkgreen;">
                            <tr>
                                <td class="text-center text-white" style="width: 8%">SL</td>
                                <td class="text-center text-white" style="width: 8%">ID</td>
                                <td class="text-center text-white" style="width: 17%">Case ID</td>
                                <td class="text-center text-white" style="width: 17%">Case NO</td>
                                <td class="text-center text-white" style="width: 20%">C Date</td>
                                <td class="text-center text-white" style="width: 20%">C For</td>
                                <td class="text-center text-white" style="width: 20%">Next Date</td>
                                <td class="text-center text-white" style="width: 20%">Next For</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cases as $case)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $case['id'] }}</td>
                                    <td>{{ $case['cases_id'] }}</td>
                                    <td>{{ $case['caseno'] }}</td>
                                    <td>{{ $case['c_date'] }}</td>
                                    <td>{{ $case['c_for'] }}</td>
                                    <td>{{ $case['n_date'] }}</td>
                                    <td>{{ $case['n_for'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
