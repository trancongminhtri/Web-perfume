<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/parsleyjs/js/parsley.min.js')}}"></script>
<script src="{{asset('assets/sweetarlet2/node_modules/sweetalert2/dist/sweetalert2.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/alertifyjs/alertify.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/bootstrap3-typeahead.min.js_4.0.2/cdnjs/bootstrap3-typeahead.min.js')}}"></script>
<script src="{{asset('assets/owlCarousel2-2.3.4/dist/owl.carousel.min.js')}}"></script>
<!-- BOOTSTRAP -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Vanilla titl js -->
<script type="text/javascript" src="{{asset('assets/js/vanilla-titl-js/vanilla-tilt.min.js')}}"></script>



<!-- Đăng ký tài khoản -->
<script>
    $('#dang-ky').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    showLoadingBtnRegister();
                },
                success: function(data) {
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.status == 'success') {
                        backFormRegister();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            button: 'OK!'
                        })
                    }
                    hideLoadingBtnRegister();
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#dang-ky').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Đăng nhập tài khoản -->
<script>
    $('#dang-nhap').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.status == 'success_user') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                    if (data.status == 'success_admin') {
                        window.setTimeout(function() {
                            window.location.replace("{{route('quanly.ql-tai-khoan')}}");
                        });
                    }
                }
            });
        }
    });
</script>

<!-- Quên mật khẩu -->
<script>
    $('#quen-mat-khau').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    showLoadingBtnEmail();
                },
                success: function(data) {
                    hideLoadingBtnEmail();
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.status == 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        formOTP();
                    }
                }
            });
        }
    });
</script>

<!-- Biểu mẫu OTP -->
<script>
    $('#form-otp').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    showLoadingBtnOtp();
                },
                success: function(data) {
                    hideLoadingBtnOtp();
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.status == 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        formLogin();
                    }
                }
            });
        }
    });
</script>

<!-- Thêm sản phẩm vào giỏ hàng -->
<script>
    function addCart(id) {
        $.ajax({
            url: '/./Add-Cart/' + id,
            type: 'GET',
        }).done(function(res) {
            RenderCart(res);
            alertify.notify('Đã Thêm Sản Phẩm Thành Công!', 'success');
        });
    }
</script>

<!-- Xóa sản phẩm khỏi giỏ hàng -->
<script>
    $('#change-item-cart').on('click', '.header__cart-item-remove', function() {
        $.ajax({
            url: '/./Delete-Item-Cart/' + $(this).data('id-cart'),
            type: 'GET',
        }).done(function(res) {
            RenderCart(res);
            tangSanPham();
            giamSanPham();
            alertify.notify('Đã Xóa Sản Phẩm Thành Công!', 'success');
        });
    });
</script>

<script>
    function RenderCart(res) {
        $('#change-item-cart').empty();
        $('#change-item-cart').html(res['gio-hang']);
        $('#header__cart-notice').text($('#total-quanty-cart').val());
        $('#delete-list-cart').empty();
        $('#delete-list-cart').html(res['danh-sach-gio-hang']);
    }
</script>

<!-- Mua sản phẩm ngay -->
<script>
    function buyNow(id) {
        $.ajax({
            url: '/./Add-Cart/' + id,
            type: 'GET',
        }).done(function(res) {
            window.setTimeout(function() {
                window.location.replace("{{route('trang-thanh-toan')}}");
            });
        });
    }
</script>

<!-- csrf-token" -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- navbar tablet and mobile -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.menu-tablet-mobile').click(function() {
            $('.menu-mt-nav').toggleClass('show');
        });

        $('.nav-close').click(function() {
            $('.menu-mt-nav').toggleClass('show');
        });

        //   $('.menu-mt-nav').click(function() {
        //     $('.menu-mt-nav').toggleClass('show');
        //   });

    });
</script>

<!-- Back top top -->
<script type="text/javascript">
    var btnScrollTop = document.getElementById('btn__back-to-top');
    window.onscroll = function() {
        function scrollFunc() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                btnScrollTop.style.display = "flex";
            } else {
                btnScrollTop.style.display = "none";
            }
        }
        scrollFunc();
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<!-- Tìm kiếm nhanh typeahead-js -->
<script>
    var path = "{{ route('khachhang.tim-kiem-nuoc-hoa') }}";
    $('input.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        },
        highlighter: function(item, data) {
            var parts = item.split('#'),
                html = `<div class="row" style="padding:2px 0px;"><div class="col-md-1" style="padding-right:8px;"><img src="../${data.img}"/ height=44px;" width="60px;"></div><div class="col-md-10 pl-0"><span style="font-size: 1.4rem;">${data.name}</span></div></div>`;
            return html;
        }
    });
