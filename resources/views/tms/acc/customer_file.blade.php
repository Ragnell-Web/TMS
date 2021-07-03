@extends('master')

@section('title', 'TMS | Customer File')

@section('css')
<?php

$tgl = date('d-m-Y');

?>
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">
<style>
    .invoice {
        cursor: pointer;
    }

    .goodScroll {
        height: 65vh;
        overflow: auto;
    }

    .scrollGood {
        height: 20vh;
        overflow: auto;
    }

    #biling {
        margin-left: 350px;
    }

    #do {
        margin-left: 50px;
    }

    #custcode2,#company2,#pt2,#contact2 {
        text-transform: uppercase;
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

    <div class="row">
        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="addItem" data-bs-toggle="modal"
                    data-bs-target="#exampleModal1">
                    Add Item
                </a>
            </div>
        </div>

        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="editItem" data-bs-toggle="modal"
                    data-bs-target="#exampleModal2">
                    Edit Item
                </a>
            </div>
        </div>

        <div class="col-1">
            <div class="#">
                <a href="" class="btn btn-danger btn-round" id="deleteItem">
                    Delete Item
                </a>
            </div>
        </div>
    </div>

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
                            <h4 class="card-header-title">Customer File</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="data-tables datatable-dark">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="col-1 mb-2">
                                                    <label>Code/Id</label>
                                                </div>
                                                <input type="hidden" name="id" class="form-control form-control-sm"
                                                    id="id" value="{{$getCustomer['id']}}">
                                                <div class="col-1 mb-2">
                                                    <input type="text" name="custcode"
                                                        class="form-control form-control-sm"
                                                        value="{{$getCustomer['custcode']}}" id="custcode" disabled>
                                                </div>
                                                <div class="col-1 mb-2">
                                                    <input type="text" name="cus_group"
                                                        class="form-control form-control-sm"
                                                        value="{{$getCustomer['cus_group']}}" id="cus_group" disabled>
                                                </div>

                                                <div class="col-1 mb-2">
                                                    <input type="text" class="form-control form-control-sm" disabled>
                                                </div>

                                                <div class="col-md-6 mb-1 align-right">
                                                    <label>Branch/Wh Id</label>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <input type="text" name="branch"
                                                        class="form-control form-control-sm"
                                                        value="{{$getCustomer['branch']}}" id="branch" disabled>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <input type="text" name="warehouuse" id="warehouse"
                                                        value="{{$getCustomer['warehouse']}}"
                                                        class="form-control form-control-sm" disabled="">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>Company</label>
                                                </div>
                                                <div class="col-5 mb-1">
                                                    <input type="text" name="company" autocomplete="off"
                                                        value="{{$getCustomer['company']}}"
                                                        class="form-control form-control-sm" id="company" disabled>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <input type="text" name="pt" autocomplete="off"
                                                        class="form-control form-control-sm" id="pt" disabled>
                                                </div>
                                                <div class="col-md-3 mb-1 align-right">
                                                    <label> Entered </label>
                                                </div>
                                                <div class="col-2 mb-1">
                                                    <input class="form-control form-control-sm" name="date" type="text"
                                                        id="date" value="{{$getCustomer['entered']}}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>Contact</label>
                                                </div>
                                                <div class="col-5 mb-1">
                                                    <input type="text" name="contact" autocomplete="off" id="contact"
                                                        value="{{$getCustomer['contact']}}"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-md-4 mb-1 align-right">
                                                    <label>Part Tag No ?</label>
                                                </div>
                                                <div class="col-1 mb-1">
                                                    <input class="form-control form-control-sm" name="part" type="text"
                                                        id="part" value="N" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-5 mb-1" id="biling">
                                                    <label>Billing Address</label>
                                                </div>
                                                <div class="col-1 mb-1" id="do">
                                                    <label>DO Address</label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-5 mb-1">
                                                    <input type="text" id="address1" name="address1" autocomplete="off"
                                                        value="{{$getCustomer['address1']}}"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <input type="text" id="do_addr1" name="do_addr1"
                                                        value="{{$getCustomer['do_addr1']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label></label>
                                                </div>
                                                <div class="col-5 mb-1">
                                                    <input type="text" id="address2" name="address2"
                                                        value="{{$getCustomer['address2']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <input type="text" id="do_addr2"
                                                        value="{{$getCustomer['do_addr2']}}" name="do_addr2"
                                                        autocomplete="off" class="form-control form-control-sm"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label></label>
                                                </div>
                                                <div class="col-5 mb-1">
                                                    <input type="text" id="address3" name="address3"
                                                        value="{{$getCustomer['address3']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <input type="text" id="do_addr3" name="do_addr3"
                                                        value="{{$getCustomer['do_addr3']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label></label>
                                                </div>
                                                <div class="col-5 mb-1">
                                                    <input type="text" id="address4" name="address4"
                                                        value="{{$getCustomer['address4']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <input type="text" id="do_addr4" name="do_addr4"
                                                        value="{{$getCustomer['do_addr4']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-2 mb-1">
                                                    <input type="text" id="phone" name="phone"
                                                        value="{{$getCustomer['phone']}}" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-3 mb-1 align-right">
                                                    <label>Salesman</label>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <input type="text" id="salesman" name="salesman" autocomplete="off"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                                <div class="col-md-5 mb-1">
                                                    <input type="text" id="salesman2" name="salesman2"
                                                        autocomplete="off" class="form-control form-control-sm"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>Fax</label>
                                                </div>
                                                <div class="col-2 mb-1">
                                                    <input type="text" id="fax" value="{{$getCustomer['fax']}}"
                                                        name="fax" autocomplete="off"
                                                        class="form-control form-control-sm" id="due" disabled>
                                                </div>
                                                <div class="col-3 mb-2 align-right">
                                                    <label>GLAR</label>
                                                </div>
                                                <div class="col-md-2 mb-1">
                                                    <input type="text" name="glar" autocomplete="off"
                                                        value="{{$getCustomer['glar']}}"
                                                        class="form-control form-control-sm" id="glar" disabled>
                                                </div>
                                                <div class="col-md-4 mb-1">
                                                    <input type="text" name="" autocomplete="off"
                                                        value="Trade Receivables - Third Parties"
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>H.P.</label>
                                                </div>
                                                <div class="col-2 mb-1">
                                                    <input type="text" id="hp" name="hp" value="{{$getCustomer['hp']}}"
                                                        autocomplete="off" class="form-control form-control-sm"
                                                        disabled>
                                                </div>
                                                <div class="col-3 mb-2 align-right">
                                                    <label>NPWP</label>
                                                </div>
                                                <div class="col-md-3 mb-1">
                                                    <input class="form-control form-control-sm" name="npwp" type="text"
                                                        id="npwp" value="{{$getCustomer['npwp']}}" disabled>
                                                </div>
                                                <div class="col-1 mb-2 align-right">
                                                    <label>Price By</label>
                                                </div>
                                                <div class="col-md-2 mb-1">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="pl_by" disabled>
                                                        <?php

                                                        if ($getCustomer['pl_by'] == 'S') {
                                                            echo "<option value='S' selected>SO</option>";
                                                            echo "<option value='D'>DATE</option>";
                                                        }else {
                                                            echo "<option value='D'selected>DATE</option>";
                                                            echo "<option value='S'>SO</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-1 mb-1">
                                                    <label>E-mail</label>
                                                </div>
                                                <div class="col-2 mb-1">
                                                    <input type="text" name="email" autocomplete="off"
                                                        class="form-control form-control-sm" id="email"
                                                        value="{{$getCustomer['email']}}" disabled>
                                                </div>
                                                <div class="col-3 mb-2 align-right">
                                                    <label>Term of Pay</label>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <input class="form-control form-control-sm" name="termofpay"
                                                        type="text" id="termofpay" value="{{$getCustomer['termofpay']}}"
                                                        disabled>
                                                </div>
                                                <div class="col-1 mb-2">
                                                    <label>days</label>
                                                </div>
                                                <div class="col-2 mb-2 align-right">
                                                    <label>DN Term</label>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <input class="form-control form-control-sm" name="term_dn"
                                                        type="text" id="term_dn" value="{{$getCustomer['term_dn']}}"
                                                        disabled>
                                                </div>
                                                <div class="col-1 mb-2">
                                                    <label>days</label>
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
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade satu" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                                    <label>Code/Id</label>
                                </div>
                                <div class="col-1 mb-2">
                                    <input type="text" name="custcode2" class="form-control form-control-sm"
                                        id="custcode2">
                                </div>
                                <div class="col-1 mb-2" id="divCusgroup">
                                    <input type="text" name="cus_group2" class="form-control form-control-sm inputModal"
                                        id="cus_group2" disabled>
                                </div>

                                <div class="col-1 mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled>
                                </div>

                                <div class="col-md-6 mb-1 align-right">
                                    <label>Branch/Wh Id</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" name="branch2" class="form-control form-control-sm inputModal"
                                        id="branch2" disabled>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" name="warehouse2" id="warehouse2"
                                        class="form-control form-control-sm inputModal" disabled="">
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Company</label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" name="company2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" id="company2" disabled>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" name="pt2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" id="pt2" disabled>
                                </div>
                                <div class="col-md-3 mb-1 align-right">
                                    <label> Entered </label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="date2" type="text"
                                        id="date2" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Contact</label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" name="contact2" autocomplete="off" id="contact2"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-md-4 mb-1 align-right">
                                    <label>Part Tag No ?</label>
                                </div>
                                <div class="col-1 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="part2" type="text"
                                        id="part2" value="N" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-5 mb-1" id="biling2">
                                    <label>Billing Address</label>
                                </div>
                                <div class="col-1 mb-1" id="do2">
                                    <label>DO Address</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Address</label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address1_2" name="address1_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr1_2" name="do_addr1_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label></label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address2_2" name="address2_2" autocomplete="off"
                                        class="form-control form-control-sm  inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr2_2" name="do_addr2_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label></label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address3_2" name="address3_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr3_2" name="do_addr3_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label></label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address4_2" name="address4_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr4_2" name="do_addr4_2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Phone</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" id="phone2" name="phone2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-3 mb-1 align-right">
                                    <label>Salesman</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" id="salesman2" name="salesman2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-md-5 mb-1">
                                    <input type="text" id="salesman2_2" name="salesman2_2" autocomplete="off"
                                        class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Fax</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" id="fax2" name="fax2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" id="due" disabled>
                                </div>
                                <div class="col-3 mb-2 align-right">
                                    <label>GLAR</label>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <input type="text" name="glar2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" value="11.212.000" id="glar2"
                                        disabled>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <input type="text" name="" autocomplete="off"
                                        value="Trade Receivables - Third Parties" class="form-control form-control-sm"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>H.P.</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" id="hp2" name="hp2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-3 mb-2 align-right">
                                    <label>NPWP</label>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="npwp2" type="text"
                                        id="npwp2" disabled>
                                </div>
                                <div class="col-1 mb-2 align-right">
                                    <label>Price By</label>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <select class="form-select inputModal" id="pl_by2"
                                        aria-label="Default select example" disabled>
                                        <option value="S" selected>SO</option>
                                        <option value="D">DATE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>E-mail</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" name="email2" autocomplete="off"
                                        class="form-control form-control-sm inputModal" id="email2" disabled>
                                </div>
                                <div class="col-3 mb-2 align-right">
                                    <label>Term of Pay</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="termofpay2" type="text"
                                        id="termofpay2" disabled>
                                </div>
                                <div class="col-1 mb-2">
                                    <label>days</label>
                                </div>
                                <div class="col-2 mb-2 align-right">
                                    <label>DN Term</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="term_dn2" type="text"
                                        id="term_dn2" disabled>
                                </div>
                                <div class="col-1 mb-2">
                                    <label>days</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#exampleModal1">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
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
                                    <label>Code/Id</label>
                                </div>
                                <div class="col-1 mb-2">
                                    <input type="text" name="custcode3" class="form-control form-control-sm"
                                        value="{{$getCustomer['custcode']}}" id="custcode3" disabled>
                                </div>
                                <div class="col-1 mb-2" id="divCusgroup2">
                                    <select class="form-select inputModal" id="cus_group3"
                                        aria-label="Default select example">
                                        <option value="00"
                                            <?php if($getCustomer['cus_group'] == '00' ) { echo "selected='selected'"; }?>>
                                            00 OTOMATIF - ISI</option>
                                        <option value="10"
                                            <?php if($getCustomer['cus_group'] == '10' ) { echo "selected='selected'"; }?>>
                                            10 OTOMATIF - NON ISI</option>
                                        <option value="90"
                                            <?php if($getCustomer['cus_group'] == '90' ) { echo "selected='selected'"; }?>>
                                            90 LAIN - LAIN</option>
                                        <option value="SC"
                                            <?php if($getCustomer['cus_group'] == 'SC' ) { echo "selected='selected'"; }?>>
                                            SC - SUBCON SUPLIER</option>
                                    </select>
                                </div>

                                <div class="col-1 mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled>
                                </div>

                                <div class="col-md-6 mb-1 align-right">
                                    <label>Branch/Wh Id</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" name="branch3" class="form-control form-control-sm inputModal"
                                        value="{{$getCustomer['branch']}}" id="branch3" disabled>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" name="warehouse3" id="warehouse3"
                                        value="{{$getCustomer['warehouse']}}"
                                        class="form-control form-control-sm inputModal" disabled="">
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Company</label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" name="company3" autocomplete="off"
                                        value="{{$getCustomer['company']}}"
                                        class="form-control form-control-sm inputModal" id="company3" disabled>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" name="pt3" autocomplete="off"
                                        class="form-control form-control-sm inputModal" id="pt3" disabled>
                                </div>
                                <div class="col-md-3 mb-1 align-right">
                                    <label> Entered </label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="date3" type="text"
                                        id="date3" value="{{$getCustomer['entered']}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Contact</label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" name="contact3" autocomplete="off" id="contact3"
                                        value="{{$getCustomer['contact']}}"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-md-4 mb-1 align-right">
                                    <label>Part Tag No ?</label>
                                </div>
                                <div class="col-1 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="part3" type="text"
                                        id="part3" value="N" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-5 mb-1" id="biling">
                                    <label>Billing Address</label>
                                </div>
                                <div class="col-1 mb-1" id="do">
                                    <label>DO Address</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Address</label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address1_3" name="address1_3" autocomplete="off"
                                        value="{{$getCustomer['address1']}}"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr1_3" name="do_addr1_3"
                                        value="{{$getCustomer['do_addr1']}}" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label></label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address2_3" name="address2_3"
                                        value="{{$getCustomer['address2']}}" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr2_3" value="{{$getCustomer['do_addr2']}}"
                                        name="do_addr2_3" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label></label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address3_3" name="address3_3"
                                        value="{{$getCustomer['address3']}}" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr3_3" name="do_addr3_3"
                                        value="{{$getCustomer['do_addr3']}}" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label></label>
                                </div>
                                <div class="col-5 mb-1">
                                    <input type="text" id="address4_3" name="address4_3"
                                        value="{{$getCustomer['address4']}}" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-6 mb-1">
                                    <input type="text" id="do_addr4_3" name="do_addr4_3"
                                        value="{{$getCustomer['do_addr4']}}" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Phone</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" id="phone3" name="phone3" value="{{$getCustomer['phone']}}"
                                        autocomplete="off" class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-3 mb-1 align-right">
                                    <label>Salesman</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input type="text" id="salesman3" name="salesman3" autocomplete="off"
                                        class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-md-5 mb-1">
                                    <input type="text" id="salesman2_3" name="salesman2_3" autocomplete="off"
                                        class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>Fax</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" id="fax3" value="{{$getCustomer['fax']}}" name="fax3"
                                        autocomplete="off" class="form-control form-control-sm inputModal" id="due"
                                        disabled>
                                </div>
                                <div class="col-3 mb-2 align-right">
                                    <label>GLAR</label>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <input type="text" name="glar3" autocomplete="off" value="{{$getCustomer['glar']}}"
                                        class="form-control form-control-sm inputModal" id="glar3" disabled>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <input type="text" name="" autocomplete="off"
                                        value="Trade Receivables - Third Parties" class="form-control form-control-sm"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>H.P.</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" id="hp3" name="hp3" value="{{$getCustomer['hp']}}"
                                        autocomplete="off" class="form-control form-control-sm inputModal" disabled>
                                </div>
                                <div class="col-3 mb-2 align-right">
                                    <label>NPWP</label>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="npwp3" type="text"
                                        id="npwp3" value="{{$getCustomer['npwp']}}" disabled>
                                </div>
                                <div class="col-1 mb-2 align-right">
                                    <label>Price By</label>
                                </div>
                                <div class="col-md-2 mb-1" id="divPlby">
                                    <select class="form-select inputModal" id="pl_by3"
                                        aria-label="Default select example" disabled>
                                        <option value="S"
                                            <?php if($getCustomer['pl_by']=='S'){echo "selected='selected'";}?>>SO
                                        </option>
                                        <option value="D"
                                            <?php if($getCustomer['pl_by']=='D'){echo "selected='selected'";}?>>DATE
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 mb-1">
                                    <label>E-mail</label>
                                </div>
                                <div class="col-2 mb-1">
                                    <input type="text" name="email3" autocomplete="off"
                                        class="form-control form-control-sm inputModal" id="email3"
                                        value="{{$getCustomer['email']}}" disabled>
                                </div>
                                <div class="col-3 mb-2 align-right">
                                    <label>Term of Pay</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="termofpay3" type="text"
                                        id="termofpay3" value="{{$getCustomer['termofpay']}}" disabled>
                                </div>
                                <div class="col-1 mb-2">
                                    <label>days</label>
                                </div>
                                <div class="col-2 mb-2 align-right">
                                    <label>DN Term</label>
                                </div>
                                <div class="col-md-1 mb-1">
                                    <input class="form-control form-control-sm inputModal" name="term_dn3" type="text"
                                        id="term_dn3" value="{{$getCustomer['term_dn']}}" disabled>
                                </div>
                                <div class="col-1 mb-2">
                                    <label>days</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editBtn" data-bs-dismiss="modal">Ok</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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

        $(document).ready(function () {

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Function On Load
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            populate_dtItem('#tms_MasterItem_Datatable');

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Function On Other Function Changes
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $('#add_form').click(function () {
                $('#form_addItem').toggle();
            });

            $('#post_Item').click(function () {
                var email = $('#exampleInputEmail1').val();
                if (email != '') {
                    post_entryItem(email);
                } else {
                    alert('Fill all fields');
                };
            });

            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // JS Nested Function
            // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            function post_entryItem(email) {
                $.ajax({
                    type: 'POST',
                    url: 'post_entryItem', //Make sure your URL is correct
                    dataType: 'json', //Make sure your returning data type dffine as json
                    data: {
                        _token: CSRF_TOKEN,
                        email: email
                    },
                    success: function (response) {
                        if (response == 'success') {
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
        });
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
</div>