@extends('layouts.app')
@section('title', $category->name)

@section('content')
     <!-- page-title -->
     <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">{{ $category->name }}</div>
                    <p class="text-center text-2 text_black-2 mt_5">{{ $category->description }}</p> 
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->
    <section class="flat-spacing-1">
        <div class="container">
            <div class="tf-shop-control grid-3 align-items-center">
                <div class="tf-control-filter">
                    <a href="product-style-02.html#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">الفلاتر</span></a>
                </div>
                <ul class="tf-control-layout d-flex justify-content-center">
                    <li class="tf-view-layout-switch sw-layout-2" data-value-grid="grid-2">
                        <div class="item"><span class="icon icon-grid-2"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-3" data-value-grid="grid-3">
                        <div class="item"><span class="icon icon-grid-3"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-4" data-value-grid="grid-4">
                        <div class="item"><span class="icon icon-grid-4"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-5 active" data-value-grid="grid-5">
                        <div class="item"><span class="icon icon-grid-5"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-6" data-value-grid="grid-6">
                        <div class="item"><span class="icon icon-grid-6"></span></div>
                    </li>
                </ul>
                <div class="tf-control-sorting d-flex justify-content-end">
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">المميز</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item active">
                                <span class="text-value-item">المميز</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">ترتيب أبجدي أ-ي</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">ترتيب أبجدي ي-أ</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">السعر من الأدنى إلى الأعلى</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">السعر من الأعلى إلى الأدنى</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">التاريخ من القديم إلى الجديد</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">التاريخ من الجديد إلى القديم</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            <div class="results_product">
                @include('components.products', ['products' => $category->products])
            </div>
            
        </div>
    </section>

    <!-- Filter -->
    <div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="filter-icon">
                    <span class="icon icon-filter"></span>
                    <span>الفلاتر</span>
                </div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body">
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
                        <span>فئات المنتجات</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            @php
                                $cats = DB::table('cats')->get();
                            @endphp
                            @foreach ($cats as $cat)
                            <li class="cate-item {{  $cat->id == $category->id ? 'current' : ''}} "><a href="{{ route('shop.category', $cat->slug) }}"><span>{{ $cat->name }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form action="product-style-02.html#" id="facet-filter-form" class="facet-filter-form">
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                            <span>السعر</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price filter-price">
                                <div class="tow-bar-block">
                                    <div class="progress-price"></div>
                                </div>
                                <div class="range-input">
                                    <input name="price[]" class="range-min" type="range" min="0" max="3000" value="0"/>
                                    <input name="price[]" class="range-max" type="range" min="0" max="3000" value="3000"/>
                                </div>
                                <div class="box-title-price">
                                    <span class="title-price">السعر :</span>
                                    <div class="caption-price">
                                        <div>
                                            <span>EGP</span>
                                            <span class="min-price">0</span>
                                        </div>
                                        <span>-</span>
                                        <div>
                                            <span>EGP</span>
                                            <span class="max-price">300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#color" data-bs-toggle="collapse" aria-expanded="true" aria-controls="color">
                            <span>اللون</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="color" class="collapse show">
                            <ul class="tf-filter-group filter-color current-scrollbar mb_36">
                                
                                @php
                                    $colors = DB::table('colors')->get();
                                @endphp
                                @foreach ($colors as $item)
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="checkbox" name="color" class="tf-check-color" style="background: {{ $item->color }};" id="color{{ $item->id }}" value="{{ $item->name }}">
                                    <label for="color{{ $item->id }}" class="label"><span>{{ $item->name }}</span>&nbsp;<span>(3)</span></label>
                                </li>
                                @endforeach
                                
                                
                                
                            </ul>
                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#size" data-bs-toggle="collapse" aria-expanded="true" aria-controls="size">
                            <span>المقاس</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="size" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar">
                                @php
                                    $sizes = DB::table('sizes')->get();
                                @endphp
                               @foreach ($sizes as $item)
                               <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="size" class="tf-check tf-check-size" value="{{ $item->name }}" id="s{{ $item->id }}">
                                <label for="s{{ $item->id }}" class="label"><span>{{ $item->name }}</span></label>
                            </li>
                               @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </form>    
            </div>
            
        </div>       
    </div>
    <!-- End Filter -->
@endsection