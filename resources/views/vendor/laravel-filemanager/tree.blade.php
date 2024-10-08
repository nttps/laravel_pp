<div id="m_tree_1">  
  <ul>
      @foreach($root_folders as $root_folder)
        <li data-jstree='{ "icon" : "fa fa-briefcase m--font-success " }'>
          <a class="clickable folder-item" data-id="{{ $root_folder->path }}">
            <i class="fa fa-folder"></i> {{ $root_folder->name }}
          </a>
          @if(count($root_folder->children) > 0)
            @foreach($root_folder->children as $directory)
            <ul>
                <li>
                  <a class="clickable folder-item" data-id="{{ $directory->path }}">
                    <i class="fa fa-folder"></i> {{ $directory->name }}
                  </a>
                </li>
            </ul>
            @endforeach
          @endif
        </li>
        
        @if($root_folder->has_next)
          <hr>
        @endif
      @endforeach  
    </ul>  
</div>

