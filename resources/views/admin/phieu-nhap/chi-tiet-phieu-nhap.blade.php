@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<div class="content-admin content-admin__ckeditor">
    <div class="grid_g wide_g wide_g-tablet">
        <div class="add-form__header add-form__add-account--center add-form__haeder-product">
            <h3 class="add-form__haeding add-form__haeding-product">Chi tiết phiếu nhập</h3>
        </div>
            <div class="add-form__container add-form__container-account">
                <div class="row_g">
                    @foreach($timPhieuNhap as $phieuNhap)
                    <div class="col_g l-12_g m-12_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Người nhập:</label>
                            <div class="add-form__item">
                                <input type="text" disabled class="add-form__input add-form__input-number" value="{{$phieuNhap['ho_ten']}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-6_g m-6_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Tổng số lượng:</label>
                            <div class="add-form__item">
                                <input type="number" disabled class="add-form__input add-form__input-number" id="tong-so-luong-nhap" name="tong-so-luong-nhap" value="{{$phieuNhap['tong_so_luong']}}" placeholder="Tổng số lượng nhập">
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-6_g m-6_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Ngày nhập:</label>
                            <div class="add-form__item">
                                <input type="date" value="{{$phieuNhap['ngay_nhap']}}" class="add-form__input add-form__input-number" id="ngay-nhap" name="ngay-nhap"  required data-parsley-required-message="Vui lòng chọn ngày nhập!" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-12_g m-12_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Tổng tiền:</label>
                            <div class="add-form__item">
                                <input type="text" value="{{number_format($phieuNhap['tong_tien'])}}đ" disabled class="add-form__input add-form__input-number" id="tong-tien-nhap" name="tong-tien-nhap" placeholder="Tổng tiền nhập">
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-12_g m-12_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Nhà cung cấp:</label>
                            <div class="add-form__item">
                                <input value="{{$phieuNhap['ten_ncc']}}" class="add-form__input add-form__select" id="nha-cung-cap" name="nha-cung-cap"  required data-parsley-required-message="Vui lòng chọn nhà cung cấp!" disabled>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <!-- Nhập nước hoa -->
                    @foreach($timChiTietPhieuNhap as $chiTietPhieuNhap)
                    <div class="add-form__container-product-perfume">
                        <div class="row_g row_g-perfume-0">
                            <div class="col_g l-12_g m-12_g">
                                <div class="add-form__group add-form__item-position">
                                    <label style="width:80px">Nước hoa:</label>
                                    <div class="add-form__item">
                                        <input value="{{$chiTietPhieuNhap['ten_nuoc_hoa']}}" class="add-form__input add-form__select" id="chon-nuoc-hoa-0" name="chon-nuoc-hoa"  required data-parsley-required-message="Vui lòng chọn nước hoa!" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col_g c-o-2_g m-o-2_g l-4_g m-4_g">
                                <div class="add-form__group add-form__item-position">
                                    <label>Giá nhập:</label>
                                    <div class="add-form__item">
                                        <input value="{{number_format($chiTietPhieuNhap['gia_tien_nuoc_hoa'])}}đ" type="text" class="add-form__input add-form__input-number" id="gia-nhap-0" name="gia-nhap" placeholder="Giá tiền nhập"  required data-parsley-required-message="Vui lòng nhập giá!" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col_g l-3_g m-3_g">
                                <div class="add-form__group add-form__item-position">
                                    <label>Số lượng:</label>
                                    <div class="add-form__item">
                                        <input type="number" value="{{$chiTietPhieuNhap['so_luong_nhap']}}" class="add-form__input add-form__input-number" id="so-luong-nhap-0" name="so-luong-nhap" placeholder="Số lượng"  required data-parsley-required-message="Vui lòng nhập số lượng!" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <!-- End nhập nước hoa -->
                </div>

                <div class="row_g row__add-product">
                    <div class="col_g l_12_g">
                        <div class="add-form__controls add-form__controls-add-product">
                            <a href="{{route('quanly.ql-phieu-nhap')}}" type="button" class="btn add-form__controls-back btn--normal btn--des-account">TRỞ LẠI</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
@section('page-js')

@endsection