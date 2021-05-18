<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ADD DISPLAY MODAL CREATE
$(document).on('click', '#addModalStin', function(e) {
    e.preventDefault();
    $('#createModalStin').modal('show');
    $('.modal-title').text('Stock In Entry (New)');
});

$('#createModalStin').on('shown.bs.modal', function () {
  $('#types_create_stin').focus();
  var period = $('#setperiod').val();
//   alert(period)
  checkStClose(period);
})
$('#editModalStout').on('shown.bs.modal', function () {
  $('#refs_no_edit_stout').focus()
})


function keyPressed(e){
    if (e.keyCode == 13) { // PRESS KEYBOARD SHORTCUT ENTER FOR APPEAR DATA ITEM
        e.preventDefault();
        // var jml_row_create = document.getElementById('jml_row').value;
        // $('#btnPopUpStin'+jml_row_create).click();
        clearSearch()
        $('#stinModal').modal('show');
    } else if(e.keyCode){
        e.preventDefault();
    }
}
function keyPressedAddnewItem(e){
    if (e.keyCode == 13) { // PRESS KEYBOARD SHORTCUT ENTER FOR APPEAR DATA ITEM
        e.preventDefault();
        // var jml_row_edit = document.getElementById('jml_row_editdetail').value;
        clearSearchEdit()
        $('#stinModal2').modal('show');
    } else if(e.keyCode){
        e.preventDefault();
    }
}

function keyPressedEdit(e){
    if (e.keyCode == 13) { // PRESS KEYBOARD SHORTCUT ENTER FOR APPEAR DATA ITEM
        e.preventDefault();
        $('#btnPopUpstin3').click();
    } else if(e.keyCode){
        e.preventDefault();
    }
}

function keyPressedSysWarehouse(e){
    if (e.keyCode == 13) {
        e.preventDefault();
        $('#SysWarehouseModalStin').modal('show');
    }
}
function keyPressedSysWarehouseEdit(e){
    if (e.keyCode == 13) {
        e.preventDefault();
        $('#SysWarehouseModal2').modal('show');
    }
}
$(".datepicker").datetimepicker({
        format: "YYYY-MM-DD",
        useCurrent: true
        
    });

    $("#setdate").datetimepicker({
        date: moment(),
        format: "YYYY-MM-DD"
    });

    $("#setperiod").datetimepicker({
        date: moment(),
        format: "YYYY-MM"
    });

    $('.datepicker').on('dp.change', function(e){ 
        var getperiod = e.date.format("YYYY-MM");
        $('#setperiod').data("DateTimePicker").date(getperiod);
    });
// view detail
$(document).on('click', '.view', function(e){
e.preventDefault();
    var id = $(this).attr('row-id');
    $('#viewModalStin').modal('show');
    $('.modal-title').text('Stock In Entry (View)');
    getDetail(id, 'VIEW')
});


