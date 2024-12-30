<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Branca Fashion')</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    {{-- __ CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- font -->
    {{-- <link rel="stylesheet" href="fonts/fonts.css"> --}}
    <!-- Icons -->

    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet"type="text/css" href="{{ asset('css/styles.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">

    {{-- 
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;700;800&display=swap" rel="stylesheet"> --}}

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="images/logo/favicon.png') }}">

    {!! setting('site.pixels') !!}

</head>

<body class="preload-wrapper rtl">

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <!-- announcement-bar -->
        <div class="announcement-bar bg_dark">
            <div class="wrap-announcement-bar">
                <div class="box-sw-announcement-bar">

                    @foreach (App\Note::all() as $item)
                    <div class="announcement-bar-item">
                        <p>
                            @if ($item->url != null)
                                <a href="{{ $item->url }}" class="text_white">{{ $item->title }}</a>
                            @else
                                {{ $item->title }}
                            @endif
                            
                        </p>
                    </div>
                    @endforeach

                    
                    
                </div>
            </div>
            <span class="icon-close close-announcement-bar"></span>

        </div>
        <!-- /announcement-bar -->

        <!-- header -->
        <header id="header" class="header-default header-style-2">
            <div class="main-header line">
                <div class="container-full px_15 lg-px_40">
                    <div class="row wrapper-header align-items-center">
                        <div class="col-xl-5 tf-md-hidden">
                            <ul class="header-list-categories">
                                @php
                                    $categoriesTopNavbar = DB::table('cats')->where('show_navbar', 1)->get();
                                    $active_cat_id = 0;
                                    if (Route::currentRouteName() == 'shop.category') {
                                        $active_cat_id = $category->id;
                                    }
                                @endphp
                                @foreach ($categoriesTopNavbar as $item)
                                    <li class="categories-item {{ $active_cat_id == $item->id ? 'active' : '' }} "><a
                                            href="{{ route('shop.category', $item->slug) }}"
                                            class="text-uppercase">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4 col-3 tf-lg-hidden">
                            <a href="/#mobileMenu" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16"
                                    viewBox="0 0 24 16" fill="none">
                                    <path
                                        d="M2.00056 2.28571H16.8577C17.1608 2.28571 17.4515 2.16531 17.6658 1.95098C17.8802 1.73665 18.0006 1.44596 18.0006 1.14286C18.0006 0.839753 17.8802 0.549063 17.6658 0.334735C17.4515 0.120408 17.1608 0 16.8577 0H2.00056C1.69745 0 1.40676 0.120408 1.19244 0.334735C0.978109 0.549063 0.857702 0.839753 0.857702 1.14286C0.857702 1.44596 0.978109 1.73665 1.19244 1.95098C1.40676 2.16531 1.69745 2.28571 2.00056 2.28571ZM0.857702 8C0.857702 7.6969 0.978109 7.40621 1.19244 7.19188C1.40676 6.97755 1.69745 6.85714 2.00056 6.85714H22.572C22.8751 6.85714 23.1658 6.97755 23.3801 7.19188C23.5944 7.40621 23.7148 7.6969 23.7148 8C23.7148 8.30311 23.5944 8.59379 23.3801 8.80812C23.1658 9.02245 22.8751 9.14286 22.572 9.14286H2.00056C1.69745 9.14286 1.40676 9.02245 1.19244 8.80812C0.978109 8.59379 0.857702 8.30311 0.857702 8ZM0.857702 14.8571C0.857702 14.554 0.978109 14.2633 1.19244 14.049C1.40676 13.8347 1.69745 13.7143 2.00056 13.7143H12.2863C12.5894 13.7143 12.8801 13.8347 13.0944 14.049C13.3087 14.2633 13.4291 14.554 13.4291 14.8571C13.4291 15.1602 13.3087 15.4509 13.0944 15.6653C12.8801 15.8796 12.5894 16 12.2863 16H2.00056C1.69745 16 1.40676 15.8796 1.19244 15.6653C0.978109 15.4509 0.857702 15.1602 0.857702 14.8571Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6 text-center">
                            <a href="/" class="logo-header">
                                <img src="{{ asset('images/logo/logo.png') }}" alt="logo" class="logo">
                            </a>
                        </div>

                        <div class="col-xl-5 col-md-4 col-3">
                            <ul class="nav-icon d-flex justify-content-end align-items-center gap-20">
                                <li class="nav-search"><a href="/search"  class="nav-icon-item"><i
                                            class="icon icon-search"></i></a></li>

                                <li class="nav-wishlist"><a href="{{ route('shop.wishlist') }}"
                                        class="nav-icon-item"><i class="icon icon-heart"></i><span
                                            class="count-box count_wishlist">0</span></a></li>
                                <li class="nav-cart"><a href="/#shoppingCart" data-bs-toggle="modal"
                                        class="nav-icon-item"><i class="icon icon-bag"></i><span
                                            class="count-box count_cart">0</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom line">
                <div class="container-full px_15 lg-px_40">
                    <div class="wrapper-header d-flex justify-content-center align-items-center">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">
                                <li class="menu-item">
                                    <a href="/" class="item-link">الرئيسية</a>
                                </li>
                                <li class="menu-item">
                                    <a href="/#" class="item-link">الأقسام<i
                                            class="icon icon-arrow-down"></i></a>
                                    <div class="sub-menu mega-menu">
                                        <div class="container">
                                            <div class="row">

                                                @php
                                                    $cats = App\Models\Cat::limit(22)->get();
                                                @endphp

                                                @foreach ($cats as $index => $item)
                                                    @if ($index % 8 == 0)
                                                        <div class="col-lg-2">
                                                            <div class="mega-menu-item">
                                                                <div class="menu-heading">إقسام الموقع</div>
                                                                <ul class="menu-list">
                                                    @endif
                                <li><a href="{{ route('shop.category', $item->slug) }}"
                                        class="menu-link-text link">{{ $item->name }}</a></li>
                                @if ($index % 8 == 7 || $loop->last)
                            </ul>
                    </div>
                </div>
                @endif
                @endforeach




                @php
                    $bannersCat = App\Models\Cat::where('show_like_home', 1)->inRandomOrder()->limit(2)->get();
                @endphp
                @foreach ($bannersCat as $item)
                    <div class="col-lg-3">
                        <div class="collection-item hover-img">
                            <div class="collection-inner">
                                <a href="{{ route('shop.category', $item->slug) }}"
                                    class="collection-image img-style">
                                    <img class="lazyload" data-src="{{ Voyager::image($item->image) }}"
                                        src="{{ Voyager::image($item->image) }}" alt="collection-demo-1">
                                </a>
                                <div class="collection-content">
                                    <a href="{{ route('shop.category', $item->slug) }}"
                                        class="tf-btn hover-icon btn-xl collection-title fs-16"><span>{{ $item->name }}</span><i
                                            class="icon icon-arrow1-top-left"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
    </div>
    </div>
    </li>
    <li class="menu-item">
        <a href="/#" class="item-link">المنتجات<i class="icon icon-arrow-down"></i></a>
        <div class="sub-menu mega-menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="mega-menu-item">
                            <div class="menu-heading">تصفح حسب اللون</div>
                            <ul class="menu-list">
                                @php
                                    $colors = App\Color::inRandomOrder()->limit(10)->get();
                                @endphp
                                @foreach ($colors as $color)
                                    <li><a href="{{ route('shop.products_get', ['color' => $color->id]) }}"
                                            class="menu-link-text link">{{ $color->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mega-menu-item">
                            <div class="menu-heading">تصفح حسب الحجم</div>
                            <ul class="menu-list">
                                @php
                                    $sizes = App\Size::inRandomOrder()->limit(10)->get();
                                @endphp
                                @foreach ($sizes as $size)
                                    <li><a href="{{ route('shop.products_get', ['size' => $size->id]) }}"
                                            class="menu-link-text link">{{ $size->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mega-menu-item">
                            <div class="menu-heading">تصفح حسب السعر</div>
                            <ul class="menu-list">
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
                                            class="menu-link-text link">{{ $price[0] }} - {{ $price[1] }}
                                            EGP</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mega-menu-item">
                            <div class="menu-heading">تصفح حسب الترتيب</div>
                            <ul class="menu-list">

                                <li><a href="{{ route('shop.products_get', ['sort' => 'date_asc']) }}"
                                        class="menu-link-text link">التاريخ من أحدث الى أقدم</a></li>
                                <li><a href="{{ route('shop.products_get', ['sort' => 'date_desc']) }}"
                                        class="menu-link-text link">التاريخ من أقدم الى أحدث</a></li>
                                {{-- السعر من الأدني إلي الأعلي --}}
                                <li><a href="{{ route('shop.products_get', ['sort' => 'price_asc']) }}"
                                        class="menu-link-text link">السعر من الأدني إلي الأعلي</a></li>
                                <li><a href="{{ route('shop.products_get', ['sort' => 'price_desc']) }}"
                                        class="menu-link-text link">السعر من الأعلي إلي الأدني</a></li>
                                {{-- ترتيب أبجدي --}}
                                <li><a href="{{ route('shop.products_get', ['sort' => 'alph_asc']) }}"
                                        class="menu-link-text link">ترتيب أبجدي أ - ي</a></li>
                                <li><a href="{{ route('shop.products_get', ['sort' => 'alph_desc']) }}"
                                        class="menu-link-text link">ترتيب أبجدي ي - أ</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="menu-heading">أفضل المبيعات</div>
                        <div class="hover-sw-nav hover-sw-2">
                            <div dir="ltr" class="swiper tf-product-header">
                                <div class="swiper-wrapper">

                                    @php
                                        $products = App\Models\Product::where('show_in_home', 1)
                                            ->inRandomOrder()
                                            ->limit(4)
                                            ->get();
                                    @endphp

                                    @foreach ($products as $item)
                                        <div class="swiper-slide" lazy="true">
                                            @include('components.card_product', ['item' => $item])
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="nav-sw nav-next-slider nav-next-product-header box-icon w_46 round"><span
                                    class="icon icon-arrow-left"></span></div>
                            <div class="nav-sw nav-prev-slider nav-prev-product-header box-icon w_46 round"><span
                                    class="icon icon-arrow-right"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="menu-item position-relative">
        <a href="/#" class="item-link">الصفحات<i class="icon icon-arrow-down"></i></a>
        <div class="sub-menu submenu-default">
            <ul class="menu-list">

                @php
                    $pages = App\Page::orderBy('sort', 'asc')->get();
                @endphp

                @foreach ($pages as $item)
                    <li>
                        <a href="{{ $item->href() }}"
                            class="menu-link-text link text_black-2">{{ $item->name }}</a>
                    </li>
                @endforeach




            </ul>
        </div>
    </li>
    <li class="menu-item"><a href="{{ route('contact') }}" class="item-link">تواصل معنا</a></li>
    <li class="menu-item"><a href="{{ route('shop.checkout') }}" class="item-link">سلة المشتريات</a></li>
    </ul>
    </nav>
    <ul class="header-list-categories tf-lg-hidden">
        @foreach ($categoriesTopNavbar as $item)
            <li class="categories-item {{ $active_cat_id == $item->id ? 'active' : '' }} ">
                <a href="{{ route('shop.category', $item->slug) }}"
                    class="text-uppercase">{{ $item->name }}</a></li>
        @endforeach
    </ul>
    </div>
    </div>
    </div>

    </header>
    <!-- /header -->

    @yield('content')

    <!-- footer -->
    <footer id="footer" class="footer background-gray md-pb-70">
        <div class="footer-wrap">
            <div class="footer-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="footer-infor">
                                <div class="footer-logo">
                                    <a href="/">
                                        <img src="{{ asset('images/logo/logo.png') }}" style="max-width: 116px;"
                                            alt="Branca">
                                    </a>
                                </div>
                                <ul>
                                    <li>
                                        <p>العنوان: {{ setting('site.address') }}</p>
                                    </li>
                                    <li>
                                        <p>البريد الإلكتروني: <a
                                                href="mailto:{{ setting('site.email') }}">{{ setting('site.email') }}</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p>رقم التواصل: <a
                                                href="tel:{{ setting('site.phone') }}">{{ setting('site.phone') }}</a>
                                        </p>
                                    </li>
                                </ul>
                                <a href="{{ route('contact') }}" class="tf-btn btn-line">تواصل معنا<i
                                        class="icon icon-arrow1-top-left"></i></a>
                                <ul class="tf-social-icon d-flex gap-10">
                                    <li><a target="_blank" href="{{ setting('site.facebook') }}"
                                            class="box-icon w_34 round social-facebook social-line"><i
                                                class="icon fs-14 icon-fb"></i></a></li>
                                    <li><a target="_blank" href="{{ setting('site.twiter') }}"
                                            class="box-icon w_34 round social-twiter social-line"><i
                                                class="icon fs-12 icon-Icon-x"></i></a></li>
                                    <li><a target="_blank" href="{{ setting('site.instagram') }}"
                                            class="box-icon w_34 round social-instagram social-line"><i
                                                class="icon fs-14 icon-instagram"></i></a></li>
                                    <li><a target="_blank" href="{{ setting('site.tiktok') }}"
                                            class="box-icon w_34 round social-tiktok social-line"><i
                                                class="icon fs-14 icon-tiktok"></i></a></li>
                                    <li><a target="_blank" href="{{ setting('site.pinterest') }}"
                                            class="box-icon w_34 round social-pinterest social-line"><i
                                                class="icon fs-14 icon-pinterest-1"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                            <div class="footer-heading footer-heading-desktop">
                                <h6>مساعدة</h6>
                            </div>
                            <div class="footer-heading footer-heading-moblie">
                                <h6>مساعدة</h6>
                            </div>
                            <ul class="footer-menu-list tf-collapse-content">
                                <li>
                                    <a href="/page/privacy-policy" class="footer-menu_item">سياسة الخصوصية</a>
                                </li>
                                <li>
                                    <a href="/page/shiprates" class="footer-menu_item">سياسة الشحن</a>
                                </li>
                                <li>
                                    <a href="/page/terms-Conditions" class="footer-menu_item">الشروط والأحكام</a>
                                </li>
                                <li>
                                    <a href="/page/faqs" class="footer-menu_item">الاسألة الشائعة</a>
                                </li>
                                <li>
                                    <a href="/compare" class="footer-menu_item">المقارنات</a>
                                </li>
                                <li>
                                    <a href="/checkout" class="footer-menu_item">السلة</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                            <div class="footer-heading footer-heading-desktop">
                                <h6>من نحن</h6>
                            </div>
                            <div class="footer-heading footer-heading-moblie">
                                <h6>من نحن</h6>
                            </div>
                            <ul class="footer-menu-list tf-collapse-content">
                                <li>
                                    <a href="/page/about" class="footer-menu_item">عن المتجر</a>
                                </li>
                                <li>
                                    <a href="/contact" class="footer-menu_item">تواصل معنا</a>
                                </li>
                                <li>
                                    <a href="/" class="footer-menu_item">الرئيسية</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="footer-newsletter footer-col-block">
                                <div class="footer-heading footer-heading-desktop">
                                    <h6>إشتراك الواتس اب</h6>
                                </div>
                                <div class="footer-heading footer-heading-moblie">
                                    <h6>إشتراك الواتس اب</h6>
                                </div>
                                <div class="tf-collapse-content">
                                    <div class="footer-menu_item">سجل للحصول على الأولوية للمنتجات الجديدة والمبيعات
                                        والمحتوى الحصري والأحداث والمزيد!</div>
                                    <form class="form-newsletter" id="subscribe-form" action="/#" method="post"
                                        accept-charset="utf-8" data-mailchimp="true">
                                        <div id="subscribe-content">
                                            <fieldset class="email">
                                                <input type="phone" name="email-form" id="subscribe-email"
                                                    placeholder="إدخل رقم الواتس اب" tabindex="0"
                                                    aria-required="true">
                                            </fieldset>
                                            <div class="button-submit">
                                                <button id="subscribe-button"
                                                    class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn"
                                                    type="button">إشتراك<i
                                                        class="icon icon-arrow1-top-left"></i></button>
                                            </div>
                                        </div>
                                        <div id="subscribe-msg"></div>
                                    </form>
                                    <div class="tf-cur">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">
                                <div class="footer-menu_item">جميع الحقوق محفوظة متجر <a href="/">برانكا</a> ©
                                    2025</div>
                                <div class="tf-payment no_click no_color">
                                    <img src="{{ asset('images/payments/visa.png') }}" alt="">
                                    <img src="{{ asset('images/payments/img-1.png') }}" alt="">
                                    <img src="{{ asset('images/payments/img-2.png') }}" alt="">
                                    <img src="{{ asset('images/payments/img-3.png') }}" alt="">
                                    <img src="{{ asset('images/payments/img-4.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer -->

    </div>

    <!-- gotop -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;">
            </path>
        </svg>
    </div>
    <!-- /gotop -->

    <!-- toolbar-bottom -->
    <div class="tf-toolbar-bottom type-1150">
        <div class="toolbar-item">
            <a href="/#toolbarShopmb" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                <div class="toolbar-icon">
                    <i class="icon-shop"></i>
                </div>
                <div class="toolbar-label">تصفح</div>
            </a>
        </div>

        <div class="toolbar-item">
            <a href="/search">
                <div class="toolbar-icon">
                    <i class="icon-search"></i>
                </div>
                <div class="toolbar-label">البحث</div>
            </a>
        </div>
        
        <div class="toolbar-item">
            <a href="{{  route('shop.wishlist') }}">
                <div class="toolbar-icon">
                    <i class="icon-heart"></i>
                    <div class="toolbar-count count_wishlist">0</div>
                </div>
                <div class="toolbar-label">المفضلة</div>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="/#shoppingCart" data-bs-toggle="modal">
                <div class="toolbar-icon">
                    <i class="icon-bag"></i>
                    <div class="toolbar-count count_cart">0</div>
                </div>
                <div class="toolbar-label">السلة</div>
            </a>
        </div>
    </div>
    <!-- /toolbar-bottom -->

    

    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                
                @include('components.navbar_mobile')
                
                <div class="mb-other-content">
                    <div class="d-flex group-icon">
                        <a href="{{  route('shop.wishlist') }}" class="site-nav-icon"><i class="icon icon-heart"></i>المفضلة</a>
                        <a href="home-search.html" class="site-nav-icon"><i
                                class="icon icon-search"></i>البحث</a>
                    </div>
                    <div class="mb-notice">
                        <a href="{{ route('contact') }}" class="text-need">تحتاج مساعدة؟</a>
                    </div>
                    <ul class="mb-info">
                        <li>العنوان: {{ setting('site.address') }}</li>
                        <li>البريد الإلكتروني: <b>{{ setting('site.email') }}</b></li>
                        <li>الموبيل: <b>{{ setting('site.phone') }}</b></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- /mobile menu -->


    <!-- toolbarShopmb -->
    <div class="offcanvas offcanvas-start canvas-mb toolbar-shop-mobile" id="toolbarShopmb">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">

                                @php
                                    $categories = DB::table('cats')->where('show_top_home', 1)->get();
                                @endphp
                                @foreach ($categories as $item)
                                <li class="nav-mb-item">
                                    <a href="{{ route('shop.category', $item->slug) }}" class="tf-category-link mb-menu-link">
                                        <div class="image">
                                            <img src="{{ Voyager::image($item->image) }}" alt="">
                                        </div>
                                        <span>{{ $item->name }}</span>
                                    </a>
                                </li>
                                @endforeach

                    
                    
                    
                </ul>
            </div>
            <div class="mb-bottom">
                <a href="{{ route('shop.products_get') }}" class="tf-btn fw-5 btn-line">مشاهدة جميع المنتجات<i
                        class="icon icon-arrow1-top-left"></i></a>
            </div>
        </div>
    </div>
    <!-- /toolbarShopmb -->

    

    <!-- shoppingCart -->
    <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="header">
                    <div class="title fw-5">السلة الخاصه بك</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-mini-cart-threshold">
                        <div class="tf-progress-bar">
                            <span style="width: 50%;">
                                <div class="progress-car">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                        viewBox="0 0 21 14" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 0.875C0 0.391751 0.391751 0 0.875 0H13.5625C14.0457 0 14.4375 0.391751 14.4375 0.875V3.0625H17.3125C17.5867 3.0625 17.845 3.19101 18.0104 3.40969L20.8229 7.12844C20.9378 7.2804 21 7.46572 21 7.65625V11.375C21 11.8582 20.6082 12.25 20.125 12.25H17.7881C17.4278 13.2695 16.4554 14 15.3125 14C14.1696 14 13.1972 13.2695 12.8369 12.25H7.72563C7.36527 13.2695 6.39293 14 5.25 14C4.10706 14 3.13473 13.2695 2.77437 12.25H0.875C0.391751 12.25 0 11.8582 0 11.375V0.875ZM2.77437 10.5C3.13473 9.48047 4.10706 8.75 5.25 8.75C6.39293 8.75 7.36527 9.48046 7.72563 10.5H12.6875V1.75H1.75V10.5H2.77437ZM14.4375 8.89937V4.8125H16.8772L19.25 7.94987V10.5H17.7881C17.4278 9.48046 16.4554 8.75 15.3125 8.75C15.0057 8.75 14.7112 8.80264 14.4375 8.89937ZM5.25 10.5C4.76676 10.5 4.375 10.8918 4.375 11.375C4.375 11.8582 4.76676 12.25 5.25 12.25C5.73323 12.25 6.125 11.8582 6.125 11.375C6.125 10.8918 5.73323 10.5 5.25 10.5ZM15.3125 10.5C14.8293 10.5 14.4375 10.8918 14.4375 11.375C14.4375 11.8582 14.8293 12.25 15.3125 12.25C15.7957 12.25 16.1875 11.8582 16.1875 11.375C16.1875 10.8918 15.7957 10.5 15.3125 10.5Z">
                                        </path>
                                    </svg>
                                </div>
                            </span>
                        </div>
                        {{-- <div class="tf-progress-msg">
                            Buy <span class="price fw-6">$75.00</span> more to enjoy <span class="fw-6">Free Shipping</span>
                        </div> --}}
                    </div>
                    <div class="tf-mini-cart-wrap">
                        <div class="tf-mini-cart-main">
                            <div class="tf-mini-cart-sroll">
                                <div class="tf-mini-cart-items result_cart_home">

                                </div>

                            </div>
                        </div>
                        <div class="tf-mini-cart-bottom">
                            <div class="tf-mini-cart-bottom-wrap">
                                <div class="tf-cart-totals-discounts">
                                    <div class="tf-cart-total">المجموع الفرعي</div>
                                    <div class="tf-totals-total-value fw-6">
                                        <span class="price_short"></span> EGP
                                    </div>
                                </div>
                                <div class="tf-cart-tax">
                                    سوف يتم إحتساب خدمة الشحن في صفحة إتمام الشراء
                                </div>
                                <div class="tf-mini-cart-line"></div>
                                <div class="tf-cart-checkbox">
                                    <div class="tf-checkbox-wrapp">
                                        <input class="" type="checkbox" id="CartDrawer-Form_agree"
                                            name="agree_checkbox">
                                        <div>
                                            <i class="icon-check"></i>
                                        </div>
                                    </div>
                                    <label for="CartDrawer-Form_agree">
                                        أوافق على
                                        <a href="/#" title="Terms of Service">
                                            الشروط والأحكام
                                        </a>
                                    </label>
                                </div>
                                <div class="tf-mini-cart-view-checkout">
                                    <a href="/checkout"
                                        class="tf-btn btn-outline radius-3 link w-100 justify-content-center">مشاهدة
                                        السلة</a>
                                    <a href="/checkout"
                                        class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>إتمام
                                            الطلب</span></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /shoppingCart -->

    <!-- modal compare -->
    <div class="offcanvas offcanvas-bottom canvas-compare" id="compare">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="close-popup">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas"
                        aria-label="Close"></span>
                </div>
            </header>
            <div class="canvas-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="tf-compare-list">
                                <div class="tf-compare-head">
                                    <div class="title">مقارنة المنتجات</div>
                                </div>
                                <div class="tf-compare-offcanvas result_compare_javascript">

                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3"
                                                    src="{{ asset('images/products/orange-1.jpg') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="tf-compare-buttons">
                                    <div class="tf-compare-buttons-wrap">
                                        <a href="/compare"
                                            class="tf-btn radius-3 btn-fill justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn ">صفحة
                                            المقارنات</a>
                                        <div class="tf-compapre-button-clear-all link">
                                            حذف الكل
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal compare -->

    <!-- modal quick_add -->
    <div class="modal fade modalDemo" id="quick_add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap result_quick"></div>
            </div>
        </div>
    </div>
    <!-- /modal quick_add -->

    

    <!-- modal find_size -->
    <div class="modal fade modalDemo tf-product-modal" id="find_size">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Size chart</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-rte">
                    <div class="tf-table-res-df">
                        <h6>Size guide</h6>
                        <table class="tf-sizeguide-table">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>US</th>
                                    <th>Bust</th>
                                    <th>Waist</th>
                                    <th>Low Hip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>XS</td>
                                    <td>2</td>
                                    <td>32</td>
                                    <td>24 - 25</td>
                                    <td>33 - 34</td>
                                </tr>
                                <tr>
                                    <td>S</td>
                                    <td>4</td>
                                    <td>34 - 35</td>
                                    <td>26 - 27</td>
                                    <td>35 - 26</td>
                                </tr>
                                <tr>
                                    <td>M</td>
                                    <td>6</td>
                                    <td>36 - 37</td>
                                    <td>28 - 29</td>
                                    <td>38 - 40</td>
                                </tr>
                                <tr>
                                    <td>L</td>
                                    <td>8</td>
                                    <td>38 - 29</td>
                                    <td>30 - 31</td>
                                    <td>42 - 44</td>
                                </tr>
                                <tr>
                                    <td>XL</td>
                                    <td>10</td>
                                    <td>40 - 41</td>
                                    <td>32 - 33</td>
                                    <td>45 - 47</td>
                                </tr>
                                <tr>
                                    <td>XXL</td>
                                    <td>12</td>
                                    <td>42 - 43</td>
                                    <td>34 - 35</td>
                                    <td>48 - 50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tf-page-size-chart-content">
                        <div>
                            <h6>Measuring Tips</h6>
                            <div class="title">Bust</div>
                            <p>Measure around the fullest part of your bust.</p>
                            <div class="title">Waist</div>
                            <p>Measure around the narrowest part of your torso.</p>
                            <div class="title">Low Hip</div>
                            <p class="mb-0">With your feet together measure around the fullest part of your
                                hips/rear.
                            </p>
                        </div>
                        <div>
                            <img class="sizechart lazyload"
                                data-src="{{ asset('images/shop/products/size_chart2.jpg') }}"
                                src="{{ asset('images/shop/products/size_chart2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal find_size -->

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/rangle-slider.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/shop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/multiple-modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main2.js') }}"></script>

    <script>
        $(document).ready(function() {
            var spinner = `<div class="spinner-border float-start" role="status">`;
            $("body").on('click', '.quick-add', function() {
                var id = $(this).attr('data-id');
                $(".result_quick").html(spinner);
                $.post('/quick-view', {
                    id,
                    _token: '{{ csrf_token() }}'
                }, function(d) {
                    $(".result_quick").hide().html(d).fadeIn();
                    resetButtons();
                });
            });

            $("body").on('click', ".btn-add-to-cart", function() {
                var mainProduct = $(this).closest(".main_product");
                var id = mainProduct.find("[name='product_id']").val();
                var name = mainProduct.find("[name='name']").val();
                var image = mainProduct.find("[name='image']").val();
                var color = mainProduct.find("[name='color']").val();
                var size = mainProduct.find("[name='size']").val();
                var price = parseFloat(mainProduct.find("[name='price']").val());
                var count = parseFloat(mainProduct.find("[name='number']").val());
                var slug = mainProduct.find("[name='slug']").val();
                //  item.id === product.id 
                //  item.price === product.price 
                //  item.image === product.image 
                //  item.color === product.color 
                //  item.size === product.size 
                //  item.count === product.count
                const product = {
                    id,
                    name,
                    image,
                    color,
                    size,
                    price,
                    count,
                    slug
                };
                toggleCartItem(product);
                getCart();
                $("#shoppingCart").modal("show");
            });

            $("body").on("change", ".liveCountCart", function(e) {
                console.log('asd');
                var v = $(this).val();
                var id = $(this).attr("data-id");
                updateCartItem(id, v);
            });

        });
    </script>
    @yield('scripts')
</body>

</html>
