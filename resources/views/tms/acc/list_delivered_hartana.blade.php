@extends('master')
@section('title', 'TMS | List Of Item Delivered (Hartana)')
@section('content')
<?php

$tgl = date('Y-m');
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
                        <h4 class="card-header-title">List Of Item Delivered (Hartana)</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="startWithDate">Start with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="startWithDate" autocomplete="off" class="form-control form-control-sm" id="startWithDate" value="{{firstDay()}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="endWithDate">End with date :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="endWithDate" autocomplete="off"
                                        class="form-control form-control-sm" id="endWithDate" value="{{lastday()}}" disabled>
                                </div>
                            </div>
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
                                    <label for="reportTitle">Report Title :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="reportTitle" autocomplete="off"
                                        value="LIST OF RAW MATERIAL SOLD               " class="form-control form-control-sm"
                                        id="reportTitle">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="dataSelection">Data Selection :</label>
                                </div>
                                <div class="col-md-6 d-flex flex-row">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataAll"
                                            value="all">
                                        <label class="form-check-label" for="dataAll">
                                            All
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataPosted"
                                            value="posted">
                                        <label class="form-check-label" for="dataPosted">
                                            Posted
                                        </label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="dataSelection" id="dataOpen"
                                            value="open">
                                        <label class="form-check-label" for="dataOpen">
                                            Open
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="dataSelection"
                                            id="dataVoided" value="voided">
                                        <label class="form-check-label" for="dataVoided">
                                            voided
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="recalculateCost">Recalculate Cost</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="yes" selected>Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="reportFrom">Report From</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="detail">Detail</option>
                                        <option value="summary" selected>Summary</option>
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
                            <th width='20%'>Item Code</th>
                            <th width='20%'>Part No.</th>
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
                            <th width='20%'>Item Code</th>
                            <th width='20%'>Part No.</th>
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
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/scriptListDelivered.js')}}"></script>
@endsection