//   ADD ROW 
$(document).ready(function(){
  
    $('#addRow').click(function(){
        validateRow()
        var table = $('#tbl-detail-stin-create').DataTable({
            stateSave: true,
            "bDestroy": true,
            paging: false,
            scrollY: "250px",
            scrollCollapse: true,
            "bFilter": false
        });
        var counter = table.rows().count();
        var jml_row = Number(counter)+1;
        document.getElementById('jml_row').value = jml_row;
        var itemcode = "itemcode"+jml_row;
            part_no = "part_no"+jml_row;
            descript = "descript"+jml_row;
            fac_unit = "fac_unit"+jml_row;
            fac_qty  = "fac_qty"+jml_row;
            factor = "factor"+jml_row;
            unit = "unit"+jml_row;
            quantity = "quantity"+jml_row;
            remark = "remark"+jml_row;
            btn_delete = "remove"+jml_row;
            //
            qty = "qty"+jml_row;
            // btnPopUp = "btnPopUpStin"+jml_row;
            // btnDelete = "destroy"+jml_row;



        table.row.add([
        // '<div class="input-group">'+
        //     '<input type="text" autofocus="on"  placeholder="Cari Itemcode" autocomplete="off"'+
        //     'id="'+ itemcode +'" name="itemcode[]" required  class="form-control form-control-sm itemcode">'+
        //     '<span class="input-group-btn">'+
        //         '<button type="button" id="'+btnPopUp+'" onclick="clearSearch()"  data-toggle="modal" data-target="#stinModal" class="btn btn-info btn-xs">'+
        //         '<i class="ti-search"></i>'+
        //         '</button>'+
        //     '</span>'+
        // '</div>',
        // '<input type="text" readonly name="part_no[] " id="'+ part_no +'"  class="form-control form-control-sm">',
        // '<input type="text" readonly name="descript[]"  id="'+ descript +'" class="form-control form-control-sm">',
        // '<input type="text" readonly name="fac_unit[]"  id="'+fac_unit+'" class="form-control form-control-sm">',
        // '<input type="number"  name="fac_qty[]" value="0"   id="'+fac_qty+'" onchange="autoFillKali('+ jml_row +')" class="form-control form-control-sm fac_qty">',
        // '<input type="text" readonly name="factor[]" id="'+ factor +'" class="form-control form-control-sm factor_create">',
        // '<input type="text" readonly name="unit[]"  id="'+ unit +'" class="form-control form-control-sm unit">',
        // '<input type="number"  name="quantity[]"  id="'+ quantity +'" class="form-control form-control-sm qty">',
        // '<input type="text"  name="remark_detail[]" id="'+ remark +'"  class="form-control form-control-sm">',
        // '<a href="#" class="btn btn-xs btn-danger destroy" id="'+btnDelete+'"><i class="ti-trash remove"></i></a>'+"</tr>",
        "<tr>"+
        "<td>"+
        // '<div class="input-group">'+
            '<input type="text" autofocus="on"  placeholder="Cari Itemcode" autocomplete="off"'+
            'id="'+ itemcode +'" name="itemcode[]" onkeydown="keyPressed(event)" onclick="clearSearch()" required  class="form-control form-control-sm itemcode">'+
            // '<span class="input-group-btn">'+
            //     '<button type="button" id="btnPopUpStout" onclick="clearSearch()"   data-toggle="modal" data-target="#stoutModal" class="btn btn-info btn-xs">'+
            //     '<i class="ti-search"></i>'+
            //     '</button>'+
            // '</span>'+
        // '</div>'+
        "</td>",
        '<td><input type="text" readonly name="part_no[] " id="'+ part_no +'"  class="form-control form-control-sm"></td>',
        '<td><input type="text" readonly name="descript[]"  id="'+ descript +'" class="form-control form-control-sm"></td>',
        '<td><input type="text" readonly name="fac_unit[]"  id="'+fac_unit+'" class="form-control form-control-sm"></td>',
        '<td><input type="number"  name="fac_qty[]" value="0" autocomplete="off"  id="'+fac_qty+'" onchange="autoFillKali('+ jml_row +')" class="form-control form-control-sm fac_qty"></td>',
        '<td><input type="text" readonly name="factor[]" id="'+ factor +'" class="form-control form-control-sm factor_create"></td>',
        '<td><input type="text" readonly name="unit[]"  id="'+ unit +'" class="form-control form-control-sm unit"></td>',
        '<td><input type="number"  name="quantity[]" readonly  id="'+ quantity +'" class="form-control form-control-sm qty"></td>',
        '<td><input type="text"  name="remark_detail[]" autocomplete="off" id="'+ remark +'"  class="form-control form-control-sm"></td>'+"</tr>",
        ]).draw(false);
        $(document).ready(function(){
        $('#itemcode'+jml_row).on('keyup', function(){
        if ($(this).val() != '') {
             Swal.fire({
                icon: 'warning',
                title: 'Perhatikan inputan anda tekan tombol button search untuk menampilkan Itemcode yang akan diinput',
            })
            $('#itemcode'+jml_row).val("");
        } 
        
    })
    $('#itemcode'+jml_row).focus();

    // validateRow(table, jml_row)
    
})


        // alert(fac_qty)
        

    })


// DELETE ROW IN ADD ITEM PAGE
// $(document).on('click', '.destroy', function(e){  

//     var btn = $('#body tr').length;
//     if(btn){
//         $(this).parent().parent().remove();
//         var jml_row = document.getElementById('jml_row').value;
//         jml_row = Number(jml_row)-1;
//     }
// });


// DELETE ROW IN ADD ITEM PAGE
$(document).on('click','.destroy', function(){
var table = $('#tbl-detail-stin-create').DataTable();
// $('#tbl-detail-stin-create tbody').on( 'click', 'tr', function () {
//     if ( $(this).hasClass('selected') ) { 
//         $(this).removeClass('selected'); 
//     } else { 
//         table.$('tr.selected').removeClass('selected');
//         $(this).addClass('selected'); 
//     } 
// });
var index = table.row('tr:last').indexes();
    table.row(index).remove().draw(false);
var jml_row = document.getElementById("jml_row").value.trim();
    jml_row = Number(jml_row);
    nextRow = table.rows().count() + 1;
for($i = nextRow; $i <= jml_row; $i++) {
    var itemcode = "#itemcode" + $i;
    var itemcode_new = "itemcode" + ($i-1);
    $(itemcode).attr({"id":itemcode_new});

    var part_no = "#part_no" + $i;
    var part_no_new = "part_no" + ($i-1);
    $(part_no).attr({"id":part_no_new});

    var descript = "#descript" + $i;
    var descript_new = "descript" + ($i-1);
    $(descript).attr({"id":descript_new, "name":descript_new});

    var fac_unit = "#fac_unit" + $i;
    var fac_unit_new = "fac_unit" + ($i-1);
    $(fac_unit).attr({"id":fac_unit_new});

    var fac_qty = "#fac_qty" + $i;
    var fac_qty_new = "fac_qty" + ($i-1);
    $(fac_qty).attr({"id":fac_qty_new});

    var factor = "#factor" + $i;
    var factor_new = "factor" + ($i-1);
    $(factor).attr({"id":factor_new});

    var unit = "#unit" + $i;
    var unit_new = "unit" + ($i-1);
    $(unit).attr({"id":unit_new});

    var quantity = "#quantity" + $i;
    var quantity_new = "quantity" + ($i-1);
    $(quantity).attr({"id":quantity_new});

    var remark = "#remark" + $i;
    var remark_new = "remark" + ($i-1);
    $(remark).attr({"id":remark_new});

    var btnPopUp = "#btnPopUpStin" + $i;
    var btnPopUp_new = "btnPopUpStin" + ($i-1);
    $(btnPopUp).attr({"id":btnPopUp_new});

    var jml_row1 = $i - 1;
    var tes = document.getElementById('jml_row').value = jml_row1;
}

});


});
    
//  INSERT VIA AJAX 
$('.modal-footer').on('click','.addStin', function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
    url: "{{ route('tms.warehouse.stock_in_entry_storeStockIn') }}",
    type: "POST",
    data: $('#form-stin').serialize(),
    dataType: 'json',
    success: function(data){
        if($.isEmptyObject(data.error)){
                if(data.checkdata){
                    Swal.fire({
                        icon: 'warning',
                        title: data.errors
                    });
                    clear_store_stin();
                    // clear_table_when_input_data_same();
                } else {
                    $('.addStin').html('Saving...')
                    clear_store_stin();
                        Swal.fire(
                        'Successfully!',
                        'Menambahkan data baru Stock In entry!',
                        'success'
                    ).then(function(){
                        $('#createModalStin').modal('hide');
                        $('#stin-entry-datatables').DataTable().ajax.reload();
                    })
                }
        } else {
        //     Swal.fire({
        //     icon: 'warning',
        //     title: 'Warning',
        //     text: 'Perhatikan Inputan Anda! Form Tidak Boleh Ada Yang Kosong',
        //   });
            printErrorMsg(data.error)
        }

        }
    })

    function printErrorMsg(msg){
        $('.print-error-msg').find('ul').html('');
        $('.print-error-msg').css('display','block');
        $('.addStout').html('Save')
        $.each(msg, function(key, value){
            $('.print-error-msg').find('ul').append('<li style="font-size: 15px"><i class="fa fa-exclamation-circle"></i> '+value+'</ul>');
        });
    }
})



