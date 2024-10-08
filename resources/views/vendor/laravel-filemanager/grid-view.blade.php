@if((sizeof($files) > 0) || (sizeof($directories) > 0))

<div class="row">

  @foreach($items as $item)
  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 img-row">
    <?php $item_name = $item->name; ?>
    <?php $thumb_src = $item->thumb; ?>
    <?php $item_path = $item->is_file ? $item->url : $item->path; ?>

    <div class="square clickable {{ $item->is_file ? '' : 'folder-item' }}" data-id="{{ $item_path }}"
           @if($item->is_file && $thumb_src) onclick="useFile('{{ $item_path }}', '{{ $item->updated }}')"
           @elseif($item->is_file) onclick="download('{{ $item_name }}')" @endif >
      @if($thumb_src)
      <img src="{{ $thumb_src }}">
      @else
      <i class="fa {{ $item->icon }} fa-5x"></i>
      @endif
    </div>

    <div class="caption text-center">
      <div class="btn-group m-btn-group" role="group">
        <button type="button" data-id="{{ $item_path }}"
                class="item_name btn btn-default btn-xs {{ $item->is_file ? '' : 'folder-item'}}"
                @if($item->is_file && $thumb_src) onclick="useFile('{{ $item_path }}', '{{ $item->updated }}')"
                @elseif($item->is_file) onclick="download('{{ $item_name }}')" @endif >
          {{ $item_name }}
        </button>
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="javascript:rename('{{ $item_name }}')"><i class="fa fa-edit fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-rename') }}</a>
            @if($item->is_file)
              <a class="dropdown-item" href="javascript:download('{{ $item_name }}')"><i class="fa fa-download fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-download') }}</a>
              <li class="divider"></li>
                @if($thumb_src)
                  <a class="dropdown-item" href="javascript:fileView('{{ $item_path }}', '{{ $item->updated }}')"><i class="fa fa-image fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-view') }}</a>
                  <a class="dropdown-item" href="javascript:resizeImage('{{ $item_name }}')"><i class="fa fa-arrows-alt fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-resize') }}</a>
                  <a class="dropdown-item" href="javascript:cropImage('{{ $item_name }}')"><i class="fa fa-crop fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-crop') }}</a>
                  <li class="divider"></li>
                @endif
            @endif
              <a class="dropdown-item" href="javascript:trash('{{ $item_name }}')"><i class="fa fa-trash fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-delete') }}</a>
        
          </div>
        </div>
        
        <ul class="dropdown-menu" role="menu">
          <li></li>
          @if($item->is_file)
          <li><a href="javascript:download('{{ $item_name }}')"><i class="fa fa-download fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-download') }}</a></li>
          <li class="divider"></li>
          @if($thumb_src)
          <li><a href="javascript:fileView('{{ $item_path }}', '{{ $item->updated }}')"><i class="fa fa-image fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-view') }}</a></li>
          <li><a href="javascript:resizeImage('{{ $item_name }}')"><i class="fa fa-arrows fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-resize') }}</a></li>
          <li><a href="javascript:cropImage('{{ $item_name }}')"><i class="fa fa-crop fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-crop') }}</a></li>
          <li class="divider"></li>
          @endif
          @endif
          <li><a href="javascript:trash('{{ $item_name }}')"><i class="fa fa-trash fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-delete') }}</a></li>
        </ul>
      </div>
    </div>

  </div>
  @endforeach

</div>

@else
<p>{{ Lang::get('laravel-filemanager::lfm.message-empty') }}</p>
@endif
