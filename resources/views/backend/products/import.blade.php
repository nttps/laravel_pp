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
            <form class="form-horizontal" method="POST" action="{{ route('admin.catalogs.product.import_parse') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                    <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                    <div class="col-md-6">
                        <input id="csv_file" type="file" class="form-control" name="csv_file" accept=".csv" required>
                        <span class="help-block">
                            <strong>.CSV only</strong>
                        </span>

                       
                        @if ($errors->has('csv_file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="header" checked> File contains header row?
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Parse CSV
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@stop

@push('script')
@toastr_render
<script src="{{ asset('js/backend/vendor/bootstrap-switch.js') }}" type="text/javascript"></script>

@endpush
