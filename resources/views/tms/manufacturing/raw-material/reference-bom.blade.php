@extends('master')

@section('title', 'TMS | Manufacturing - Raw Material - Reference BoM Tree')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/select2/css/select2.min.css') }}">
<!-- JSTree -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/jstree/themes/default/style.min.css') }}">

@endsection

@section('content')

@include('tms.__layouts.tms-menuRawMaterial-horizontal')

<div class="main-content-inner">

    <div id="div-unsticky">
        <div class="row" id='row-form'>
            <div class="col-12 mt-3" id="col-form">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" id="reference-bom-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" name="ld" id="reference-bom-form-search" placeholder="keywords :: customer, model, description, item code" required>
                                                <h6 class="reference-bom-form-view" id="reference-bom-form-search"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <button type="submit" form="reference-bom-form" class="btn btn-secondary" id="reference-bom-search"><i class="ti-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="jstree_bom" class="demo" style="padding-left:15px; margin-top:1em; min-height:200px;"></div>
    </div>
</div>

@endsection

@push('js')

<!-- Datatables -->
<script src="{{ asset('/vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/vendor/Datatables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>
<script src="{{ asset('js/custom-select2.js') }}"></script>
<!-- JSTree -->
<script src="{{ asset('vendor/jstree/jstree.min.js') }}"></script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // 1. Search button submit
    $('#reference-bom-form').on('submit', function(event){
        event.preventDefault();

        var keywords = $('#reference-bom-form-search').val();
        var referenceBom_url = "{{ route('tms.manufacturing.raw-material.reference-bom.get_datReferenceBom', ['flag' => ':flag', 'keyword' => ':keyword' ]) }}";
        referenceBom_url  = referenceBom_url.replace(':flag', "SEARCH");
        referenceBom_url  = referenceBom_url.replace(':keyword', keywords);

        $.ajax({
            url: referenceBom_url,
            method: "GET",
            dataType: "json",
            success:function(response){
                var len = 0;
                if(response['data'] != null){
                    len = response['data'].length;
                }
                if(len > 0){
                    // Read data and create <option >
                    var testData = [];

                    for(var i=0; i<len; i++){
                        var parent_node = response['data'][i].parent_node;
                        var child_node  = response['data'][i].child_node;
                        var descript = response['data'][i].descript;
                        var descript1   = response['data'][i].descript1;
                        var cust_code = response['data'][i].custcode;
                        var part_no = response['data'][i].part_no;
                        var factor = response['data'][i].factor;

                        var desc_text
                        if (cust_code =="-"){
                            desc_text = child_node +' - '+ descript + ' ('+ descript1 + ') P/N : '+ part_no + ' [ PN : CN = 1 : ' + factor + ' ]';
                        } else {
                            desc_text = child_node +' - '+ descript + ' ('+ descript1 + ') P/N : '+ part_no + ' # '+ cust_code + ' #';
                        }

                        if (parent_node=="#"){
                            testData[i] = {"id":child_node, "parent":parent_node, "text":desc_text, "type":"root"};
                        } else {
                            testData[i] = {"id":child_node, "parent":parent_node, "text":desc_text, "type":"default"};
                        }
                    }
                    console.log(testData);
                    createJSTree(testData);
                }
            }
        });

    });


    //$(function () {
    //    testData = ["Child 1", { "id" : "demo_child_1", "text" : "Child 2", "children" : [ { "id" : "demo_child_2", "text" : "One more", "type" : "file" }] }];
    //    testData = [
    //                { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
    //                { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
    //                { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
    //                { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
    //                { "id" : "ajson5", "parent" : "ajson3", "text" : "Child Child 1" },
    //               ]
    //    createJSTree(testData);
    //});

    function createJSTree(jsondata){
        $('#jstree_bom').jstree("destroy").empty();
        $('#jstree_bom').jstree({
            "core" : {
                "animation" : 0,
                "check_callback" : true,
                "themes" : { "stripes" : true },
                "data" : jsondata,
            },
            "types" : {
                "#" : {
                    "max_children" : -1,
                    "max_depth" : -1,
                },
                "root" : {
                    "icon" : "ti-folder",
                    "valid_children" : ["default", "file"]
                },
                "default" : {
                    "icon" : "ti-folder",
                    "valid_children" : ["default", "file"]
                },
                "file" : {
                     "icon" : "ti-folder",
                     "valid_children" : []
                 },
            },

            "plugins" : [ "state", "types", "wholerow", "sort" ],
        });

    }

</script>

@endpush
