
@foreach ($option->children as $item)
    <th class="text-center">{{ $item->option_name }}</th>
    @if($option->children->count())
        @include('frontend.products.forms.fecthth', ['option' => $item])
    @endif
@endforeach
    
