@extends('master')

@section('content')

@include('tms.__layouts.tms-menuProductionPlan-horizontal')

<div class="main-content-inner">

    <div id="div-unsticky">
        <div class="row" id='row-form'>
            <div class="col-12 mt-3" id="col-form">
                <div class="card" id="card-form">
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <span> Select Period (N) date </span>
                                <div class="col-md-auto">
                                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="period">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-auto">
                                    <select class="form-control" type="process" id="process">
                                        <option value='0'>-- Select Process --</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="form-inline">
                    <div class="form-group">
                        <span> Select Period (N) date </span>
                        <div class="col-md-auto">
                            <input class="form-control" type="date" value={{ date('Y-m-d') }} id="period">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-auto">
                            <select class="form-control" type="process" id="process">
                                <option value='0'>-- Select Process --</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <div class="row" id="chart_s0" hidden>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s0">Capacity vs Loading</h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s0"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s1">Capacity vs Loading</h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s1"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s2">Capacity vs Loading</h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s2"></div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('js')

<script src="{{ asset('vendor/Highcharts-8.0.4/code/highcharts.js') }}"></script>
<script src="{{ asset('js/custom_tms_chart.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>

<script>
    var datSummaryLoadingCapacityPerDate_url = "{{ route('tms.manufacturing.production-plan.get_datSummaryLoadingCapacityPerDate') }}";

    $(document).ready(function() {
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Load
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        populate_cmbProdProcess('#process', datSummaryLoadingCapacityPerDate_url, 'get_cmbProdProcess');

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Other Function Changes
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $('#period').change(function(){
            populate_cmbProdProcess('#process', datSummaryLoadingCapacityPerDate_url, 'get_cmbProdProcess');
        });
        $('#process').change(function(){
            nested_populate_dtPlanSummaryPerDate();
        });

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Nested Function
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function nested_populate_dtPlanSummaryPerDate(){
            $("#chart_s0").attr("hidden", false);
                var period = $('#period').val();
                var process = $('#process').val();
                var shift = '0';
                    populate_chartPlanSummaryPerDate('#chart_PlanSummary_s0', period, process, shift, datSummaryLoadingCapacityPerDate_url);
                var shift = '1';
                    populate_chartPlanSummaryPerDate('#chart_PlanSummary_s1', period, process, shift, datSummaryLoadingCapacityPerDate_url);
                var shift = '2';
                    populate_chartPlanSummaryPerDate('#chart_PlanSummary_s2', period, process, shift, datSummaryLoadingCapacityPerDate_url);
            };
        });
    </script>

@endpush
