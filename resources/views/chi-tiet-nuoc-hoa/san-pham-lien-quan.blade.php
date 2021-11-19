@if(count($dsThuongHieuSP) != 0)
<div class="home-product detail-product">
    <span class="home-product__title">Cùng thương hiệu</span>
    <!-- PC -->
    <div class="row_g">
        <!-- Product Item -->
        @foreach($dsThuongHieuSP as $thuongHieuSP)
        <div class="col_g l-2-4_g m-4_g c-6_g home-product-items">
            <a href="{{route('khachhang.chi-tiet-nuoc-hoa', [Str::slug($thuongHieuSP['ten_nuoc_hoa'], '-'), $thuongHieuSP['id']])}}" class="home-product-item">
            <span class="home-product-item__span-top"></span>
            <span class="home-product-item__span-right"></span>
            <span class="home-product-item__span-bottom"></span>
            <span class="home-product-item__span-left"></span> 
                <div class="home-product-item__img" style="background-image: url('../{{$thuongHieuSP->duong_dan}}');">
                </div>
                <h4 class="home-product-item__name">{{$thuongHieuSP->ten_nuoc_hoa}}</h4>
                <div class="home-product-item__price">
                    <span class="home-product-item__price-old">{!! number_format((float)($thuongHieuSP['gia_tien'])) !!}đ</span>
                    <span class="home-product-item__price-current">
                        {!! number_format((float)($thuongHieuSP['gia_tien'] - ($thuongHieuSP['gia_tien'] * $thuongHieuSP['gia_khuyen_mai'] / 100))) !!}đ
                    </span>
                </div>

                <div class="home-product-item__action">
                    <div class="home-product-item__action-rating">
                        @for($i=1; $i<=5; $i++) 
                            <i class="fas fa-star {{$i <= $thuongHieuSP['diem_danh_gia_tb'] ?'home-product-item__action-rating-gold' : ''}}"></i>
                        @endfor
                    </div>
                    <span class="home-product-item__brand">{{$thuongHieuSP->ten_thuong_hieu}}</span>

                </div>

                @if(!empty($thuongHieuSP->gia_khuyen_mai))
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">{{$thuongHieuSP->gia_khuyen_mai}}%</span>
                        <span class="home-product-item__sale-off-label">Giảm</span>
                    </div>
                @endif

            </a>
            <div class="home-product-item__btn">
                <button class="home-product-item__btn-add-cart" onclick="addCart('{{$nuocHoa->id}}')">Thêm giỏ hàng</button>
                @if(!auth()->check())
                <button class="home-product-item__btn-buy-now" onclick="formLogin()">Mua ngay</button>
                @else
                <button class="home-product-item__btn-buy-now" onclick="buyNow('{{$nuocHoa->id}}')">Mua ngay</button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif