@extends('master')

@section('content')

@include('tms.__layouts.tms-menuProductionPlan-horizontal')

<div class="main-content-inner">
    <div id="div-unsticky">
        <div class="row" id='row-form'>
            <div class="col-12 mt-3" id="col-form">
                <div class="card" id="card-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <span> Select Period (N) month </span>
                                        <div class="col-md-auto">
                                            <input class="form-control" type="month" value="{{ date('Y-m') }}" id="period" />
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
                                            <select class="form-control" id="type">
                                                <option value='0'>-- Select Data --</option>
                                                <option value='op'>by OP</option>
                                                <option value='mps'>by MPS</option>
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
    </div>


    <div class="row" id="chart" hidden>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s0"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s0"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s1"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s1"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s2"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s2"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s3"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s3"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s4"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s4"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s5"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s5"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s6"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s6"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s7"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s7"></div>
                    <h4 class="card-title"></h4>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title" id="chart_title_s8"></h4>
                </div>
                <div class="card-body">
                    <div id = "chart_PlanSummary_s8"></div>
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
    var datSummaryLoadingCapacityPerMonth_url = "{{ route('tms.manufacturing.production-plan.get_datSummaryLoadingCapacityPerMonth') }}";

    $(document).ready(function() {
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Load
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        populate_cmbProdProcess('#process', datSummaryLoadingCapacityPerMonth_url, 'get_cmbProdProcess');

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Other Function Changes
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $('#generate').click(function(){
            var type = $('#type').val();
            var period = $('#period').val();
            var process = $('#process').val();
            var type = $('#type').val();

            if(process != '0'){
                if(type == 'op'){
                    nested_populate_dtPlanSummaryPerMonthByOp(period, process, type);
                } else if(type == 'mps'){
                    nested_populate_dtPlanSummaryPerMonth(period, process, type);
                } else {
                    Swal.fire("Select Data Type", "", "warning");
                };
            } else {
                Swal.fire("Select Process", "", "warning");
            };
        });

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Nested Function
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function nested_populate_dtPlanSummaryPerMonth(period, process, type){
            $("#chart").attr("hidden", false);

            var i;
            var len = 8;
            for(i=0; i<=len; i++){
                populate_chartPlanSummaryPerMonth('#chart_PlanSummary_s'+i, period, process, i+'1', '10', datSummaryLoadingCapacityPerMonth_url);
                $('#chart_title_s'+i).empty();
                $('#chart_title_s'+i).append("Capacity vs Loading "+type+" ("+(i+1)+")");
            };
        };

        function nested_populate_dtPlanSummaryPerMonthByOp(period, process, type){
            $("#chart").attr("hidden", false);
                var i;
                var len = 8;
                for(i=0; i<=len; i++){
                    populate_chartPlanSummaryPerMonthByOp('#chart_PlanSummary_s'+i, period, process, i+'1', '10', datSummaryLoadingCapacityPerMonth_url);
                    $('#chart_title_s'+i).empty();
                    $('#chart_title_s'+i).append("Capacity vs Loading "+type+" ("+(i+1)+")");
                };
            };
        });

</script>

@endpush
