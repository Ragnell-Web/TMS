@extends('master')

@section('title', 'TMS | Print Customer Invoice')

@section('css')

<!-- DATATABLES -->

<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">

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

<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Print Customer Invoice
    </button>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Customer Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- data table start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-3 ">
                                <label> Report Form </label>
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="custcode" autocomplete="off"
                                    class="form-control form-control-sm" id="custcode">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Cut Off Line</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="custcode" autocomplete="off"
                                    class="form-control form-control-sm" id="custcode">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Start/End with Inv no</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided">
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="voided" type="text" id="voided">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Start/End with Vat no</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided" disabled="">
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="voided" type="text" id="voided" disabled="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Start/End with OR no</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided" disabled="">
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="voided" type="text" id="voided" disabled="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Start with date</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Data Selection</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input type="radio" aria-label="Radio button for following text input">
                                <label>Un-printed</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input type="radio" aria-label="Radio button for following text input">
                                <label>Printed</label>
                            </div>
                            <div class="col-3 mb-1">
                                <input type="radio" aria-label="Radio button for following text input">
                                <label>All</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3">
                                <label>PIC</label>
                            </div>
                            <div class="col-6 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Title</label>
                            </div>
                            <div class="col-6 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3">
                                <label>Print to</label>
                            </div>
                            <div class="col-md-3-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided">
                            </div>
                        </div>

                    </div>
                </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
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




</script>
<script src="{{asset('/js/scriptCustomerInvoice.js')}}"></script>
@endpush
