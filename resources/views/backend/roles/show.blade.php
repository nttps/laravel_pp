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
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2> Show Role</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}"> Back</a>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop

@push('script')
@toastr_render
@endpush
