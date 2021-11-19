@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<div class="content-admin content-admin__ckeditor">
    <div class="grid_g">
        <div class="add-form__header add-form__add-account--center add-form__haeder-product">
            <h3 class="add-form__haeding add-form__haeding-product">Thêm Trang Tĩnh</h3>
        </div>
        <form action="{{route('quanly.them-blog')}}" method="POST" id="them_blog" data-parsley-validate enctype="multipart/form-data">
            @csrf
            <div class="row_g">
                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__container add-form__container-account">
                        <div class="add-form__form">
                            <div class="add-form__group">
                                <label for="" class="add-form__name-slideshow" style="align-self: center;">Tiêu đề:</label>
                                <div class="add-form__item">
                                    <textarea type="text" class="add-form__input add-form__input-slideshow" id="tieu_de_blog" name="tieu_de_blog"
                                    placeholder="Tiêu đề" required data-parsley-required-message="Vui lòng nhập tiêu đề!" style="height: 64px;" autofocus></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__container add-form__container-account">
                        <div class="add-form__form">
                            <div class="add-form__group">
                                <label for="" class="add-form__name-slideshow" style="align-self: center;">Mô tả:</label>
                                <div class="add-form__item">
                                    <textarea type="text" class="add-form__input add-form__input-slideshow" id="mo_ta_blog" name="mo_ta_blog"
                                    placeholder="Mô tả" required data-parsley-required-message="Vui lòng nhập mô tả!" style="height: 64px;"></textarea>
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
                            <div style="width:200px" class="event-right__text-title event-rght__txt-title title__banner-slideshow" style="font-weight:500;">Đường dẫn banner:</div>
                            <div class="event-right__content" style="text-align: left;">
                                <label id="id-label-0" for="event__input-0" class="form-control form-control__slideshow event-rght__label"></label>
                                <input hidden class="form-control event-rght__input" id="event__input-0" name="duong_dan_banner" type="file" required data-parsley-required-message="Vui lòng chọn ảnh!"multiple placeholder="Nhập đường link" data-parsley-length="[10, 150]"  data-parsley-length-message="Tên file tối đa 150 kí tự!" onchange="uploadBannerFile(this, 0)" accept=".jpg, .png">
                                <img class="event-right__img" id="event__img-0" src="{{asset('assets/img/slider_m.jpg')}}" alt="blog" width="450px" height="320px">
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
                                <select class="add-form__input add-form__select-status" id="trang_thai_blog" required data-parsley-required-message="Vui lòng chọn chọn trạng thái!">
                                    <option value="1" >Hiện trang tĩnh</option>
                                    <option value="0" >Ẩn trang tĩnh</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label class="title__news">Nội dung:</label>
                  <div class="add-form__group add-form__group-add-news">
                    <div class="add-form__item">
                      <textarea type="text" id="ckeditor_blog" name="ckeditor_blog" class="add-form__input"></textarea>
                    </div>
                  </div>

            <div class="row_g row__add-product">
                <div class="col_g l_12_g">
                    <div class="add-form__controls add-form__controls-add-product">
                        <a href="{{route('quanly.ql-blog')}}" type="button" class="btn add-form__controls-back btn--normal btn--des-account">HỦY</a>
                        <button class="btn btn--primary btn--add-product">LƯU</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-js')
<script>
   CKEDITOR.replace('ckeditor_blog', {
        filebrowserUploadUrl: "{{route('quanly.ckeditor.upload', ['_token' => csrf_token()])}}",
        filebrowserUploadMethod: 'form',
  });
</script>
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

<!-- Thêm Blog --> 
<script>
    $('#them_blog').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            let count_blog = document.getElementsByName('duong_dan_banner');

            // Lấy giá trị trong ckeditor
            var data_ckeditor = CKEDITOR.instances.ckeditor_blog.getData();
            
            // Form data
            var formData = new FormData($(this)[0]);
            formData.append('data_blog', count_blog[0].files[0]);
            formData.append('noi_dung_blog', data_ckeditor);
            formData.append('tieu_de_blog', $('#tieu_de_blog').val());
            formData.append('mo_ta_blog', $('#mo_ta_blog').val());
            formData.append('trang_thai_blog', $('#trang_thai_blog').val());

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
                    if(data.status === 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.setTimeout(function(){
                            window.location.replace("{{route('quanly.ql-blog')}}");
                        },1500);
                    } else {
                        $('.grid_g').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + data.message + '</div>');
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 5000);
                    }
                },
                // dùng để bắt lỗi 422 khi xài ajax
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