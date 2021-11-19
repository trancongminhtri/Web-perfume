<div class="row_g row_g-background row_g-gutters">
    <div class="col_g l-4_g m-4_g c-12_g">
        <div class="perfume-slider gallerys">
            @foreach($mangHinh as $stt => $hinh)
            <div class="perfume-slider__img {{$stt != 0 ? '' : 'active'}}">
                <a href="{{asset($hinh)}}">
                    <img src="{{asset($hinh)}}" alt="" class="">
                </a>
            </div>
            @endforeach
        </div>
        <div class="perfume-slider__navigation">
            @foreach($mangHinh as $stt => $hinh)
            <img src="{{asset($hinh)}}" class="perfume-slider__navigation-btn {{$stt != 0 ? '' : 'active'}}"></img>
            @endforeach
        </div>
    </div>

    <div class="col_g l-8_g m-8_g c-12_g">
        <div class="option-right-perfume">
            <div class="name-perfume">
                <span>{{$nuocHoa['ten_nuoc_hoa']}}</span>
            </div>
            <div class="perfume-info">
                <div class="perfume-info__rating" id="luot-danh-gia">
                    @include('chi-tiet-nuoc-hoa.luot-danh-gia')
                </div>
                
                <div class="perfume-info__price">
                    <span>{!! number_format((float)($giaTien)) !!}đ</span>
                </div>
                <div class="perfume-inf perfume-info__gender">
                    Giới tính <span>: {{$nuocHoa['ten_gioi_tinh']}}</span>
                </div>

                <div class="perfume-inf perfume-info__trademark">
                    Thương hiệu <span>: {{$nuocHoa['ten_thuong_hieu']}}</span>
                </div>

                <div class="perfume-inf perfume-info__flavor">
                    Hương thơm
                    <span>:
                        @foreach($mangHuongThom as $huongThom)
                        {{$huongThom}}@if(!$loop->last),@endif 
                        @endforeach
                    </span>
                </div>

                <div class="perfume-inf perfume-info__concentration">
                    Nồng độ <span>: {{$nuocHoa['ten_nong_do']}}</span>
                </div>

                <div class="perfume-inf perfume-info__release">
                    Năm phát hành <span>: {{ \Carbon\Carbon::parse($nuocHoa->nam_phat_hanh)->format('Y')}}</span>
                </div>

                <div class="perfume-inf perfume-info__capacity">
                    Dung tích <span>: {{$nuocHoa['ten_dung_tich']}}</span>
                </div>

                <div class="perfume-inf perfume-info__perfumer">
                    Nhà pha chế <span>: {{$nuocHoa['nha_pha_che']}}</span>
                </div>

                <div class="perfume-info__btn">
                    <a onclick="addCart('{{$nuocHoa->id}}')" class="btn btn__add-cart"><i class="fas fa-cart-plus icon__add-cart"></i>Thêm vào giỏ hàng</a>
                    @if(!auth()->check())
                    <a class="btn btn-buy" onclick="formLogin()">Mua ngay</a>
                    @else
                    <a onclick="buyNow('{{$nuocHoa->id}}')" class="btn btn-buy">Mua ngay</a>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>