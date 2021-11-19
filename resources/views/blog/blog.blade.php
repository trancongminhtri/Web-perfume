@if(count($dsBlog) != 0)
@foreach($dsBlog as $blog)
<div class="col_g l-6_g m-6_g c-12_g">
    <a class="product__item" href="{{route('khachhang.trang-chi-tiet-blog', [Str::slug($blog['tieu_de'], '-'), $blog['id']])}}">
        <div class="product__img-blog product__img-new" style="background-image: url('../{{$blog->duong_dan}}')"></div>
        <div class="product__body product__body-new">
            <h3 class="product__title" style="word-break: break-word">
                {{$blog['tieu_de']}}
            </h3>
            <p class="product__info" style="word-break: break-word;">
                {{$blog['mo_ta_noi_dung']}}
            </p>
        </div>
    </a>
</div>
@php($lastId = $blog->id)
@endforeach
<div class="col_g l-12_g m-12_g c-12_g">
    <div class="product__see-more">
        <a data-id-blog="{{route('khachhang.xem-them-blog')}}" data-id-last="{{$lastId}}" id="xem_them_blog" class="category-load-more__btn" style="cursor:pointer">
            <span>Xem thêm</span>
            <span>Xem thêm</span>
    </a>
    </div>
</div>
@else
<div class="col_g l-12_g m-12_g c-12_g">
    <div class="home-no-product">
        <img src="{{asset('assets/img/no_blog.png')}}" alt="">
    </div>
</div>
@endif