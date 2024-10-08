{{-- <div class="product-options">
    <div class="option-item">
        @foreach ($options as $option)
            @php
        
        $optionchildenCount = $option->withCount('children')->first();
        $last_option    = '_last';
        if($optionchildenCount->children_count > 0){
            $last_option    =   '';
        }
        @endphp
            <label for="option_value">{{ $option->option_name }}</label>
            <select name="option_value" class="option_value" id="option_value{{$last_option}}">
                <option value="">เลือก</option>
                @php $optioValu = $option->values()->get(); @endphp
                @foreach ($optioValu as $value)
                    <option value="{{ $value->value }}" data-option-id="{{ $option->id }}" data-id="{{ $value->id }}">{{ $value->value }}</option>
                @endforeach
            </select>    
        @endforeach
    </div>
    
    <div class="option-more" style="opacity:0"></div>
</div>

<div id="price-content">
    <div class="add-to-box">
        <div class="add-to-cart">
            <div class="qty-wrapper">
                <input type="text" disabled name="qty" id="qty" maxlength="5" value="1" title="จำนวน" class="input-text qty">
                <button type="button" disabled title="เพิ่ม" class="btn update_qty btn_minus quantity_inc" data-type="product"><i class="fas fa-chevron-up mb-0"></i></button>
                <button type="button" disabled title="ลบ" class="btn update_qty btn_plus quantity_dec" data-type="product"><i class="fas fa-chevron-down mb-0"></i></button>
            </div>
            <div class="clear" style="clear:both"></div>
            <div class="add-to-cart-buttons">
                <button type="button" class="button btn-to-cart bg-primary" disabled data-type="product" id="btn-toCart" data-id=""><i class="fas fa-shopping-cart"></i> ใส่ตะกร้าสินค้า</button>
                <button type="button" class="button btn-cart"><i class="fas fa-shopping-cart"></i> สั่งซื้อทันที</button>
                <button type="button" class="shoppinglist-details-link add-favorite btn text-white">เพิ่มเข้ารายการโปรด</button>
            </div>
        </div>
        <ul class="productview-add-to-links">
            <li><a href="{{ route('products.index') }}" class="product-more shoppinglist-details-link btn text-white ml-0">ดูสินค้าเพิ่มเติม</a></li>
            <li class="compare-link">
                <button type="button" class="btn-compare shoppinglist-details-link btn text-white  ml-0">เปรียบเทียบสินค้า</button>
            </li>
        </ul>
    </div>            
</div> --}}


<div class="table-responsive table-var">
<table class="table table-variantproduct-cart mx-auto">
    <thead>
        <tr>
            <th class="sku">SKU</th>
            @foreach ($optionsForProduct as $option)
                <th class="text-center">{{ $option->option_name }}</th>

                @if($option->children->count())
                    @include('frontend.products.forms.fecthth', ['option' => $option])
                @endif
                
            @endforeach
            <th class="text-right">Unit/Price</th>
            <th class="qty-th text-center">{{ __('main.word.quantity')}}</th>
            <th class="action text-center"></th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 0;
            $rowspan = 0;
        @endphp
    @foreach ($product->variants()->get() as $key=>$productVarient)
        @php $count += 1; @endphp
        <tr>
            <td>{{ $productVarient->pivot->sku }}</td>
            
            @if($productVarient->parent != null)
                @include('frontend.products.forms.fecthtd', ['productVarient' => $productVarient->parent])
                <td class="text-center">{{ $productVarient->parent->value }}</td>
            @endif
            
            <td class="text-center">{{ $productVarient->value }}</td>
            <td class="text-right">{{ $productVarient->getPrice() }}.-</td>
            <td class="qty-th input text-center"><a href="javascript:void(0);" class="quantity_dec"><i class="fa fa-minus"></i></a><input type="text" name="qty" class="qty" maxlength="5" value="0" data-id="{{$productVarient->pivot->id}}" title="จำนวน" class="input-text qty"><a href="javascript:void(0);" class="quantity_inc"><i class="fa fa-plus"></i></a></td>
            @if ($key == 0 || $rowspan == $count)
                @php
                    $count = 0;
                    $rowspan = $productVarient->id;
                @endphp
                <td class="action text-center" rowspan="{{ $rowspan }}">
                    <button class="btn-to-cart button bg-primary btn-cart mb-2 btn-buy d-block w-100" data-type="variant" data-to="checkout"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now')}}</button>
                    <button class="btn-to-cart button btn-buy d-block w-100" data-type="variant" data-to="cart"><i class="fas fa-shopping-cart"></i> {{ __('main.word.addtocart')}}</button>
                </td>
            @endif
            
        </tr>
    @endforeach
      
        
    </tbody>
</table>
</div>
<div class="add-to-box d-flex justify-content-center mt-3">
    <a href="{{ route('products.index') }}" class="mr-3 product-more shoppinglist-details-link btn text-white ml-0">{{ __('main.word.view_product_more')}}</a>
    <button type="button" data-id="{{$product->id}}" class="mr-3 btn-compare shoppinglist-details-link btn text-white btn-chk-compare ml-0">{{ __('main.word.compare_product')}}</button>
</div>       