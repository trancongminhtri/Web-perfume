@extends('layout-user')
@section('title')
@endsection
@section('perfume-filter')
@include('trang-chu.loc-nuoc-hoa')
@endsection
@section('content')
<div class="loading">
    <div class=""></div>
    <div class=""></div>
    <div class=""></div>
</div>

<!-- Start Slider -->
<div class="app__slideshow">
    <div class="grid_g wide_g">
        <!-- Thông báo kích hoạt tài khoản thành công hoặc thất bại trong đăng ký tài khoản -->
        @if(Session::has('error_activate'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span style="font-size: 1.5rem;">{{Session::get('error_activate')}}</span>
        </div>
        @endif
        @if(Session::has('success_activate'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span style="font-size: 1.5rem;">{{Session::get('success_activate')}}</span>
        </div>
        @endif
        <!-- SlideShow -->
        @include('trang-chu.slideshow')
    </div>
</div>

<!-- End Slider -->
<div class="app__container">
    <div class="grid_g wide_g">
        <div class="row_g sm-gutters app__content">
            <!-- Danh mục -->
            @include('trang-chu.danh-muc')

            <div class="col_g l-10_g m-12_g c-12_g">
                <nav class="mobile-category__nav ">
                    <ul class="mobile-category__list owl-carousel owl-theme">
                        <li class="mobile-category__item">
                            <a href="{{route('khachhang.trang-danh-sach-blog')}}" class="mobile-category__link">TRANG TĨNH</a>
                        </li>
                        @foreach($dsDanhMuc as $stt => $danhMuc)
                        <li class="mobile-category__item">
                            <a href="{{route('khachhang.danh-muc-nuoc-hoa', [Str::slug($danhMuc['ten_danh_muc'], '-'), $danhMuc['id']])}}" class="mobile-category__link">{{$danhMuc['ten_danh_muc']}}</a>
                        </li>
                        @endforeach
                        @foreach($dsKhuyenMai as $stt => $khuyenMai)
                        <li class="mobile-category__item">
                            <a href="{{route('khachhang.khuyen-mai-nuoc-hoa', [Str::slug($khuyenMai['ten_khuyen_mai'], '-'), $khuyenMai['id']])}}" class="mobile-category__link">{{$khuyenMai['ten_khuyen_mai']}}</a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
                <!-- Home filter -->
                <form action="{{route('nguoidung.trang-chu-nguoi-dung')}}" id="loc-nuoc-hoa" method="GET">
                    <div class="home-filter">
                        @yield('perfume-filter')
                    </div>
                </form>

                <!-- Sản Phẩm -->
                <div class="home-product">
                    <div class="row_g sm-gutters" id="filter-perfume">
                        @include('trang-chu.nuoc-hoa')
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<!-- slider -->
<script>
    //start slider
    const slider = document.querySelector('.slider');
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');
    const sliderImg = document.querySelectorAll(".slider__img");
    const btnNavSlider = document.querySelectorAll(".slider__navigation-btn");
    const numberOfSlides = sliderImg.length;
    let curentSlide = 0;

    // next btn
    nextBtn.addEventListener("click", () => {
        sliderImg.forEach((slide) => {
            slide.classList.remove("active");
        });
        btnNavSlider.forEach((slideIcon) => {
            slideIcon.classList.remove("active");
        });

        curentSlide++;
        if (curentSlide > numberOfSlides - 1) {
            curentSlide = 0;
        }
        sliderImg[curentSlide].classList.add("active");
        btnNavSlider[curentSlide].classList.add("active");
    });

    // prev btn
    prevBtn.addEventListener("click", () => {
        sliderImg.forEach((slide) => {
            slide.classList.remove("active");
        });
        btnNavSlider.forEach((slideIcon) => {
            slideIcon.classList.remove("active");
        });

        curentSlide--;
        if (curentSlide < 0) {
            curentSlide = numberOfSlides - 1;
        }
        sliderImg[curentSlide].classList.add("active");
        btnNavSlider[curentSlide].classList.add("active");
    });

    // Manual Navigation
    var manualNav = function(manual) {
        sliderImg.forEach((slide) => {
            slide.classList.remove("active");

            btnNavSlider.forEach((btn) => {
                btn.classList.remove("active");
            });
        });

        sliderImg[manual].classList.add("active");
        btnNavSlider[manual].classList.add("active");
    }

    btnNavSlider.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            manualNav(i);
            curentSlide = i;
        });
    });

    // Auto Navigation 
    var autoSlider;

    var repeater = () => {
        autoSlider = setInterval(() => {
            sliderImg.forEach((slide) => {
                slide.classList.remove("active");
            });
            btnNavSlider.forEach((slideIcon) => {
                slideIcon.classList.remove("active");
            });

            curentSlide++;
            if (curentSlide > numberOfSlides - 1) {
                curentSlide = 0;
            }
            sliderImg[curentSlide].classList.add("active");
            btnNavSlider[curentSlide].classList.add("active");
        }, 5000);
    }
    repeater();

    // stop the autoplay on mouse 
    slider.addEventListener('mouseover', () => {
        clearInterval(autoSlider);
    });

    // continue the autoplay on mouseover
    slider.addEventListener('mouseout', () => {
        repeater();
    });
    //end slider
</script>

<!-- Filter -->
<script>
    $('#loc-nuoc-hoa').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: 'GET',
            url: url,
            data: form.serialize(),
            success: function(data) {
                $('#filter-perfume').empty();
                $('#filter-perfume').html(data);
            }
        });
    });
</script>

<!-- Slider range price -->
<script>
    $('#range-list-price').slider({
        range: 'min',
        min: 0,
        max: 100,
        value: 0,
        slide: function(e, ui) {
            $('#price_max').val(ui.value * 100000);
            $('#input-price-chose').val(ui.value * 100000);
            $('#input-price-min').val(0);
            $('#input-price-max').val(ui.value * 100000);
        }

    });
    $('#price_max').val($('#range-list-price').slider('value'));

    $('.form-price').each(function() {

        var dropdown = $(this).find('.custom-price');

        $(this).on('click', function() {
            dropdown.stop().slideToggle();
        });

        dropdown.on('click', '.custom-list-range ul li', function() {
            $('#input-price-chose').val($(this).text());
            $('#input-price-min').val($(this).data("price-min"));
            $('#input-price-max').val($(this).data("price-max"));
            // console.log($('#input-price-min').val(), $('#input-price-max').val())
        });

    });
</script>

<!-- Xem thêm sản phẩm -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#xem-them-nuoc-hoa', function(event) {
            event.preventDefault();
            var url = $(this).data('duong-dan-them');
            var last_id = $(this).data('last-id');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    last_id: last_id,
                    gioi_tinh_id: $('#gioi_tinh_id').val(),
                    thuong_hieu_id: $('#thuong_hieu_id').val(),
                    dung_tich_id: $('#dung_tich_id').val(),
                    gia_tien_lon: $('#input-price-max').val(),
                    gia_tien_nho: $('#input-price-min').val()
                },
                success: function(data) {
                    $('#xem-them-nuoc-hoa').parent().remove();
                    $('#filter-perfume').append(data);
                    vanillaTilt();
                }
            });
        });
    });
</script>

<!-- Loading-->
<script type="text/javascript">
    window.addEventListener("load", function() {
        $('.loading').fadeOut('linear');
    });
</script>
@endsection