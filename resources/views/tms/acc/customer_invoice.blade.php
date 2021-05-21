@extends('master')

@section('title', 'TMS | Customer Invoice')

@section('css')

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

<!-- @section('tms_content_menuHorizontal')
<div class="page-title-area">
    <div class="row" >
        <div class="#">
            <a href="#" class="btn btn-primary btn-round" id="add_form">
                Add Item
            </a>
        </div>
    </div>
</div>
@endsection -->

@section('content')

    <div class="page-title-area">
    <div class="row" >
        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="add_form" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    Add Item
                </a>
            </div>
        </div>

        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="edit_form" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    Edit Item
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
                        <h4 class="card-header-title">Invoice</h4>
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
                                            <th>No</th>
                                            <th>Part No</th>
                                            <th>Item Code</th>
                                            <th>Descript</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>DO No</th>
                                            <th>SSO No</th>
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

    <!-- <div id="data_table"> -->
        <!-- data table start -->
        <!-- <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Master Item TMS</h4>
                    <div class="data-tables datatable-dark">
                        <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%"> -->
                        <!-- <table id="tms_MasterItem_Datatable"
                            class="table table-striped text-center cell-border display compact"
                            style="width:100%"> -->
                            <!-- <thead class="text-uppercase">
                                <tr>
                                    <th>Item Code</th>
                                    <th>Part Number</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Cust</th>
                                    <th>Group</th>
                                    <th>Type</th>
                                    <th>State</th>
                                    <th>Track</th>
                                    <th>BoM</th>
                                    <th>Unit</th>
                                    <th>Fac_Qty</th>
                                    <th>Fac_Unit</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- data table end -->
    <!-- </div> -->
</div>