</script>

<!-- Set value null after submit -->
<script>
    function setNullValueInput() {
        $('input[type="text"]').val('');
        $('input[type="number"]').val('');
        $('input[type="email"]').val('');
        $('input[type="password"]').val('');
        // $('input[type="date"]').val('');
    }

    function setNullInputPassword() {
        $('input[type="password"]').val('');
    }
</script>

<!-- Vanilla titl 3D Custom -->
<script type="text/javascript">
    function vanillaTilt() {
        let itemProduct = document.querySelectorAll(".home-product-item");
        VanillaTilt.init(itemProduct, {
            max: 25,
            speed: 400,
        });
    }
    vanillaTilt();
</script>

<!-- Ẩn hiện loader khi submit -->
<script>
    // Hiện loader
    function loaderBtnShow() {
        $('.loader').delay(300).css("display", "flex");
    }

    // Ẩn loader
    function loaderBtnHide() {
        $('.loader').fadeOut('slow');
    }
</script>

<!-- Show hide password -->
<script>
    // Login show hide password
    function isShowHidePasswordLogin() {
        let inputPassword = document.getElementById('input-pass');
        let btnShow = document.getElementById('eye-pass');
        let btnHide = document.getElementById('eye-slash-pass');
        if (inputPassword.type === 'password') {
            inputPassword.type = 'text';
            btnHide.style.display = 'block'
            btnShow.style.display = 'none';
        } else {
            inputPassword.type = 'password';
            btnHide.style.display = 'none'
            btnShow.style.display = 'block';
        }
    }

    // Register show hide password
    function isShowHidePasswordRegister() {
        let inputPassword = document.getElementById('input__pass-register');
        let btnShow = document.getElementById('eye__pass-register');
        let btnHide = document.getElementById('eye-slash__pass-register');
        if (inputPassword.type === 'password') {
            inputPassword.type = 'text';
            btnHide.style.display = 'block'
            btnShow.style.display = 'none';
        } else {
            inputPassword.type = 'password';
            btnHide.style.display = 'none'
            btnShow.style.display = 'block';
        }
    }

    function isShowHidePasswordRegister2() {
        let inputPassword = document.getElementById('mat_khau');
        let btnShow = document.getElementById('eye__pass-register2');
        let btnHide = document.getElementById('eye-slash__pass-register2');
        if (inputPassword.type === 'password') {
            inputPassword.type = 'text';
            btnHide.style.display = 'block'
            btnShow.style.display = 'none';
        } else {
            inputPassword.type = 'password';
            btnHide.style.display = 'none'
            btnShow.style.display = 'block';
        }
    }
</script>

<!-- Loading đăng ký -->
<script>
    function showLoadingBtnRegister() {
        $('.btn__register').addClass('btn__register-loading');
        $('.btn__register').attr('disabled', true);
        $('.btn__register').css('opacity', '0.5');
    }

    function hideLoadingBtnRegister() {
        $('.btn__register').removeClass('btn__register-loading');
        $('.btn__register').delay(800).attr('disabled', false);
        $('.btn__register').delay(800).css('opacity', '1');
    }
</script>

<!-- Loading nhập email -->
<script>
    function showLoadingBtnEmail() {
        $('.btn__email').addClass('btn__email-loading');
        $('.btn__email').attr('disabled', true);
        $('.btn__email').css('opacity', '0.5');
    }

    function hideLoadingBtnEmail() {
        $('.btn__email').removeClass('btn__email-loading');
        $('.btn__email').delay(800).attr('disabled', false);
        $('.btn__email').delay(800).css('opacity', '1');
    }
</script>

<!-- Loading nhập otp -->
<script>
    function showLoadingBtnOtp() {
        $('.btn__otp').addClass('btn__otp-loading');
        $('.btn__otp').attr('disabled', true);
        $('.btn__otp').css('opacity', '0.5');
    }

    function hideLoadingBtnOtp() {
        $('.btn__otp').removeClass('btn__otp-loading');
        $('.btn__otp').delay(800).attr('disabled', false);
        $('.btn__otp').delay(800).css('opacity', '1');
    }
</script>

<!-- Owl Carousel Custom Danh Mục-->
<script>
    $(document).ready(function() {
        $(".mobile-category__list").owlCarousel({
            loop: true,
            autoWidth: true,
        });
    });
</script>