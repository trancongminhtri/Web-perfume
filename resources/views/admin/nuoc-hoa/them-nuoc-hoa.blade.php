@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<div class="content-admin content-admin__ckeditor">
    <div class="grid_g wide_g wide_g-tablet">
        <div class="add-form__header add-form__add-account--center add-form__haeder-product">
            <h3 class="add-form__haeding add-form__haeding-product">Thêm Nước Hoa</h3>
        </div>
        <form action="{{route('quanly.them-nuoc-hoa')}}" id="them-nuoc-hoa" method="POST" data-parsley-validate enctype="multipart/form-data">
            @csrf
            <div class="row_g">
                <div class="col_g l-6_g m-6_g">
                    <div class="add-form__container add-form__container-account">
                        <div class="add-form__group">
                            <label>Tên nước hoa:</label>
                            <div class="add-form__item">
                                <input type="text" class="add-form__input" id="ten_nuoc_hoa" name="ten_nuoc_hoa" placeholder="Tên nước hoa" required data-parsley-required-message="Vui lòng nhập tên nước hoa!" autofocus>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Năm phát hành:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="nam_phat_hanh" name="nam_phat_hanh">
                                    <option value="">Tùy chọn năm phát hành </option>
                                    @for($i = $now; $i >= 1700; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Nhà pha chế:</label>
                            <div class="add-form__item">
                                <input type="text" class="add-form__input" id="nha_pha_che" name="nha_pha_che" placeholder="Nhà pha chế">
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Giá tiền:</label>
                            <div class="add-form__item">
                                <input type="number" class="add-form__input add-form__input-number" id="gia_tien" name="gia_tien" placeholder="Giá tiền" required data-parsley-required-message="Vui lòng nhập giá tiền!">
                            </div>
                        </div>

                        <div class="add-form__group add-form__item-position">
                            <label>Số lượng tồn:</label>
                            <div class="add-form__item">
                                <input type="number" class="add-form__input add-form__input-number" id="so_luong_ton" name="so_luong_ton" placeholder="Số lượng tồn" required data-parsley-required-message="Vui lòng nhập số lượng tồn!">
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Hương thơm:</label>
                            <div class="add-form__item ">
                                <!-- <i class="fas fa-sort-down icon__arow-down"></i> -->
                                <input type="text" class="add-form__input add-form__input-flavor" placeholder="Hương thơm">
                                <div class="flavor__list">
                                    @foreach($dsHuongThom as $huongThom)
                                    <div class="flavor__item"> <input type="checkbox" class="flavor__item-input" name="huong_thom" id="check{{$huongThom['id']}}" data-id-huong-thom="{{$huongThom['id']}}" value="{{$huongThom['ten_huong_thom']}}"><label class="flavor__item-name" for="check{{$huongThom['id']}}">{{$huongThom['ten_huong_thom']}}</label></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Giới tính:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="gioi_tinh" name="gioi_tinh" required data-parsley-required-message="Vui lòng chọn giới tính!">
                                    <option value="">Tùy chọn giới tính</option>
                                    @foreach($dsGioiTinh as $gioiTinh)
                                    <option value="{{$gioiTinh['id']}}">{{$gioiTinh['ten_gioi_tinh']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Danh mục:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="danh_muc" name="danh_muc">
                                    <option value="">Tùy chọn danh mục</option>
                                    @foreach($dsDanhMuc as $danhMuc)
                                    <option value="{{$danhMuc['id']}}">{{$danhMuc['ten_danh_muc']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Thương hiệu:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="thuong_hieu" name="thuong_hieu" required data-parsley-required-message="Vui lòng chọn thương hiệu!">
                                    <option value="">Tùy chọn thương hiệu</option>
                                    @foreach($dsThuongHieu as $thuongHieu)
                                    <option value="{{$thuongHieu['id']}}">{{$thuongHieu['ten_thuong_hieu']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Nồng độ:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="nong_do" name="nong_do" required data-parsley-required-message="Vui lòng chọn nồng độ!">
                                    <option value="">Tùy chọn nồng độ</option>
                                    @foreach($dsNongDo as $nongDo)
                                    <option value="{{$nongDo['id']}}">{{$nongDo['ten_nong_do']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Dung tích:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="dung_tich" name="dung_tich" required data-parsley-required-message="Vui lòng chọn dung tích!">
                                    <option value="">Tùy chọn dung tích</option>
                                    @foreach($dsDungTich as $dungTich)
                                    <option value="{{$dungTich['id']}}">{{$dungTich['ten_dung_tich']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label>Khuyến mãi:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="khuyen_mai" name="khuyen_mai">
                                    <option value="">Tùy chọn khuyến mãi</option>
                                    @foreach($dsKhuyenMai as $khuyenMai)
                                    <option value="{{$khuyenMai['id']}}">{{$khuyenMai['ten_khuyen_mai']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner -->
                <div class="col_g l-6_g m-6_g banner__scroll">
                    <div class="row__banner" id="row-0-panel">
                        <div class="event-rght__ip">
                            <div class="event-right__text-title event-rght__txt-title">Đường dẫn banner </div>
                            <div class="event-right__content">
                                <label id="id-label-0" for="event__input-0" class="form-control event-rght__label"></label>
                                <input hidden class="form-control event-rght__input" id="event__input-0" name="duong_dan_banner" type="file" multiple placeholder="Nhập đường link" required data-parsley-required data-parsley-required-message="Vui lòng nhập đường dẫn!" onchange="uploadBannerFile(this, 0)" accept=".jpg, .png">
                                <img class="event-right__img" id="event__img-0" src="{{asset('assets/img/no_cart.png')}}" alt="" width="250px" height="150px">
                            </div>
                        </div>
                    </div>

                    <div class="event-right__panel">
                        <label class="event-right__upload d-flex" for="upload-panel" onclick="action()" style="justify-content: center;">
                            <span class=""><i class="fas fa-plus"></i> Thêm đường dẫn banner</span>
                        </label>
                    </div>
                </div>
            </div>
            <label class="title__news">Bài viết:</label>
            <div class="add-form__group add-form__group-add-news">
                <div class="add-form__item">
                    <textarea type="text" id="ckeditor" name="ckeditor" class="add-form__input" placeholder="Bài viết"></textarea>
                </div>
            </div>

            <div class="row_g row__add-product">
                <div class="col_g l_12_g">
                    <div class="add-form__controls add-form__controls-add-product">
                        <a href="{{route('quanly.ql-nuoc-hoa')}}" type="button" class="btn add-form__controls-back btn--normal btn--des-account">HỦY</a>
                        <button class="btn btn--primary btn--add-product">LƯU</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-js')

<!-- Chọn hương thơm  -->
<script type="text/javascript">
    $(document).ready(function() {
        $('input[class="flavor__item-input"]').click(function() {
            let checbox = "";
            let cut_string = "";
            $('.add-form__input-flavor').attr("readonly", true);
            $('input[class="flavor__item-input"]:checked').each(function() {
                checbox += $(this).val() + ", ";
                cut_string = checbox.substring(0, checbox.length - 2);
            });
            if (checbox !== null) {
                $('.add-form__input-flavor').val(cut_string);
            } else {
                $('.add-form__input-flavor').val("Chọn");
            }
        });
    });
</script>

<!-- Đóng mở danh sách hương thơm -->
<script>
    $(document).ready(function() {
        let input_flavor = document.getElementsByClassName('add-form__input-flavor');

        for (var i = 0; i < input_flavor.length; i++) {
            let flavor__lists = document.getElementsByClassName('flavor__list')[i];
            input_flavor[i].addEventListener('click', function() {
                if (flavor__lists.style.display !== 'block') {
                    flavor__lists.style.display = 'block';

                } else {
                    flavor__lists.style.display = 'none';

                }
            });
        }
    });
</script>

<!-- CKEDITOR -->
<script>
    CKEDITOR.replace('ckeditor', {
        filebrowserUploadUrl: "{{route('quanly.ckeditor.upload', ['_token' => csrf_token()])}}",
        filebrowserUploadMethod: 'form',
    });
</script>

<!-- add banner -->
<script type="text/javascript">
    var index = 1;
    var more = 0;

    function action() {
        $('.event-right__panel').before('<div class="row__banner" id="row_g-' + index + '-panel"><div class="event-rght__ip"><div class="event-right__text-title event-rght__txt-title">Đường dẫn banner </div><div class="event-right__content"><label id="id-label-' +
            index + '" class="form-control event-rght__label" for="event__input-' + index + '"></label><input hidden class="form-control event-rght__input" id="event__input-' +
            index + '" name="duong_dan_banner" type="file" placeholder="Nhập đường link" required data-parsley-required data-parsley-required-message="Vui lòng nhập đường dẫn!" onchange="uploadBannerFile(this,' + index + ')" accept=".jpg, .png"><img class="event-right__img" id="event__img-' +
            index + '" src="../assets/img/no_cart.png" alt="" width="250px" height="150px"><span class="trash" id="span_-' + index + '-trash" onclick="trash(' + index + ')"><i style="margin-top: 4px;" class="fas fa-trash-alt trash__icon"></i></span></div></div></div>');
        index++;
        more++;
    }
</script>
<!-- /add banner -->

<!-- delete and choose file -->
<script type="text/javascript">
    function trash(index1) {
        $('#row_g-' + index1 + '-panel').remove();
    }

    function uploadBannerFile(input, tam) {
        $('#id-label-' + tam).html(input.files[0].name);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#event__img-' + tam).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        $('#event__input-' + tam).change(function() {
            readURL(this);
        });
    }
</script>
<!-- /delete and choose file -->

<!-- UI -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.event__image-upload-wrap').hide();
                $('.file-upload-input').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-input').val('');
        $('.file-upload-content').hide();
        $('.event__image-upload-wrap').show();
    }
    $('.event__image-upload-wrap').bind('dragover', function() {
        $('.event__image-upload-wrap').addClass('image-dropping');
    });
    $('.event__image-upload-wrap').bind('dragleave', function() {
        $('.event__image-upload-wrap').removeClass('image-dropping');
    });
</script>

<!-- Thêm nước hoa -->
<script>
    $('#them-nuoc-hoa').submit(function(event) {
        event.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            var arr_input_banner = new Array();
            var arr_input_checkbox = new Array();
            let count_banner = document.getElementsByName('duong_dan_banner');
            // Lấy giá trị input file banner
            for (var i = 0; i < count_banner.length; i++) {
                if (count_banner[i].files[0] != undefined) {
                    arr_input_banner.push(count_banner[i].files[0]);
                }
            }
            // Lấy giá trị input checkbox hương thơm
            $('input[class="flavor__item-input"]:checked').each(function() {
                arr_input_checkbox.push($(this).data('id-huong-thom'));
            });
            // Lấy giá trị trong ckeditor
            var data_ckeditor = CKEDITOR.instances.ckeditor.getData();
            // Khai báo formData
            var formData = new FormData($(this)[0]);
            for (i = 0; i < arr_input_banner.length; i++) {
                formData.append('data_input_banner[]', arr_input_banner[i]);
            }
            for (i = 0; i < arr_input_checkbox.length; i++) {
                formData.append('data_input_checkbox[]', arr_input_checkbox[i]);
            }
            formData.append('ten_nuoc_hoa', $('#ten_nuoc_hoa').val());
            formData.append('nam_phat_hanh', $('#nam_phat_hanh').val());
            formData.append('nha_pha_che', $('#nha_pha_che').val());
            formData.append('gia_tien', $('#gia_tien').val());
            formData.append('so_luong_ton', $('#so_luong_ton').val());
            formData.append('gioi_tinh', $('#gioi_tinh').val());
            formData.append('danh_muc', $('#danh_muc').val());
            formData.append('thuong_hieu', $('#thuong_hieu').val());
            formData.append('nong_do', $('#nong_do').val());
            formData.append('dung_tich', $('#dung_tich').val());
            formData.append('khuyen_mai', $('#khuyen_mai').val());
            formData.append('bai_viet', data_ckeditor);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.setTimeout(function(){
                            window.location.replace("{{route('quanly.ql-nuoc-hoa')}}");
                        },1500);
                    } else {
                        $('.grid_g').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + data.message + '</div>');
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 5000);
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $('.add-form__header.add-form__add-account--center').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + error + '</div>');
                    }),
                    window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                    }, 2500);
                }
            });
        }
    });
</script>
@endsection