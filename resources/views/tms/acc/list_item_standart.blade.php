@extends('master')

@section('title', 'TMS | List Of Item Sold (Standart)')

@section('content')
<?php

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
                        <h4 class="card-header-title">List of Item Sold (Standart)</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-row mb-2 printBy">
                                <div class="col-md-2">
                                    <label for="printBy">Print By :</label>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="printBy" id="item" value="item" checked>
                                        <label class="form-check-label" for="item">
                                            Item
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="printBy" id="date"  value="date">
                                        <label class="form-check-label" for="date">
                                            Date
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="printBy" id="customer" value="customer">
                                        <label class="form-check-label" for="customer">
                                            Customer
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="printBy" id="sales" value="sales">
                                        <label class="form-check-label" for="sales">
                                            Sales
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="printBy" id="combination" value="combination">
                                        <label class="form-check-label" for="combination">
                                            Combination
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row mt-2">
                                <div class="col-md-6">
                                    <label for="startWithItemCode">Start with Item Code :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startWithItemCode" autocomplete="off" class="form-control form-control-sm" id="startWithItemCode" value="{{$datas[0]['ITEMCODE']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithItemCode">End with Item Code :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endWithItemCode" autocomplete="off" class="form-control form-control-sm" id="endWithItemCode" value="{{$datas[1]['ITEMCODE']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithDate">Start with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="startWithDate" autocomplete="off" class="form-control form-control-sm" id="startWithDate" value="{{$datas[2]['written']}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithDate">End with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="endWithDate" autocomplete="off" class="form-control form-control-sm" id="endWithDate" value="<?=$tgl ?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithCustomer">Start with Customer :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startWithCustomer" autocomplete="off" class="form-control form-control-sm" id="startWithCustomer" value="{{$datas[4]['custcode']}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithCustomer">End with Customer :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endWithCustomer" autocomplete="off" class="form-control form-control-sm" id="endWithCustomer" value="{{$datas[5]['custcode']}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithSales">Start with Sales :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startWithSales" autocomplete="off" class="form-control form-control-sm" id="startWithSales" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithSales">End with Sales :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endWithSales" autocomplete="off" class="form-control form-control-sm" id="endWithSales" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="reportTitle">Report Title :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="reportTitle" autocomplete="off" value="LIST OF RECEIVABLE ITEMS" class="form-control form-control-sm" id="reportTitle">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="xlsFileName">XLS File Name :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="xlsFileName" autocomplete="off" class="form-control form-control-sm" id="xlsFileName">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="dataSelection">Data Selection :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataAll" value="all">
                                        <label class="form-check-label" for="dataAll">
                                            All
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataPosted" value="posted">
                                        <label class="form-check-label" for="dataOpen">
                                            Posted
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataOpen" value="open">
                                        <label class="form-check-label" for="dataOpen">
                                            Open
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataVoided" value="voided">
                                        <label class="form-check-label" for="dataVoided">
                                            voided
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="linkToTTF">Link to TTF :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="linkToTTF" id="linkItem" value="item">
                                        <label class="form-check-label" for="linkItem">
                                            Item
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="linkToTTF" id="linkDate" value="date">
                                        <label class="form-check-label" for="linkDate">
                                            Date
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="linkToTTF" id="linkCustomer" value="customer">
                                        <label class="form-check-label" for="linkCustomer">
                                            Customer
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="linkToTTF" id="linkSales" value="sales">
                                        <label class="form-check-label" for="linkSales">
                                            Sales
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
                    <div class="col-12">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th width='12%'>Item Code</th>
                            <th width='14%'>Part No.</th>
                            <th width='14%'>Description</th>
                            <th width='14%'>Type</th>
                            <th width='22%'>Unit</th>
                            <th width='24%'>Qty</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="height: 35vh;overflow: auto;">
                    <div class="col-12">
                      <table class="table table-hover">
                        <tbody id="tBodyItem"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
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
                    <div class="col-12">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th width='12%'>Invoice</th>
                            <th width='12%'>PPn No.</th>
                            <th width='12%'>Ref No.</th>
                            <th width='12%'>OR No.</th>
                            <th width='20%'>Date</th>
                            <th width='22%'>Company</th>
                            <th width='10%'>ID</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="height: 35vh;overflow: auto;">
                    <div class="col-12">
                      <table class="table table-hover">
                        <tbody id="tBodyItem2"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal2">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade tiga" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal3">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade empat" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal3">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/scriptListItemStandart.js')}}"></script>
@endsection
