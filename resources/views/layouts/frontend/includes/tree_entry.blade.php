<div class="drop">
    <ul class="sub-menu">
        @foreach($entries as $child)
            <li class="menu-item-has-children ">
                
                <a href="{{ route('categories.show' , $child->getUrlSlugParent() )}}" class="">{{ $child->name }}</a>
                @if($child->children->count())
                    @include('layouts.frontend.includes.tree_entry',['entries' => $child->children])
                @endif
            </li>
        @endforeach
    </ul>
</div>