// EDIT PAGE
$(document).on('click', '.edit', function(e){
    e.preventDefault();
    document.getElementById('refs_no_edit_stin').focus();
    var id = $(this).attr('row-id');
    var posted = $(this).attr('data-target');
    var in_no = $(this).attr('data-id');
    var select2 = $('.select2').select2();
        select2.select2('focus');

    if (posted !== '') {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            text: 'Stock In Entry no.' + in_no + ' '+'telah di posted tidak bisa diedit',
        });
    } else {
        $('#editModalStin').modal('show');
        $('.modal-title').text('Stock In Entry (Edit)');
        EditData(id)
        // updateStout(id)        
    }   
});


// VOIDED STOCK OUT ENTRY
$(document).on('click', '.voided', function(e){
    e.preventDefault();
    var id = $(this).attr('row-id');
    var in_no = $(this).attr('data-id');
    var posted = $(this).attr('data-target'); 
    var period = $(this).attr('data-period'); 
    if (posted !== '') {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            text: 'Stock In Entry no.' + in_no + ' '+'telah di posted tidak bisa divoid',
        });
    } else {  // 
        $('.modal-title').html('Stock In Entry (VOID)')
        $('.in_no_void').val(in_no);
        $('#ModalVoidStin').modal('show');
        voidedData(in_no, period);
    }
    
});




// POSTED DATA STOUT
$(document).on('click', '.posted', function(e){
    e.preventDefault();
    var id = $(this).attr('row-id');
    var in_no = $(this).attr('data-id');
    var posted = $(this).attr('data-target');
    var period = $(this).attr('data-period');
    // alert(posted);
    if(posted !== ''){
        $('#ModalUnPostStin').modal('show');
        $('.modal-title').text('Stock In Entry (UN-POST)')
        $('.in_no_unpost').val(in_no);
        document.getElementById('in_no_unpost').value = in_no;
    } else {
        postedSTIN(in_no)
    }
});

// LOG ACTIVITY
$(document).on('click', '.log', function(e){
    e.preventDefault();
    var in_no = $(this).attr('data-id');
    $('#logModalStin').modal('show');
    $('.modal-title').text('View Stock In Entry Log');
    var route  = "{{ route('tms.warehouse.stock_in_entry_log', ':id') }}";
    route  = route.replace(':id', in_no);
    $.ajax({
        url:      route,
        method:   'get',
        dataType: 'json',
        success:function(data){
            var detailDataset = [];
            for(var i = 0; i < data.length; i++){
                detailDataset.push([
                    formatDate(data[i].date), data[i].time, data[i].status_change,
                    data[i].user, data[i].note
                    ]);
            }
            $('#tbl-log-stin').DataTable().clear().destroy();
            $('#tbl-log-stin').DataTable({
                data: detailDataset,
                columns: [
                { title: 'Date'},
                { title: 'Time'},
                { title: 'Type'},
                { title: 'User' },
                { title: 'Note' }
                ]
            });
        }, 
        error: function(){
            alert('error');
        }
    })    
});

// VALIDATE UN-POST BUTTON DISABLED WHEN NOT YET FILL IN EXCEPTION NOTE
$(document).ready(function(){
    $('.ok_unpost_stout').attr('disabled', true);
    $('#note').on('keyup',function() {
        if($(this).val() != '') {
            $('.ok_unpost_stout').attr('disabled' , false);
        }else{
            $('.ok_unpost_stout').attr('disabled' , true);
        }
    });
})

// VALIDATE UN-POST BUTTON DISABLED WHEN NOT YET FILL IN EXCEPTION NOTE (VOID)
$(document).ready(function(){
    $('.void_submit').attr('disabled', true);
    $('#note_void').on('keyup',function() {
        if($(this).val() != '') {
            $('.void_submit').attr('disabled' , false);
        }else{
            $('.void_submit').attr('disabled' , true);
        }
    });
})

// validasi types create
$(document).ready(function(){
    $('#types_create_stin').on('keyup', function(){
        if ($(this).val() != '') {
             Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Perhatikan inputan anda tekan ENTER untuk menampilkan select warehouse',
            })
            $('#types_create_stin').val("");
        } 
    })
})

// validasi types EDIT
$(document).ready(function(){
    $('#types_edit_stin').on('keyup', function(){
        if ($(this).val() != '') {
             Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Perhatikan inputan anda tekan ENTER',
            })
            // var tes = $('#types_edit_stin').val();
            // alert(tes)
            $('#editModalStin').modal('hide');
        } else {
            alert('Not found');
        }
    })
})

// VOIDED DATA STOUT

function voidedData(in_no, period){
    $('.modal-footer').on('click','.void_submit', function(){
        // $('.void_submit').html('Saving...');
        var route  = "{{ route('tms.warehouse.stock_in_entry_void', ':id') }}";
            route  = route.replace(':id', in_no);
            $.ajax({
                url: route,
                type: "POST",
                data : $('#form-stin-void').serialize(),
                success: function(data){   
                    if (data.check) {
                        Swal.fire({
                            icon: 'warning',
                            title:data.errors +" "+ "period "+":"+" "+ period
                        });
                        $('#ModalVoidStin').modal('hide');
                        $('#note_void').val("");
                    } else {
                        console.log(data)
                        $('#ModalVoidStin').modal('hide');
                        Swal.fire(       
                            'Void!',
                            'Data berhasil divoid',
                            'success'
                            ).then(function(){
                                
                                $('#stin-entry-datatables').DataTable().ajax.reload();
                            });

                        }
                    }
            
                });
        
    });
}
//  VIEW DATA SHOW DETAIL FROM AJAX
function getDetail(id, method){
    var route  = "{{ route('tms.warehouse.show_view_stock_in_entry', ':id') }}";
    route  = route.replace(':id', id);
    $.ajax({
        url:      route,
        method:   'get',
        dataType: 'json',
        success:function(data){
        
            $('#in_no_view_stin').val(data['header'].in_no);
            $('#branch_view_stin').val(data['header'].branch);
            $('#types_view_stin').val(data['header'].types);
            $('#refs_no_view_stin').val(data['header'].ref_no);
            $('#period_view_stin').val(data['header'].period);
            $('#created_date_view_stin').val(formatDate(data['header'].created_date));
            $('#staff_view_stin').val(data['header'].staff);
            // $('#dept_view_stin').val(data['header'].dept);
            $('#staff_view_stin2').val(data['header'].staff);
            $('#printed_view_stin').val(formatDate(data['header'].printed));
            $('#voided_view_stin').val(formatDate(data['header'].voided));
            $('#posted_view_stin').val(formatDate(data['header'].posted));
            $('#remark_header_view_stin').val(data['header'].remark_header);
            $('#total_item_view').val(data.count);

        

            var detailDataset = [];
            for(var i = 0; i < data['detail'].length; i++){
                detailDataset.push([
                    data['detail'][i].itemcode, 
                    data['detail'][i].part_no, 
                    data['detail'][i].descript,
                    data['detail'][i].fac_unit, 
                    data['detail'][i].fac_qty, 
                    data['detail'][i].factor.toFixed(2), 
                    data['detail'][i].unit, 
                    data['detail'][i].quantity,
                    data['detail'][i].remark_detail
               ]);
            }
            $('#tbl-detail-stin-view').DataTable().clear().destroy();
            $('#tbl-detail-stin-view').DataTable({
                "paging":  false,
                "scrollY": '250px',
                "scrollCollapse": true, 
                data: detailDataset,
                columns: [
                { title: 'Itemcode'},
                { title: 'Part No.'},
                { title: 'Description'},
                { title: 'Fac Unit' },
                { title: 'Fac Qty' },
                { title: 'Factor' },
                { title: 'Unit' },
                { title: 'Qty' },
                { title: 'Remark'}
                ]
            });
        }
    });
}

