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
                            <button class="btn btn-success" type="submit" form="userForm"><i class="ti-check"></i> &nbsp; Save</button>
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
                    
                    <form method="post" action="{!! !empty($data) ? route('admin.users.edit.post', ['id' => $data->id]) : route('admin.users.post') !!}" id="userForm">

                        <div class="row">
                            <div class="col-6">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="userNik" class="col-form-label">NIK</label>
                                            <h4>{{ $data->UserID }}</h4>
                                        </div>
                                        <div class="col-8">
                                            <label for="userName" class="col-form-label">Name</label>
                                            <h4>{{ $data->FullName }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">TMS - INV Group</label>
                                    <h4>{{ $data->Group }}</h4>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">TMS - PRD Group</label>
                                    <h4>{{ $data->Group_OEE }}</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="role" class="col-form-label">Role</label>
                                    <select class="custom-select" name='role'>
                                        <option value='0' selected="selected">No Role</option>
                                        @foreach($roles as $role)
                                        <option value='{{ $role->id }}' {{ $userRole !== null && $userRole->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" value="{!! !empty($data) ? $data->email : '' !!}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
         </div>
    </div>

</div>


@endsection

@push('js')


@endpush