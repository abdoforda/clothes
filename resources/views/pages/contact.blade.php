@extends('layouts.app')


@section('content')
    <!-- page-title -->
    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center">التواصل معنا</div>
        </div>
    </div>
    <!-- /page-title -->
    <!-- map -->
    <section class="flat-spacing-9">
        <div class="container">
            <div class="tf-grid-layout gap-0 lg-col-2">
                <div class="w-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d317859.6089702069!2d-0.075949!3d51.508112!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760349331f38dd%3A0xa8bf49dde1d56467!2sTower%20of%20London!5e0!3m2!1sen!2sus!4v1719221598456!5m2!1sen!2sus" width="100%" height="894" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="tf-content-left has-mt">
                    <div class="sticky-top">
                        <h5 class="mb_20">تفضل بزيارة متجرنا</h5>
                        <div class="mb_20">
                            <p class="mb_15"><strong>البريد الإلكتروني</strong></p>
                            <p>
                                <a href="mailto:brancaeg111@gmail.com">brancaeg111@gmail.com</a>
                            </p>
                        </div>
                        <div class="mb_36">
                            <p class="mb_15"><strong>أوقات العمل</strong></p>
                            <p class="mb_15"></p>
                            <p>يتم قبول الطلبات من 8 صباحاً حتى 10 مساءً</p>
                        </div>
                        <div>
                            <ul class="tf-social-icon d-flex gap-20 style-default">
                                <li><a href="#" class="box-icon link round social-facebook border-line-black"><i class="icon fs-14 icon-fb"></i></a></li>
                                <li><a href="#" class="box-icon link round social-twiter border-line-black"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                                <li><a href="#" class="box-icon link round social-instagram border-line-black"><i class="icon fs-14 icon-instagram"></i></a></li>
                                <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i class="icon fs-14 icon-tiktok"></i></a></li>
                                <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /map -->
    <!-- form -->
    <section class="bg_grey-7 flat-spacing-9 border-bottom">
        <div class="container ">
            <div class="flat-title">
                <span class="title">تواصل معنا</span>
                <p class="sub-title text_black-2">
                    تواصل معنا يمكنك كتابة رسالتك هنا وسيتم التواصل معكم في أسرع وقت ممكن
                </p>
            </div>
            <div>
                <form class="mw-705 mx-auto text-center form-contact" id="contactform"  action="{{ route('contact') }}">
                    <div class="d-flex gap-15 mb_15">
                        <fieldset class="w-100">
                            <input type="text" name="name" id="name" required placeholder="الإسم *"/>
                        </fieldset>
                        <fieldset class="w-100">
                            <input type="email" name="email" id="email" required placeholder="البريد الإلكتروني او الموبيل *"/>
                        </fieldset>
                    </div>
                    <div class="mb_15">
                        <textarea placeholder="الرسالة" name="message" id="message" required cols="30" rows="10"></textarea>
                    </div>
                    <div class="send-wrap">
                        <button type="button" id="contact" class="tf-btn radius-3 btn-fill animate-hover-btn justify-content-center">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /form -->
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $("#contact").click(function(){
                $(".text-danger").remove();
                var form = $("#contactform");
                $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: { _token : '{{ csrf_token() }}',
                            name : $("#name").val(),
                            email : $("#email").val(),
                            message : $("#message").val(),
                        },
                        success: function(data) {
                            $("#contactform").hide().html(`<div class="info_black">تم الارسال بنجاح</div>`).fadeIn();
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
            });
        });
    </script>
@endsection