@extends('layouts.backend.master')


@section('title.page' , 'Products')

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.catalogs.product.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Products</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Import</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Import product CSV
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            @if(Session::has('message'))
                <p class="alert alert-warning"><strong>{!! Session::get('message') !!}</strong> </p>
            @endif
            <p class="alert alert-success"> 
                <strong>Data imported successfully. </strong>
                <br> <strong> Total   {{ $p }} </strong><br> 
                
                <strong> Product : {{ $subp }}.  </strong> <br> 
                
                <strong> Attribute : {{ $suba }}  </strong>
            
            </p>
            

           
        </div>
    </div>


@stop

@push('script')
@toastr_render
<script src="{{ asset('js/backend/vendor/bootstrap-switch.js') }}" type="text/javascript"></script>

@endpush
