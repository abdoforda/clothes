<ul class="nav-ul-mb" id="wrapper-menu-navigation">
    <li class="nav-mb-item">
        <a href="/" class="mb-menu-link">الرئيسية</a>
    </li>
    <li class="nav-mb-item">
        <a href="/#dropdown-menu-one" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true"
            aria-controls="dropdown-menu-one">
            <span>الأقسام</span>
            <span class="btn-open-sub"></span>
        </a>
        <div id="dropdown-menu-one" class="collapse">
            <ul class="sub-nav-menu">

                @php
                    $cats = App\Models\Cat::limit(22)->get();
                @endphp

                @foreach ($cats as $index => $item)
                    <li><a href="{{ route('shop.category', $item->slug) }}" class="sub-nav-link">{{ $item->name }}</a>
                    </li>
                @endforeach


            </ul>
        </div>

    </li>
    <li class="nav-mb-item">
        <a href="/#dropdown-menu-two" class="collapsed mb-menu-link current" data-bs-toggle="collapse"
            aria-expanded="true" aria-controls="dropdown-menu-two">
            <span>المنتجات</span>
            <span class="btn-open-sub"></span>
        </a>
        <div id="dropdown-menu-two" class="collapse">
            <ul class="sub-nav-menu" id="sub-menu-navigation">

                <li><a href="/#sub-shop-one" class="sub-nav-link collapsed" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="sub-shop-one">
                        <span>تصفح حسب اللون</span>
                        <span class="btn-open-sub"></span>
                    </a>
                    <div id="sub-shop-one" class="collapse">
                        <ul class="sub-nav-menu sub-menu-level-2">
                            @php
                                $colors = App\Color::inRandomOrder()->limit(10)->get();
                            @endphp
                            @foreach ($colors as $color)
                                <li><a href="{{ route('shop.products_get', ['color' => $color->id]) }}"
                                        class="sub-nav-link">{{ $color->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li><a href="/#sub-shop-tow" class="sub-nav-link collapsed" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="sub-shop-tow">
                        <span>تصفح حسب الحجم</span>
                        <span class="btn-open-sub"></span>
                    </a>
                    <div id="sub-shop-tow" class="collapse">
                        <ul class="sub-nav-menu sub-menu-level-2">
                            @php
                                $sizes = App\Size::inRandomOrder()->limit(10)->get();
                            @endphp
                            @foreach ($sizes as $size)
                                <li><a href="{{ route('shop.products_get', ['size' => $color->id]) }}"
                                        class="sub-nav-link">{{ $size->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li><a href="/#sub-shop-tow" class="sub-nav-link collapsed" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="sub-shop-tow">
                        <span>تصفح حسب السعر</span>
                        <span class="btn-open-sub"></span>
                    </a>
                    <div id="sub-shop-tow" class="collapse">
                        <ul class="sub-nav-menu sub-menu-level-2">
                            @php
                                $prices = [
                                    [0, 100],
                                    [100, 200],
                                    [200, 300],
                                    [300, 400],
                                    [400, 500],
                                    [500, 600],
                                    [600, 700],
                                    [700, 800],
                                ];

                            @endphp
                            @foreach ($prices as $price)
                                <li><a href="{{ route('shop.products_get', ['price' => $price]) }}"
                                        class="sub-nav-link">{{ $price[0] }} - {{ $price[1] }}
                                        EGP</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </li>
    <li class="nav-mb-item">
        <a href="/#dropdown-menu-one_01" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true"
            aria-controls="dropdown-menu-one_01">
            <span>الصفحات</span>
            <span class="btn-open-sub"></span>
        </a>
        <div id="dropdown-menu-one_01" class="collapse">
            <ul class="sub-nav-menu">

                @php
                    $pages = App\Page::orderBy('sort', 'asc')->get();
                @endphp

                @foreach ($pages as $item)
                    <li><a href="{{ $item->href() }}" class="sub-nav-link">{{ $item->name }}</a>
                    </li>
                @endforeach


            </ul>
        </div>

    </li>
    <li class="nav-mb-item">
        <a href="{{ route('contact') }}" class="mb-menu-link">تواصل معنا</a>
    </li>
    <li class="nav-mb-item">
        <a href="{{ route('shop.checkout') }}" class="mb-menu-link">سلة المشتريات</a>
    </li>
</ul>
