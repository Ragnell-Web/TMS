@extends('master')
@section('title', 'TMS | Invoice vs DO Item')
@section('content')
@php
date_default_timezone_set('Asia/Calcutta');
$tgl = date('Y-m-d',time());
function firstDay($month = '', $year = '')
{
    if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   return date('Y-m-d', $result);
}
function lastday($month = '', $year = '') {
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('Y-m-d', $result);
}
@endphp
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
                        <h4 class="card-header-title">List of Receivable Items</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithDate">Start with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="startWithDate" autocomplete="off"
                                        class="form-control form-control-sm" id="startWithDate" placeholder="../../.."
                                        value="{{firstDay()}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithDate">End with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="endWithDate" autocomplete="off"
                                        class="form-control form-control-sm" id="endWithDate" value="{{lastday()}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="sortBy">Sort By :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dataItem"
                                            value="item" checked>
                                        <label class="form-check-label" for="dataItem">
                                            Item
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dataInvoice"
                                            value="invoice">
                                        <label class="form-check-label" for="dataInvoice">
                                            Invoice
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dataCustomer"
                                            value="customer">
                                        <label class="form-check-label" for="dataCustomer">
                                            Customer
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="reportFrom">Report From</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" disabled>
                                        <option value="detail">Detail</option>
                                        <option value="letter" selected>Letter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col-md-6">
                                    <label for="printTo">Print to</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="printer">
                                            Printer | Print to Default Printer
                                        </option>
                                        <option value="prompt">
                                            Prompt | Prompt for Printer Selection
                                        </option>
                                        <option value="preview" selected>
                                            Screen | Preview Printout
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


</div>
<script src="{{ asset('/js/scriptInvoiceDoItem.js') }}"></script>
@endsection
