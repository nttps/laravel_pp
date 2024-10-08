@extends('layouts.backend.master')


@section('title.page' , 'Roles')

@section('breadcrumb')
    {{-- <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">ตั้งค่า</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">ตั่งค่าทั่วไป</span>
            </a>
        </li>
    </ul> --}}
@stop

@section('content')
<div class="m-portlet animated fadeInRight">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Role Management
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    @can('role-create')
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-default btn-sm"> <i class="fa fa-plus"></i> Create New Role</a>
                    @endcan
                </li>
            </ul>
        </div>
        
    </div>
    <div class="m-portlet__body">    
    
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        
        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    {{-- <a class="btn btn-info" href="{{ route('admin.roles.show',$role->id) }}">Show</a> --}}
                    @can('role-edit')
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['admin.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
        
        
        {!! $roles->render() !!}

    </div>
</div>
@stop

@push('script')
@toastr_render
@endpush
