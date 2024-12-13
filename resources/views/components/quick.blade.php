<div class="main_product">
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="name" value="{{ $product->name }}">
<input type="hidden" name="slug" value="{{ $product->slug }}">
<input type="hidden" name="image" value="{{ Voyager::image(json_decode($product->images)[0]) }}">
<input type="hidden" name="price" value="{{ $product->final_price }}">
<input type="hidden" name="color" value="{{ $product->colors[0]->name }}">
<input type="hidden" name="size" value="{{  $product->sizes[0]->name }}">


<div class="tf-product-info-item">
    <div class="image">
        <img src="{{ Voyager::image(json_decode($product->images)[0]) }}" alt="{{$product->name}}">
    </div>
    <div class="content">
        <a href="{{ route('shop.product', $product->slug) }}">{{ $product->name }}</a>
        <div class="tf-product-info-price">
            @if ($product->is_discount)
                <div class="price-on-sale">{{ $product->final_price }} EGP</div>
                <div class="compare-at-price">{{ $product->price }} EGP</div>
                {{-- <div class="badges-on-sale"><span>20</span>% OFF</div> --}}
            @else
            <div class="price">{{ $product->final_price }} EGP</div>
            @endif
            
            
        </div>
    </div>
</div>
<div class="tf-product-info-variant-picker mb_15">
    <div class="variant-picker-item">
        <div class="variant-picker-label">
            اللون: <span class="fw-6 variant-picker-label-value">{{ $product->colors[0]->name }}</span>
        </div>
        <div class="variant-picker-values">
            @foreach ($product->colors as $index => $color)
            <input id="vv{{$index}}" type="radio" name="efhuiwefh" value="{{ $color->name }}" {{ $index == 0 ? 'checked' : '' }} >
            <label class="hover-tooltip radius-60 color" for="vv{{$index}}" data-value="{{ $color->name }}">
                <span class="btn-checkbox" style="background-color: {{ $color->color }};"></span>
                <span class="tooltip">{{ $color->name }}</span>
            </label>
            
            @endforeach
        </div>
    </div>
    <div class="variant-picker-item">
        <div class="variant-picker-label">
            المقاس: <span class="fw-6 variant-picker-label-value">S</span>
        </div>
        <div class="variant-picker-values">
            @foreach ($product->sizes as $index => $size)
            <input type="radio" name="ssdqwda9" id="values{{$index}}" value="{{ $size->name }}" {{  $index == 0 ? 'checked' : ''}} >
            <label class="style-text size" for="values{{$index}}" data-value="{{ $size->name }}">
                <p>{{ $size->name }}</p>
            </label>
            @endforeach

        </div>
    </div>
</div>
<div class="tf-product-info-quantity mb_15">
    <div class="quantity-title fw-6">العدد</div>
    <div class="wg-quantity">
        <span class="btn-quantity minus-btn">-</span>
        <input type="text" name="number" value="1">
        <span class="btn-quantity plus-btn">+</span>
    </div>
</div>
<div class="tf-product-info-buy-button">
    <form class="">
        <a href="javascript:void(0);"  class=" tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>إضافة المنتج في السلة -&nbsp;</span><span class="tf-qty-price price_final_show">{{ $product->final_price }} EGP</span></a>
        <div data-product-id="{{ $product->id }}" class="favorite-btn tf-product-btn-wishlist btn-icon-action">
            <i class="icon-heart"></i>
            <i class="icon-delete"></i>
        </div>
        <a href="/#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" data-product-id="{{ $product->id }}" data-product-image="{{ Voyager::image(json_decode($product->images)[0]) }}" class="compare-btn tf-product-btn-wishlist box-icon bg_white compare btn-icon-action">
            <span class="icon icon-compare"></span>
            <span class="icon icon-check"></span>
        </a>
        <div class="w-100">
            <a class="btns-full no_click">شراء عبر <img src="{{ asset('images/payments/paypal.png') }}" alt=""></a>
            <a href="{{ route('shop.product', $product->slug) }}" class="payment-more-option">مشاهدة صفحة المنتج كاملة</a>
        </div>
    </form>
</div>
</div>