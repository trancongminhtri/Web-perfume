<div class="row_g sm-gutters">
    <div class="slider">
        @foreach($dsSlideShow as $stt => $slideShow)
        <div class="slider__img {{$stt != 0 ? '' : 'active'}}">
            <img src="{{asset($slideShow['duong_dan'])}}" alt="">
        </div>
        @endforeach
        <div class="navigation">
            <i class="fas fa-chevron-left prev-btn"></i>
            <i class="fas fa-chevron-right next-btn"></i>
        </div>
        <div class="slider__navigation">
            @foreach($dsSlideShow as $stt => $slideShow)
            <div class="slider__navigation-btn {{$stt != 0 ? '' : 'active'}}"></div>
            @endforeach
        </div>
    </div>
</div>