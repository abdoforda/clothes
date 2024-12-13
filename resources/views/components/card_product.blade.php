<div class="card-product" data-price="{{ $item->final_price }}" 
    data-color="@foreach ($item->colors as $color){{ $color->name }}@if(!$loop->last) @endif @endforeach"
    data-size="@foreach ($item->sizes as $size) {{ $size->name }}@if(!$loop->last) @endif @endforeach"
    >
    <div class="card-product-wrapper">
        <a href="{{ route('shop.product', $item->slug) }}" class="product-img">
            @foreach (json_decode($item->images) as $key => $img)
                @if ($key <= 1)
                <img class=" {{ $key == 0 ? 'img-product' : 'img-hover' }} ls-is-cached lazyloaded "
                data-src="{{ Voyager::image($img) }}" src="{{ Voyager::image($img) }}"
                alt="image-product">
                @endif
            @endforeach
        </a>
        <div class="list-product-btn absolute-2">
            <a href="#quick_add" data-bs-toggle="modal" 
            
            class="box-icon bg_white quick-add tf-btn-loading" data-id="{{ $item->id }}">
                <span class="icon icon-bag"></span>
                <span class="tooltip">أضف للسلة</span>
            </a>
            <a href="javascript:void(0);" data-product-id="{{ $item->id }}" class="favorite-btn box-icon bg_white wishlist btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">أضف في المفضلة</span>
                <span class="icon icon-delete"></span>
            </a>
            <a href="#compare" data-product-id="{{ $item->id }}" data-product-image="{{ Voyager::image(json_decode($item->images)[0]) }}" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                class="box-icon bg_white compare btn-icon-action compare-btn">
                <span class="icon icon-compare"></span>
                <span class="tooltip">أضف للمقارنة</span>
                <span class="icon icon-check"></span>
            </a>
            <a href="{{  route('shop.product', $item->slug)}}" class="box-icon bg_white quickview tf-btn-loading">
                <span class="icon icon-view"></span>
                <span class="tooltip">مشاهدة</span>
            </a>
        </div>

        <div class="size-list">
            <span>@foreach ($item->sizes as $size) {{ $size->name }} @if(!$loop->last) - @endif @endforeach</span>
        </div>
        @if ($item->is_discount)
        <div class="on-sale-wrap">
            <div class="on-sale-item">-{{  $item->discount_rate }}%</div>
        </div>
        @endif
        
        

    </div>
    <div class="card-product-info">
        <a href="{{ route('shop.product', $item->slug) }}" class="title link">
            {{  $item->name }}
        </a>
        <span class="price">
            @if ($item->is_discount)
            <span class="desc_price">{{ $item->price }} EGP</span>
            @endif
            <span>{{ $item->final_price }} EGP</span>
            
        </span>
        @if (count($item->colors) > 0)
        <ul class="list-color-product">

            @foreach ($item->colors as $index_color => $color)
            @if ($index_color < count(json_decode($item->images)))
            <li class="list-color-item color-swatch active">
                <span class="tooltip">{{ $color->name }}</span>
                <span class="swatch-value" style="background-color: {{  $color->color }}"></span>
                <img class=" ls-is-cached lazyloaded" data-src="{{ Voyager::image(json_decode($item->images)[$index_color]) }}"
                    src="{{ Voyager::image(json_decode($item->images)[$index_color]) }}" alt="image-product">
            </li>
            @endif
            
            @endforeach
            
        </ul> 
        @endif
        
    </div>
</div>