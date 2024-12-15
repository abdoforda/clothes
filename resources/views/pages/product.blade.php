@extends('layouts.app')
@section('title', $product->name)

@section('content')
     <!-- page-title -->
     <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">{{ $product->name }}</div>
                    <p class="text-center text-2 text_black-2 mt_5">
                        الرئيسية / (@foreach ($product->cats as $cat)
                        <a href="{{ route('shop.category', $cat->slug) }}">{{ $cat->name }}</a>
                        @if (!$loop->last)
                            ,
                        @endif
                        @endforeach) / {{ $product->name }}    
                    </p> 
                </div>
            </div>
        </div>
    </div>
    
    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="/" class="text">الرئيسية</a>
                    <i class="icon icon-arrow-left"></i>
                    @foreach ($product->cats as $cat)
                    <a href="{{ route('shop.category', $cat->slug) }}" class="text">{{ $cat->name }}</a>
                    <i class="icon icon-arrow-left"></i>
                    @endforeach
                    <span class="text">{{ $product->name }}</span>
                </div>
                <div class="tf-breadcrumb-prev-next">
                    <a href="product-detail.html#" class="tf-breadcrumb-prev hover-tooltip center">
                        <i class="icon icon-arrow-left"></i>
                        <!-- <span class="tooltip">Cotton jersey top</span> -->
                    </a>
                    <a href="product-detail.html#" class="tf-breadcrumb-back hover-tooltip center">
                        <i class="icon icon-shop"></i>
                        <!-- <span class="tooltip">Back to Women</span> -->
                    </a>
                    <a href="product-detail.html#" class="tf-breadcrumb-next hover-tooltip center">
                        <i class="icon icon-arrow-right"></i>
                        <!-- <span class="tooltip">Cotton jersey top</span> -->
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- default -->
    <section class="flat-spacing-4 pt_0">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">
                                        @if ($product->youtube_id != null)
                                        <div class="swiper-slide stagger-item" >
                                            <div class="item">
                                                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/{{ $product->youtube_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        @endif
                                        @foreach (json_decode($product->images) as $image)
                                        <div class="swiper-slide stagger-item" >
                                            <div class="item">
                                                <img class="lazyload" data-src="{{ Voyager::image($image) }}" src="{{ Voyager::image($image) }}" alt="img-product">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper" >
                                        @if ($product->youtube_id != null)
                                        <div class="swiper-slide">
                                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $product->youtube_id }}?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        </div>
                                        @endif
                                        @foreach (json_decode($product->images) as $image)

                                        <div class="swiper-slide" >
                                            <a href="{{ Voyager::image($image) }}" target="_blank" class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                                <img class="tf-image-zoom lazyload" data-zoom="{{ Voyager::image($image) }}" data-src="{{ Voyager::image($image) }}" src="{{ Voyager::image($image) }}" alt="">
                                            </a>
                                        </div>

                                        @endforeach
                                        
                                        
                                    </div>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative main_product">

                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="slug" value="{{ $product->slug }}">
                            <input type="hidden" name="image" value="{{ Voyager::image(json_decode($product->images)[0]) }}">
                            <input type="hidden" name="price" value="{{ $product->final_price }}">
                            <input type="hidden" name="color" value="{{ $product->colors[0]->name }}">
                            <input type="hidden" name="size" value="{{  $product->sizes[0]->name }}">


                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5>{{ $product->name }}</h5>
                                </div>
                                <div class="tf-product-info-badges">
                                    <div class="badges">الأكثر مبيعا</div>
                                    <div class="product-status-content">
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6">يتم البيع بسرعة! يوجد 56 شخصًا لديهم هذا المنتج في عربات التسوق الخاصة بهم.</p>
                                    </div>
                                </div>
                                <div class="tf-product-info-price">
                                    <div class="price-on-sale">{{ $product->final_price }} EGP</div>
                                    @if ($product->is_discount)
                                    <div class="compare-at-price">{{ $product->price }}</div>
                                    <div class="badges-on-sale"><span>{{ $product->discount_rate }}</span>% تخفيض</div>
                                    @endif
                                    
                                </div>
                                <div class="tf-product-info-liveview">
                                    <div class="liveview-count">
                                        @php
                                            //random number from 12 to 37
                                            $randomNumber = mt_rand(12, 37);
                                            echo $randomNumber;
                                        @endphp

                                    </div>
                                    <p class="fw-6">
                                        الناس يشاهدون هذا الآن
                                    </p>
                                </div>
                                @if ($product->is_discount)
                                <div class="tf-product-info-countdown">
                                    <div class="countdown-wrap">
                                        <div class="countdown-title">
                                            <i class="icon-time tf-ani-tada"></i>
                                            <p>اسرع ! ينتهي العرض في</p>
                                        </div>
                                        <div class="tf-countdown style-1">
                                            <div class="js-countdown" data-timer="{{ $product->countdown }}" data-labels="أيام :,ساعات :,دقائق :,ثواني"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="tf-product-info-variant-picker">
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label">
                                            لون المنتج: <span class="fw-6 variant-picker-label-value value-currentColor">{{ $product->colors[0]->name }}</span>
                                        </div>
                                        <div class="variant-picker-values">

                                            @foreach ($product->colors as $index => $color)
                                            <input id="values{{$index}}" type="radio" name='efhuiwefh' value="{{ $color->name }}" @if ($index == 0) checked @endif>
                                            <label class="hover-tooltip radius-60 color" for="values{{$index}}" data-color="{{ $color->name }}" data-value="{{ $color->name }}">
                                                <span class="btn-checkbox" style="background-color:{{ $color->color }}"></span>
                                                <span class="tooltip">{{ $color->name }}</span>
                                            </label>
                                            @endforeach

                                            

                                            
                                            
                                        </div>
                                    </div>
                                    <div class="variant-picker-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="variant-picker-label">
                                                المقاس: <span class="fw-6 variant-picker-label-value">{{ $product->sizes[0]->name }}</span>
                                            </div>
                                            <a href="product-detail.html#find_size" data-bs-toggle="modal" class="find-size fw-6">ابحث عن مقاسك</a>
                                        </div>
                                        <div class="variant-picker-values">
                                            @foreach ($product->sizes as $index => $size)
                                            <input type="radio" name="size1" id="valuesss{{$index}}" @if ($index == 0) checked @endif >
                                            <label class="style-text size-btn size" for="valuesss{{$index}}" data-value="{{ $size->name }}">
                                                <p>{{ $size->name }}</p>
                                            </label>
                                            
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-product-info-quantity">
                                    <div class="quantity-title fw-6">العدد</div>
                                    <div class="wg-quantity">
                                        <span class="btn-quantity btn-decrease">-</span>
                                        <input type="text" class="quantity-product" name="number" value="1">
                                        <span class="btn-quantity btn-increase">+</span>
                                    </div>
                                </div>
                                <div class="tf-product-info-buy-button">
                                    <form class="overflow-hidden">
                                        <a href="javascript:void(0);" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>إضافة إلي السلة  -&nbsp;</span><span class="tf-qty-price total-price">{{ $product->final_price }} EGP</span></a>
                                        <a data-product-id="{{ $product->id }}" href="javascript:void(0);" class="favorite-btn tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">إضافة في المفضلة</span>
                                            <span class="icon icon-delete"></span>
                                        </a>
                                        <a href="product-detail.html#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" data-product-id="{{ $product->id }}" data-product-image="{{ Voyager::image(json_decode($product->images)[0]) }}" class="compare-btn tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                                            <span class="icon icon-compare"></span>
                                            <span class="tooltip">إضافة للمقارنة</span>
                                            <span class="icon icon-check"></span>
                                        </a>
                                        <div class="w-100">
                                            <a  class="btns-full no_click">شراء عبر <img src="/images/payments/paypal.png" alt=""></a>
                                            
                                        </div>
                                    </form>
                                </div>
                                <div class="tf-product-info-extra-link">
                                    <a href="product-detail.html#compare_color" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <img src="/images/item/compare.svg" alt="">
                                        </div>
                                        <div class="text fw-6">متعدد الألوان</div>
                                    </a>
                                    <a href="product-detail.html#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <i class="icon-question"></i>
                                        </div>
                                        <div class="text fw-6">تواصل معنا للإستفسار</div>
                                    </a>
                                    <a href="product-detail.html#delivery_return" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <svg class="d-inline-block" xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 18" fill="currentColor"><path d="M21.7872 10.4724C21.7872 9.73685 21.5432 9.00864 21.1002 8.4217L18.7221 5.27043C18.2421 4.63481 17.4804 4.25532 16.684 4.25532H14.9787V2.54885C14.9787 1.14111 13.8334 0 12.4255 0H9.95745V1.69779H12.4255C12.8948 1.69779 13.2766 2.07962 13.2766 2.54885V14.5957H8.15145C7.80021 13.6052 6.85421 12.8936 5.74468 12.8936C4.63515 12.8936 3.68915 13.6052 3.33792 14.5957H2.55319C2.08396 14.5957 1.70213 14.2139 1.70213 13.7447V2.54885C1.70213 2.07962 2.08396 1.69779 2.55319 1.69779H9.95745V0H2.55319C1.14528 0 0 1.14111 0 2.54885V13.7447C0 15.1526 1.14528 16.2979 2.55319 16.2979H3.33792C3.68915 17.2884 4.63515 18 5.74468 18C6.85421 18 7.80021 17.2884 8.15145 16.2979H13.423C13.7742 17.2884 14.7202 18 15.8297 18C16.9393 18 17.8853 17.2884 18.2365 16.2979H21.7872V10.4724ZM16.684 5.95745C16.9494 5.95745 17.2034 6.08396 17.3634 6.29574L19.5166 9.14894H14.9787V5.95745H16.684ZM5.74468 16.2979C5.27545 16.2979 4.89362 15.916 4.89362 15.4468C4.89362 14.9776 5.27545 14.5957 5.74468 14.5957C6.21392 14.5957 6.59575 14.9776 6.59575 15.4468C6.59575 15.916 6.21392 16.2979 5.74468 16.2979ZM15.8298 16.2979C15.3606 16.2979 14.9787 15.916 14.9787 15.4468C14.9787 14.9776 15.3606 14.5957 15.8298 14.5957C16.299 14.5957 16.6809 14.9776 16.6809 15.4468C16.6809 15.916 16.299 16.2979 15.8298 16.2979ZM18.2366 14.5957C17.8853 13.6052 16.9393 12.8936 15.8298 12.8936C15.5398 12.8935 15.252 12.943 14.9787 13.04V10.8511H20.0851V14.5957H18.2366Z"></path></svg>
                                        </div>
                                        <div class="text fw-6">الشحن - الإسترجاع</div>
                                    </a>
                                    <a href="product-detail.html#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <i class="icon-share"></i>
                                        </div>
                                        <div class="text fw-6">مشاركة</div>
                                    </a>
                                </div>
                                <div class="tf-product-info-delivery-return">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery">
                                                <div class="icon">
                                                    <i class="icon-delivery-time"></i>
                                                </div>
                                                <p>تقدير أوقات التسليم: <span class="fw-7">2-6 أيام</span> (القاهرة, الجيزة)<br> <span class="fw-7">7-3 أيام</span> (غير ذلك).</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery mb-0">
                                                <div class="icon">
                                                    <i class="icon-return-order"></i>
                                                </div>
                                                <p>يمكن إرجاع المنتج خلال <span class="fw-7">12 يومًا</span>  من تاريخ الشراء. <br>الرسوم والضرائب غير قابلة للاسترداد.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-product-info-trust-seal">
                                    <div class="tf-product-trust-mess">
                                        <i class="icon-safe"></i>
                                        <p class="fw-6">
                                            خدمة الدفع بالفيزا
                                            <br>
                                            <span class="fw-5">قريبا</span>
                                        </p>
                                    </div>
                                    <div class="tf-payment no_click no_color">
                                        <img src="/images/payments/visa.png" alt="">
                                        <img src="/images/payments/img-1.png" alt="">
                                        <img src="/images/payments/img-2.png" alt="">
                                        <img src="/images/payments/img-3.png" alt="">
                                        <img src="/images/payments/img-4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- /default -->
    <!-- tabs -->
    <section class="flat-spacing-17 pt_0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-tabs style-has-border">
                        <ul class="widget-menu-tab">
                            <li class="item-title active">
                                <span class="inner">وصف المنتج</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">معلومات المنتج</span>
                            </li>
                            
                            <li class="item-title">
                                <span class="inner">الشحن</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">سياسة الإرجاع</span>
                            </li>
                        </ul>
                        <div class="widget-content-tab">
                            <div class="widget-content-inner active">
                                {!! $product->description !!}
                            </div>
                            <div class="widget-content-inner">
                                <table class="tf-pr-attrs">
                                    <tbody>
                                        <tr class="tf-attr-pa-color">
                                            <th class="tf-attr-label">الألوان</th>
                                            <td class="tf-attr-value">
                                                <p>
                                                    @foreach ($product->colors as $color)
                                                        {{ $color->name }}@if (!$loop->last), @endif
                                                    @endforeach
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="tf-attr-pa-size">
                                            <th class="tf-attr-label">الأحجام</th>
                                            <td class="tf-attr-value">
                                                <p>
                                                    @foreach ($product->sizes as $size)
                                                        {{ $size->name }}@if (!$loop->last), @endif
                                                    @endforeach
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="widget-content-inner">
                                <div class="tf-page-privacy-policy">
                                    <div class="title">سياسة الشحن</div>
                                    <p>
                                        نحن نقدم خدمة شحن بسيطة وسهلة لجميع منتجاتنا، دون أي تعقيدات أو شروط إضافية. نحرص على توصيل طلباتكم بسرعة وأمان إلى عتبة بابكم. شكراً لاختياركم خدماتنا!
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <ul class="d-flex justify-content-center mb_18">
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M8.7 30.7h22.7c.3 0 .6-.2.7-.6l4-25.3c-.1-.4-.3-.7-.7-.8s-.7.2-.8.6L34 8.9l-3-1.1c-2.4-.9-5.1-.5-7.2 1-2.3 1.6-5.3 1.6-7.6 0-2.1-1.5-4.8-1.9-7.2-1L6 8.9l-.7-4.3c0-.4-.4-.7-.7-.6-.4.1-.6.4-.6.8l4 25.3c.1.3.3.6.7.6zm.8-21.6c2-.7 4.2-.4 6 .8 1.4 1 3 1.5 4.6 1.5s3.2-.5 4.6-1.5c1.7-1.2 4-1.6 6-.8l3.3 1.2-3 19.1H9.2l-3-19.1 3.3-1.2zM32 32H8c-.4 0-.7.3-.7.7s.3.7.7.7h24c.4 0 .7-.3.7-.7s-.3-.7-.7-.7zm0 2.7H8c-.4 0-.7.3-.7.7s.3.6.7.6h24c.4 0 .7-.3.7-.7s-.3-.6-.7-.6zm-17.9-8.9c-1 0-1.8-.3-2.4-.6l.1-2.1c.6.4 1.4.6 2 .6.8 0 1.2-.4 1.2-1.3s-.4-1.3-1.3-1.3h-1.3l.2-1.9h1.1c.6 0 1-.3 1-1.3 0-.8-.4-1.2-1.1-1.2s-1.2.2-1.9.4l-.2-1.9c.7-.4 1.5-.6 2.3-.6 2 0 3 1.3 3 2.9 0 1.2-.4 1.9-1.1 2.3 1 .4 1.3 1.4 1.3 2.5.3 1.8-.6 3.5-2.9 3.5zm4-5.5c0-3.9 1.2-5.5 3.2-5.5s3.2 1.6 3.2 5.5-1.2 5.5-3.2 5.5-3.2-1.6-3.2-5.5zm4.1 0c0-2-.1-3.5-.9-3.5s-1 1.5-1 3.5.1 3.5 1 3.5c.8 0 .9-1.5.9-3.5zm4.5-1.4c-.9 0-1.5-.8-1.5-2.1s.6-2.1 1.5-2.1 1.5.8 1.5 2.1-.5 2.1-1.5 2.1zm0-.8c.4 0 .7-.5.7-1.2s-.2-1.2-.7-1.2-.7.5-.7 1.2.3 1.2.7 1.2z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M36.7 31.1l-2.8-1.3-4.7-9.1 7.5-3.5c.4-.2.6-.6.4-1s-.6-.5-1-.4l-7.5 3.5-7.8-15c-.3-.5-1.1-.5-1.4 0l-7.8 15L4 15.9c-.4-.2-.8 0-1 .4s0 .8.4 1l7.5 3.5-4.7 9.1-2.8 1.3c-.4.2-.6.6-.4 1 .1.3.4.4.7.4.1 0 .2 0 .3-.1l1-.4-1.5 2.8c-.1.2-.1.5 0 .8.1.2.4.3.7.3h31.7c.3 0 .5-.1.7-.4.1-.2.1-.5 0-.8L35.1 32l1 .4c.1 0 .2.1.3.1.3 0 .6-.2.7-.4.1-.3 0-.8-.4-1zm-5.1-2.3l-9.8-4.6 6-2.8 3.8 7.4zM20 6.4L27.1 20 20 23.3 12.9 20 20 6.4zm-7.8 15l6 2.8-9.8 4.6 3.8-7.4zm22.4 13.1H5.4L7.2 31 20 25l12.8 6 1.8 3.5z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M5.9 5.9v28.2h28.2V5.9H5.9zM19.1 20l-8.3 8.3c-2-2.2-3.2-5.1-3.2-8.3s1.2-6.1 3.2-8.3l8.3 8.3zm-7.4-9.3c2.2-2 5.1-3.2 8.3-3.2s6.1 1.2 8.3 3.2L20 19.1l-8.3-8.4zM20 20.9l8.3 8.3c-2.2 2-5.1 3.2-8.3 3.2s-6.1-1.2-8.3-3.2l8.3-8.3zm.9-.9l8.3-8.3c2 2.2 3.2 5.1 3.2 8.3s-1.2 6.1-3.2 8.3L20.9 20zm8.4-10.2c-1.2-1.1-2.6-2-4.1-2.6h6.6l-2.5 2.6zm-18.6 0L8.2 7.2h6.6c-1.5.6-2.9 1.5-4.1 2.6zm-.9.9c-1.1 1.2-2 2.6-2.6 4.1V8.2l2.6 2.5zM7.2 25.2c.6 1.5 1.5 2.9 2.6 4.1l-2.6 2.6v-6.7zm3.5 5c1.2 1.1 2.6 2 4.1 2.6H8.2l2.5-2.6zm18.6 0l2.6 2.6h-6.6c1.4-.6 2.8-1.5 4-2.6zm.9-.9c1.1-1.2 2-2.6 2.6-4.1v6.6l-2.6-2.5zm2.6-14.5c-.6-1.5-1.5-2.9-2.6-4.1l2.6-2.6v6.7z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M35.1 33.6L33.2 6.2c0-.4-.3-.7-.7-.7H13.9c-.4 0-.7.3-.7.7s.3.7.7.7h18l.7 10.5H20.8c-8.8.2-15.9 7.5-15.9 16.4 0 .4.3.7.7.7h28.9c.2 0 .4-.1.5-.2s.2-.3.2-.5v-.2h-.1zm-28.8-.5C6.7 25.3 13 19 20.8 18.9h11.9l1 14.2H6.3zm11.2-6.8c0 1.2-1 2.1-2.1 2.1s-2.1-1-2.1-2.1 1-2.1 2.1-2.1 2.1 1 2.1 2.1zm6.3 0c0 1.2-1 2.1-2.1 2.1-1.2 0-2.1-1-2.1-2.1s1-2.1 2.1-2.1 2.1 1 2.1 2.1z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M20 33.8c7.6 0 13.8-6.2 13.8-13.8S27.6 6.2 20 6.2 6.2 12.4 6.2 20 12.4 33.8 20 33.8zm0-26.3c6.9 0 12.5 5.6 12.5 12.5S26.9 32.5 20 32.5 7.5 26.9 7.5 20 13.1 7.5 20 7.5zm-.4 15h.5c1.8 0 3-1.1 3-3.7 0-2.2-1.1-3.6-3.1-3.6h-2.6v10.6h2.2v-3.3zm0-5.2h.4c.6 0 .9.5.9 1.7 0 1.1-.3 1.7-.9 1.7h-.4v-3.4z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M30.2 29.3c2.2-2.5 3.6-5.7 3.6-9.3s-1.4-6.8-3.6-9.3l3.6-3.6c.3-.3.3-.7 0-.9-.3-.3-.7-.3-.9 0l-3.6 3.6c-2.5-2.2-5.7-3.6-9.3-3.6s-6.8 1.4-9.3 3.6L7.1 6.2c-.3-.3-.7-.3-.9 0-.3.3-.3.7 0 .9l3.6 3.6c-2.2 2.5-3.6 5.7-3.6 9.3s1.4 6.8 3.6 9.3l-3.6 3.6c-.3.3-.3.7 0 .9.1.1.3.2.5.2s.3-.1.5-.2l3.6-3.6c2.5 2.2 5.7 3.6 9.3 3.6s6.8-1.4 9.3-3.6l3.6 3.6c.1.1.3.2.5.2s.3-.1.5-.2c.3-.3.3-.7 0-.9l-3.8-3.6z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li class="">
                                        <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222" margin="5px">
                                            <path fill="currentColor"
                                                d="M34.1 34.1H5.9V5.9h28.2v28.2zM7.2 32.8h25.6V7.2H7.2v25.6zm13.5-18.3a.68.68 0 0 0-.7-.7.68.68 0 0 0-.7.7v10.9a.68.68 0 0 0 .7.7.68.68 0 0 0 .7-.7V14.5z">
                                            </path>
                                        </svg>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /tabs -->
    <!-- product -->
    <section class="flat-spacing-1 pt_0">
        <div class="container">
            <div class="flat-title">
                <span class="title">منتجات تم بيعها مؤخرََا</span>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                    <div class="swiper-wrapper">
                        
                        @foreach ($product->products_with_same_cats() as $item)
                        <div class="swiper-slide" lazy="true">
                            @include('components.card_product', ['item' => $item])
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
                <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /product -->
    <!-- recent -->
    <section class="flat-spacing-4 pt_0">
        <div class="container">
            <div class="flat-title">
                <span class="title">منتجات قد تعجبك</span>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div dir="ltr" class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">

                        @foreach ($product->products_with_same_colors() as $item)
                        <div class="swiper-slide" lazy="true">
                            @include('components.card_product', ['item' => $item])
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /recent -->
@endsection


@section('scripts')
<link rel="stylesheet" href="/css/drift-basic.min.css">
<script type="text/javascript" src="/js/drift.min.js"></script>
<script type="module" src="/js/model-viewer.min.js"></script>
    <script type="module" src="/js/zoom.js"></script>
@endsection