@extends('layout-user')
@section('title')
@endsection
@section('perfume-filter')
@include('trang-chu.loc-nuoc-hoa')
@endsection
@section('content')
<!-- Start Container -->
<div class="app__category">
    <div class="grid_g wide_g">
        <div class="row_g sm-gutters app__content">
            <!-- Danh mục -->
            @include('trang-chu.danh-muc')

            <div class="col_g l-10_g m-12_g c-12_g">
                <nav class="mobile-category__nav">
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
                <form action="{{route('khachhang.danh-muc-nuoc-hoa', [Str::slug($timDanhMuc['ten_danh_muc'], '-'), $timDanhMuc['id']])}}" id="loc-nuoc-hoa" method="GET">
                    <div class="home-filter hide-on-mobile-tablet">
                        @yield('perfume-filter')
                    </div>
                </form>

                <div class="home-product">
                    <div class="row_g sm-gutters" id="them-nuoc-hoa">
                        <!-- <div > -->
                        <!-- Sản Phẩm -->
                        @include('danh-muc-nuoc-hoa.nuoc-hoa')
                        <!-- </div> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<!-- Xem thêm sản phẩm -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#xem-them-nuoc-hoa', function(event) {
            event.preventDefault();
            var url = $(this).data('id-danh-muc');
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
                    $('#them-nuoc-hoa').append(data);
                    vanillaTilt();
                }
            });
        });
    });
</script>

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
                $('#them-nuoc-hoa').empty();
                $('#them-nuoc-hoa').html(data);
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
            $('#nput-price-min').val(0);
            $('#nput-price-max').val(ui.value * 100000);
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
            console.log($('#input-price-min').val(), $('#input-price-max').val())
        });

    });
</script>
@endsection