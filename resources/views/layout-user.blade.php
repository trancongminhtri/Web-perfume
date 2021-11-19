<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.header')

    @include('includes.link')

    @yield('title')
</head>

<body>
    <!-- Socials Button -->
    <div class="socials-btn">
        <ul class="socials-btn__list">
            <li class="socials-btn__item socials-btn__item-facebook">
                <a href="https://www.facebook.com/profile.php?id=100008342193616" target="_blank" class="socials-btn__link">
                    facebook<i class="fab fa-facebook icon-facebook"></i>
                </a>
            </li>

            <li class="socials-btn__item socials-btn__item-messenger">
                <a href="https://www.facebook.com/messages/t/100008342193616" target="_blank" class="socials-btn__link">
                    messenger<i class="fab fa-facebook-messenger icon-messenger"></i>
                </a>
            </li>

            <li class="socials-btn__item socials-btn__item-instagram">
                <a href="https://www.instagram.com/gears42.th/" target="_blank" class="socials-btn__link">
                    instagram<i class="fab fa-instagram icon-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- Back to top -->
    <div id="btn__back-to-top" onclick="topFunction()" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>
    
    <div class=" wapper">
        <!-- Start Header -->
        <header class="header">
            <div class="grid_g wide_g">
                <nav class="header__navbar hide-on-mobile-tablet">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate">
                            <a class="header__navbar-item__number-phone" href="tel:+9491 6494 960">Tel: <span> 0916494960</span></a>
                        </li>
                        <li class="header__navbar-item">
                            <span class="header_navbar--title-no-pointer">Kết nối</span>
                            <a href="https://www.facebook.com/messages/t/100008342193616" target="_blank" class="header__navbar-icon-link"><i class="header__navbar-icon fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/gears42.th/" target="_blank" class="header__navbar-icon-link"><i class="header__navbar-icon fab fa-instagram"></i></a>
                        </li>
                    </ul>
                    <ul class="header__navbar-list">

                        <?php if (!auth()->check()) { ?>
                            <li class="header__navbar-item header__navbar-item-strong header__navbar-item--separate" id="btn__register" onclick="formRegister()">Đăng Ký</li>
                            <li class="header__navbar-item header__navbar-item-strong" id="btn__login" onclick="formLogin()">Đăng Nhập</li>
                        <?php } else { ?>

                            <li class="header__navbar-item header__navbar-user" style="position:relative;">
                                @if(auth()->user()->anh_dai_dien == NULL)
                                <img alt="" class="header__navbar-item-img" src="{{asset('assets/img/avt_none.png')}}" alt="">
                                @else
                                <img alt="" class="header__navbar-item-img" src="../{{auth()->user()->anh_dai_dien}}" alt="">
                                @endif
                                <span class="header__navbar-item-name">{{auth()->user()->ho_ten}}</span>
                                <!-- Menu  -->
                                <ul class="header_navbar-user-menu">
                                    <li class="header__navbar-user-item"><a href="{{route('thong-tin-ho-so')}}">Tài khoản của tôi</a> </li>
                                    <li class="header__navbar-user-item header__navbar-user-item--separate"><a href="{{route('dang-xuat')}}">Đăng xuất</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                </nav>

                <!-- Header with search -->
                <form action="{{route('nguoidung.trang-chu-nguoi-dung')}}" method="GET">
                    <div class="header-with-search">
                        <label for="mobile__search-checkbox" class="header__mobile-search">
                            <i class="header__mobile-search-icon fas fa-search"></i>
                        </label>

                        <div class="header__logo">
                            <a href="/" class="header__logo-link">
                                <img src="{{asset('assets/img/logo2.png')}}" alt="" class="header_logo-img">
                            </a>
                        </div>

                        <input type="checkbox" hidden name="" id="mobile__search-checkbox">
                        <div class="header__search ">
                            <div class="header__search-input-wrap">
                                <input type="text" name="ten_nuoc_hoa" class="header__search-input typeahead" placeholder="Nhập để tìm kiếm sản phẩm" autoComplete="off" />
                            </div>

                            <button class="header__search-btn">
                                <i class="header__search-btn-icon fas fa-search"></i>
                            </button>
                        </div>
                        <!-- Cart   -->
                        <div class="header__cart">
                            <div class="header__cart-wrap" id="change-item-cart">
                                @include('gio-hang')
                            </div>
                        </div>
                        <!-- Icon navbar -->
                        <div class="menu-tablet-mobile">
                            <i class="fas fa-bars"></i>
                        </div>
                    </div>
                </form>
            </div>

        </header>
        <!-- End Header -->

        <!-- Menu Moible - Tablet -->
        <div class="menu-mt-nav hide-on-pc">
            <div class="nav-half ">
                <div class="nav__list">
                    <div class="nav__item">
                        <i class="fas fa-times nav-close"></i>
                    </div>
                    <?php if (!auth()->check()) { ?>
                        <div class="nav__item" onclick="formLogin()"><a class="nav__item__link"><i class="fas fa-sign-in-alt"></i>Đăng nhập</a></div>
                        <div class="nav__item" onclick="formRegister()"><a class="nav__item__link"><i class="fas fa-user-plus"></i>Đăng ký</a></div>
                    <?php } else { ?>
                        <div class="nav__item">
                            <div class="nav-profile">
                                @if(auth()->user()->anh_dai_dien == NULL)
                                <img alt="" class="nav-profile__img" src="{{asset('assets/img/avt_none.png')}}">
                                @else
                                <img alt="" class="nav-profile__img" src="../{{auth()->user()->anh_dai_dien}}">
                                @endif
                                <div class="nav-profile__name"><a href="{{route('thong-tin-ho-so')}}">{{auth()->user()->ho_ten}}</a></div>
                            </div>
                        </div>
                        <div class="nav__item">
                            <a class="nav__item__link" href="{{route('dang-xuat')}}">
                                <i class="fas fa-sign-out-alt"></i>Đăng xuất
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <!-- <div class="home-filter">
                    @yield('perfume-filter')
                </div> -->

            </div>
        </div>

        <!-- Start Container -->
        @yield('content')
        <!-- End Container -->

        <!-- Start Footer -->
        @include('includes.footer')
        <!-- End Footer -->
    </div>

    <!-- Modal Layout Login -->
    <div class="modal" id="modal">
        <!-- .modal để chiếm hết màn hình -->
        <div class="modal__overlay" id="modal__overlay">
            <!-- modal__overlay tạo lớp phủ mờ  -->
        </div>
        <div class="modal__body">
            <!-- modal__body để canh chỉnh kích thước, vị trí khung chứa content  -->
            @include('dang-ky')

            <!-- Login form -->
            @include('dang-nhap')

            <!-- Forgot password -->
            @include('quen-mat-khau')

            <!-- OTP -->
            @include('otp')

        </div>
    </div>

    @include('includes.js')

    @yield('page-js')
</body>

</html>