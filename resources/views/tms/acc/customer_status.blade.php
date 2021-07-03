@extends('master')

@section('title', 'TMS | Customer Status')

@section('content')

<div class="main-content-inner">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
<div class="page-title-area">
    <div class="row">
        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="recalcItem">
                    Recalc
                </a>
            </div>
        </div>

        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="updateItem">
                    Update
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Customer Status</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="row mb-3">
                                <div class="col-2">
                                    <label for="ar_update">As of Date : </label>
                                </div>
                                <div class="col-2">
                                    <input type="date" id="ar_update" name="ar_update" placeholder="dd/mm/yyyy"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row" style="height: 35vh;overflow: auto;">
                                <div class="col-12">
                                    <table class="table table-striped table-dark" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>Balance</th>
                                                <th>
                                                    < 8 Hari</th> <th>8 - 14 Hari
                                                </th>
                                                <th>15 - 45 Hari</th>
                                                <th>> 45 Hari</th>
                                                <th>ST</th>
                                                <th>New</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tBodyCustomer">
                                            @foreach ($customerList as $data)
                                            <tr>
                                                <td>{{$data['company']}}</td>
                                                <td>{{$data['balance']}}</td>
                                                <td>{{$data['ar_00']}}</td>
                                                <td>{{$data['ar_01']}}</td>
                                                <td>{{$data['ar_02']}}</td>
                                                <td>{{$data['ar_03']}}</td>
                                                <td>{{$data['status']}}</td>
                                                <td>{{$data['new_status']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/scriptCustomerStatus.js')}}"></script>
</div>
@endsection
