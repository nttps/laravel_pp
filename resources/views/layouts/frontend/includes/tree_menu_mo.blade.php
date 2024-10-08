<ul class="smenu">
@foreach($entries as $child)
    <li @if($menu->children->count()) id="mitem-{{ $child->id }}" @endif>
        <a href="{{ route('categories.show' , $child->slug)}}" class="catemenu-item s-m"> - {{ $child->name }}</a>
        @if($child->children->count())
            @include('layouts.frontend.includes.tree_menu_mo',['entries' => $child->children])
        @endif
    </li>
    
@endforeach
</ul>