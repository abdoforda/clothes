@extends('layouts.app')

@section('content')
<section class="invoice-section">
    <div class="cus-container2">
        <div class="top">
            <a onclick="printDiv('printableDiv')" class="tf-btn btn-fill animate-hover-btn">
                طباعة / تحميل الفاتورة
            </a>
        </div>
        <div class="box-invoice" id="printableDiv" dir="rtl">
            <div class="header">
                <div class="wrap-top">
                    <div class="box-left">
                        <a href="index.html">
                            <img src="{{ asset('images/logo/logo.png') }}" style="max-width: 200px;" alt="logo" class="logo">
                        </a>
                    </div>
                    <div class="box-right">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="title">رقم الفاتورة #</div>
                            <span class="code-num">{{ $order->invoice_code }} </span>
                        </div>
                    </div>
                </div>
                <div class="wrap-date">
                    <div class="box-left">
                        <label for="">تاريخ الفاتورة:</label>
                        <span class="date">{{ $order->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
                <div class="wrap-info">
                    <div class="box-left">
                        <div class="title">المتجر</div>
                        <div class="sub">Branka</div>
                        <p class="desc">
                            24 شارع النخيل المدينة المنورة <br>
                            مكة المكرمة المملكة العربية السعودية
                        </p>
                    </div>
                    <div class="box-right">
                        <div class="title">بيانات العميل</div>
                        <div class="sub"><small>الإسم</small> {{ $order->first_name }}</div>
                        <p class="desc">
                            {{ $order->city }} , {{ $order->address }} <br> {{ $order->phone }}
                        </p>
                    </div>
                </div>
                <div class="wrap-table-invoice">
                    <table class="invoice-table hideInPrint">
                        <thead>
                            <tr class="title">
                                <th>إسم المنتج</th>
                                <th>صورة المنتج</th>
                                <th>النوع</th>
                                <th>السعر</th>
                                <th>العدد</th>
                                <th>المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $price_no_shipping = 0;
                            @endphp
                            @foreach ($order->items as $item)
                            @php
                                $price_no_shipping += $item->price * $item->quantity;
                            @endphp

                            <tr class="content">
                                <td>{{  $item->product->name }}</td>
                                <td><img src="{{ Voyager::image(json_decode($item->product->images)[0]) }}" style="max-width: 84px;" alt="product"></td>
                                <td>
                                    اللون: {{ $item->color }} <br>
                                    الحجم: {{ $item->size }}
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price * $item->quantity }} EGP</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                    <table class="showInPrint">
                        <thead>
                            <tr>
                                <th>إسم المنتج</th>
                                <th>النوع</th>
                                <th>السعر</th>
                                <th>العدد</th>
                                <th>المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $price_no_shipping = 0;
                            @endphp
                            @foreach ($order->items as $item)
                            @php
                                $price_no_shipping += $item->price * $item->quantity;
                            @endphp

                            <tr>
                                <td>{{  $item->product->name }}</td>
                                
                                <td>
                                    اللون: {{ $item->color }} <br>
                                    الحجم: {{ $item->size }}
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price * $item->quantity }} EGP</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <hr>
                <div style="max-width: 360px;">
                    <form class="tf-page-cart-checkout widget-wrap-checkout">
                        <div class="d-flex justify-content-between line pb_8">
                            <span class="fw-5">مجموع المنتجات</span>
                            <span class="total fw-5 price_no_shipping" data-price="100">{{ $price_no_shipping }} EGP</span>
                        </div>
                        @php
                                $final_price = $price_no_shipping;
                            @endphp
                        @if ($order->coupon_details != null)
                        @php
                            $discount_price = '';
                            $final_price = '';
                            $coupon_details = json_decode($order->coupon_details);
                            if ($coupon_details->discount_price != null) {
                                $final_price = $price_no_shipping - $coupon_details->discount_price;
                                $discount_price =  $coupon_details->discount_price;
                                $discount_price = $discount_price * -1;
                            }else{
                                if ($coupon_details->discount_percentage != null) {
                                    $final_price = $price_no_shipping - ($price_no_shipping * $coupon_details->discount_percentage / 100);
                                    $discount_price = $coupon_details->discount_percentage . '%';
                                }
                            }
                            
                        @endphp
                        <div class="d-flex justify-content-between line pb_8 ">
                            <span class="fw-5">مجموع الخصومات</span>
                            <span class="total fw-5 discount_price">{{ $discount_price }} EGP</span>
                        </div>
                        <div class="d-flex justify-content-between line pb_8 ">
                            <span class="fw-5">المجموع</span>
                            <span class="total fw-5 discount_price">{{ ($final_price) }} EGP</span>
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-between line pb_8">
                            <span class="fw-5">الشحن</span>
                            <span class="total fw-5 shippingCost" data-price="40">{{ env('SHIPPING_COST') }} EGP</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-5">المجموع</h6>
                            <h6 class="total fw-5 final_price">{{ $final_price + env('SHIPPING_COST') }} EGP</h6>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="footer">
                <ul class="box-contact">
                    <li>Branca-eg.com</li>
                    <li>{{ setting('site.address') }}</li>
                    <li>{{ setting('site.phone') }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
.invoice-table .content td {
    text-align: center;
    padding: 20px 0px 20px 0px;
    font-size: 15px;
    line-height: 28px;
    border-bottom: 1px solid rgb(225, 225, 225);
    text-wrap: balance;
}
.widget-wrap-checkout {
    gap: 8px;
}
.tf-page-cart-checkout {
    padding: 16px;
}
.box-invoice .header {
    padding-bottom: 16px;
}

.showInPrint{
    width: 100%;
    display: none;
}

.showInPrint , .showInPrint th, .showInPrint td {
    text-align: center;
    border: 1px solid #ddd;
    border-collapse: collapse;
    vertical-align: middle;
}


</style>
@endsection

@section('scripts')
<script>
    function printDiv(divId) {
        const divContent = document.getElementById(divId);
        const style = [...document.styleSheets]
            .map(sheet => {
                try {
                    return [...sheet.cssRules].map(rule => rule.cssText).join("\n");
                } catch (e) {
                    console.warn(`Couldn't read CSS rules: ${e}`);
                    return '';
                }
            })
            .join("\n");

            // show in print & hide in not print
            document.querySelector('.showInPrint').style.display = 'inline-table';
            document.querySelector('.hideInPrint').style.display = 'none';

            

        const printWindow = window.open('', '', 'width=800,height=600');
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Preview</title>
                <style>${style}</style>
            </head>
            <body>
                ${divContent.outerHTML}
            </body>
            </html>
        `);

        // انتظار تحميل الصور
        const images = printWindow.document.images;
        const totalImages = images.length;
        let loadedImages = 0;

        function checkImagesLoaded() {
            if (loadedImages === totalImages) {
                printWindow.focus();
                printWindow.print();
                printWindow.close();
                document.querySelector('.showInPrint').style.display = 'none';
                document.querySelector('.hideInPrint').style.display = 'inline-table';
            }
        }

        if (totalImages === 0) {
            checkImagesLoaded(); // إذا لم تكن هناك صور
        } else {
            for (const img of images) {
                img.onload = () => {
                    loadedImages++;
                    checkImagesLoaded();
                };
                img.onerror = () => {
                    loadedImages++;
                    checkImagesLoaded();
                };
            }
        }
    }
</script>
@endsection