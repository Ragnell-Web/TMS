@extends('master')
@section('title', 'TMS | Warehouse - Stock In Entry')
@section('css')
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"  type="text/css" href="{{asset('vendor/datetimepicker/css/bootstrap-datetimepicker.css')}}"/>
<script src="{{asset('vendor/datetimepicker/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor/datetimepicker/js/moment.min.js')}}"></script>
<script src="{{asset('vendor/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<style>
    input[type=search]{
        text-transform: uppercase;
    }
   #refs_no_create_stin, 
   #refs_no_edit_stin,
   #remark_header_create_stin, 
   #remark_header_edit_stin{
        text-transform: uppercase;
    }
 
    /* .edit-modal {
        overflow-y: scroll;
        height:calc(100% - 100px);
    }
    .create-modal {
        overflow-y: scroll;
        height:calc(100% - 100px);
    } */
    /* .edit-modal-detail {
        overflow-y: scroll;
        height:calc(100% - 100px);
    } */
    /* } */
    /* input[type=text]{
        text-transform: uppercase;
    } */
</style>
@endsection
@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="#">
                <button type="button"  class="btn btn-primary btn-flat btn-sm" id="addModalStin">
                    <i class="ti-plus"></i>  Add New Data
                </button>
               {{--  <button type="button" id="checkStockItem" class="btn btn-flat btn-sm btn-danger">
                    <i class="fa fa-check"></i> Stock
                </button> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Stock In Entry</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="datatable datatable-primary">
                                <div class="table-responsive">
                                    <table id="stin-entry-datatables"  class="table table-striped table-hover" style="width:100%">
                                        <thead class="text-center" style="text-transform: uppercase; font-size: 11px;" >
                                            {{-- style="background-color: #D3D3D3" style="font-size: 15px;" --}}
                                            <tr>
                                                <th width="10%">In No</th>
                                                <th width="10%">Date</th>
                                                <th width="10%">Posted</th>
                                                <th width="10%">Ref No</th>
                                                <th width="10%">Staff</th>
                                                <th width="20%">Description I</th>
                                                <th width="20%">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('tms.warehouse.stock-in-entry.modal.create-stin-modal.create')
@include('tms.warehouse.stock-in-entry.modal.pop-up-choiceitemdata.item-modal')
@include('tms.warehouse.stock-in-entry.modal.view-stin-modal.view-stin')
@include('tms.warehouse.stock-in-entry.modal.edit-stin-modal._edit-stin')
@include('tms.warehouse.stock-in-entry.modal.modal-log-stin.un_posted')
@include('tms.warehouse.stock-in-entry.modal.modal-log-stin.view_logstin')
@include('tms.warehouse.stock-in-entry.modal.edit-stin-modal._edit-detail')
@include('tms.warehouse.stock-in-entry.modal.pop-up-choiceitemdata.item-modal2')
@include('tms.warehouse.stock-in-entry.modal.pop-up-choiceitemdata.item-modal3')
@include('tms.warehouse.stock-in-entry.modal.pop-up-choiceitemdata.datatables_wh')
@include('tms.warehouse.stock-in-entry.modal.pop-up-choiceitemdata.datatables_wh_edit')
@include('tms.warehouse.stock-in-entry.modal.modal-log-stin.void')

@endsection
@section('script')
@include('tms.warehouse.stock-in-entry.ajax')
@endsection

{{-- generate datatable mto-entry --}}
@push('js')
<!-- Datatables -->
<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {

        //get data from datatables
        var table = $('#stin-entry-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tms.warehouse.get_stock_in_datatables') }}",
            },
            order: [[ 0, 'desc']],
            responsive: true,
            columns: [
            { data: 'in_no', name: 'in_no' },
            { data: 'created_date', name: 'created_date' },
            { data: 'posted', name: 'posted' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'staff', name: 'staff' },
            { data: 'remark_header', name: 'remark_header' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]    
        });

        // get(table)
      
        // get(table)
        // GET ITEM DATA 
        var url = "{{ route('tms.warehouse.get_choice_data_item_datatables_stock_in') }}";
        var lookUpdataStin =  $('#lookUpdataStin').DataTable({
            processing: true, 
            serverSide: true, 
            "pagingType": "numbers",
            ajax: url,
            responsive: true,
            "order": [[1, 'asc']],
            columns: [
            { data: 'ITEMCODE', name: 'ITEMCODE' },
            { data: 'PART_NO', name: 'PART_NO' },
            { data: 'DESCRIPT', name: 'DESCRIPT' }
       

            ],
            "bDestroy": true,
            "initComplete": function(settings, json) {
                // $('div.dataTables_filter input').focus();
                $('#lookUpdataStin tbody').on('dblclick', 'tr', function () {
                    var dataArr = [];
                    var rows = $(this);
                    var rowData = lookUpdataStin.rows(rows).data();
                    $.each($(rowData),function(key,value){
                        var table = $('#tbl-detail-stin-create').DataTable();
                        var jml_row = table.rows().count();
                        var item = document.getElementById("itemcode" + jml_row).value = value["ITEMCODE"];
                        document.getElementById("part_no"+ jml_row).value = value["PART_NO"];
                        document.getElementById("descript"+ jml_row).value = value["DESCRIPT"];
                        document.getElementById("fac_unit"+ jml_row).value = value["FAC_UNIT"];
                        document.getElementById("unit"+ jml_row).value = value["UNIT"];
                        document.getElementById("factor"+ jml_row).value = value["FACTOR"];
                        var itemcode2 = $('#itemcode'+jml_row).val();
                        if (itemcode2 !== "") {
                            $('#itemcode'+jml_row).attr('readonly', true)
                        }  else {
                            console.log('OK');
                        }
                        // validateItemSame(item)
                        // validateRow(jml_row, item);
                        $('#stinModal').modal('hide');
                        $('.fac_qty').focus();
                        
                        
                    });
                });
                // $('#stinModal').on('hidden.bs.modal', function(){
                //     if()
                // })
              
            },
      
        });
        // var tableSt = $('#tbl-detail-stout').DataTable();
        // var url2 = "{{ route('tms.warehouse.get_stock_out_get_choice_data_item_datatables') }}";
        var lookUpdataStin2 =  $('#lookUpdataStin2').DataTable({
            
            processing: true, 
            serverSide: true, 
            "pagingType": "numbers",
            ajax: url,
            responsive: true,
            
            // "scrollX": true,
            // "scrollY": "500px",
            // "scrollCollapse": true,
            "order": [[1, 'asc']],
            columns: [
            { data: 'ITEMCODE', name: 'ITEMCODE' },
            { data: 'PART_NO', name: 'PART_NO' },
            { data: 'DESCRIPT', name: 'DESCRIPT' }
       

            ],
            "bDestroy": true,
            "initComplete": function(settings, json) {
                // $('div.dataTables_filter input').focus();
                $('#lookUpdataStin2 tbody').on( 'dblclick', 'tr', function () {
                    var dataArr = [];
                    var rows2 = $(this);
                    var rowData2 = lookUpdataStin2.rows(rows2).data();
                    $.each($(rowData2),function(key,value){
                        var table = $('#tbl-edit-stin').DataTable();
                        var itung = table.rows().count();
                        var item = document.getElementById("itemcode_editdetaill"+itung ).value = value["ITEMCODE"];
                        document.getElementById("part_no_editdetaill"+itung).value = value["PART_NO"];
                        document.getElementById("descript_editdetaill"+itung).value = value["DESCRIPT"];
                        document.getElementById("fac_unit_editdetaill"+itung).value = value["FAC_UNIT"];
                        document.getElementById("unit_editdetaill"+itung).value = value["UNIT"];
                        document.getElementById("factor_editdetaill"+itung).value = value["FACTOR"];
                        var itemcodeedit = $('#itemcode_editdetaill'+itung).val();
                        if (itemcodeedit !== "") {
                            $('#itemcode_editdetaill'+itung).attr('readonly' , true);
                            // $('#itemcode'+jml_row).attr('disabled', true)
                        } else  {
                            console.log('OK')
                        }
                        // validateItemSameEdit(item)
                        // clear_edit_stout_detail(itung)
                        $('#stinModal2').modal('hide');
                        $('.fac_qty_addrowEdit').focus();
                        // $('#quantity_create').autofocus();
                        
                    });
                });
              
            },
      
        });
        // // tes(e, lookUpdataStout)
        // // get(tableSt)
        // var url3 = "{{ route('tms.warehouse.get_stock_out_get_choice_data_item_datatables') }}";
        var lookUpdataStin3 =  $('#lookUpdataStin3').DataTable({
            
            processing: true, 
            serverSide: true, 
            "pagingType": "numbers",
            ajax: url,
            responsive: true,
            "order": [[1, 'asc']],
            columns: [
            { data: 'ITEMCODE', name: 'ITEMCODE' },
            { data: 'PART_NO', name: 'PART_NO' },
            { data: 'DESCRIPT', name: 'DESCRIPT' }
       

            ],
            "bDestroy": true,
            "initComplete": function(settings, json) {
                // $('div.dataTables_filter input').focus();
                $('#lookUpdataStin3 tbody').on( 'dblclick', 'tr', function () {
                    var dataArr = [];
                    var rows3 = $(this);
                    var rowData3 = lookUpdataStin3.rows(rows3).data();
                    $.each($(rowData3),function(key,value){
             
                        var item = document.getElementById("itemcode_editdetail2").value = value["ITEMCODE"];
                        document.getElementById("part_no_editdetail2").value = value["PART_NO"];
                        document.getElementById("descript_editdetail2").value = value["DESCRIPT"];
                        document.getElementById("fac_unit_editdetail2").value = value["FAC_UNIT"];
                        document.getElementById("unit_editdetail2").value = value["UNIT"];
                        document.getElementById("factor_editdetail2").value = value["FACTOR"];
                        // validateItemSame(item)
                        $('#stinModal3').modal('hide');
                        clearFacQtyQuantity();
                        // $('#quantity_create').autofocus();
                        
                    });
                });
              
            },
      
        });


        var url_select_sys_wh = "{{ route('tms.warehouse.stock_in_entry.stock_in_select_warehouse') }}";
        var lookUpdataStin_wh =  $('#lookUpdataStinWh').DataTable({ 
            "pagingType": "numbers",
            ajax: url_select_sys_wh,
            responsive: true,
            paging: false,
            "bFilter": false,
            "order": [[1, 'asc']],
            columns: [
            { data: 'warehouse_id', name: 'warehouse_id' },
            { data: 'descript', name: 'descript' }

            ],
            "bDestroy": true,
            "initComplete": function(settings, json) {
                // $('div.dataTables_filter input').focus();
                $('#lookUpdataStinWh tbody').on('dblclick', 'tr', function () {
                    var dataArrWh = [];
                    var rowsWh = $(this);
                    var rowDataWh = lookUpdataStin_wh.rows(rowsWh).data();
                    $.each($(rowDataWh),function(key,value){
                        document.getElementById("types_create_stin").value = value["warehouse_id"]; 
                        $('#SysWarehouseModalStin').modal('hide');
                        $('#refs_no_create_stin').focus()
  
                    });
                });
              
            },
      
        });

        // //
       
     
        $('#tbl-detail-stin-create').DataTable({
            paging: false,
            // scrollY: '250px',
            scrollCollapse: true,
            "bFilter": false
        });
    });
   
</script>
@endpush