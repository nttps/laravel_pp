<ul class="children">
    @foreach($categories as $child)
        <li id="product_cat-{{$child->id}}">
            <label class="selectit">
                <input value="{!! $child->id !!}" type="checkbox" name="productcat[]" id="in-product_cat-{{$child->id}}" {{ $categoriesForProduct->contains($child) ? 'checked' : '' }}> {{$child->name}}
            </label>
            @if($child->children->count())
                @include('backend.products.category',['categories' => $child->children])
            @endif
        </li>
    @endforeach
</ul>