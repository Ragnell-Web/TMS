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
                                <div class="col-md-auto">
                                    <select class="form-control" id="type">
                                        <option value='0'>-- Select Data --</option>
                                        <option value='by OP'>by OP</option>
                                        <option value='by MPS'>by MPS</option>
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

    <div class="row" id="chart_s0" hidden>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_header_s0">Capacity vs Loading</h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s0"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_header_s1">Capacity vs Loading</h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s1"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_header_s2">Capacity vs Loading</h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s2"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- <div class="row" id="chart_s0"  hidden>
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-industry"></i> TMS Scheduler
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id = "chart_PlanSummary_s0" style = "width: 1250px; height: 400px; margin: 0 auto"></div>
                    <h4 class="card-title" id="chart_header_s0"></h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-industry"></i> TMS Scheduler
                    </div>
                </div>
            </div>
            <div class="card" id="chart_s1">
                <div class="card-body">
                    <div id = "chart_PlanSummary_s1" style = "width: 1250px; height: 400px; margin: 0 auto"></div>
                    <h4 class="card-title" id="chart_header_s1"></h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-industry"></i> TMS Scheduler
                    </div>
                </div>
            </div>
            <div class="card" id="chart_s2">
                <div class="card-body">
                    <div id = "chart_PlanSummary_s2" style = "width: 1250px; height: 400px; margin: 0 auto"></div>
                    <h4 class="card-title" id="chart_header_s2"></h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-industry"></i> TMS Scheduler
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>
@endsection

@push('js')

<script src="{{ asset('vendor/Highcharts-8.0.4/code/highcharts.js') }}"></script>
<script src="{{ asset('js/custom_tms_chart.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>

    <script>
        var datSummaryLoadingCapacityPerMachine_url = "{{ route('tms.manufacturing.production-plan.get_datSummaryLoadingCapacityPerMachine') }}";


        $(document).ready(function() {
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Function On Load
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            populate_cmbProdProcess('#process', datSummaryLoadingCapacityPerMachine_url, 'get_cmbProdProcess');

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Function On Other Function Changes
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $('#process').change(function(){
                var prod_process = $(this).val();
                populate_cmbMachineNumber('#machine', datSummaryLoadingCapacityPerMachine_url, prod_process, 1, 'get_cmbMachineNumber')
            });
            $('#generate').click(function(){
                var process = $('#process').val();
                var type = $('#type').val();
                var machine = $('#machine').val();
                var period = $('#period').val();

                if(machine != '0'){
                    $("#chart_s0").attr("hidden", false);

                    if(type == 'by OP'){
                        nested_populate_dtPlanSummaryPerMachineByOp(process, type, machine, period);
                    } else if(type == 'by MPS'){
                        nested_populate_dtPlanSummaryPerMachineByMps(process, type, machine, period);
                    } else {
                        Swal.fire("Select Data Type", "", "warning");
                    };
                } else{
                    Swal.fire("Select Machine", "", "warning");
                };
            });

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Nested Function
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            function nested_populate_dtPlanSummaryPerMachineByOp(process, type, machine, period){
                $("#chart_s0").attr("hidden", false);
                $("#chart_s1").attr("hidden", true);
                $("#chart_s2").attr("hidden", true);

                $('#chart_header_s0').empty();
                $('#chart_header_s0').append("Capacity vs Loading "+type+ " Period "+period+" Machine "+machine);

                populate_chartPlanSummaryPerMachineByOp('#chart_PlanSummary_s0', period, machine, process, datSummaryLoadingCapacityPerMachine_url);
            };

            function nested_populate_dtPlanSummaryPerMachineByMps(process, type, machine, period){
                $("#chart_s0").attr("hidden", false);
                $("#chart_s1").attr("hidden", false);
                $("#chart_s2").attr("hidden", false);

                $('#chart_header_s0').empty();
                $('#chart_header_s0').append("Capacity vs Loading "+type+" Period "+period+" Machine "+machine+" for Shift: 1 and 2");
                $('#chart_header_s1').empty();
                $('#chart_header_s1').append("Capacity vs Loading "+type+" Period "+period+" Machine "+machine+" for Shift: 1");
                $('#chart_header_s2').empty();
                $('#chart_header_s2').append("Capacity vs Loading "+type+" Period "+period+" Machine "+machine+" for Shift: 2");

                var shift = '0';
                    populate_chartPlanSummaryPerMachine('#chart_PlanSummary_s0', period, machine, shift, datSummaryLoadingCapacityPerMachine_url);
                var shift = '1';
                    populate_chartPlanSummaryPerMachine('#chart_PlanSummary_s1', period, machine, shift, datSummaryLoadingCapacityPerMachine_url);
                var shift = '2';
                    populate_chartPlanSummaryPerMachine('#chart_PlanSummary_s2', period, machine, shift, datSummaryLoadingCapacityPerMachine_url);
            };

        });
    </script>

@endpush
