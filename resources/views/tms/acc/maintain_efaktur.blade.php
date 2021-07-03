@extends('master')

@section('title', 'TMS | Maintain E-Faktur')

@section('content')
<style>
  .marginTop{
    margin-top: -15px;
  }
</style>
<div class="main-content-inner">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>
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
    </div>

    <div class="row">
      <div class="col-12 mt-5">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <h4 class="card-header-title">Maintain E-Faktur</h4>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <table class="table table-striped table-active" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Printed</th>
                      <th>Date</th>
                      <th>Inv No</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="col-7">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                  <button class="btn btn-primary" id="eFakturBtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                    E-Faktur Content
                  </button>
                  <button class="btn btn-primary" id="note" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                      Note
                  </button>
                </div>
              </div>
            </div>
            <div class="row marginTop"  >
              <div class="col-5" style="height: 40vh;overflow-y: auto;">
                <table class="table table-hover" id="tableEfPrint" style="width: 100%;">
                  <tbody id="tBodyInvoice">
                    @foreach ($getEfPrint as $item)
                        <tr class="tableInvoice" data-ef="{{$item['ef_no']}}">
                          <td class="noUrut">{{$item['ef_no']}}</td>
                          <td class="printed">{{$item['printed']}}</td>
                          <td class="date">{{$item['start_date']}}</td>
                          <td class="invNo">{{$item['start_inv']}}</td>
                          <td class="action">
                            <a href="#" class="link-primary" data-ef="{{$item['ef_no']}}"><i class="ti-write editItem"></i></a>
                            <a href="#" class="link-danger" data-ef="{{$item['ef_no']}}"><i class="ti-trash deleteItem"></i></a>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col-7" style="height: 40vh;overflow-y: auto;">
                <div class="collapse eFakturNote" id="collapseExample1">
                  <div class="card card-body card-bordered cardEfaktur">
                    {{$getEfaktur['m_header']}}
                  </div>
                </div>
                <div class="collapse" id="collapseExample2">
                  <div class="card card-body card-bordered">
                    <table class="table table-borderless table-primary">
                      <tr>
                        <th>Printed</th>
                        <td> :</td>
                        <td id="printedDate"></td>
                      </tr>
                      <tr>
                        <th>Inv. No</th>
                        <td> :</td>
                        <td id="invoiceNo"></td>
                      </tr>
                      <tr>
                        <th>Inv. Date</th>
                        <td> :</td>
                        <td id="dateNo"></td>
                      </tr>
                      <tr>
                        <th>Operator</th>
                        <td> :</td>
                        <td id="operator"></td>
                      </tr>
                    </table>
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
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col">
                      <div class="form-row">
                        <div class="col-6 mb-4">
                          <label for="noPrefix">Tax No Prefix :</label>
                        </div>
                        <div class="col-6 mb-4">
                          <input type="text" name="noPrefix" id="noPrefix" class="form-control form-control-sm" value="00215">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-7">
                          <label for="startInvoiceNo">Start with Invoice no :</label>
                        </div>
                        <div class="col-5">
                          <input type="text" name="startInvoiceNo" id="startInvoiceNo" class="form-control form-control-sm" value="{{$startInvoice[0]['invoice']}}">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-7">
                          <label for="endInvoiceNo">End with Invoice no :</label>
                        </div>
                        <div class="col-5">
                          <input type="text" name="endInvoiceNo" id="endInvoiceNo" class="form-control form-control-sm" value="{{$startInvoice[1]['invoice']}}">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-6">
                          <label for="startDate">Start with Date :</label>
                        </div>
                        <div class="col-6">
                          <input type="date" name="startDate" id="startDate" class="form-control form-control-sm" value="{{$startInvoice[0]['written']}}">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-6">
                          <label for="endDate">End with Date :</label>
                        </div>
                        <div class="col-6">
                          <input type="date" name="endDate" id="endDate" class="form-control form-control-sm" value="{{$startInvoice[1]['written']}}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade dua" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th width='12%'>Invoice</th>
                            <th width='12%'>PPn No.</th>
                            <th width='12%'>Ref No.</th>
                            <th width='12%'>OR No.</th>
                            <th width='20%'>Date</th>
                            <th width='22%'>Company</th>
                            <th width='10%'>ID</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="height: 35vh;overflow: auto;">
                    <div class="col-12">
                      <table class="table table-hover">
                        <tbody id="tBodyInvoice2"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade tiga" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th width='12%'>Invoice</th>
                            <th width='12%'>PPn No.</th>
                            <th width='12%'>Ref No.</th>
                            <th width='12%'>OR No.</th>
                            <th width='20%'>Date</th>
                            <th width='22%'>Company</th>
                            <th width='10%'>ID</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="height: 35vh;overflow: auto;">
                    <div class="col-12">
                      <table class="table table-hover">
                        <tbody id="tBodyInvoice3"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Close</button>
                    <button type="button" class="btn btn-info addStin" data-bs-dismiss="modal" id="addBtn"><i
                            class="ti-check"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('/js/scriptMaintain.js')}}"></script>
</div>

@endsection
