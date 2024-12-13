@extends('layouts.app')

@section('content')
    
        <!-- categories -->
        <section class="flat-spacing-20">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tf-categories-wrap">
                            <div class="tf-shopall-wrap">
                                <div class="collection-item-circle tf-shopall">
                                    <a href="shop-collection-sub.html" class="collection-image img-style tf-shopall-icon">
                                        <i class="icon icon-arrow1-top-left"></i>
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-6"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> كل المنتجات </font></font></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-categories-container">
                                
                                @php
                                    $categories = DB::table('cats')->where('show_top_home', 1)->get();
                                @endphp
                                
                                @foreach ($categories as $cat01)
                                <div class="collection-item-circle hover-img">
                                    <a href="{{ route('shop.category', $cat01->slug) }}" class="collection-image img-style">
                                        <img class="lazyload" data-src="{{ Voyager::image($cat01->image) }}" src="{{ Voyager::image($cat01->image) }}" alt="collection-img">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="{{ route('shop.category', $cat01->slug) }}" class="link title fw-6">{{ $cat01->name }}</a>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        <!-- /categories -->

        <!-- slider -->
        <div class="tf-slideshow slider-women slider-effect-fade position-relative">
            <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true" data-auto-play="false" data-delay="2000" data-speed="1000">
                <div class="swiper-wrapper">
                    

                    @php
                        $slidshows = DB::table('slidshows')->get();
                    @endphp

                    @foreach ($slidshows as $item)
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-slider">
                            <img class="lazyload" data-src="{{ Voyager::image($item->image) }}" src="{{ Voyager::image($item->image) }}" alt="women-slideshow-{{  $item->id }}" >
                            <div class="box-content">
                                <div class="container">
                                    <h1 class="fade-item fade-item-1">{{ $item->title }}</h1>
                                    <p class="fade-item fade-item-2">{{ $item->desc }}</p>
                                    <a href="{{ $item->url_button }}" class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-60"><span>{{ $item->text_button }}</span><i class="icon icon-arrow-left"></i></a>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    @endforeach

                    
                    
                </div>
            </div>
            <div class="wrap-pagination">
                <div class="container">
                    <div class="sw-dots sw-pagination-slider justify-content-center"></div>
                </div>
            </div>
        </div>
        <!-- /slider -->

        <!-- Categories -->
        <section class="flat-spacing-5 pb_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">أقسام قد تعجبك</span>
                </div>
                <div class="hover-sw-nav">
                    <div dir="ltr" class="swiper tf-sw-collection" data-preview="4" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                        <div class="swiper-wrapper">

                            @php
            $bannersCat = App\Models\Cat::where('show_like_home', 1)
            ->orderBy('sort', 'asc')
            ->get();
        @endphp

                            @foreach ($bannersCat as $item)
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="{{ route('shop.category', ['slug' => $item->slug]) }}" class="collection-image img-style">
                                            <img class="lazyload" data-src="{{ Voyager::image($item->image) }}" src="{{ Voyager::image($item->image) }}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="{{ route('shop.category', ['slug' => $item->slug]) }}" class="tf-btn collection-title hover-icon fs-15 rounded-full"><span>{{ $item->name }}</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            

                            
                            
                            
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-collection box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-collection box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-collection justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Categories -->

        <!-- Banner Collection -->
        <section class="flat-spacing-10 pb_0">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-recent" data-preview="2" data-tablet="2" data-mobile="1.3" data-space-lg="30" data-space-md="15" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        
                        @php
                            $products = App\Models\Product::where('show_in_home', 1)
                            ->orderBy('id', 'desc')
                            ->limit(2)
                            ->get();
                        @endphp
                        
                        @foreach ($products as $item)
                        <div class="swiper-slide" lazy="true">
                            <div class="collection-item-v4 hover-img">
                                <div class="collection-inner">
                                    <a href="{{ route('shop.product', ['slug' => $item->slug]) }}" class="collection-image img-style radius-10">
                                        <img class="lazyload" data-src="{{ Voyager::image(json_decode($item->images)[0]) }}" src="{{ Voyager::image(json_decode($item->images)[0]) }}" alt="collection-img">
                                    </a>
                                    <div class="collection-content wow fadeInUp" data-wow-delay="0s">
                                        <h5 class="heading text_white">{{ $item->name }}</h5>
                                        <a href="{{ route('shop.product', ['slug' => $item->slug]) }}" class="tf-btn style-3 fw-6 btn-light-icon rounded-full animate-hover-btn"><span>مشاهدة المنتج</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- /Banner Collection -->
        @php
            $bannersCat = App\Models\Cat::where('is_banner', 1)
            ->orderBy('sort', 'asc')
            ->get();
        @endphp
        @foreach ($bannersCat as $cat)
            <!-- Best seller -->
        <section class="flat-spacing-15 pb_0">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title">{{ $cat->name }}</span>
                    <p class="sub-title">{{ $cat->description }}</p>
                </div>
                <div class="hover-sw-nav hover-sw-3">
                    <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            
                            @foreach ($cat->products_random() as $item)
                            <div class="swiper-slide" lazy="true">
                                @include('components.card_product', ['item' => $item])
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                </div>
            </div>
        </section>
        <!-- /Best seller -->
        @endforeach

        <!-- Shop Collection -->
        <section class="flat-spacing-19">
            <div class="container">
                <div class="tf-grid-layout md-col-2 tf-img-with-text style-1">
                    <div class="tf-image-wrap wow fadeInUp" data-wow-delay="0s">
                        <img class="lazyload" data-src="{{ asset('images/collections/collection-58.jpg') }}" src="{{ asset('images/collections/collection-58.jpg') }}" alt="collection-img">
                    </div>
                    <div class="tf-content-wrap wow fadeInUp" data-wow-delay="0s">
                        <div class="heading">إعادة تعريف الأناقة <br> تميّز لا يُضاهى</div>
                        <p class="description">الآن فرصتك لتجديد خزانتك بمجموعة متنوعة من الملابس العصرية.</p>
                        <a href="/page/about" class="tf-btn style-2 btn-fill rounded-full animate-hover-btn">مشاهدة قصتنا</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Shop Collection -->

        

        <!-- Icon box -->
        <section class="flat-spacing-11 pb_0 flat-iconbox wow fadeInUp" data-wow-delay="0s">
            <div class="container">
                <div class="wrap-carousel wrap-mobile">
                    <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-shipping"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">شحن مجاني</div>
                                        <p>شحن مجاني على الطلبات بقيمة  1200 جنية</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-payment fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">الدفع المرن</div>
                                        <p>يمكنك الدفع عند الإستلام</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-return fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">إرجاع خلال 14 يومًا</div>
                                        <p>يمكنك إرجاع السلع بشرط عدم لبسها او حدوث عيب فيها</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-suport"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">دعم متميز</div>
                                        <p>دعم متميز على مدار الساعة</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Icon box -->
        
        <div class="pt-5"></div>

@endsection