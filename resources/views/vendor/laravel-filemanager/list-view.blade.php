@if((sizeof($files) > 0) || (sizeof($directories) > 0))
<table class="table m-table m-table--head-separator-primary">
  <thead>
    <th style='width:40%;'>{{ Lang::get('laravel-filemanager::lfm.title-item') }}</th>
    <th>{{ Lang::get('laravel-filemanager::lfm.title-size') }}</th>
    <th>{{ Lang::get('laravel-filemanager::lfm.title-type') }}</th>
    <th>{{ Lang::get('laravel-filemanager::lfm.title-modified') }}</th>
    <th>{{ Lang::get('laravel-filemanager::lfm.title-action') }}</th>
  </thead>
  <tbody>
    @foreach($items as $item)
    <tr>
      <td>
        <img src="{{ $item->icon }}" alt="" style="width:2.1rem">
        <a class="{{ $item->is_file ? 'file' : 'folder'}}-item clickable" data-id="{{ $item->is_file ? $item->url : $item->path }}" title="{{$item->name}}">
          {{ str_limit($item->name, $limit = 40, $end = '...') }}
        </a>
      </td>
      <td>{{ $item->size }}</td>
      <td>{{ $item->type }}</td>
      <td>{{ $item->time }}</td>
      <td class="actions">
        @if($item->is_file)
          <a class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" href="javascript:download('{{ $item->name }}')" title="{{ Lang::get('laravel-filemanager::lfm.menu-download') }}">
            <i class="fa fa-download fa-fw"></i>
          </a>
          @if($item->thumb)
            <a class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" href="javascript:fileView('{{ $item->url }}', '{{ $item->updated }}')" title="{{ Lang::get('laravel-filemanager::lfm.menu-view') }}">
              <i class="fa fa-image fa-fw"></i>
            </a>
            <a class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" href="javascript:cropImage('{{ $item->name }}')" title="{{ Lang::get('laravel-filemanager::lfm.menu-crop') }}">
              <i class="fa fa-crop fa-fw"></i>
            </a>
            <a class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" href="javascript:resizeImage('{{ $item->name }}')" title="{{ Lang::get('laravel-filemanager::lfm.menu-resize') }}">
              <i class="fa fa-arrows-alt fa-fw"></i>
            </a>
          @endif
        @endif
        <a class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" href="javascript:rename('{{ $item->name }}')" title="{{ Lang::get('laravel-filemanager::lfm.menu-rename') }}">
          <i class="fa fa-edit fa-fw"></i>
        </a>
        <a class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" href="javascript:trash('{{ $item->name }}')" title="{{ Lang::get('laravel-filemanager::lfm.menu-delete') }}">
          <i class="fa fa-trash fa-fw"></i>
        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{-- <table class="table visible-xs">
  <tbody>
    @foreach($items as $item)
    <tr>
      <td>
        <div class="media" style="height: 70px;">
          <div class="media-left">
            <div class="square {{ $item->is_file ? 'file' : 'folder'}}-item clickable"  data-id="{{ $item->is_file ? $item->url : $item->path }}">
              @if($item->thumb)
              <img src="{{ $item->thumb }}">
              @else
              <i class="fa {{ $item->icon }} fa-5x"></i>
              @endif
            </div>
          </div>
          <div class="media-body" style="padding-top: 10px;">
            <div class="media-heading">
              <p>
                <a class="{{ $item->is_file ? 'file' : 'folder'}}-item clickable" data-id="{{ $item->is_file ? $item->url : $item->path }}">
                  {{ str_limit($item->name, $limit = 20, $end = '...') }}
                </a>
                &nbsp;&nbsp;
                {{-- <a href="javascript:rename('{{ $item->name }}')">
                  <i class="fa fa-edit"></i>
                </a> 
              </p>
            </div>
            <p style="color: #aaa;font-weight: 400">{{ $item->time }}</p>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table> --}}

@else
<p>{{ trans('laravel-filemanager::lfm.message-empty') }}</p>
@endif
