<div class="col_g l-2_g m-0_g c-0_g">
    <nav class="category">
        <h3 class="category__heading"> Danh Mục</h3>
        <ul class="category-list">
        <li class="category-item">
            <a href="{{route('khachhang.trang-danh-sach-blog')}}" class="category-item__link">TRANG TĨNH</a>
        </li>
            @foreach($dsDanhMuc as $stt => $danhMuc)
            <li class="category-item {{($select_category == $danhMuc['id']) ? 'category-item--avtive' : ''}}">
                <a href="{{route('khachhang.danh-muc-nuoc-hoa', [Str::slug($danhMuc['ten_danh_muc'], '-'), $danhMuc['id']])}}" class="category-item__link">
                    {{$danhMuc['ten_danh_muc']}}
                </a>
            </li>
            @endforeach

        </ul>

        <h3 class="category__heading category__heading-promotion"> Khuyến Mãi</h3>
        <ul class="category-list category-list-promotion">
            @foreach($dsKhuyenMai as $stt => $khuyenMai)
            <li class="category-item {{($select_promotion == $khuyenMai['id']) ? 'category-item--avtive' : ''}}">
                <a href="{{route('khachhang.khuyen-mai-nuoc-hoa', [Str::slug($khuyenMai['ten_khuyen_mai'], '-'), $khuyenMai['id']])}}" class="category-item__link">
                    {{$khuyenMai['ten_khuyen_mai']}}
                </a>
            </li>
            @endforeach

        </ul>
    </nav>
</div>