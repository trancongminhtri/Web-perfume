@for($i=1; $i <= 5; $i++) 
    <i style="font-size:14px" class="fas fa-star {{($i <= $diemDanhGiaTB) ? '   perfume-info__rating-gold' : ''}}"></i>
@endfor
    <div class="perfume-info__rating-comment">
        <span>{{$diemDanhGiaTB}} / {{$luotDanhGia}} lượt đánh giá</span>
    </div>