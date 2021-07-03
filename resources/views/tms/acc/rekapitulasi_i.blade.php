@extends('master')

@section('title', 'TMS | Rekapitulasi Penjualan I')

@section('content')

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
                        <h4 class="card-header-title">Rekapitulasi Penjualan I</h4>
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
                                        <input class="form-check-input" type="radio" name="printBy" id="item" value="item">
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
                                        <input class="form-check-input" type="radio" name="printBy" id="number" value="number">
                                        <label class="form-check-label" for="number">
                                            Number
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="printBy" id="combination" value="combination" checked>
                                        <label class="form-check-label" for="combination">
                                            Combination
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row mt-2">
                                <div class="col-md-6">
                                    <label for="startPartNo">Start with Part No :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startPartNo" autocomplete="off" class="form-control form-control-sm" id="startPartNo" value="{{$datas[0]['PART_NO']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endPartNo">End with Part No :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endPartNo" autocomplete="off" class="form-control form-control-sm" id="endPartNo" value="{{$datas[1]['PART_NO']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithDate">Start with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="startWithDate" autocomplete="off" class="form-control form-control-sm" id="startWithDate" value="{{$datas[2]['written']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithDate">End with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="endWithDate" autocomplete="off" class="form-control form-control-sm" id="endWithDate" value="{{$datas[3]['written']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithCustomer">Start with Customer :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startWithCustomer" autocomplete="off" class="form-control form-control-sm" id="startWithCustomer" value="{{$datas[4]['custcode']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithCustomer">End with Customer :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endWithCustomer" autocomplete="off" class="form-control form-control-sm" id="endWithCustomer" value="{{$datas[5]['custcode']}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithSJNo">Start with SJ No :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="startWithSJNo" autocomplete="off" class="form-control form-control-sm" id="startWithSJNo" value="{{ $datas[6]['do_no'] }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithSJNo">End with SJ No :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="endWithSJNo" autocomplete="off" class="form-control form-control-sm" id="endWithSJNo" value="{{ $datas[7]['do_no'] }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="reportTitle">Report Title :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="reportTitle" autocomplete="off" value="LAPORAN PENJUALAN" class="form-control form-control-sm" id="reportTitle">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="dataStatus">Data Status :</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" id="dataStatus" aria-label="Default select example">
                                        <option value="all" selected>All</option>
                                        <option value="invoiced">Invoiced</option>
                                        <option value="not invoiced">Not Invoiced</option>
                                    </select>
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
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataOpen" value="open">
                                        <label class="form-check-label" for="dataOpen">
                                            Open
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataPosted" value="posted">
                                        <label class="form-check-label" for="dataPosted">
                                            Posted
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
                                    <label for="sortBy">Sort By :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dataItem" value="item">
                                        <label class="form-check-label" for="dataItem">
                                            Item
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dateDate" value="date">
                                        <label class="form-check-label" for="dateDate">
                                            Date
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dataCustomer" value="customer">
                                        <label class="form-check-label" for="dataCustomer">
                                            Customer
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="sortBy" id="dataNumber" value="customer">
                                        <label class="form-check-label" for="dataNumber">
                                            Number
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="groupBy">Group By :</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" id="groupBy" aria-label="Default select example">
                                        <option value="none" selected>None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="reportFrom">Report From :</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="summary" selected>Summary</option>
                                        <option value="sales">Sales</option>
                                        <option value="due">Due</option>
                                        <option value="detail">Detail</option>
                                        <option value="vat">VAT</option>
                                        <option value="ttf">TTF</option>
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
                            <th width='20%'>Part No.</th>
                            <th width='20%'>Item Code</th>
                            <th width='20%'>Description</th>
                            <th width='20%'>Type</th>
                            <th width='10%'>Unit</th>
                            <th width='10%'>Qty</th>
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
                            <th width='20%'>Part No.</th>
                            <th width='20%'>Item Code</th>
                            <th width='20%'>Description</th>
                            <th width='20%'>Type</th>
                            <th width='10%'>Unit</th>
                            <th width='10%'>Qty</th>
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

    <!-- Modal -->
    <div class="modal fade lima" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <th width='10%'>SJ No.</th>
                            <th width='10%'>Ref No</th>
                            <th width='15%'>Written</th>
                            <th width='20%'>PO No.</th>
                            <th width='20%'>DN No.</th>
                            <th width='25%'>Company Name</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="height: 35vh;overflow: auto;">
                    <div class="col-12">
                      <table class="table table-hover">
                        <tbody id="tBodySJ"></tbody>
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
    <div class="modal fade enam" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <th width='10%'>SJ No.</th>
                            <th width='10%'>Ref No</th>
                            <th width='15%'>Written</th>
                            <th width='20%'>PO No.</th>
                            <th width='20%'>DN No.</th>
                            <th width='25%'>Company Name</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="height: 35vh;overflow: auto;">
                    <div class="col-12">
                      <table class="table table-hover">
                        <tbody id="tBodySJ2"></tbody>
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
</div>
<script src="{{asset('/js/scriptRekapitulasii.js')}}"></script>
@endsection