<!-- Modal -->
<div class="modal fade satu" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col">
                <h4 class="header-title">Entry of Invoice Data</h4>
              </div>
          </div>
          <div class="row goodScroll">
              <div class="col-12">
                <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                        {{ csrf_field() }}
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>Company</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($datasInvoices as $data)
                                <tr class="invoice" data-id="{{$data['id']}}" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-dismiss="modal">
                                    <td>{{$i++}}</td>
                                    <td class="tdCustcode">{{$data['custcode']}}</td>
                                    <td>{{$data['company']}}</td>
                                    <td>{{$data['contact']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
              </div>
          </div>
        <!-- data table start -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade dua" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- data table start -->
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="col-1 mb-2">
                                <label>Invoice No</label>
                            </div>
                            <div class="col-1 mb-2">
                                <input type="text" name="noinvoice" class="form-control form-control-sm" id="noinvoice"
                                    aria-describedby="" value="1" placeholder="No Invoice" disabled>
                            </div>
                            <div class="col-1 mb-2">
                                <input type="text" name="inv_type" class="form-control form-control-sm" id="inv_type"
                                    placeholder="SJ">
                            </div>

                            <div class="col-2 mb-2">
                                <input type="text" placeholder="HO" id="source" name="source"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="col-md-1 mb-2 align-center">
                                <label>Customer Id</label>
                            </div>
                            <div class="col-md-1 mb-2">
                                <input type="text" name="custcode1" class="form-control form-control-sm" id="custcode"
                                    placeholder="Cust Code">
                            </div>
                            <div class="col-md-1 mb-2">
                                <input type="text" name="" class="form-control form-control-sm" placeholder="">
                            </div>
                            <div class="col-md-1 mb-2">
                                <input type="number" name="" class="form-control form-control-sm" placeholder="0"
                                    disabled>
                            </div>
                            <div class="col-md-2 mb-2 align-right">
                                <label>Staff</label>
                            </div>
                            <div class="col-1 mb-2">
                                <input class="form-control form-control-sm" value="{{ Auth::user()->FullName }}"
                                    name="staff" type="text" id="staff_create_stin" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Per/Date</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="period" autocomplete="off" class="form-control form-control-sm"
                                    id="period" placeholder="YYYY/MM">
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="written" autocomplete="off"
                                    class="form-control form-control-sm" id="written" placeholder="YYYY-MM-DD">
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" name="company1" autocomplete="off"
                                    class="form-control form-control-sm" id="company" placeholder="Name of your pt"
                                    disabled>
                            </div>
                            <div class="col-md-1 mb-1 align-right">
                                <label>Prn/Post</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="post" type="text" id="post" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Refs.No</label>
                            </div>
                            <div class="col-4 mb-1">
                                <input type="text" name="ref_no" autocomplete="off" class="form-control form-control-sm"
                                    id="reff_no" placeholder="Ref No">
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" name="contact" autocomplete="off"
                                    class="form-control form-control-sm" id="contact" placeholder="Nama Orang di sana">
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>Voided</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="voided" type="text" id="voided"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>VAT No</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="">
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="">
                            </div>
                            <div class="col-1 mb-1">
                                <input type="text" name="taxrate" autocomplete="off"
                                    class="form-control form-control-sm" id="taxrate" placeholder="Tax Rate %">
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" name="address1" autocomplete="off"
                                    class="form-control form-control-sm" id="address1" placeholder="Address">
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>Sub Total</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Sales / PIC</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="">
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="">
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" name="address3" autocomplete="off"
                                    class="form-control form-control-sm" id="address3" placeholder="Pos code">
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>CN / Disc</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Currency</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="valas" autocomplete="off" class="form-control form-control-sm"
                                    id="valas" placeholder="IDR">
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="rate" autocomplete="off" class="form-control form-control-sm"
                                    id="rate" placeholder="1000">
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="">
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>V.A.T</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Terms</label>
                            </div>
                            <div class="col-4 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="0 Days">
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="">
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>Total</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Due Date</label>
                            </div>
                            <div class="col-4 mb-1">
                                <input type="text" name="due" autocomplete="off" class="form-control form-control-sm"
                                    id="due" placeholder="Date">
                            </div>
                            <div class="col-1 mb-2 align-center">
                                <label>Gl Ar</label>
                            </div>
                            <div class="col-md-1 mb-1">
                                <input type="text" name="glar" autocomplete="off" class="form-control form-control-sm"
                                    id="glar" placeholder="Gl Ar">
                            </div>
                            <div class="col-md-2 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    placeholder="Trade receiveables - Third Parties" disabled>
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>Payment</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Remark</label>
                            </div>
                            <div class="col-4 mb-1">
                                <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
                                    id="refs_no_create_stin" placeholder="">
                            </div>
                            <div class="col-md-6 mb-1 align-right">
                                <label>Balance</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" id="printed_create_stin"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row scrollGood">
                    <div class="col-12 mt-12">
                        <div class="datatable datatable-primary">
                            <div class="table-responsive">
                                <table id="tbl-detail-stin-create" class="table table-bordered table-striped">
                                    {{-- style="background-color: #D3D3D3" --}}
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Part No</th>
                                            <th>Item Code</th>
                                            <th>Descript</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>DO No</th>
                                            <th>SSO No</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body">
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
            <div class="modal-footer">
                <button type="button" data-toggle="tooltip" data-placement="top" title="Add Item" class="btn btn-info"
                    id="addRow" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-dismiss="modal">Add
                    Item</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Close</button>
                <button type="button" class="btn btn-info addStin" id="saveRow" data-bs-dismiss="modal"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade tiga " id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <div class="form-row">
                    <div class="col-1 mb-1">
                        <label>Customer</label>
                    </div>
                    <div class="col-2 mb-1">
                        <input type="text" disabled   name="custcode2" class="form-control form-control-sm custcode" aria-describedby="" placeholder="" disabled>
                    </div>
                    <div class="col-4 mb-1">
                        <input type="text"  value="HO" name="company2"  class="form-control form-control-sm company" placeholder="" disabled>
                    </div>

                    <div class="col-md-2 mb-1 align-right" >
                        <label>Invoice No</label>
                    </div>
                    <div class="col-2 mb-1">
                        <input class="form-control form-control-sm invoiceNo"  value="{{ Auth::user()->FullName }}"  name="invoice" type="text" disabled>
                    </div>

                </div>
            </div>
        </div>
        <div class="row goodScroll">
            <div class="col">
                <form  id="form-stin" method="post" action="javascript:void(0)">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="custSuratJalan" name="custSuratJalan">
                    <hr>
                    <div class="row">
                        <div class="col-12 mt-12">
                            <div class="datatable datatable-primary">
                                <div class="table-responsive">
                                    <table id="tbl-detail-stin-create" class="table table-bordered table-striped">
                                            {{-- style="background-color: #D3D3D3" --}}
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Cus Id</th>
                                                <th>SJ No</th>
                                                <th>DN No</th>
                                                <th>PO No</th>
                                                <th>Ref No</th>
                                                <th>SSO No</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyCustomers">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveBtn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-dismiss="modal">Save changes</button>
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
<script src="{{asset('/js/scriptCustomerInvoice.js')}}"></script>
@endpush
