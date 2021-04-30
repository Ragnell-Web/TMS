@extends('master')

@section('title', 'TMS | Admin - Roles')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/jstree/themes/default/style.min.css') }}">

@endsection


@section('content')          

@include('admin.role.role-modal')

<?php   use App\Http\Controllers\ModuleController as module; ?>
<?php   use App\Http\Controllers\ModuleItemController as moduleItem; ?>
<?php   use App\Http\Controllers\ModuleItemPermissionController as permission; ?>
    
<div class="main-content-inner">

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @php echo $ActionButton @endphp
                            <!-- <button class="btn btn-flat btn-success" id="save-btn"><i class="ti-check"></i> &nbsp; Save</button> -->
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
    
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Roles</h4>
                </div>
                <div class="card-body">

                @php $tabModules = module::getAll(array('id', 'name')); @endphp
  
                    <div class="row mt-3">
                        <div class="col">
                            <div class="d-md-flex">
                                <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                
                                @php $i = 1 @endphp

                                @foreach($tabModules as $tabModule)
                                    <a  class="nav-link {{ $i == 1 ? 'activess' : '' }}" 
                                        id="v-pills-{{ $tabModule->id }}-tab" 
                                        data-toggle="pill" 
                                        href="#v-pills-{{ $tabModule->id }}" 
                                        role="tab" 
                                        aria-controls="v-pills-{{ $tabModule->id }}" 
                                        aria-selected="{{ $i == 1 ? 'true' : 'false' }}"
                                        module-id="{{ $tabModule->id }}"
                                    >
                                        {{ $tabModule->name }}
                                    </a>
                                    @php $i++ @endphp
                                @endforeach
                               
                                </div>

                                <div class="tab-content" id="v-pills-tabContent">
                                    
                                @php $i = 1 @endphp

                                @foreach($tabModules as $tabModule)

                                    <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}" id="v-pills-{{ $tabModule->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $tabModule->name }}-tab">

                                    @php $moduleItems = moduleItem::getItem($tabModule->id, array('id', 'title')); @endphp
                                        
                                        <div class="role-jstree" id="{{ 'v-pills-'.$tabModule->id.'-jstree' }}">

                                        @foreach($moduleItems as $moduleItem)

                                            <?php echo permission::getJstree($moduleItem->id) ?>

                                        @endforeach

                                        </div>

                                    </div>

                                    @php $i++ @endphp
                                @endforeach

                                </div>


                            </div>
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
<script src="{{ asset('vendor/jstree/jstree.min.js') }}"></script>


<script>

$(document).ready(function() {
    //Load JsTree
    $('.role-jstree').jstree({
        "checkbox" : {
            "keep_selected_style" : false
        },
        "plugins" : [ "wholerow", "checkbox"]
    });

    getPermission();

    //Save Button
    $('#save-btn').click(function() {
        var selectedTab, selectedJstreeID, moduleID;

        $('.nav-link').each(function() {
            if ($(this).attr("aria-selected") === "true") {
                selectedTab = $(this).attr("aria-controls");
                moduleID    = $(this).attr("module-id");
            }
        });
        
        selectedJstreeID = '#' + selectedTab + '-jstree'; 

        var checked_ids = $(selectedJstreeID).jstree("get_selected", true);

        $.ajax({
            url: "{{ route('admin.roles.permission.save', $role->id) }}",
            method: "POST",
            data: { 
                "_token":"{{ csrf_token() }}",
                "permission":checked_ids,
                "moduleID": moduleID,
            },
            dataType: "json",
            success:function(data){
                if(data.status = 1){
                    Swal.fire(
                        'Success',
                        data.message,
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Failed',
                        data.message,
                        'danger'
                    );
                }
            }
        });
    });

    
});

function getPermission(){
    $.ajax({
        url: "{{ route('admin.roles.permission.get', $role->id) }}",
        method: 'get',
        dataType: 'json',
        success:function(data){
            for(var i = 0; i < data['module'].length; i++){
                for(var ii = 0; ii < data['rolePermission'].length; ii++){
                    $('#v-pills-' + data['module'][i].id  + '-jstree').jstree('check_node', '#' + data['rolePermission'][ii].permission_id);
                }
            }
        }
    });
}

</script>

@endpush