@extends('master')

@section('title', 'TMS | Manufacturing - Raw Material')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">

@endsection

@section('content')

@include('tms.__layouts.tms-menuRawMaterial-horizontal')

<div class="main-content-inner">

    <div class="row" id='dashboard_forecastNote'>
        <div class="col-5.5 mt-3" id="view-colForm">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Forecast Note Dashboard</h4>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" style="height:5%" type="text" name="period" id="cmbPeriodForecastNote" required>
                                    <option value=''>-- Select Period --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="data-tables datatable-dark">
                                <table id="dtDashboardForecastNote" class="table table-striped" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Ver No</th>
                                            <th>Prepared</th>
                                            <th>Approved</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
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
<script src="{{ asset('vendor/Datatables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>

<script>

    var user = "{{ Auth::user()->FullName }}";
    var periodNow = new Date().toISOString().slice(0,7);
    var dateNow = new Date().toISOString().slice(0,10);

    $(document).ready(function() {
        var cmbPeriod_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
            cmbPeriod_url  = cmbPeriod_url.replace(':vend_code', null);
            cmbPeriod_url  = cmbPeriod_url.replace(':period', null);
            cmbPeriod_url  = cmbPeriod_url.replace(':flag', 'cmbPeriodRawMaterial');

        populate_cmbPeriodRawMaterial('#cmbPeriodForecastNote', cmbPeriod_url, periodNow);
        populate_dtDashboardForecastNote(periodNow);
    });

    $('#cmbPeriodForecastNote').change(function(){
        populate_dtDashboardForecastNote($('#cmbPeriodForecastNote').val());
    });

    function populate_dtDashboardForecastNote(periodSelected){
        var supplierSelected = 'null';

        var viewForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
            viewForecastNote_url  = viewForecastNote_url.replace(':vend_code', supplierSelected);
            viewForecastNote_url  = viewForecastNote_url.replace(':period', periodSelected);
            viewForecastNote_url  = viewForecastNote_url.replace(':flag', 'DASH_DETAIL');

        get_dtDashboardForecastNote('#dtDashboardForecastNote', viewForecastNote_url);
    }

</script>

@endpush
