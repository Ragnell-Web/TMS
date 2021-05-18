    <div class="modal fade bd-example-modal-lg modalcreateStin" data-backdrop="static" data-keyboard="false" style="z-index: 1041" tabindex="-1" id="createModalStin"   role="dialog">
        <div class="modal-dialog modal-80">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" ></h4>
              {{-- <button type="button" class="close" data-dismiss="modal" onclick="clear_value_create_page()"><span>&times;</span></button> --}}
            </div>
            <div class="row">
            <div class="col">
              <div class="modal-body create-modal">
                <div class="alert alert-danger print-error-msg" role="alert" style="display: none">
                  <ul></ul>
                </div>
                <form  id="form-stin" method="post" action="javascript:void(0)">
                  @csrf
                  @method('POST')
                  <input type="hidden" id="id_stin" name="id_stin">
                  @include('tms.warehouse.stock-in-entry.modal.create-stin-modal._form')
                  <hr>
                  <div class="row">
                    <div class="col-12 mt-12">
                    <div class="datatable datatable-primary">
                      <div class="table-responsive">
                      <table id="tbl-detail-stin-create" class="table table-bordered table-striped">
                        {{-- style="background-color: #D3D3D3" --}}
                        <thead  class="text-center">
                          <tr>
                            <th>Item Code</th>
                            <th>Part No</th>
                            <th>Description</th>
                            <th>F.Unit</th>
                            <th>F.Qty</th>
                            <th>Factor</th>
                            <th>Unit</th>
                            <th>Qty</th>
                            <th>Remark</th>
                            {{-- <th>
                              {{-- ACTION --}}
                                {{-- <button type="button" data-toggle="tooltip"  data-placement="top" title="Add Item" class="btn btn-danger btn-xs" id="addRow">  <i class="ti-plus"></i></button> --}}
                            {{-- </th>  --}}
                          </tr>
                        </thead>
                        <tbody id="body">  
                        </tbody>
                      </table>  
                      </div>
                    </div>
                  </div>  
                </div>
                <div class="modal-footer">
                  <a href="#" class="btn btn-info destroy">Delete Row</a>
                  {{-- <button type="button" data-toggle="tooltip"  data-placement="top" title="Add Item" class="btn btn-info" id="addRow"> Add Item</button> --}}
                  <button type="button" data-toggle="tooltip"  data-placement="top" title="Add Item" class="btn btn-info" id="addRow">Add Item</button>
                  <button type="button" onclick="clear_value_create_page()" class="btn btn-info " data-dismiss="modal">Close</button>
                  <button type="button"  class="btn btn-info addStin" ><i class="ti-check"></i> Save</button>
              
                {{-- @php $counter @endphp --}}
                  <input type="hidden" id="jml_row" name="jml_row" value="">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>