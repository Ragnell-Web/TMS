<div class="modal fade-out bd-example-modal-lg modalUnPostStin"  tabindex="-1" id="ModalUnPostStin"  role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" ></h4>
        </div>
        <div class="row">
         <div class="col">
          <div class="modal-body">
            <form  id="form-stin-un-post" method="post" action="javascript:void(0)">
              @csrf
              @method('POST')
              <input type="hidden" id="in_no_unpost" name="in_no" value="">
              <div class="form-group row">
                <label for="type"   class="col-2 col-form-label">Type</label>
                <div class="col-9">
                  <input type="text" disabled  value="UN-POST"  name="in_no" class="form-control form-control-sm" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="number"   class="col-2 col-form-label">Number</label>
                <div class="col-9">
                  <input type="text" disabled  name="in_no" class="form-control form-control-sm in_no_unpost" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="exception_note"  class="col-2 col-form-label">Exception Note</label>
                <div class="col-9">
                  <input type="text"  autocomplete="off" name="note" id="note" class="form-control form-control-sm" placeholder="">
                </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info btn-flat btn-sm " data-dismiss="modal">Cancel</button>
                <button type="button"  class="btn btn-info btn-flat btn-sm ok_unpost_stin" ><i class="ti-check"></i> Ok</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>