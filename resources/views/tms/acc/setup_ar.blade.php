@extends('master')
@section('title', 'TMS | Setup AR Period')
@section('content')
@php
    $tgl = date('Y-d');
@endphp
<div class="main-content-inner">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
<div class="page-title-area">
    <div class="row mb-5 btnCollection">
        <div class="col-md-2">
            <div class="printDiv">
                <a href="#" class="btn btn-primary btn-round" id="printItem">
                    Print Item
                </a>
            </div>
        </div>
        <div class="col-md-1">
            <div class="editDiv">
                <a href="#" class="btn btn-primary btn-round" id="editItem">
                    Edit Item
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Setup AR Period</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="receivableAR">Receivable (AR) :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="receivableAR" autocomplete="off" class="form-control form-control-sm dateInput" id="receivableAR" value="{{ $tgl }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="financeFIN">Finance (FIN) :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="financeFIN" autocomplete="off"
                                        class="form-control form-control-sm dateInput" id="financeFIN" value="{{$tgl}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="salesOrder">Sales Order (SO) :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="salesOrder" autocomplete="off" class="form-control form-control-sm dateInput" id="salesOrder" value="2020-06" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="salesForecast">Sales Forecast (SFC) :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="salesForecast" autocomplete="off" class="form-control form-control-sm dateInput" id="salesForecast" value="2017-08" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="suratJalan">Surat Jalan :</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="suratJalan" autocomplete="off"
                                        value="2021-03" class="form-control form-control-sm dateInput"
                                        id="suratJalan" disabled>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('/js/scriptSetupAR.js')}}"></script>
@endsection
