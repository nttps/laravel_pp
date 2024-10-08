@if (count($breadcrumbs))

    <ul class="pp-breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="pp-breadcrumb-item"><a href="{{ $breadcrumb->url }}"> {{ $breadcrumb->title }} / </a>  </li>
            @else
                <li class="pp-breadcrumb-item active"> {{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ul>

@endif