// DISPLAY EDIT 
function EditData(id){
    var route  = "{{ route('tms.warehouse.stock_in_entry_edit', ':id') }}";
         route  = route.replace(':id', id);
    $.ajax({
        url:      route,
        method:   'get',
        dataType: 'json',
        success:function(data){
            // if (data['out_no']) 
            // if(data['out_no']){
            $('#id_stin_edit').val(data['header'].id_stin);
            $('#in_no_edit_stin').val(data['header'].in_no);
            $('#branch_edit_stin').val(data['header'].branch);
            $('#types_edit_stin').val(data['header'].types);
            $('#refs_no_edit_stin').val(data['header'].ref_no);
            $('#period_edit_stin').val(data['header'].period);
            $('#created_date_edit_stin').val(formatDate(data['header'].created_date));
            $('#staff_edit_stin').val(data['header'].staff);
            $('#staff_edit_stin2').val(data['header'].staff);
            // $('#dept_edit_stin').val(data['header'].dept);
            $('#staff_edit_stin').val(data['header'].staff);
            $('#printed_edit_stin').val(formatDate(data['header'].printed));
            $('#voided_edit_stin').val(data['header'].voided);
            $('#remark_header_edit_stin').val(data['header'].remark_header);
            $('#posted_edit_stin').val(formatDate(data['header'].posted));
            $('#total_item_edit ').val(data.count);
            checkStCloseEdit(data['header'].period)
        

            var route =   "{{ route('tms.warehouse.stock_in_dashboard_edit_detail', ':id') }}";
                get_inno = data['detail'].in_no;
                route  = route.replace(':id', get_inno);
            $('#tbl-edit-stin').DataTable().clear().destroy();
            $('#tbl-edit-stin').DataTable({
                paging:  false,
                scrollY: '250px',
                scrollCollapse: true, 
                serverSide: true,
                processing: true,
                ajax: route,
                columns: [
                    {  data: 'itemcode', name: 'itemcode'},
                    {  data: 'part_no', name: 'part_no'},
                    {  data: 'descript', name: 'descript'},
                    {  data: 'fac_unit', name: 'fac_unit' },
                    {  data: 'fac_qty', name: 'fac_qty' },
                    {  data: 'factor', name: 'factor' },
                    {  data: 'unit', name: 'unit'},
                    {  data: 'quantity',name: 'quantity' },
                    {  data: 'remark_detail', name: 'remark_detail'},
                    {  data: null, 'render': function(data){
                       var action= '<a href="#" id="editDetail" row-id='+data['itemcode']+'  data-id='+data['id_stin']+' class="editDetail"><i class="ti-pencil-alt"></i></a>'+
                                   '<a href="#" id="destroyDetail" row-id='+data['itemcode']+' data-id='+data['id_stin']+' class="destroyDetail"><i class="ti-trash"></i></a>'
                       return action
                    }}

                        
                 ],
               
                // processing: true,
                // serverSide: true
            });
            // alert(data.out_no);
        //     $('.restore').attr('disabled', false);
        //     } else {
        //         Swal.fire({
        //         icon: 'warning',
        //         title:data.msg,
        //       })
        //       $('#tbl-edit-stout').DataTable().clear().destroy();
        //       $('#out_no_edit_stout').val("");
        //       $('#branch_edit_stout').val("");
        //       $('#types_edit_stout').val("");
        //       $('#period_edit_stout').val("");
        //       $('#written_edit_stout').val("");
        //       $('#staff_edit_stout').val("");
        //       $('#staff_edit_stout').val("");
        //       $('#total_item_edit').val("");
        //       $('#printed_edit_stout').val("");
        //       $('#remark_header_edit_stout').val("");
        //       $('#refs_no_edit_stout').val("");
        //       $('.restore').attr('disabled', true);
        //      $('#tbl-edit-stout').DataTable({
        //         stateSave: true,
        //         "bDestroy": true,
        //         paging: false,
        //         scrollY: "250px",
        //         scrollCollapse: true
                
        //         });
        //     }
        }
           
        
    });
    

}


// EDIT DETAIL CLICK
$(document).on('click','.editDetail', function(event){
    event.preventDefault()
    var get_id = $(this).attr('data-id');
    var get_itemcode = $(this).attr('row-id');
    $('.modalEditDetail').modal('show');
    $('.title-detail').html('Edit Itemcode');
    var route  = "{{ route('tms.warehouse.stock_in_entry_edit_detail_page', ':id') }}";
        route  = route.replace(':id', get_id);
    $.ajax({
        url:      route,
        method:   'get',
        dataType: 'json',
        success:function(data){
            $('#id_stin_editdetail2').val(data.id_stin);
            $('#itemcode_editdetail2').val(data.itemcode);
            $('#part_no_editdetail2').val(data.part_no);
            $('#descript_editdetail2').val(data.descript);
            $('#fac_unit_editdetail2').val(data.fac_unit);
            $('#fac_qty_editdetail2').val(data.fac_qty);
            $('#factor_editdetail2').val(data.factor);
            $('#unit_editdetail2').val(data.unit);
            $('#qty_editdetail2').val(data.quantity);
            $('#remark_detail_editdetail2').val(data.remark_detail);
           
        }, 
        error: function(){
            alert('error');
        }
    });

});

