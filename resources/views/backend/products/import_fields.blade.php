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
            <form class="form-horizontal" method="POST" action="{{ route('admin.catalogs.product.import_process') }}">
                {{ csrf_field() }}
                <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                <div class="table-responsive">
                    <table class="table">
                        @if (isset($csv_header_fields))
                        <tr>
                            @foreach ($csv_header_fields as $csv_header_field)
                                <th>{{ $csv_header_field }}</th>
                            @endforeach
                        </tr>
                        @endif
                        @foreach ($csv_data as $row)
                            <tr>
                            @foreach ($row as $key => $value)
                                <td>{{ $value }}</td>
                            @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            
                            @foreach ($csv_data[0] as $key => $value)
                                <td>
                                    <select name="fields[{{ $key }}]">
                                        @foreach (config('app.db_fields') as $db_field)
                                            <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}"
                                                @if ($key === $db_field) selected @endif>{{ $db_field }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary">
                    Import Data
                </button>
            </form>
        </div>
    </div>


@stop

@push('script')
@toastr_render
<script src="{{ asset('js/backend/vendor/bootstrap-switch.js') }}" type="text/javascript"></script>

@endpush
