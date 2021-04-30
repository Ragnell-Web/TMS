@extends('master')

@section('title', 'TMS | Admin - Modules')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection


@section('content')           
    
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success" type="submit" form="moduleForm"><i class="ti-check"></i> &nbsp; Save</button>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    
                @if(session('success'))
                    <div class="alert-dismiss">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    @endif

                    @if(session('failed'))
                    <div class="alert-dismiss">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <form method="post" action="{!! !empty($data) ? route('admin.modules.postEdit', ['id' => $data->id]) : route('admin.modules.post') !!}" enctype="multipart/form-data" id="moduleForm">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="moduleName" class="col-form-label">Module Name</label>
                                    <input class="form-control" type="text" name="name" id="moduleName" placeholder="Sample Module" value="{!! !empty($data) ? $data->name : '' !!}" required>
                                </div>
                                <div class="form-group">
                                    <label for="moduleUrl" class="col-form-label">URL</label>
                                    <input class="form-control" type="text" name="url" id="moduleUrl" placeholder="/sample-module" value="{!! !empty($data) ? $data->url : '' !!}" required>
                                </div>
                                <label class="col-form-label">Icon</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="moduleIcon" name="icon" {!! !empty($data) ? '' : 'required' !!}>
                                    <label class="custom-file-label" for="moduleIcon" id="labelModuleIcon">{!! !empty($data) ? $data->icon : "Choose file" !!}</label>
                                </div>
                                <div class="row mt-3 icon-container dashed-border"  style="margin:auto">
                                    <div class="col text-center" style="margin:auto;">
                                        <img class="module-icon"  id='iconPreview' src="{!! !empty($data) ? asset('images/module-icons/').'/'.$data->icon : asset('images/module-icons/').'/empty-icon.png' !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-1" style="margin: auto">
                                        <button class="btn btn-xs btn-secondary" type="button" style="width:100%" id="clearPreview">Clear</button>
                                    </div>
                                </div>
                            </form>
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

<script>
$("#moduleIcon").change(function() {
  showPreview(this);
});

$("#clearPreview").click(function() {
    clearPreview("#moduleIcon", "#labelModuleIcon", "#iconPreview");
})

function showPreview(objFileInput){
    if(objFileInput.files[0]){
        var fileReader = new FileReader();
        fileReader.onload = function (e){
            $('#iconPreview').attr('src', e.target.result);
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
        $("#labelModuleIcon").html(objFileInput.files[0].name);
    }
}

function clearPreview(id, labelId, previewId, defaultImage = "{{ asset('images/module-icons/').'/empty-icon.png' }}"){
    $(id).val('');
    $(labelId).html('Choose File');
    $(previewId).attr("src", defaultImage);
}

</script>

@endpush