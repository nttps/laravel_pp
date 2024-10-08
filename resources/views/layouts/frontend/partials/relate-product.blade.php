<div class="container mt-lg-4 mb-lg-5">
    <div class="row">
        <h2 class="col-12 mb-5"> {{ __('main.word.Relate Products') }} <hr class="border-warning border-bottom my-0"></h2>
        <div class="d-flex justify-content-center  w-100">
            <div class="row w-100">
                @foreach ($relateForProduct as $item)
                    <div class="col-6 col-lg-3" >
                        <div class="product-relate-item"  style="border:1px solid black;padding: 5px;">
                            <img src="{{ \Storage::url($item->image) }}" class="img-fluid" style="display: block;border:1px solid black;" >
                            <div class="d-flex justify-content-between px-2 product-detail-top">
                                <h2 class="product-name mb-0">
                                    <a href="{{ route('products.show' , $item->slug) }}">{{ $item->name }}</a>
                                </h2>
                                <h2 class="product-brand mb-0"><a href="{{ isset($item->brands->slug) ? route('brands.show' , $item->brands->slug): '' }}">{{ isset($product->brands->name) ? $product->brands->name :'No Brands' }}</a></h2>
                            </div>
                            <div class="product-price d-flex justify-content-between px-2">
                                {!! $item->getRealPriceAttribute() !!}
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="{{ route('products.show' , $item->slug) }}" class="btn btn-warning btn-pp text-white" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach($b=1; $b<=4; $b++)
            </div>
        </div>
    </div>
</div>