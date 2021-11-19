<div class="home-filter-up">
    <select class="home-filter__btn home-filter__btn-render btn" id="gioi_tinh_id" name="gioi_tinh_id" value="{{isset($inputSearch['gioi_tinh_id']) ? $inputSearch['gioi_tinh_id'] : null}}">
        <option value="">Giới tính</option>
        @foreach($dsGioiTinh as $gioiTinh)
        <option value="{{$gioiTinh['id']}}">{{$gioiTinh['ten_gioi_tinh']}}</option>
        @endforeach
    </select>
    <select class="home-filter__btn home-filter__btn-trademark btn" id="thuong_hieu_id" name="thuong_hieu_id" value="{{isset($inputSearch['thuong_hieu_id']) ? $inputSearch['thuong_hieu_id'] : null}}">
        <option value="">Thương hiệu</option>
        @foreach($dsThuongHieu as $thuongHieu)
        <option value="{{$thuongHieu['id']}}">{{$thuongHieu['ten_thuong_hieu']}}</option>
        @endforeach
    </select>
</div>
<div class="home-filter-down">
    <select class="home-filter__btn home-filter__btn-capacity btn" id="dung_tich_id" name="dung_tich_id" value="{{isset($inputSearch['dung_tich_id']) ? $inputSearch['dung_tich_id'] : null}}">
        <option value="">Dung tích</option>
        @foreach($dsDungTich as $dungTich)
        <option value="{{$dungTich['id']}}">{{$dungTich['ten_dung_tich']}}</option>
        @endforeach
    </select>

    <div class="form-price">
        <input readonly="readonly" class="home-filter__btn home-filter__btn-price btn" id="input-price-chose" value="Giá tiền" >
        <input hidden id="input-price-max" name="gia_tien_lon" value="">
        <input hidden id="input-price-min" name="gia_tien_nho" value="">
        <div class="custom-price">
            <div class="custom-price__max">Giá tối đa:
                <input type="text" step="any" id="price_max" value="" numbersonly="true" maxlength="6">
                vnđ
            </div>
            <div id="range-list-price"></div>
            <div class="custom-list-range">
                <ul>
                    <li value="1" data-price-min="100000" data-price-max="300000">100.000 - 300.000 </li>
                    <li value="2" data-price-min="300000" data-price-max="500000">300.000 - 500.000 </li>
                    <li value="3" data-price-min="500000" data-price-max="700000">500.000 - 700.000 </li>
                    <li value="4" data-price-min="700000" data-price-max="1000000">700.000 - 1.000.000 </li>
                    <li value="5" data-price-min="1000000" data-price-max="">trên 1.000.000 </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<button class="filter__btn filter__btn-index"> <i class="fas fa-filter icon-filter"></i>Lọc</button>