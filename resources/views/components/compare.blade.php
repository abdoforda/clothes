<section class="flat-spacing-12">
    <div class="container">
        <div>
            <div class="tf-compare-table">
                <div class="tf-compare-row tf-compare-grid">
                    <div class="tf-compare-col d-md-block d-none"></div>
                    
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col index{{$index}}">
                        <div class="tf-compare-item">
                            <div class="tf-compare-remove compare-btn deleteCompare" data-d="index{{$index}}" data-product-id="{{ $item->id }}" data-product-image="{{ Voyager::image(json_decode($item->images)[0]) }}">حذف</div>
                            <a class="tf-compare-image" href="{{ route('shop.product', $item->slug) }}">
                                <img class="lazyload" data-src="{{ Voyager::image(json_decode($item->images)[0]) }}" src="{{ Voyager::image(json_decode($item->images)[0]) }}" alt="img-compare">
                            </a>
                            <a class="tf-compare-title" href="{{ route('shop.product', $item->slug) }}">{{$item->name}}</a>
                            <div class="price">
                                {{ $item->final_price }} EGP
                            </div>
                            <div class="tf-compare-group-btns d-flex gap-10">
                                <a href="{{ route('shop.product', $item->slug) }}"  class="tf-btn btn-outline-dark radius-3"><i class="icon icon-view"></i><span>صفحة المنتج</span></a>
                                <a href="#quick_add" data-bs-toggle="modal" data-id="{{ $item->id }}" class="quick-add tf-btn btn-outline-dark radius-3"><i class="icon icon-bag"></i><span>مشاهدة سريعة</span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>السعر</h6>
                    </div>
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-value text-center index{{$index}}">
                        {{ $item->final_price }} EGP
                    </div>
                    @endforeach
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>الخصم</h6>
                    </div>
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-value text-center index{{$index}}">
                        @if ($item->is_discount)
                            توفير <span style="direction: rtl; color: #68a907; margin: 0px 8px; font-weight: bold;">{{ $item->price - $item->final_price }} EGP</span>
                        @else
                            -
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>متوفر</h6>
                    </div>
                    
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-field tf-compare-stock index{{$index}}">
                        <div class="icon">
                            <i class="icon-check"></i>
                        </div>
                        <span class="fw-5">متوفر</span>
                    </div>
                    @endforeach
                    
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>البائع</h6>
                    </div>
                    
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-value text-center index{{$index}}">Branca</div>
                    @endforeach
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>الألوان</h6>
                    </div>
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-value text-center index{{$index}}">
                        @foreach ($item->colors as $color)
                            {{$color->name}}@if (!$loop->last), @endif
                        @endforeach
                    </div>
                    @endforeach
                    
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>المقاسات</h6>
                    </div>
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-value text-center index{{$index}}">
                        @foreach ($item->sizes as $color)
                            {{$color->name}}@if (!$loop->last), @endif
                        @endforeach
                    </div>
                    @endforeach
                    
                </div>
                <div class="tf-compare-row">
                    <div class="tf-compare-col tf-compare-field d-md-block d-none">
                        <h6>الفئة</h6>
                    </div>
                    @foreach ($products as $index => $item)
                    <div class="tf-compare-col tf-compare-value text-center index{{$index}}">
                        @foreach ($item->cats as $cat)
                            {{$cat->name}}@if (!$loop->last) - @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>