@extends('layouts.backend.master')


@section('title.page' , 'Categories')

@section('breadcrumb')
<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
    <li class="m-nav__item m-nav__item--home">
        <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
        </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
        <a href="{{ route('admin.catalogs.categories.index') }}" class="m-nav__link">
            <span class="m-nav__link-text">Categories</span>
        </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
        <a href="" class="m-nav__link">
            <span class="m-nav__link-text">Sort</span>
        </a>
    </li>
</ul>
@stop

@section('content')
<div class="row animated fadeInLeft">
    <div class="col-12">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Sort Categories

                            <small>Click <span class="fa	fa-arrows-alt"></span> then Drag & Drop items to sort</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">                    
                    <table class="table m-table m-table--head-bg-success">
                        <thead>

                       
                            <tr>
                                <th>Sort</th>
                                <th>Image</th>
                                <th>Category name</th>
                                <th>Category slug</th>
                            </tr>
                        </thead>
                        @php #endregion
                            $i = 1;
                        @endphp
                        <tbody class="sortable" data-entityname="slides">
                            @foreach ($categories as $category)
                                <tr id="item-{{ $category->id }}" data-sort="{{ $category->sort }}">                                
                                    <td class="sortable-handle" width="10px"><span class="fa	fa-arrows-alt"></span></td>
                                    <td><img src="{{Storage::url($category->image) }}" height="60px" alt=""></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                </tr>

                            @php $i++ ;
                            
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.catalogs.categories.sort.store') }}" method="post" name="sortables"> 
        <input type="hidden" name="test-log" id="test-log" /> 
    </form>
    
</div>

@stop

@push('script')
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
@toastr_render
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var changePosition = function(requestData){
        $.ajax({
            'url': '{{ route('admin.catalogs.categories.sort.store') }}',
            'type': 'POST',
            'data': requestData,
            'success': function(data) {
                if (data.success) {
                    toastr.success('Data Sort Complete.');
                    window.location.reload();
                } else {
                    console.error(data.errors);
                }
            },
            'error': function(){
                console.error('Something wrong!');
            }
        });
    };
    $(document).ready(function() { 

        var ul_sortable = $('.sortable');
        ul_sortable.sortable({ 
            handle : '.sortable-handle', 
            items:'tr',
            update : function () {                 
                var sortable_data = ul_sortable.sortable('serialize');
                changePosition(sortable_data);               
            } 
        }); 

        ul_sortable.disableSelection();
    });

    
</script>
@endpush
