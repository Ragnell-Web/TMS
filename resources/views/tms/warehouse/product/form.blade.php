@extends('master')

@section('title', 'TMS | Warehouse - Products')

@section('css')

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

    <!-- Highcharts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/Highcharts-8.0.4/code/css/highcharts.css') }}">

    <style>

        .highcharts-null-point {
            fill: none !important;
        }

        .highcharts-tooltip-container {
            z-index: 999999 !important;
        }

        #bomtree-chart h4{
            font-size: 12px;
        }

        #bomtree-chart p{
            color: #fff;
        }

    </style>

@endsection


@section('content')           
    
<div class="main-content-inner">

    @include('tms.warehouse.product.bomtree-modal')

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Products Descriptions</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="item-code" class="col-form-label">Item Code</label>
                                        <h4>{{ !empty($data) ? $data->ITEMCODE : '' }}</h4>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group">
                                        <label for="item-state" class="col-form-label">State</label>
                                        <h4>{{ !empty($data) ? $data->STATE_CODE . ' - ' . $data->STATE_NAME : '' }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="item-name" class="col-form-label">Name</label>
                                <h4>{{ !empty($data) ? $data->DESCRIPT : '' }}</h4>
                            </div>
                            <div class="form-group">
                                <label for="item-type" class="col-form-label">Type</label>
                                <h4>{{ !empty($data) ? $data->DESCRIPT1 : '' }}</h4>
                            </div>
                            <div class="form-group">
                                <label for="part-number" class="col-form-label">Part Number</label>
                                <h4>{{ !empty($data) ? $data->PART_NO : '' }}</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="current-stock" class="col-form-label">Current Stock</label>
                                        <h4 id="current-stock">
                                            <img class="custom-preloader-70" src="{{ asset('images/custom-preloader.gif') }}">
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="status-stock" class="col-form-label">Status</label>
                                        <h4 id="status-stock">
                                            <img class="custom-preloader-70" src="{{ asset('images/custom-preloader.gif') }}">
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="min-stock" class="col-form-label">Min Stock</label>
                                        <h4 id="min-stock">
                                            <img class="custom-preloader-70" src="{{ asset('images/custom-preloader.gif') }}">
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="max-stock" class="col-form-label">Max Stock</label>
                                        <h4 id="max-stock">
                                            <img class="custom-preloader-70" src="{{ asset('images/custom-preloader.gif') }}">
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <button class="btn btn-flat btn-info" style="width:100%" type="button" id="view-bomtree-btn"><i class="fa fa-sitemap"></i> &nbsp; View BoM Tree</button>
                                <a class="btn btn-flat btn-danger mt-2" style="width:100%" target="_blank" href="{{ route('tms.warehouse.products.stock-card', $data->ITEMCODE) }}" id="print-stock-card-btn"><i class="fa fa-file-pdf-o"></i> &nbsp; View Stock Card Detail</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
         </div>
   </div>

   <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Bill of Materials</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="data-tables datatable-dark">
                                <table id="product-bom-datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Part No.</th>
                                            <th>Customer Code</th>
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

<!-- Highcharts -->
<script src="{{ asset('vendor/Highcharts-8.0.4/code/highcharts.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-8.0.4/code/modules/sankey.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-8.0.4/code/modules/organization.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-8.0.4/code/modules/exporting.js') }}"></script>
<script src="{{ asset('vendor/Highcharts-8.0.4/code/modules/accessibility.js') }}"></script>

<script>
    var currentItemcode = "{{ !empty($data) ? $data->ITEMCODE : '' }}";

    $(document).ready(function() {
        // Load Datatable
        loadDatatable('#product-bom-datatable', currentItemcode);
        
        // Load Balance
        loadStockStatus(currentItemcode);

        // View BoM Tree Button click to show Modal
        $('#view-bomtree-btn').click(function() {
            $('#bomtree-modal').modal('show');
        });

        // When Modal is Shown -> Render Chart
        $( "#bomtree-modal" ).on('shown.bs.modal', function(){
            loadBomtree('bomtree-chart', currentItemcode);
        });
        
        //BoM Tree Fullscreen Button
        $('#bomtree-btn-fullscreen').click(function() {
            Highcharts.FullScreen = function(container) {
                this.init(container.parentNode); // main div of the chart
            };

            Highcharts.FullScreen.prototype = {
                init: function(container) {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.mozRequestFullScreen) {
                    container.mozRequestFullScreen();
                } else if (container.webkitRequestFullscreen) {
                    container.webkitRequestFullscreen();
                } else if (container.msRequestFullscreen) {
                    container.msRequestFullscreen();
                }
                }
            };
            $('#bomtree-chart').highcharts().fullscreen = new Highcharts.FullScreen($('#bomtree-chart').highcharts().container);
        });

    });

    function loadStockStatus($itemcode = null){
        var route = "{{ route('tms.warehouse.products.stock-status', ':itemcode') }}";
            route = route.replace(':itemcode', $itemcode);
        $.ajax({
            url: route,
            method: 'get',
            dataType: 'json',
            success:function(data){
                $('#current-stock').html(data[0].current_qty);
                $('#status-stock').html(data[0].stock_status);
                $('#min-stock').html(data[0].min_stock);
                $('#max-stock').html(data[0].max_stock);
            }
        });
    }

    function loadBomtree($id, $itemcode = null){
        // Get BoM Tree Data for Highcharts
        var route = "{{ route('tms.warehouse.products.bom.highcharts', ':itemcode') }}";
            route = route.replace(':itemcode', $itemcode);

        $.ajax({
            url: route,
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                swal.fire({
                    html: '<h5>Please Wait ...</h5>',
                    showConfirmButton: false
                });
            },
            success:function(data){
                // Initiate Initial Variables
                var arrlen = data['chartData'].length;
                var $chartData  = new Array();
                var $chartNodes = new Array();
                var $objNodes = {};
                var $nodesColor;
                
                // Generate Nodes Data
                for( var i = 0; i < arrlen; i++ ){
                    $chartData[i] = [
                        data['chartData'][i].fin_code,
                        data['chartData'][i].frm_code
                    ];

                    if ( data['chartData'][i].frm_state == 'FP' ) {
                        $nodesColor = '#007ad0';
                    } else if ( data['chartData'][i].frm_state == 'WP' ) {
                        $nodesColor = '#009985';
                    } else if ( data['chartData'][i].frm_state == 'RM' || data['chartData'][i].frm_state == 'SP' ) {
                        $nodesColor = '#911010';
                    } else {
                        $nodesColor = '#009985';
                    }

                    $objNodes = {
                        id: data['chartData'][i].frm_code,
                        title: data['chartData'][i].frm_code,
                        name: data['chartData'][i].frm_desc,
                        color: $nodesColor
                    };
                    $chartNodes.push($objNodes);

                    if ( data['chartData'][i].fin_state == 'FP' ) {
                        $nodesColor = '#007ad0';
                    } else if ( data['chartData'][i].fin_state == 'WP' ) {
                        $nodesColor = '#009985';
                    } else if ( data['chartData'][i].fin_state == 'RM' || data['chartData'][i].fin_state == 'SP'  ) {
                        $nodesColor = '#911010';
                    } else {
                        $nodesColor = '#009985';
                    }

                    $objNodes = {
                        id: data['chartData'][i].fin_code,
                        title: data['chartData'][i].fin_code,
                        name: data['chartData'][i].fin_desc,
                        color: $nodesColor
                    };
                    $chartNodes.push($objNodes);
                }

                // Initiate Highcharts
                Highcharts.chart($id, {
                    
                    chart: {
                        height: 1000,
                        inverted: true,
                    },

                    title: {
                        text: 'Bill of Materials Tree - ' + $itemcode
                    },

                    accessibility: {
                        point: {
                            descriptionFormatter: function (point) {
                                var nodeName = point.toNode.name,
                                    nodeId = point.toNode.id,
                                    nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                                    parentDesc = point.fromNode.id;
                                return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
                            }
                        }
                    },

                    plotOptions: {
                        series: {
                            fillColor: null
                        }
                    },

                    series: [{
                        type: 'organization',
                        name: 'BoM Chart',
                        keys: ['from', 'to'],
                        nodePadding: 20,
                        data: $chartData,
                        levels: [],
                        nodes: $chartNodes,
                        colorByPoint: false,
                        color: '#007ad0',
                        dataLabels: {
                            color: 'white'
                        },
                        borderColor: 'white',
                        nodeWidth: 65,
                        style: {
                            fontSize: '8px'
                        }
                    }],
                    
                    tooltip: {
                        outside: true
                    },
                    
                    exporting: {
                        enabled: false
                    }

                });

                swal.close();
            }
        });
               
    }

    function loadDatatable(id, itemcode){
        var route = "{{ route('tms.warehouse.products.bom.datatables', ':itemcode') }}";
            route = route.replace(':itemcode', itemcode);
        $(id).DataTable({
            processing: true,
            serverSide: true,
            ajax: route,
            order: [[ 0, 'asc']],
            columnDefs: [
                {"className": "align-left", "targets": 1},
                {"className": "align-center vertical-center", "targets": "_all"}
            ],
            columns: [
                { data: 'itemcode', name: 'itemcode' },
                { data: 'frm_desc', name: 'frm_desc' },
                { data: 'frm_desc1', name: 'frm_desc1' },
                { data: 'part_no', name: 'part_no' },
                { data: 'custcode', name: 'custcode' }
            ]
        });
    }

</script>

@endpush