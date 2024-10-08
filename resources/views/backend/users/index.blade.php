@extends('layouts.backend.master')


@section('title.page' , 'Users')

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">User</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
<div class="m-portlet animated fadeInRight">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Users Management
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    @can('user-create')
                        <a href="{{ route('admin.users.create') }}" class="btn btn-default btn-sm"> <i class="fa fa-plus"></i> Create New User</a>
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
            <th>Email</th>
            <th>Roles Admin</th>
            <th>View Price</th>
            <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
                </td>
                <td>{{ $user->type }}</td>
                <td>
                @can('user-edit')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit',$user->id) }}">Edit</a>
                @endcan
                @can('user-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                @endcan
                </td>
            </tr>
            @endforeach
            </table>
            
            
            {!! $data->render() !!}
    </div>
</div>
    
@stop


@push('script')
@toastr_render
@endpush