<h1>NHẬN XÉT VÀ ĐÁNH GIÁ</h1>
<div class="perfume__rating">
    @for($i=1; $i <= 5; $i++) <i style="font-size:32px" class="fas fa-star {{($i <= $diemDanhGiaTB) ? ' perfume__rating-gold' : ''}}">
        </i>
        @endfor
        <div class="perfume__rating-comment">
            <span>{{$diemDanhGiaTB}} / {{$luotDanhGia}} lượt đánh giá</span>
        </div>
</div>
<div class="perfume-rating-comment__question">
    <span>BẠN ĐÃ THỬ SẢN PHẨM NÀY CHƯA?</span>
</div>
@if(!auth()->check())
<div class="perfume-rating-comment__request-login">
    <a onclick="formLogin()" class="btn btn-request-login">VUI LÒNG ĐĂNG NHẬP ĐỂ ĐÁNH GIÁ</a>
</div>
@else
<div class="perfume-rating-comment__btn">
    <a onclick="reviewsForm()" class="btn btn-rating-comment">CHIA SẺ ĐÁNH GIÁ</a>
</div>
@endif
<div class="perfume-reviews">
    <span>TẤT CẢ ĐÁNH GIÁ</span>

    <div class="perfume-reviews__post">
        @foreach ($dsBinhLuan as $binhLuan)
        <div class="perfume-post perfume-post__gutters">
            <div class="perfume-post__info">
                @if($binhLuan->anh_dai_dien == NULL)
                <img src="{{asset('assets/img/avt_none.PNG')}}" alt="" class="perfume-post__avatar">
                @else
                <img src="../{{$binhLuan->anh_dai_dien}}" alt="" class="perfume-post__avatar">
                @endif
                <div class="perfume-post__info-right">
                    <div class="perfume-post__name">{{$binhLuan['ho_ten']}}</div>
                    <div class="perfume-post__rating">
                        @for($i=1; $i <= 5; $i++) <i class="fas fa-star {{($i <= $binhLuan['diem_danh_gia']) ? 'perfume-post__rating-gold' : ''}}"></i>
                            @endfor
                    </div>
                </div>
            </div>
            <div class="perfume-post__content-comment">
                {{$binhLuan['noi_dung_danh_gia']}}
            </div>
        </div>
        @endforeach
    </div>
</div>