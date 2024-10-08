@extends('layouts.backend.master')


@section('title.page' , 'ตั้งค่าทั่วไป')

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
                <span class="m-nav__link-text">ตั้งค่า</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">ตั่งค่าทั่วไป</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div class="m-portlet">
      
        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('admin.setting.general.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-10 mr-auto">
                        <h3 class="m-form__section">1. ตั้งค่าทั่วไป</h3>
                    </div>
                </div>
                @forelse ($setting_genarals->chunk(5) as $genaralRows)
                    <div class="row">
                        @foreach ($genaralRows as $setting)
                            <div class="col-xl-6">
                                <div class="form-group m-form__group row m--margin-top-10 m--margin-bottom-10">
                                    <label for="{{ $setting->name }}" class="col-lg-3 col-xl-3 col-form-label text-left">{{ $setting->title }}</label>
                                    <div class="col-lg-9 col-xl-9">
                                        @if($setting->type == 'text')
                                            <input type="text" class="form-control m-input" id="{{ $setting->name }}" name="{{ $setting->name }}" aria-describedby="emailHelp" value="{{ $setting->value }}">
                                        @elseif($setting->type == 'textarea')
                                            <textarea class="form-control m-input" id="{{ $setting->name }}" name="{{ $setting->name }}" rows="3" style="resize: none;">{{ $setting->value }}</textarea>
                                        @elseif($setting->type == 'image')
                                            @if($setting->value != null)
                                                <img src="{{ \Storage::url($setting->value) }}" alt="" style="height:50px">
                                            @else
                                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjQ4cHgiIGhlaWdodD0iNDhweCIgdmlld0JveD0iMCAwIDQ4IDQ4IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA0MS4yICgzNTM5NykgLSBodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2ggLS0+CiAgICA8dGl0bGU+KzwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJidXNpbmVzcy1zZXR1cCIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVjYXA9InNxdWFyZSI+CiAgICAgICAgPGcgaWQ9IjAyLWVycm9yIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMzY2LjAwMDAwMCwgLTUxNC4wMDAwMDApIiBzdHJva2U9IiMzODk5RUMiPgogICAgICAgICAgICA8ZyBpZD0iYnVzaW5lc3MtaW5mbyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjQ1LjAwMDAwMCwgMTg1LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9ImxvZ28iIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQyLjAwMDAwMCwgMjUxLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgICAgIDxnIGlkPSIrIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3OS4wMDAwMDAsIDc4LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMC43NjYzNTUxNCwyMy43NTcwMDkzIEw0Ni43NDc2NjM2LDIzLjc1NzAwOTMiIGlkPSJMaW5lIj48L3BhdGg+CiAgICAgICAgICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik0yMy43NTcwMDkzLDAuNzY2MzU1MTQgTDIzLjc1NzAwOTMsNDYuNzQ3NjYzNiIgaWQ9IkxpbmUiPjwvcGF0aD4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==" alt="" class="img-fluid">
                                            @endif
                                            <div class="custom-file">
                                                <input type="file" name="{{ $setting->name }}" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">
                                                    {{ ($setting->value != '') ? $setting->value : 'Choose File' }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <hr>
                <div class="form-group m-form__group row">
                    <div class="col-10 mr-auto">
                        <h3 class="m-form__section">2. Social <span class="m-form__help"> สำหรับตั้งค่าข้อมูล Social ทั้งหมดของเว็บไซต์</span></h3>
                    </div>
                </div>
                @forelse ($setting_socials->chunk(5) as $socialRows)
                    <div class="row">
                        @foreach ($socialRows as $social)
                            <div class="col-xl-6">
                                <div class="form-group m-form__group row m--margin-top-10 m--margin-bottom-10">
                                    <label for="{{ $setting->name }}" class="col-lg-3 col-xl-3 col-form-label text-left">{{ $social->title }}</label>
                                    <div class="col-lg-9 col-xl-9">
                                        @if($social->type == 'text')
                                            <input type="text" class="form-control m-input" id="{{ $social->name }}" name="{{ $social->name }}" aria-describedby="emailHelp" value="{{ $social->value }}" placeholder="{{ $social->title }}">
                                        @elseif($social->type == 'textarea')
                                            <textarea class="form-control m-input" id="{{ $social->name }}" name="{{ $social->name }}" rows="3" style="resize: none;">{{ $social->value }}</textarea>
                                        @elseif($social->type == 'image')
                                            @if($social->value != null)
                                                <img src="{{ \Storage::url($social->value) }}" alt="" style="height:50px">
                                            @else
                                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjQ4cHgiIGhlaWdodD0iNDhweCIgdmlld0JveD0iMCAwIDQ4IDQ4IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA0MS4yICgzNTM5NykgLSBodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2ggLS0+CiAgICA8dGl0bGU+KzwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJidXNpbmVzcy1zZXR1cCIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVjYXA9InNxdWFyZSI+CiAgICAgICAgPGcgaWQ9IjAyLWVycm9yIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMzY2LjAwMDAwMCwgLTUxNC4wMDAwMDApIiBzdHJva2U9IiMzODk5RUMiPgogICAgICAgICAgICA8ZyBpZD0iYnVzaW5lc3MtaW5mbyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjQ1LjAwMDAwMCwgMTg1LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9ImxvZ28iIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQyLjAwMDAwMCwgMjUxLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgICAgIDxnIGlkPSIrIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3OS4wMDAwMDAsIDc4LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMC43NjYzNTUxNCwyMy43NTcwMDkzIEw0Ni43NDc2NjM2LDIzLjc1NzAwOTMiIGlkPSJMaW5lIj48L3BhdGg+CiAgICAgICAgICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik0yMy43NTcwMDkzLDAuNzY2MzU1MTQgTDIzLjc1NzAwOTMsNDYuNzQ3NjYzNiIgaWQ9IkxpbmUiPjwvcGF0aD4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==" alt="" class="img-fluid">
                                            @endif
                                            <div class="custom-file">
                                                <input type="file" name="{{ $social->name }}" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">
                                                    {{ ($social->value != '') ? $social->value : 'Choose File' }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn btn-brand">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop

@push('script')
    @toastr_render
    <script>
    var SummernoteDemo={init:function(){$(".summernote").summernote({height:150})}};jQuery(document).ready(function(){SummernoteDemo.init()});
    </script>
@endpush
