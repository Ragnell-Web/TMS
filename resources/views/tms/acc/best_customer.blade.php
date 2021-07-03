@extends('master')
@section('title', 'TMS | Best Customer')
@section('content')
@php
date_default_timezone_set('Asia/Calcutta');
$tgl = date('Y-m-d',time());
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
                        <h4 class="card-header-title">Best Customer</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md">
                        <table class="table table-primary text-center">
                          <thead>
                            <tr>
                              <th colspan="2">Best Item</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th><label for="startWithDate">Start With Date</label></th>
                              <td><input type="date" name="startWithDate" autocomplete="off"
                                        class="form-control form-control-sm" id="startWithDate"></td>
                            </tr>
                            <tr>
                              <th><label for="endWithDate">End With Date</label></th>
                              <td><input type="date" name="endWithDate" autocomplete="off"
                                        class="form-control form-control-sm" id="endWithDate" value="{{ $tgl }}"></td>
                            </tr>
                            <tr>
                              <th><label for="dataOrder">Data Ordered By</label></th>
                              <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="frequency">Frequency</option>
                                    <option value="quantity" selected>Quantity</option>
                                    <option value="value">Value</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <th><label for="bestTop">Best / Top</label></th>
                              <td><input type="text" name="bestTop" autocomplete="off"
                                        class="form-control form-control-sm" id="bestTop" value="10"></td>
                            </tr>
                          </tbody>
                        </table>
                        <hr>
                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="printingDestination">Printing Destination</label>
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
                                        Preview | Preview Printout
                                    </option>
                                    <option value="cancel">
                                        Cancel | Cancel Printing
                                    </option>
                                </select>
                          </div>
                        </div>
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
<script src="{{ asset('/js/scriptBestCustomer.js') }}"></script>
@endsection