// ADD ROW/ITEM CLICK IN EDIT PAGE
$(document).ready(function(){
$('.addRowEdit').click(function(e){
    validateRowEdit()
    e.preventDefault();
    var table = $('#tbl-edit-stin').DataTable({
       stateSave: true,
       "bDestroy": true,
       paging: false,
       scrollY: "250px",
       scrollCollapse: true
       
    });
    // var table2 = $('.tbl-edit-stin').DataTable();
    var counter = table.rows().count();
    var itung = Number(counter)+1;
    // var tableeeee = table2.rows().count();
    // var counter2 = Number(tableeeee)+1;
    // // alert(counter2)
    // document.getElementById('jml_row_vali').value = counter2;
    document.getElementById('jml_row_editdetail').value = itung;
    var itemcode = "itemcode_editdetaill"+itung;
        part_no = "part_no_editdetaill"+itung;
        descript = "descript_editdetaill"+itung;
        fac_unit = "fac_unit_editdetaill"+itung;
        fac_qty  = "fac_qty_editdetaill"+itung;
        factor = "factor_editdetaill"+itung;
        unit = "unit_editdetaill"+itung;
        quantity = "quantity_editdetaill"+itung;
        remark = "remark_editdetaill"+itung;
        // btnPopUpEdit = "btnPopUpStinEdit"+itung;
     

    table.row.add([
        "<div class='input-group'>"+
        "<input type='text'  placeholder='Cari Itemcode'\
            id='"+itemcode+"' name='itemcode[]' onkeydown='keyPressedAddnewItem(event)' required class='form-control form-control-sm'>",
        //     "<span class='input-group-btn'>"+
        // "<button type='button'  id="+btnPopUpEdit+" onclick='clearSearch()' data-toggle='modal' data-target='#stinModal2' class='btn btn-xs btn-info'>"+
        // "<i class='ti-search'></i>"+
        //     "<span>"+
        //     "</div>",
            "<input type='text' readonly name='part_no[] ' id='"+ part_no +"' class='form-control form-control-sm'>",
            "<input type='text' readonly name='descript[] ' id='"+ descript +"' class='form-control form-control-sm'>",
            "<input type='text' readonly name='fac_unit[] ' id='"+ fac_unit +"' class='form-control form-control-sm'>",
            "<input type='number'  name='fac_qty[] ' autocomplete='off' id='"+ fac_qty +"' onchange='autoFillJumlahQtyKaliAddRowEdit("+itung+")' class='form-control form-control-sm fac_qty_addrowEdit'>",
            "<input type='text' readonly name='factor[] ' id='"+ factor +"' class='form-control form-control-sm factor_addrowEdit'>",
            "<input type='text' readonly name='unit[] ' id='"+ unit +"' class='form-control form-control-sm unit_addrowEdit'>",
            "<input type='text'  name='quantity[] ' readonly id='"+ quantity +"'  class='form-control form-control-sm qty_addrowEdit'>",
            "<input type='text' name='remark_detail[] ' autocomplete='off' id='"+ remark +"' class='form-control form-control-sm'>",
            '<a href="#"  class="btn btn-xs btn-danger destroy2"><i class="ti-trash remove"></i></a>'
    ]).draw(false);
    $(document).ready(function(){
        $('#itemcode_editdetaill'+itung).on('keyup', function(){
        if ($(this).val() != '') {
             Swal.fire({
                icon: 'warning',
                title: 'Perhatikan inputan anda tekan tombol button search untuk menampilkan Itemcode yang akan diinput',
            })
            $('#itemcode_editdetaill'+itung).val("");
        } 
    })

    $('#itemcode_editdetaill'+itung).focus();
})

  }); 
})



// DELETE DETAIL CLICK IN EDIT PAGE
$(document).on('click','.destroyDetail', function(){
    var get_id = $(this).attr('data-id');
    var get_itemcode = $(this).attr('row-id');
    Swal.fire({
        title: 'Apakah anda yakin ingin menghapus data ini?',
        text: get_itemcode,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Deleted it!'
    }).
    then((willDelete) => {
        var route  = "{{ route('tms.warehouse.stock_in_delete_detail_page', ':id') }}";
        route  = route.replace(':id', get_id);
        if(willDelete.value){
            $.ajax({
                url: route,
                type: "POST",
                data : {
                    '_method' : 'DELETE'
                },
                success: function(data){   
                    console.log(data);
                    $('#tbl-edit-stin').DataTable().ajax.reload();
                    $('#stin-entry-datatables').DataTable().ajax.reload();

                    }, 
                    error: function(){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: 'Error Hub Admin!',
                        })
                    }
                })
        } else {
            console.log(`data Stock In Entry was dismissed by ${willDelete.dismiss}`);
        }

        
    })
    
    
});


