<div class="row d-flex mt-5">
    <div class="col-12 col-md-6">
        <span class="detail-price product-price-discount text-danger">{{ __('main.word.discount_price')}} {{ $product->getPrice().'.-' }}</span>
    </div>
    <div class="col-12 col-md-6">
        <span class="detail-price">{{ __('main.word.price')}} {{ $product->price.'.-' }}</span>
    </div>
</div>
<div class="add-to-box">
    <div class="add-to-cart">
        <div class="qty-wrapper">
            <input type="text" name="qty" id="qty" maxlength="5" value="1" title="จำนวน" class="input-text qty">
            <button type="button" title="เพิ่ม" class="btn update_qty btn_minus quantity_inc" data-type="product"><i class="fas fa-chevron-up mb-0"></i></button>
            <button type="button"  title="ลบ" class="btn update_qty btn_plus quantity_dec" data-type="product"><i class="fas fa-chevron-down mb-0"></i></button>
        </div>
        <div class="clear" style="clear:both"></div>
        <div class="add-to-cart-buttons">
            <button type="button" class="button btn-to-cart bg-primary" data-type="product" data-id="{{$product->id}}"><i class="fas fa-shopping-cart"></i> {{ __('main.word.addtocart')}}</button>
            <button type="button" class="button btn-cart" data-type="product" data-id="{{$product->id}}"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now')}}</button>

        </div>
    </div>
    <ul class="productview-add-to-links">
        <li><a href="{{ route('products.index') }}" class="product-more shoppinglist-details-link btn text-white ml-0">{{ __('main.word.view_product_more')}}</a></li>
        <li class="compare-link">
            <button type="button" data-id="{{$product->id}}" class="btn-compare btn-chk-compare shoppinglist-details-link btn text-white  ml-0">{{ __('main.word.compare_product')}}</button>
        </li>
    </ul>
</div>