@extends('master')
@section('title', 'TMS | Modify DN No')
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
                <a href="#" class="btn btn-primary btn-round" id="okBtn">
                    OK
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Modify DN No</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="oldDN">Old DN No. :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="oldDN" autocomplete="off" class="form-control form-control-sm dnNo" id="oldDN">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="newDN">New DN No. :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="newDN" autocomplete="off"
                                        class="form-control form-control-sm dnNo" id="newDN" data-po="" disabled>
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
<script src="{{asset('/js/scriptModifyDn.js')}}"></script>
@endsection