// DELETE ROW CLICK
$(document).on('click','.destroy2', function(){

    var table = $('#tbl-edit-stin').DataTable();
    $('#tbl-edit-stin tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { 
            $(this).removeClass('selected'); 
        } else { 
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected'); 
        } 
    });
    var index = table.row('.selected').indexes();
    table.row(index).remove().draw(false);
    var jml_row_edit = document.getElementById("jml_row_editdetail").value.trim();
        jml_row_edit = Number(jml_row_edit);
        nextRow = table.rows().count() + 1;
    for($i = nextRow; $i <= jml_row; $i++) {
        var itemcode = "#itemcode_editdetaill" + $i;
        var itemcode_new = "itemcode_editdetaill" + ($i-1);
        $(itemcode).attr({"id":itemcode_new});

        var part_no = "#part_no_editdetaill" + $i;
        var part_no_new = "part_no_editdetaill" + ($i-1);
        $(part_no).attr({"id":part_no_new});

        var descript = "#descript_editdetaill" + $i;
        var descript_new = "descript_editdetaill" + ($i-1);
        $(descript).attr({"id":descript_new, "name":descript_new});

        var fac_unit = "#fac_unit_editdetaill" + $i;
        var fac_unit_new = "fac_unit_editdetaill" + ($i-1);
        $(fac_unit).attr({"id":fac_unit_new});

        var fac_qty = "#fac_qty_editdetaill" + $i;
        var fac_qty_new = "fac_qty_editdetaill" + ($i-1);
        $(fac_qty).attr({"id":fac_qty_new});

        var factor = "#factor_editdetaill" + $i;
        var factor_new = "factor_editdetaill" + ($i-1);
        $(factor).attr({"id":factor_new});

        var unit = "#unit_editdetaill" + $i;
        var unit_new = "unit_editdetaill" + ($i-1);
        $(unit).attr({"id":unit_new});

        var quantity = "#quantity_editdetaill" + $i;
        var quantity_new = "quantity_editdetaill" + ($i-1);
        $(quantity).attr({"id":quantity_new});

        var remark = "#remark_editdetaill" + $i;
        var remark_new = "remark_editdetaill" + ($i-1);
        $(remark).attr({"id":remark_new});

        var btnPopUpEdit = "#btnPopUpStinEdit" + $i;
        var btnPopUpEdit_new = "btnPopUpStinEdit" + ($i-1);
        $(btnPopUpEdit).attr({"id":btnPopUpEdit_new});

        var jml_row2 = $i - 1;
        var tes = document.getElementById('jml_row_editdetail').value = jml_row2;
    }
});

 
// POST STOCK OUT ENTRY FUNCTION
function postedSTIN(in_no){
    Swal.fire({
        title: 'Anda Yakin ingin mem post?',
        text: " data ini in no." + in_no,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Post it!'
    }).
    then((willPosted) => {
        var route  = "{{ route('tms.warehouse.stock_in_entry_post', ':id') }}";
        route  = route.replace(':id', in_no);
        if(willPosted.value){
            $.ajax({
                url: route,
                type: "POST",
                data : {
                    '_method' : 'POST'
                },
                success: function(data){  
                    if (data.check) {
                        Swal.fire({
                            icon: 'warning',
                            title:data.errors
                        });
                    } else {
                        console.log(data); 
                         Swal.fire(       
                        'Succesfully!',
                        'Data berhasil dipost.',
                        'success'
                        ).then(function(){
                            $('#stin-entry-datatables').DataTable().ajax.reload();
                        });

                      }
                    }
           
                })
        } else {
            console.log(`data Stin was dismissed by ${willPosted.dismiss}`);
        }

        
    })
}


// UN-POST STOCK-OUT ENTRY FUNCTION
// function UnPostedSTOUT(out_no){
  
        //
$('.modal-footer').on('click','.ok_unpost_stin', function(){
    var in_no = document.getElementById('in_no_unpost').value;
    // alert(in_no)
    var route  = "{{ route('tms.warehouse.stock_in_entry_post', ':id') }}";
        route  = route.replace(':id', in_no);
    $.ajax({
        url: route,
        type: "POST",
        data: $('#form-stin-un-post').serialize(),
        success: function(data){
            if (data.check) {
                Swal.fire({
                    icon: 'warning',
                    title: data.errors
                });
                $("#ModalUnPostStin").modal('hide'); 
                $('#note').val("");
            } else {
                console.log(data)
                Swal.fire(
                'Successfully!',
                'berhasil UN-POSTED in_no.' + in_no,
                'success'
                ).then(function(){
                    $("#ModalUnPostStin").modal('hide'); 
                    $('#note').val("");
                    $('#stin-entry-datatables').DataTable().ajax.reload();
                });

            }
          

            }
        });
    });
    
    

// date FORMAT
function formatDate (input) {
    if (input !== null) {
        var datePart = input.match(/\d+/g),
        year = datePart[0].substring(0),
        month = datePart[1], day = datePart[2];
        return day+'/'+month+'/'+year;
    } else {
        return null;
    }
}

// UPDATE STOCK-OUT HEADER IN EDIT PAGE FUNCTION

   
$('.modal-footer').on('click','.updateStin', function(){
    var id = document.getElementById('id_stin_edit').value;
    var route  = "{{ route('tms.warehouse.stock_in_entry_update', ':id') }}";
        route  = route.replace(':id', id); 
    // $('.updateStout').html('Saving...');
    $.ajax({
        url: route,
        type: "POST",
        data: $('#form-stin-edit').serialize(),
        success: function(data){
            // alert(data.itemcode);
            if (data.check) {
                Swal.fire({
                    icon: 'warning',
                    title: data.errors
                });
            } else {
                console.log(data)
                $('#stin-entry-datatables').DataTable().ajax.reload();
            }
            // $("#editModalStout").modal('hide'); 
            // location.reload();
            }
        });
    // return false;
});


// LOGIC UPDATE DETAIL IN EDIT PAGE FUNCTION

$('.modal-footer').on('click','.editItemcode', function(){
    var id = document.getElementById('id_stin_editdetail2').value;
    var route_update =  "{{ route('tms.warehouse.stock_in_entry_update_detail', ':id') }}";
        route_update = route_update.replace(':id', id);
    $.ajax({
        url: route_update,
        type: "POST",
        data: $('#form-edit-detail-stin').serialize(),
        success: function(data){
                $("#modalEditDetail").modal('hide');
                // var jml_ = document.getElementById('jml_row_editdetail').value;
                // alert(jml_)
                var tbl = $('#tbl-edit-stin').DataTable();
                tbl.draw()
                
            },
            error:function(data){
                alert('error');
            }

            
        });
    
});
        


// LOGIC UPDATE HEADER REALTIME FUNCTION
function editHeader(){
    let in_no = document.getElementById('in_no_edit_stin').value;
    let route  = "{{ route('tms.warehouse.stock_in_update_header', ':id') }}";
        route  = route.replace(':id', in_no);
    $.ajax({    
    url: route,
    type: "POST",
    data: $('#form-stin-edit-header').serialize(),
    success: function(data){
          console.log(data)
          if (data.check) {
               Swal.fire({
                    icon: 'warning',
                    title:data.errors
                }); 
          } else {
            $('#editModalStin').modal('hide');
            Swal.fire({
                title: 'Successfully',
                icon: 'success',
                timer:500
            }).then(function(){
                var tbl = $('#tbl-edit-stin').DataTable();
                tbl.draw()
                
            })
          }
       
                
        }
    });
    
}    


