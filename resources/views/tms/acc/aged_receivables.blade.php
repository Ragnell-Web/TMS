@extends('master')

@section('title', 'TMS | Aged Receivables')

@section('content')
<?php

date_default_timezone_set('Asia/Calcutta');
$tgl = date('Y-m-d');

?>
<div class="main-content-inner">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>
<div class="page-title-area">
    <div class="row mb-5">
        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="printItem">
                    Print Item
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Aged Receivables</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithCustomer">Start with Customer :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startWithCustomer" autocomplete="off" class="form-control form-control-sm" id="startWithCustomer" value="{{$datas[0]['custcode']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithCustomer">End with Customer :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endWithCustomer" autocomplete="off" class="form-control form-control-sm" id="endWithCustomer" value="{{$datas[1]['custcode']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="asOfDate">As of Date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="asOfDate" autocomplete="off" class="form-control form-control-sm" id="asOfDate" value="{{$tgl}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="invoiceDate">Invoice Date :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="invoiceDate" id="dataDue" value="due" checked>
                                        <label class="form-check-label" for="dataDue">
                                            Due
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="invoiceDate" id="dataWritten" value="witten">
                                        <label class="form-check-label" for="dataWritten">
                                            Written
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="recalculate">Recalculate ? :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="recalculate" id="dataNo" value="no">
                                        <label class="form-check-label" for="dataNo">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="recalculate" id="dataYes" value="witten" checked>
                                        <label class="form-check-label" for="dataYes">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="paymentAsOfDate">Payment As of Date ? :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="paymentAsOfDate" id="dataNo" value="no" checked>
                                        <label class="form-check-label" for="dataNo">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="paymentAsOfDate" id="dataYes" value="yes">
                                        <label class="form-check-label" for="dataYes">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="reportFrom">Report From</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="summary" selected>Summary</option>
                                        <option value="detail">Detail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col-md-6">
                                    <label for="printTo">Print to</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="printer" selected>
                                            Printer | Print to Default Printer
                                        </option>
                                        <option value="prompt">
                                            Prompt | Prompt for Printer Selection
                                        </option>
                                        <option value="preview">
                                            Preview | Preview Printout
                                        </option>
                                        <option value="cancel">
                                            Cancel | Cancel Printing
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade satu" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="header-title">Entry of Invoice Data</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                                {{ csrf_field() }}
                                <thead class="text-center">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="15%">Id</th>
                                        <th width="45%">Company</th>
                                        <th width="30%">Contact</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="height: 45vh;overflow: auto;">
                            <table class="table table-hover" id="tBodyCustomer">
                                <tbody id="tBodyCustomer">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade dua" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="header-title">Entry of Invoice Data</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                                {{ csrf_field() }}
                                <thead class="text-center">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="15%">Id</th>
                                        <th width="45%">Company</th>
                                        <th width="30%">Contact</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="height: 45vh;overflow: auto;">
                            <table class="table table-hover" id="tBodyCustomer">
                                <tbody id="tBodyCustomer2">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/scriptAgedReceivables.js')}}"></script>
@endsection
