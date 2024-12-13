
<div>
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
                                <img src="{{ asset('images/logo/logo.png') }}" style="max-width: 200px; max-height: 90px;" alt="logo" class="logo">
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
                            <div class="d-flex justify-content-between pb_8">
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
                            <div class="d-flex justify-content-between  pb_8 ">
                                <span class="fw-5">مجموع الخصومات</span>
                                <span class="total fw-5 discount_price">{{ $discount_price }} EGP</span>
                            </div>
                            <hr style="color: #000; border-top: 1px solid;">
                            <div class="d-flex justify-content-between  pb_8 ">
                                <span class="fw-5">المجموع</span>
                                <span class="total fw-5 discount_price">{{ ($final_price) }} EGP</span>
                            </div>
                            @endif
                            
                            <div class="d-flex justify-content-between  pb_8">
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
       
       /*! CSS Used from: http://127.0.0.1:7000/css/bootstrap.min.css */
*,::after,::before{box-sizing:border-box;}
hr{margin:1rem 0;color:inherit;border:0;border-top:var(--bs-border-width) solid;opacity:.25;}
h6{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;color:var(--bs-heading-color);}
h6{font-size:1rem;}
p{margin-top:0;margin-bottom:1rem;}
ul{padding-left:2rem;}
ul{margin-top:0;margin-bottom:1rem;}
small{font-size:.875em;}
a{color:rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));text-decoration:underline;}
a:hover{--bs-link-color-rgb:var(--bs-link-hover-color-rgb);}
img{vertical-align:middle;}
table{caption-side:bottom;border-collapse:collapse;}
th{text-align:inherit;text-align:-webkit-match-parent;}
tbody,td,th,thead,tr{border-color:inherit;border-style:solid;border-width:0;}
label{display:inline-block;}
.d-flex{display:flex!important;}
.flex-wrap{flex-wrap:wrap!important;}
.justify-content-between{justify-content:space-between!important;}
.align-items-center{align-items:center!important;}
/*! CSS Used from: http://127.0.0.1:7000/css/styles.css */
div,span,h6,p,a,img,small,ul,li,form,label,table,tbody,thead,tr,th,td,section{margin:0;padding:0;border:0;outline:0;font-size:100%;font:inherit;vertical-align:baseline;font-family:inherit;font-size:100%;font-style:inherit;font-weight:inherit;}
section{display:block;}
*{margin:0;padding:0;box-sizing:border-box;}
img{max-width:100%;height:auto;transform:scale(1);vertical-align:middle;-ms-interpolation-mode:bicubic;}
ul,li{list-style-type:none;margin-bottom:0;padding-left:0;list-style:none;}
h6{font-family:"Albert Sans", sans-serif;text-rendering:optimizeLegibility;color:#333;font-weight:400;}
h6{font-size:20px;line-height:30px;}
.fw-5{font-weight:500!important;}
a{-webkit-transition:all 0.3s ease;-moz-transition:all 0.3s ease;-ms-transition:all 0.3s ease;-o-transition:all 0.3s ease;transition:all 0.3s ease;text-decoration:none;cursor:pointer;display:inline-block;color:#333;}
a:focus,a:hover{-webkit-transition:all 0.3s ease;-moz-transition:all 0.3s ease;-ms-transition:all 0.3s ease;-o-transition:all 0.3s ease;transition:all 0.3s ease;text-decoration:none;outline:0;}
label{font-weight:600;}
.line{border-bottom:1px solid #ebebeb;}
.pb_8{padding-bottom:8px;}
.cus-container2{position:static;max-width:1200px;padding:0px 15px;margin:0 auto;width:100%;}
.tf-btn{-webkit-transition:all 0.3s ease;-moz-transition:all 0.3s ease;-ms-transition:all 0.3s ease;-o-transition:all 0.3s ease;transition:all 0.3s ease;will-change:background-color, color, border;pointer-events:auto;overflow:hidden;font-size:14px;line-height:16px;font-weight:500;box-sizing:border-box;padding:14px 24px;display:inline-flex;border-radius:3px;align-items:center;border:1px solid transparent;background-color:transparent;cursor:pointer;}
.btn-fill{background-color:#333;border:1px solid #333;color:#fff;}
.animate-hover-btn{position:relative;overflow:hidden;}
.animate-hover-btn:after{background-image:linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.25), transparent);content:"";left:150%;position:absolute;top:0;bottom:0;transform:skew(-20deg);width:200%;}
.animate-hover-btn.btn-fill::after{background-image:linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);}
.tf-page-cart-checkout{padding:30px;background-color:var(--bg-11);border-radius:2.5px;}
.widget-wrap-checkout{display:grid;gap:20px;background-color:#fbfbfc;border:10px;}
.invoice-section{padding:120px 0px;width:100%;}
.invoice-section .top{text-align:right;margin-bottom:36px;}
.box-invoice{background:#fff;box-shadow:0px 10px 40px 0px rgba(0, 0, 0, 0.05);border-radius:16px;}
.box-invoice .header{padding:133px 100px 122px;border-bottom:1px solid #ebebeb;}
.box-invoice .wrap-top{display:flex;margin-bottom:56px;align-items:center;gap:15px;}
.box-invoice .box-left{width:60%;}
.box-invoice .wrap-top .box-right{width:40%;}
.box-invoice .wrap-top .title{font-size:28px;line-height:36.46px;color:var(--theme-color-dark);font-weight:700;white-space:nowrap;}
.box-invoice .wrap-date{display:flex;margin-bottom:60px;}
.box-invoice .wrap-date label{font-size:15px;line-height:28px;display:block;}
.box-invoice .wrap-date .date{font-size:15px;line-height:28px;font-weight:500;}
.box-invoice .wrap-info{margin-bottom:40px;display:flex;}
.box-invoice .wrap-info .title{font-size:20px;line-height:26.04px;font-weight:500;margin-bottom:12px;}
.box-invoice .wrap-info .sub{font-size:15px;line-height:28px;font-weight:500;}
.box-invoice .wrap-info .desc{font-size:15px;line-height:28px;margin-bottom:0;font-weight:400;}
.invoice-table{width:100%;}
.invoice-table thead{background-color:#f6f6f6;}
.invoice-table .title th{padding:20px 65px 20px 40px;color:var(--primary);font-weight:500;font-size:17px;line-height:28px;text-wrap:nowrap;}
.invoice-table .title th:first-child{border-radius:8px 0 0 8px;width:40%;}
.invoice-table .title th:last-child{border-radius:0px 8px 8px 0px;}
.invoice-table .content td{padding:20px 65px 20px 40px;font-size:15px;line-height:28px;border-bottom:1px solid rgb(225, 225, 225);text-wrap:nowrap;}
.invoice-table .content:last-child td{border-bottom:none;}
.box-invoice .footer{padding:43px 30px;}
.box-invoice .footer .box-contact{display:flex;justify-content:center;align-items:center;gap:30px;flex-wrap:wrap;}
.box-invoice .footer .box-contact li{font-size:15px;line-height:28px;}
.box-invoice .footer .box-contact li:first-child{color:var(--primary);}
@media (min-width: 1150px){
.animate-hover-btn:hover:after{animation:shine 0.75s cubic-bezier(0.01, 0.56, 1, 1);}
}
@media only screen and (max-width: 991px){
.wrap-table-invoice{overflow:auto;}
.invoice-table .title th{padding:15px 30px;}
.invoice-table .content td{padding:15px 30px;}
.box-invoice .footer{padding:30px;}
.box-invoice .header{padding:30px;}
.box-invoice .wrap-top,.box-invoice .wrap-date,.box-invoice .wrap-info{gap:20px;}
.box-invoice .box-left,.box-invoice .box-right{width:50%;}
}
@media only screen and (max-width: 767px){
h6{font-size:16px;line-height:26px;}
.tf-page-cart-checkout{padding:30px 15px;}
.tf-btn:not(.btn-xl, .btn-md, .btn-line, .style-2, .style-3){padding:10px 24px;}
}
@media only screen and (max-width: 575px){
.box-invoice .wrap-top,.box-invoice .wrap-date,.box-invoice .wrap-info{flex-wrap:wrap;}
.box-invoice .box-left,.box-invoice .box-right{width:100%;}
}
/*! CSS Used from: Embedded */
.invoice-table .content td{text-align:center;padding:20px 0px 20px 0px;font-size:15px;line-height:28px;border-bottom:1px solid rgb(225, 225, 225);text-wrap:balance;}
.widget-wrap-checkout{gap:8px;}
.tf-page-cart-checkout{padding:16px;}
.box-invoice .header{padding-bottom:16px;}
.showInPrint{width:100%;display:none;}
.showInPrint,.showInPrint th,.showInPrint td{text-align:center;border:1px solid #ddd;border-collapse:collapse;vertical-align:middle;}
/*! CSS Used keyframes */
@keyframes shine{100%{left:-200%;}}


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
</div>