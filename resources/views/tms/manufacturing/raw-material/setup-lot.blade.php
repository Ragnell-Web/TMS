@extends('master')

@section('title', 'TMS | Manufacturing - Raw Material - Setup')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection

@section('content')

@include('tms.__layouts.tms-menuRawMaterial-horizontal')

<div class="main-content-inner">

    <div id="div-unsticky">
        <div class="row" id='row-form'>
            <div class="col-12 mt-5" id="col-form">
                <div class="card" id="card-form">
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="col-md-auto">
                                    <input class="form-control" type="month" value="{{ date('Y-m') }}" id="period">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-auto">
                                    <select class="form-control" type="process" id="process">
                                        <option value='0'>-- Select Process --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-auto">
                                    <select class="form-control" type="machine" id="machine">
                                        <option value='-'>-- Select Machine --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <a id="generate" href="#" class="btn btn-secondary btn-block">
                                        Generate
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')

<!-- Datatables -->
<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>


<script>


</script>

@endpush
