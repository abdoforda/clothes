@extends('layouts.app')
@section('title', 'البحث')

@section('content')
    <!-- page-title -->
    <div class="tf-page-title" id="scrollHome">
        <div class="container-full">
            <div class="heading text-center">محرك البحث</div>
            <div class="py-4" style="max-width: 300px; margin: 0 auto">
                <input type="search" placeholder="أكتب هنا كلمة البحث">
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
            
            
            <div class="resluts_products">
                @include('components.products', ['products' => $products])
            </div>
            
        </div>
    </section>
@endsection

@section('scripts')
    <script>
       $(document).ready(function() {
    var typingTimer; // مؤقت لتتبع وقت الكتابة
    var typingInterval = 3000; // 3 ثوانٍ
    
    $('input[type="search"]').on('input', function() {
        var search = $(this).val();

        clearTimeout(typingTimer); // إلغاء المؤقت السابق إذا كان موجوداً

        typingTimer = setTimeout(function() {
            var spinner = `<div class="spinner-border" role="status" style="margin: 0 auto; display: table;">
                                <span class="visually-hidden">تحميل...</span>
                            </div>`;
            $('.resluts_products').html(spinner);

            $.ajax({
                url: '/products',
                type: 'POST',
                data: {
                    search: search,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // الانتقال إلى #scrollHome
                    $('html, body').animate({
                        scrollTop: $("#scrollHome").offset().top + 60
                    });
                    $('.resluts_products').hide().html(data).fadeIn();
                }
            });
        }, typingInterval); // يتم إرسال طلب AJAX بعد 3 ثوانٍ من التوقف عن الكتابة
    });
});

    </script>
@endsection
