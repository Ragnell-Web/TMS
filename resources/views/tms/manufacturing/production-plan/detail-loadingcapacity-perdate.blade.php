@extends('master')

@section('title', 'TMS | Manufacturing Production Plan - Detail Loading Capacity Per Date')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection

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

    <div class="row" id="dtPlanDetail"  hidden>
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 id="tableHeader" class="header-title"></h4>
                    <div class="data-tables datatable-dark">
                        <table id="dtPlanDetailPerDate"
                               class="table table-striped text-center cell-border display compact"
                               style="width:100%">
                            <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th>Plan Date</th>
                                    <th>Dayname</th>
                                    <th>Capacity S1 (min)</th>
                                    <th>Capacity S2 (min)</th>
                                    <th>Capacity Total (min)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>

    <script id="details-template-machine" type="text/x-handlebars-template">
        @verbatim
        <div class="label label-info float-left bold">Machine {{ machine }}'s</div>
        <table id="machine-{{ id }}"
            class="table table-striped text-center cell-border display compact"
            style="width:100%">
            <thead class="text-uppercase">
                <tr>
                    <th></th>
                    <th>Plan Date</th>
                    <th>Machine</th>
                    <th>Loading (min)</th>
                    <th>Capacity (min)</th>
                    <th>Loading (%)</th>
                </tr>
            </thead>
        </table>
        @endverbatim
    </script>

    <script id="details-template-date" type="text/x-handlebars-template">
        @verbatim
        <div class="label label-info float-left bold">Plan Date {{ plan_date }}'s</div>
        <table id="date-{{ plan_date }}"
               class="table table-striped text-center cell-border display compact"
               style="width:100%">
            <thead class="text-uppercase">
                <tr>
                    <th></th>
                    <th>Shift</th>
                    <th>Plan Date</th>
                    <th>Machine</th>
                    <th>Loading (min)</th>
                    <th>Capacity (min)</th>
                    <th>Loading (%)</th>
                </tr>
            </thead>
        </table>
        @endverbatim
    </script>

    <script id="details-template-date-byOp" type="text/x-handlebars-template">
        @verbatim
        <div class="label label-info float-left bold">Plan Date {{ plan_date }}'s</div>
        <table id="date-{{ plan_date }}"
               class="table table-striped text-center cell-border display compact"
               style="width:100%">
            <thead class="text-uppercase">
                <tr>
                    <th>Prod Code</th>
                    <th>Item Code</th>
                    <th>Part No</th>
                    <th>Descript</th>
                    <th>Model</th>
                    <th>Seq</th>
                    <th>C/T</th>
                    <th>Qty</th>
                    <th>Loading (min)</th>
                    <th>Capacity (min)</th>
                    <th>Loading (%)</th>
                </tr>
            </thead>
        </table>
        @endverbatim
    </script>

    <script id="details-template-shift" type="text/x-handlebars-template">
        @verbatim
        <div class="label label-info float-left bold">Shift {{ shift }}'s</div>
        <table id="shift-{{ shift }}"
               class="table table-striped text-center cell-border display compact"
               style="width:100%">
            <thead class="text-uppercase">
                <tr>
                    <th>Prod Code</th>
                    <th>Item Code</th>
                    <th>Part No</th>
                    <th>Descript</th>
                    <th>Model</th>
                    <th>Seq</th>
                    <th>C/T</th>
                    <th>Qty</th>
                    <th>Loading (min)</th>
                    <th>Capacity (min)</th>
                    <th>Loading (%)</th>
                </tr>
            </thead>
        </table>
        @endverbatim
    </script>



</div>
@endsection

@push('js')

<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-8.0.4/code/highcharts.js') }}"></script>
<script src="{{ asset('js/custom_tms_chart.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>

<script>
        $(document).ready(function() {
            var tableId;
            var machine;
            var shift;

            var datDetailLoadingCapacityPerDate_url = "{{ route('tms.manufacturing.production-plan.get_datDetailLoadingCapacityPerDate') }}";

            var table = $('#dtPlanDetailPerDate').DataTable();

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Function On Load
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            populate_cmbProdProcess('#process', datDetailLoadingCapacityPerDate_url, 'get_cmbProdProcess');

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Function On Other Function Changes
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $('#generate').click(function(){
                var period = $('#period').val();
                var type = $('#type').val();

                if(process != '0'){
                    $("#dtPlanDetail").attr("hidden", false);
                    $('#tableHeader').empty();
                    $('#tableHeader').append("Capacity vs Loading "+type);

                    if(type == 'by OP'){
                        //initTableByOp_master('#dtPlanDetailPerMachineNumber', process);
                        //table = $('#dtPlanDetailPerMachineNumber').DataTable();
                    } else if(type == 'by MPS'){
                        initTableDate_master('#dtPlanDetailPerDate', period);
                        table = $('#dtPlanDetailPerDate').DataTable();
                    } else {
                        Swal.fire("Select Data Type", "", "warning");
                    };
                } else{
                    Swal.fire("Select Process", "", "warning");
                };
            });

            // Add event listener for opening and closing details
            /*
            $('#dtPlanDetailPerMachineNumber tbody').on('click', 'td.details-control', function () {
                var type = $('#type').val();

                var tr = $(this).closest('tr');
                var row = table.row(tr);
                tableId = row.data().id;
                machine = row.data().machine;
                var period = $('#period').val();

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(template_machine(row.data())).show();
                    if(type == 'by OP'){
                        initTableByOp_detail('#machine-'+tableId, period, machine);
                    } else if(type == 'by MPS'){
                        initTable_detail('#machine-'+tableId, period, machine);
                    };
                    console.log(row.data());
                    tr.addClass('shown');
                    tr.next().find('td').addClass('no-padding bg-gray');

                    table_date = $('#machine-'+tableId).DataTable();
                }

                // Add event listener for opening and closing details
                $('#machine-'+tableId+' tbody').on('click', 'td.details-control-perDay', function () {

                    var tr = $(this).closest('tr');
                    var row = table_date.row(tr);
                    tableDate = row.data().plan_date;
                    machine = row.data().machine;

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open this row
                        if(type == 'by OP'){
                            var period = $('#period').val();

                            row.child(template_date_byOp(row.data())).show();
                            initTableByOp_detail_detail('#date-'+tableDate, tableDate, machine, period);
                        } else if(type == 'by MPS'){
                            row.child(template_date(row.data())).show();
                            initTable_detail_detail('#date-'+tableDate, tableDate, machine);

                            table_shift = $('#date-'+tableDate).DataTable();
                        };
                        console.log(row.data());
                        tr.addClass('shown');
                        tr.next().find('td').addClass('no-padding bg-gray');
                    }

                    // Add event listener for opening and closing details
                    $('#date-'+tableDate+' tbody').on('click', 'td.details-control-perShift', function () {
                        var tr = $(this).closest('tr');

                        var row = table_shift.row(tr);
                        tableShift = row.data().shift;
                        plan_date = row.data().plan_date;
                        machine = row.data().machine;

                        if (row.child.isShown()) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass('shown');
                        } else {
                            // Open this row
                            if(type == 'by OP'){
                                // nothing
                            } else if(type == 'by MPS'){
                                row.child(template_shift(row.data())).show();
                                initTable_detail_detail_detail('#shift-'+tableShift, tableShift, plan_date, machine);
                            };
                            console.log(row.data());
                            tr.addClass('shown');
                            tr.next().find('td').addClass('no-padding bg-gray');
                        }

                    });
                });
            });*/

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Nested Function
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++


        });
    </script>


@endpush
