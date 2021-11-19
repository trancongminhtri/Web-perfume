<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.header')

    @include('admin.includes.link')

    @yield('title')
</head>

<body>
    <input type="checkbox" name="" id="check">

    <!-- Start header -->
    <header class="header-admin">
        <div class="option-left">
            <img src="{{asset('assets/img/logo2.png')}}" alt="logo">
            <h3>Perfume</h3>
            <div class="icon-slider">
                <label for="check" class="icon-btn">
                    <i class="fas fa-bars" id="slidebar-btn"></i>
                </label>
            </div>
        </div>

        <div class="option-right">
            <div class="header__noti">
                <div class="header__noti-wrap">
                    <i class="far fa-bell icon__notif"></i>
                    <span data-count="0" class="header__noti-notice">0</span>
                    <div class="header__noti-list">
                        <div class="header__noti-heading">Thông báo mới</div>
                        <ul class="header__noti-list-item">
                            @foreach($thongBaoMoi as $thongBao)
                                @php($chi_tiet = json_decode($thongBao['noi_dung'],TRUE))
                                <a href="{{route('quanly.chi-tiet-don-hang' , $chi_tiet['don_hang_id'])}}">
                                    <li class="header__noti-item">
                                        <div class="noti-item__avt">
                                            <img src="{{asset('assets/img/notice_avt.jpg')}}" alt="" class="noti-item__avt-img">
                                        </div>
                                        <div class="noti-item__content">
                                            Bạn có đơn hàng:
                                            <span class="header-noti__code-order">{{$chi_tiet['don_hang_id']}}</span>
                                            mới từ
                                            <span class="header-noti__email-order">{{$chi_tiet['nguoi_dung']}}</span>. <br />
                                            <span class="header-noti__date-order">{{ \Carbon\Carbon::parse($chi_tiet['thoi_gian'])->diffForHumans() }}</span>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="profile-info" style="position: relative;">
                <img alt="avt" class="profile-img" @if(isset(auth()->user()->anh_dai_dien))
                src="../{{auth()->user()->anh_dai_dien}}"
                @else
                src="{{asset('assets/img/avt_none.PNG')}}"
                @endif;
                >
                <h4>{{auth()->user()->ho_ten }}</h4>
                <!-- Logout -->
                <ul class="profile__logout">
                    <li class="profile__logout-item">
                        <a href="{{route('quanly.trang-cap-nhat-thong-tin')}}">
                            <i class="fas fa-cogs profile__logout-icon"></i>Tài khoản
                        </a>
                    </li>
                    <li class="profile__logout-item">
                        <a href="{{route('dang-xuat')}}">
                            <i class="fas fa-sign-out-alt profile__logout-icon"></i>Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <!-- End headebar -->

    <!-- Start mobile nav -->
    <!-- <div class="mobile_nav">
        <div class="nav_bar">
            <img src="{{asset('assets/img/avt2.jpg')}}" alt="bg" class="mobile_profile_img">
            <i class="fas fa-bars nav_btn"></i>
        </div>
        <div class="mobile-nav-items">
            <a href="{{route('quanly.ql-nuoc-hoa')}}"><i class="fas fa-air-freshener"></i><span>Nước hoa</span></a>
            <a href="{{route('quanly.ql-danh-muc')}}"><i class="fas fa-list-ol"></i></i><span>Danh mục</span></a>
            <a href="{{route('quanly.ql-tai-khoan')}}"><i class="fas fa-user-circle"></i></i><span>Tài khoản</span></a>
            <a href="{{route('quanly.ql-ncc')}}"><i class="fab fa-supple"></i><span>Nhà cung cấp</span></a>
            <a href="{{route('quanly.ql-nhan-xet-danh-gia')}}"><i class="far fa-comment-dots"></i><span>Nhận xét đánh giá</span></a>
            <a href="{{route('quanly.ql-khuyen-mai')}}"><i class="fas fa-percent"></i><span>Khuyến mãi</span></a>
            <a href="{{route('quanly.ql-thuong-hieu')}}"><i class="fas fa-trademark"></i><span>Thương hiệu</span></a>
            <a href="{{route('quanly.ql-phieu-nhap')}}"><i class="fas fa-warehouse"></i><span>Nhập kho</span></a>
            <a href="{{route('quanly.ql-huong-thom')}}"><i class="fas fa-air-freshener"></i><span>Hương thơm</span></a>
            <a href="{{route('quanly.ql-slideshow')}}"><i class="fab fa-slideshare"></i><span>SlideShow</span></a>
            <a href="{{route('quanly.ql-don-hang')}}"><i class="fas fa-luggage-cart"></i><span>Đơn hàng</span></a>
            <a href="{{route('quanly.bao-cao-thong-ke')}}"><i class="fas fa-scroll"></i><span>Thống kê</span></a>
            <a href="{{route('quanly.ql-blog')}}"><i class="fas fa-scroll"></i><span>Blog</span></a>
            <a><i class="fas fa-scroll"></i><span></span></a>
        </div>
    </div> -->
    <!-- End mobile nav -->

    <!-- Start Slidebar -->
    <div class="slidebar">
        <a href="{{route('quanly.ql-nuoc-hoa')}}"><i class="fas fa-air-freshener"></i><span>Nước hoa</span></a>
        <a href="{{route('quanly.ql-danh-muc')}}"><i class="fas fa-list-ol"></i></i><span>Danh mục</span></a>
        <a href="{{route('quanly.ql-tai-khoan')}}"><i class="fas fa-user-circle"></i></i><span>Tài khoản</span></a>
        <a href="{{route('quanly.ql-ncc')}}"><i class="fab fa-supple"></i><span>Nhà cung cấp</span></a>
        <a href="{{route('quanly.ql-nhan-xet-danh-gia')}}"><i class="far fa-comment-dots"></i><span>Nhận xét đánh giá</span></a>
        <a href="{{route('quanly.ql-khuyen-mai')}}"><i class="fas fa-percent"></i><span>Khuyến mãi</span></a>
        <a href="{{route('quanly.ql-thuong-hieu')}}"><i class="fas fa-trademark"></i><span>Thương hiệu</span></a>
        <a href="{{route('quanly.ql-phieu-nhap')}}"><i class="fas fa-warehouse"></i><span>Nhập kho</span></a>
        <a href="{{route('quanly.ql-huong-thom')}}"><i class="fas fa-air-freshener"></i><span>Hương thơm</span></a>
        <a href="{{route('quanly.ql-slideshow')}}"><i class="fab fa-slideshare"></i><span>SlideShow</span></a>
        <a href="{{route('quanly.ql-don-hang')}}"><i class="fas fa-luggage-cart"></i><span>Đơn hàng</span></a>
        <a href="{{route('quanly.bao-cao-thong-ke')}}"><i class="fas fa-scroll"></i><span>Thống kê</span></a>
        <a href="{{route('quanly.ql-blog')}}"><i class="fas fa-blog"></i><span>Trang tĩnh</span></a>
        <a><i class="fas fa"></i><span></span></a>
    </div>
    <!-- End Slider -->

    @yield('content')

    <!-- @include('admin.includes.footer') -->

    @include('admin.includes.js')

    @yield('page-js')

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('65f6e3a28f32013e66c3', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        var notificationsCount = $('.header__noti-notice').data('count');

        channel.bind('form-submitted', function(data) {
            $('.header__noti-list-item').prepend(`
                <a href="/./chi-tiet-don-hang/` + data['data']['don_hang_id'] + `">
                    <li class="header__noti-item">
                            <div class="noti-item__avt">
                                <img src="{{asset('assets/img/notice_avt.jpg')}}" alt="" class="noti-item__avt-img">
                            </div>
                            <div class="noti-item__content">
                                Bạn có đơn hàng:
                                <span class="header-noti__code-order">` + data['data']['don_hang_id'] + `</span>
                                mới từ
                                <span class="header-noti__email-order">` + data['data']['nguoi_dung'] + `</span>. <br />
                                <span class="header-noti__date-order"> a few seconds ago </span>
                            </div>
                    </li>
                </a>
            `);

            notificationsCount += 1;
            $('.header__noti-notice').attr('data-count', notificationsCount);
            $('.header__noti-notice').text(notificationsCount);
        });
    </script>
    
</body>

</html>