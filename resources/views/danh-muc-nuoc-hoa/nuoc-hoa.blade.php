@if(count($dsNuocHoa) != 0)
<!-- Product Item -->
@foreach($dsNuocHoa as $nuocHoa)
<div class="col_g l-2-4_g m-4_g c-6_g home-product-items" >
    <a href="{{route('khachhang.chi-tiet-nuoc-hoa', [Str::slug($nuocHoa['ten_nuoc_hoa'], '-'), $nuocHoa['id']])}}" class="home-product-item" >
        <span class="home-product-item__span-top"></span>
        <span class="home-product-item__span-right"></span>
        <span class="home-product-item__span-bottom"></span>
        <span class="home-product-item__span-left"></span> 
        <div class="home-product-item__img" style="background-image: url('../{{$nuocHoa->duong_dan}}');">
        </div>
        <h4 class="home-product-item__name">{{$nuocHoa['ten_nuoc_hoa']}}</h4>
        <div class="home-product-item__price">
            <span class="home-product-item__price-old">{!! number_format((float)($nuocHoa['gia_tien'])) !!}đ</span>
            <span class="home-product-item__price-current">
                {!! number_format((float)($nuocHoa['gia_tien'] - ($nuocHoa['gia_tien'] * $nuocHoa['gia_khuyen_mai'] / 100))) !!}đ</span>
        </div>
        <div class="home-product-item__action">           
            <div class="home-product-item__action-rating">
                @for($i=1; $i<=5; $i++) 
                    <i class="fas fa-star {{$i <= $nuocHoa['diem_danh_gia_tb'] ?'home-product-item__action-rating-gold' : ''}}"></i>
                @endfor
            </div>
            <span class="home-product-item__brand">{{$nuocHoa['ten_thuong_hieu']}}</span>
        </div>

        @if(!empty($nuocHoa['gia_khuyen_mai']))
        <div class="home-product-item__sale-off">
            <span class="home-product-item__sale-off-percent">{{$nuocHoa['gia_khuyen_mai']}}%</span>
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
@php($lastId = $nuocHoa->id)
@endforeach
<div class="home-load-more" style="width: 100%">
    <a data-id-danh-muc="{{route('khachhang.xem-them-nuoc-hoa', $timDanhMuc['id'])}}" data-last-id="{{$lastId}}" class="category-load-more__btn btn btn--primary" id="xem-them-nuoc-hoa">
        <span>Xem thêm</span>
        <span>Xem thêm</span>
    </a>
</div>
@else
<div class="col_g l-12_g m-12_g c-12_g">
    <div class="home-no-product">
        <img src="{{asset('assets/img/category_no_product.jpg')}}" alt="">
    </div>
</div>
@endif