@extends('layouts.app')
@section('title', 'إتمام مشترياتك')

@section('content')
<!-- page-title -->
<div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">إتمام مشترياتك</div>
            </div>
        </div>
        <!-- /page-title -->
       
        <!-- Section Product -->
        <div class="resluts_products d-none">
            <!-- page-cart -->
        <section class="flat-spacing-11">
            <div class="container">
                <div class="tf-page-cart-wrap layout-2">
                    <div class="tf-page-cart-item">
                        <h5 class="fw-5 mb_20">عنوان الشحن الخاص بك</h5>
                        <form class="form-checkout">
                            <div class="box grid-2">
                                <fieldset class="fieldset">
                                    <label for="first_name">الإسم الأول</label>
                                    <input type="text" id="first_name" placeholder="إسمك" required @if (Session::has('information')) value="{{ Session::get('information')['first_name'] }}" @endif>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <label for="last_name">الإسم الأخير</label>
                                    <input type="text" id="last_name" required  @if (Session::has('information')) value="{{ Session::get('information')['last_name'] }}" @endif>
                                </fieldset>
                            </div>

                            <fieldset class="box fieldset">
                                <label for="country">المحافظة</label>
                                <div class="select-custom">
                                    <select class="tf-select w-100" id="city" name="" @if (Session::has('information')) data-default="{{ Session::get('information')['city'] }}" @endif >
                                        <option value="" selected disabled>---</option>
                                        @foreach ($governorates as $g)
                                            <option value="{{ $g }}">{{ $g }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset class="box fieldset">
                                <label for="address">العنوان</label>
                                <input type="text" id="address" required @if (Session::has('information')) value="{{ Session::get('information')['address'] }}" @endif>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="phone">رقم الهاتف</label>
                                <input type="number" id="phone" required @if (Session::has('information')) value="{{ Session::get('information')['phone'] }}" @endif>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="note" class="noDot">ملاحظات الطلب (إختياري)</label>
                                <textarea name="note" id="note"></textarea>
                            </fieldset>
                        </form>
                    </div>
                    <div class="tf-page-cart-footer">
                        <div class="tf-cart-footer-inner">
                            <h5 class="fw-5 mb_20">سلة مشترياتك</h5>
                            <form class="tf-page-cart-checkout widget-wrap-checkout">
                                <ul class="wrap-checkout-product">
                                </ul>
                                <div class="coupon-box">
                                    <input type="text" placeholder="كوبون خصم" id="coupon">
                                    <a class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn btn_coupon">تطبيق</a>
                                </div>
                                <div class="d-flex justify-content-between line pb_20">
                                    <span class="fw-5">مجموع المنتجات</span>
                                    <span class="total fw-5 price_no_shipping">{{ env('SHIPPING_COST') }} EGP</span>
                                </div>
                                <div class="d-flex justify-content-between line pb_20 d-none discountDiv" style="color: #00ab54;">
                                    <span class="fw-5">مجموع الخصومات</span>
                                    <span class="total fw-5 discount_price"></span>
                                </div>
                                <div class="d-flex justify-content-between line pb_20">
                                    <span class="fw-5">الشحن</span>
                                    <span class="total fw-5 shippingCost" data-price="{{ env('SHIPPING_COST') }}">{{ env('SHIPPING_COST') }} EGP</span>
                                </div>
                                <div class="d-flex justify-content-between line pb_20">
                                    <h6 class="fw-5">المجموع</h6>
                                    <h6 class="total fw-5 final_price"></h6>
                                </div>
                                <div class="wd-check-payment">
                                    <div class="fieldset-radio mb_20">
                                        <input type="radio" name="payment" id="delivery" class="tf-check" checked>
                                        <label for="delivery">الدفع عند الإستلام</label>
                                    </div>
                                    <p class="text_black-2 mb_20">سيتم استخدام بياناتك الشخصية لمعالجة طلبك ودعم تجربتك عبر  Branca  <a href="privacy-policy.html" class="text-decoration-underline">سياسة الخصوصية</a>.</p>
                                    <div class="box-checkbox fieldset-radio mb_20 check_dev">
                                        <input type="checkbox" id="check-agree" class="tf-check">
                                        <label for="check-agree" class="text_black-2">لقد قرأت ووافقت على <a href="/page/terms-conditions" target="_blank" class="text-decoration-underline"> شروط وأحكام الموقع</a>.</label>
                                    </div>
                                </div>
                                <button class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center" type="button" id="placeOrder">إتمام الشراء الآن</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page-cart -->
        </div>
        <!-- /Section Product -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $("select").each(function() {
                var $this = $(this);
                // get data-default
                var defaultVal = $this.attr('data-default');
                if (defaultVal) {
                    $this.find('option[value="' + defaultVal + '"]').attr('selected', 'selected');
                }
            })

            var wishlist_ids = getCart();
            
            if (wishlist_ids.length > 0) {
                $(".resluts_products").hide().removeClass("d-none").fadeIn();
                var array = [];
                var final_price = 0;
                wishlist_ids.forEach(element => {
                    final_price += parseFloat(element.price);
                    $(".wrap-checkout-product").append(`<li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="${element.image}" alt="product">
                                            <span class="quantity">${element.count}</span>
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">${element.name}</p>
                                                <span class="variant">${element.color} / ${element.size}</span>
                                            </div>
                                            <span class="price">${element.price} EGP</span>
                                        </div>
                                    </li>`);
                    array.push(element.id);
                });

                $(".price_no_shipping").text(final_price + " EGP").attr("data-price", final_price);
                final_price += parseFloat({{ env('SHIPPING_COST') }});
                $(".final_price").text(final_price + " EGP");
                
                // $.post('/checkout', {ids:array,_token:'{{ csrf_token() }}'}, function(data) {
                //     //$(".resluts_products").hide().html(data).fadeIn();
                //     //resetButtons();
                // });
            }else{
                $(".resluts_products").hide().html(`<div class="info_black">
            لم تضف أي منتجات إلى السلة حتى الآن!<br>
            تصفح منتجاتنا وأضف ما يعجبك إلى قائمتك السلة ❤️
          </div>`).fadeIn();
            }

            $("#placeOrder").click(function(){
                $(".text-danger, .errror").remove();
                if($("#check-agree").is(":checked")){
                    var cart = getCart();

                    $.ajax({
                        url: '/place-order',
                        type: 'POST',
                        data: { _token : '{{ csrf_token() }}',
                            cart : cart,
                            'first_name' : $("#first_name").val(),
                            'last_name' : $("#last_name").val(),
                            'city' : $("#city").val(),
                            'address' : $("#address").val(),
                            'phone' : $("#phone").val(),
                            'note' : $("#note").val(),
                            'coupon' : $("#coupon").val()
                        },
                        success: function(data) {
                            // empty cart
                            clearCart();
                            // redirect to success page
                            //console.log(data);
                            window.location.href = "/invoice/" + data.data.invoice_code;
                        }, 
                        error: function(data) {
                            // foreach errors
                            var errors = data.responseJSON.errors;
                            console.log(errors);
                            // show error messages
                            for (var key in errors) {
                                $("#"+key).after("<span class='text-danger'>"+errors[key][0]+"</span>");
                            }
                        }
                    });
                    
                }else{
                    $(".check_dev").append(`<span class="text-danger errror">يجب قبول شروط وأحكام الموقع</span>`);
                }
            });


        });
    </script>
@endsection


