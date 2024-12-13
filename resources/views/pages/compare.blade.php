@extends('layouts.app')
@section('title', 'مقارنة منتجاتك')

@section('content')
<!-- page-title -->
<div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">مقارنة منتجاتك</div>
            </div>
        </div>
        <!-- /page-title -->
       
        <!-- Section Product -->
        <div class="resluts_products"></div>
        <!-- /Section Product -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var wishlist_ids = getComparisons();
            
            if (wishlist_ids.length > 0) {
                var array = [];
                wishlist_ids.forEach(element => {
                    array.push(element.id);
                });
                console.log(array);
                $.post('/compare-products', {ids:array,_token:'{{ csrf_token() }}'}, function(data) {
                    $(".resluts_products").hide().html(data).fadeIn();
                    resetButtons();
                });
            }else{
                $(".resluts_products").hide().html(`<div class="info_black">
            لم تضف أي منتجات إلى المفضلة حتى الآن!<br>
            تصفح منتجاتنا وأضف ما يعجبك إلى قائمتك المفضلة ❤️
          </div>`).fadeIn();
            }


        $("body").on("click", ".deleteCompare", function (e) {
            var cc = $(this).attr("data-d");
            $("."+cc).remove();
        });

        });
    </script>
@endsection