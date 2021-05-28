@extends('master')

@section('title', 'TMS | Customer Invoice')

@section('css')
<?php

use App\Models\Dbtbs\InvoiceNoGenerate;
$stock = new InvoiceNoGenerate;
$tgl = date('Y-m-d');
?>
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">
<style>
    .invoice{
        cursor: pointer;
    }
    .goodScroll{
        height: 65vh;
        overflow: auto;
    }
    .scrollGood{
        height: 20vh;
        overflow: auto;
    }



</style>

@endsection

@section('content')

<div class="page-title-area">
    <div class="row" >
        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="add_form" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    Recalc
                </a>
            </div>
        </div>

        <div class="col-1" id="tes">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="edit_form" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    Update
                </a>
            </div>
        </div>
    </div>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}

    <div class="main-content-inner">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

      <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Customer Status</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="isiInput">

                    </div>
                    <div class="row mt-3" style="height: 35vh;overflow: auto">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                
                                    <thead class="text-center">
                                        <tr>
                                            <th>id</th>
                                            <th>Company</th>
                                            <th>Balance</th>
                                            <th> < 8 hari</th>
                                            <th>8 - 14 hari</th>
                                            <th>15 - 45 hari</th>
                                            <th> > 45 hari </th>
                                            <th> ST </th>
                                            <th> New </th>
                                        </tr>
                                    </thead>

                                    <tbody id="suratJalanBody">
                                        <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>
                                            </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
    
@endsection

@push('js')

<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Load
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        populate_dtItem('#tms_MasterItem_Datatable');

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Other Function Changes
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $('#add_form').click(function() {
            $('#form_addItem').toggle();
        });

        $('#post_Item').click(function() {
            var email = $('#exampleInputEmail1').val();
            if(email != ''){
                post_entryItem(email);
            } else {
                alert('Fill all fields');
            };
        });

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Nested Function
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function post_entryItem(email){
            $.ajax({
                type:'POST',
                url:'post_entryItem', //Make sure your URL is correct
                dataType: 'json', //Make sure your returning data type dffine as json
                data:{
                    _token: CSRF_TOKEN,
                    email: email
                },
                success:function(response){
                    if(response == 'success'){
                        Swal.fire("Data posting successfully!", "", "success");
                        $('#form_addItem').toggle();
                        populate_dtItem('#tms_MasterItem_Datatable');
                    } else {
                        Swal.fire("Data posting failed!", "", "warning");
                    }
                }
            });
        };
        // const trS = document.querySelectorAll('.invoice');
        // trS.forEach(tr=>tr.addEventListener('click',function (e) {
        //     console.log(e.target);
        //  }))
    } );
    // const trS = document.querySelectorAll('.invoice');
    //     trS.forEach(tr=>tr.addEventListener('click',function (e) {
    //         console.log(e.target.dataset.id);
    //         $.get('/tms/acc',{
    //             id:e.target.dataset.id
    //         },function (data) {
    //             $("#tms_MasterItem_Datatable").html(data)
    //          })
        //  }))

    // console.log(dataId);



</script>
<script src="{{asset('/js/scriptCustomerFile.js')}}"></script>
@endpush