function autoFillKali(jml_row){
    let qty2 = $('#quantity'+jml_row).val();
    let factor = $('#factor'+jml_row).val();
    let fac_qty = $('#fac_qty'+jml_row).val();
    let jumlahKali = fac_qty*factor;
    $('#quantity'+jml_row).val(jumlahKali)
}

function autoFillJumlahQtyKaliEdit(){
        let fac_qty = $('#fac_qty_editdetail2').val();
        let factor = $('#factor_editdetail2').val();
        let qty2 = $('#qty_editdetail2').val();
        let unit = $('#unit_editdetail2').val();
        let jumlahKali = fac_qty*factor;
        $('#qty_editdetail2').val(jumlahKali);
        
}


function autoFillJumlahQtyKaliAddRowEdit(itung){
        let fac_qty = $('#fac_qty_editdetaill'+itung).val();
        let factor = $('#factor_editdetaill'+itung).val();
        let qty2 = $('#quantity_editdetaill'+itung).val();
        // let unit = $('#unit_addrowEdit'+itung).val();
        let jumlahKali = fac_qty*factor;
        $('#quantity_editdetaill'+itung).val(jumlahKali);
}


function clearFacQtyQuantity(){
   $('#fac_qty_editdetail2').val("");
   $('#qty_editdetail2').val("");  
   autoFillJumlahQtyKaliEdit();
//    autoFillJumlahQtyBagiEdit(); 
}

function clear_store_stin(){
    $('#dept_create_stin').val("");
    $('#types_create_stin').val("");
    $('#refs_no_create_stin').val("");
    $('#remark_header_create_stin').val("");
    var table = $('#tbl-detail-stin-create').DataTable();
        table.rows().remove().draw(false);
    $('.addStin').html('Save');
}


function checkStClose(period){    
    // var period = $('#period_edit').val();
    // alert(period)
    var route = "{{ route('tms.warehouse.stock_in_check_stclose_',':id') }}";
        route = route.replace(':id', period);
        // $('#tbl-create-mto').DataTable().clear().destroy();
        $.ajax({
            url: route,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                // if (data.msg) {
                    Swal.fire({
                        icon: 'warning',
                        title:  data.msg,
                    }).then(function(){
                        $('#createModalStin').modal('hide');
                    });                   
                } 
              
            
        })
}

function checkStCloseEdit(period){    
    // var period = $('#period_edit').val();
    // alert(period)
    var route = "{{ route('tms.warehouse.stock_in_check_stclose_',':id') }}";
        route = route.replace(':id', period);
        // $('#tbl-create-mto').DataTable().clear().destroy();
        $.ajax({
            url: route,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                // if (data.msg) {
                    Swal.fire({
                        icon: 'warning',
                        title:  'Data sudah closing tidak bisa edit period:'+" "+period
                    }).then(function(){
                        $('#editModalStin').modal('hide'); 
                    });
                                      
                } 
              
            
        })
}
function clear_value_create_page(){
    $('#types_create_stin').val("");
    $('#refs_no_create_stin').val("");
    $('#remark_header_create_stin').val("");
    var table = $('#tbl-detail-stin-create').DataTable();
        table.rows().remove().draw();

}
function clearSearch(){
    $('input[type=search').val("");
    $('#stinModal').on('shown.bs.modal', function () {
        $('input[type=search').focus();
    })
 
}

function clearSearchEdit(){
    $('input[type=search').val("");
    $('#stinModal2').on('shown.bs.modal', function () {
        $('input[type=search').focus();
    })
 
}
function clearSearchEdit2(){
    $('input[type=search').val("");
    $('#stinModal3').on('shown.bs.modal', function () {
        $('input[type=search').focus();
    })
}



function validateRow(){
    var jml_row = document.getElementById('jml_row').value;
    for (let i = 1; i <= jml_row; i++) {
        var itemcode = $('#itemcode'+i).val();
        if (itemcode === "" && i >= i ) {
        Swal.fire({
            icon: 'warning',
            title: 'Isi form dengan berurutan! Sistem akan mereload ke row sebelumnya ke row ke'+"-"+i ,
        }).then(function(){
            var table = $('#tbl-detail-stin-create').DataTable();
            table.row(i).remove().draw();
            // $('#itemcode'+i).focus();
        });
        var table = $('#tbl-detail-stin-create').DataTable();
    } else {
        console.log('OK')
    }
        
    }
   
    // alert(itemcode);
}

function validateRowEdit(){
    var jml_row = document.getElementById('jml_row_editdetail').value;
    for (let i = 1; i <= jml_row; i++) {
        var itemcode = $('#itemcode_editdetaill'+i).val();
        if (itemcode === "" && i >= i ) {
            Swal.fire({
            icon: 'warning',
            title: 'Isi form edit itemcode dengan berurutan! Sistem edit page akan mereload ke row sebelumnya ke row ke'+"-"+ i ,
        }).then(function(){
            var table = $('#tbl-edit-stin').DataTable();
            table.row(i).remove().draw();
        });
        
    } else {
        console.log('OK')
    }
    // alert(itemcode);
}
}
// ONCHANGE
// function editTypes(){
//     let in_no = document.getElementById('in_no_edit_stout').value;
//     let route  = "{{ route('tms.warehouse.stock_out_update_header', ':id') }}";
//         route  = route.replace(':id', out_no);
//     $.ajax({
//     url: route,
//     type: "POST",
//     data: $('#form-stin-edit-header').serialize(),
//     success: function(data){
//         if (data.check) {
//             Swal.fire({
//                 icon: 'warning',
//                 title:data.errors
//             }); 
//         } else {
//             console.log(data)
//         }

//         }
//     });
    
// } 

// function SaveLogEdit(){

// }

