@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- End Slider -->
<div class="content-admin content-admin__ckeditor">
    <div class="grid_g">
        <div class="add-form__header add-form__add-account--center add-form__haeder-product">
            <h3 class="add-form__haeding add-form__haeding-product">Thêm Slideshow</h3>
        </div>
        <form action="{{route('quanly.them-slideshow')}}" method="POST" id="them-slideshow" data-parsley-validate enctype="multipart/form-data">
            @csrf
            <div class="row_g">
                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__container add-form__container-account">
                        <div class="add-form__form">

                            <div class="add-form__group">
                                <label for="" class="add-form__name-slideshow">Tên slideshow:</label>
                                <div class="add-form__item">
                                    <input type="text" class="add-form__input add-form__input-slideshow" name="ten_slideshow" id="ten_slideshow" placeholder="Tên slideshow" required data-parsley-required-message="Vui lòng nhập tên slideshow!" autofocus>
                                </div>
                            </div>

                            <div class="add-form__group">
                                <label for="" class="add-form__name-slideshow add-form__description-slideshow">Mô tả:</label>
                                <div class="add-form__item">
                                    <textarea class="add-form__input add-form__textarea-slideshow" id="mo_ta_slideshow"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row_g">
                <div class="col_g l-12_g  m-12_g banner__scroll-slideshow">
                    <div class="row_g row__banner" id="row-0-panel">
                        <div class="col_g l_12_g event-rght__ip">
                            <div style="width:200px" class="event-right__text-title event-rght__txt-title title__banner-slideshow">Đường dẫn banner </div>
                            <div class="event-right__content" style="text-align: left;">
                                <label id="id-label-0" for="event__input-0" class="form-control form-control__slideshow event-rght__label "></label>
                                <input hidden class="form-control event-rght__input" id="event__input-0" name="duong_dan_banner" type="file" multiple placeholder="Nhập đường link" required data-parsley-required data-parsley-required-message="Vui lòng chọn đường dẫn!" 
                                data-parsley-length="[10, 150]"  data-parsley-length-message="Tên file tối đa 150 kí tự!" onchange="uploadBannerFile(this, 0)" accept=".jpg, .png">
                                <img class="event-right__img" id="event__img-0" src="{{asset('assets/img/slider_m.jpg')}}" alt="slider" width="100%" height="320px">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row_g">
                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__container add-form__container-account">
                        <div class="add-form__group">
                            <label class="add-form__name-slideshow">Trạng thái:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select-status" id="trang_thai_slideshow" required data-parsley-required-message="Vui lòng chọn chọn trạng thái!">
                                    <option value="0">Ẩn slider</option>
                                    <option value="1">Hiện slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row_g row__add-product">
                <div class="col_g l_12_g">
                    <div class="add-form__controls add-form__controls-add-product">
                        <a href="{{route('quanly.ql-slideshow')}}" type="button" class="btn add-form__controls-back btn--normal btn--des-account">HỦY</a>
                        <button class="btn btn--primary btn--add-product">LƯU</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('page-js')
<!-- delete and choose file -->
<script type="text/javascript">
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
<!-- Thêm slideshow -->
<script>
    $('#them-slideshow').submit(function(event) {
        event.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            let count_slideshow = document.getElementsByName('duong_dan_banner');

            // Khai báo formData
            var formData = new FormData($(this)[0]);
            formData.append('data_slideshow', count_slideshow[0].files[0]);
            formData.append('ten', $('#ten_slideshow').val());
            formData.append('mo_ta', $('#mo_ta_slideshow').val());
            formData.append('trang_thai', $('#trang_thai_slideshow').val());
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
                        window.setTimeout(function() {
                            window.location.replace("{{route('quanly.ql-slideshow')}}");
                        }, 1500);
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