// function clear_table_when_input_data_same(){
//     var table = $('#tbl-detail-stout-create').DataTable();
//     table.rows().remove().draw(false);
// }
// function validateItemSame(item){
//     var url = "{{ route('tms.warehouse.stock_out_validate_edit_detail_page', 'item') }}";
//         url = url.replace('item', item);
//     $.ajax({
//         url: url,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data){
//             if (data.check) {
//                 var tableStoutCreate = $('#tbl-detail-stout-create').DataTable();
//                 var counter= tableStoutCreate.rows().count();
//                 Swal.fire({
//                     icon: 'warning',
//                     title: 'Warning',
//                     text: data.error,
//                 });
//                 $('#itemcode'+counter).val("");
//                 $('#part_no'+counter).val("");
//                 $('#descript'+counter).val("");
//                 $('fac_unit'+counter).val("");
//                 $('#fac_qty'+counter).val("");
//                 $('#factor'+counter).val("");
//                 $('#unit'+counter).val("");
//                 $('#quantity'+counter).val("");
//                 $('#remark'+counter).val("");
//             } else {
//                 alert('Not Found');
//             }
//         }
//     })
// }

// function validateItemSameEdit(item){
//     var url = "{{ route('tms.warehouse.stock_out_validate_edit_detail_page', 'item') }}";
//         url = url.replace('item', item);
//     $.ajax({
//         url: url,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data){
//             if (data.check) {
//                 var tableStoutEditDetail = $('#tbl-edit-stout').DataTable();
//                 var counter= tableStoutEditDetail.rows().count();
//                 // alert(counter)
//                 Swal.fire({
//                     icon: 'warning',
//                     title: 'Warning',
//                     text: data.error,
//                 });
//                 $('#itemcode_editdetaill'+counter).val("");
//                 $('#part_no_editdetaill'+counter).val("");
//                 $('#descript_editdetaill'+counter).val("");
//                 $('#fac_unit_editdetaill'+counter).val("");
//                 $('#fac_qty_editdetaill'+counter).val("");
//                 $('#factor_editdetaill'+counter).val("");
//                 $('#unit_editdetaill'+counter).val("");
//                 $('#quantity_editdetaill'+counter).val("");
//                 $('#remark_editdetaill'+counter).val("");
//             } else {
//                 alert('Not Found');
//             }
//         }
//     })
// }
// $('.modal-footer').on('click','.addStin', function(){
//     $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     }); 
//     $.ajax({
//     url: "{{ route('tms.warehouse.stock_in_entry_storeStockIn') }}",
//     type: "POST",
//     data: $('#form-stin').serialize(),
//     dataType: 'json',
//     success: function(data){
//         if($.isEmptyObject(data.error)){
//                 if(data.checkdata){
//                     Swal.fire({
//                         icon: 'warning',
//                         title: data.errors
//                     });
//                     clear_store_stin();
//                     // clear_table_when_input_data_same();
//                 } else {
//                     // $('.addStout').html('Saving...')
//                     clear_store_stin();
//                         Swal.fire(
//                         'Successfully!',
//                         'Menambahkan data baru Stock In entry!',
//                         'success'
//                     ).then(function(){
//                         $('#createModalStin').modal('hide');
//                         $('#stin-entry-datatables').DataTable().ajax.reload();
//                     })
//                 }
//         } else {
//             printErrorMsg(data.error)
//         }

//         }
//     })

//     function printErrorMsg(msg){
//         $('.print-error-msg').find('ul').html('');
//         $('.print-error-msg').css('display','block');
//         $('.addStin').html('Save')
//         $.each(msg, function(key, value){
//             $('.print-error-msg').find('ul').append('<li style="font-size: 15px"><i class="fa fa-exclamation-circle"></i> '+value+'</ul>');
//         });
//     }
// })

// function validateEditDetail(){
//      var tableStoutEditDetail = $('#tbl-edit-stout').DataTable();
//      var counter= tableStoutEditDetail.rows().count();
//      var itemcode = $('#itemcode_editdetaill'+counter).val();
//      alert(itemcode)
//      if (itemcode == "") {
//         Swal.fire({
//             icon: 'warning',
//             title: 'Isi dulu itemcode!',
//         });
//      }
// }
// $(document).on('click','.restore', function(){
// function restore(){
// $('#editModalStoutRestore').modal('show');
// $('.modal-title').text('Restore Item');
// var get_outno = document.getElementById('out_no_edit_stout').value;
// var route =   "{{ route('tms.warehouse.stock_out_stock_out_view_restore_page', ':id') }}"; 
//         route  = route.replace(':id', get_outno);
//     $('#tbl-edit-restore').DataTable().clear().destroy();
//     $('#tbl-edit-restore').DataTable({
//         paging:  false,
//         scrollY: '250px',
//         scrollCollapse: true, 
//         serverSide: true,
//         ajax: route,
//         columns: [
//             {  data: 'itemcode', name: 'itemcode'},
//             {  data: 'part_no', name: 'part_no'},
//             {  data: 'descript', name: 'descript'},
//             {  data: null, 'render': function(data){
//                 var action= '<a href="#" id="restore" class="btn btn-xs btn-success"  data-id='+data['id_stout']+' class="restore">Restore</a>'+' '+
//                             '<a href="#" id="destroypermanen" class="btn btn-xs btn-success" data-id='+data['id_stout']+' class="destroypermanen">Delete Permanen</a>'
//                 return action
//             }}

                
//             ],
        
//         // processing: true,
//         // serverSide: true
//     });
// // })
// }
// $(document).on('click','#restore', function(event){
//     event.preventDefault()
//     var get_id = $(this).attr('data-id');
//     Swal.fire({
//         title: 'Apakah anda yakin ingin merestore data ini?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Ya Restore!'
//     }).
//     then((willRes) => {
//         var route  = "{{ route('tms.warehouse.stock_out_entry_restore_action', ':id') }}";
//         route  = route.replace(':id', get_id);
//         if(willRes.value){
//             $.ajax({
//                 url: route,
//                 type: "GET",
//                 data : {
//                     '_method' : 'POST'
//                 },
//                 success: function(data){  
//                     console.log(data);
//                     $('#editModalStoutRestore').modal('hide'); 
//                     var tbl2 = $('#tbl-edit-stout').DataTable();
//                     tbl2.draw();

//                     }, 
//                     error: function(){
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Error...',
//                             text: 'Error Hub Admin!',
//                         })
//                     }
//                 })
//         } else {
//             console (`data Stock Out Entry was dismissed by ${willRes.dismiss}`);
//         }

        
//     })
    

// });
</script>
    