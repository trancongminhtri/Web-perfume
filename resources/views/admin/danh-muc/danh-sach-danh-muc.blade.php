@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- End Slider -->
<div class="content-admin">
    <div class="acount">
        <!-- Search -->
        <div class="search">
            <label for="" class="search__title">Tìm kiếm</label>
            <div class="search-form">
                <form action="{{route('quanly.ql-danh-muc')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-trademark" placeholder="Nhập tên danh mục" name="ten_danh_muc" value="{{isset($inputSearch['ten_danh_muc']) ? $inputSearch['ten_danh_muc'] : null}}">
                        <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                        <a href="{{route('quanly.ql-danh-muc')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a type="button" onclick="AddCategory()" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <div id="nuoc-hoa-danh-muc">
            @include('admin.danh-muc.nuoc-hoa')
        </div>

        <!-- Change page -->
        @if(count($dsDanhMuc) > 0)
        <div class="change-page">
            @if($dsDanhMuc->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsDanhMuc->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsDanhMuc->currentPage()}}</span>
            @if($dsDanhMuc->hasMorePages())
            <a class="change-page__link" href="{{$dsDanhMuc->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
<!-- Modal Layout  -->
<div class="modal-add-edit" id="modal-add-edit">
    <!-- .modal để chiếm hết màn hình id="modal-add-edit"-->
    <div class="modal__overlay" onclick="modalOverlayAddEdit()">
        <!-- modal__overlay tạo lớp phủ mờ id="modal__overlay-add-edit" -->
    </div>
    <div class="modal__body" id="modal__body-add-edit">
        <!-- modal__body để canh chỉnh kích thước, vị trí khung chứa content  -->
        <!-- Add category product form id="add__account-form"-->
        @include('admin.danh-muc.them-danh-muc')
        <!-- Edit Trademark form id="add__account-form"-->
        <div class="add-form add-form__add-trademark" id="edit-form__category">

        </div>

    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">
    var modalAddEdit = document.getElementById("modal-add-edit"); //id modal
    var formAddCategory = document.getElementById("add-form__category"); //id form nội dung
    var formEditCategory = document.getElementById("edit-form__category"); //id form nội dung

    function AddCategory() {
        modalAddEdit.style.display = "flex";
        formAddCategory.style.display = "block"
        formEditCategory.style.display = "none";
        document.querySelector('.input__name-category').focus();
    }

    function EditCategory() {
        modalAddEdit.style.display = "flex";
        formEditCategory.style.display = "block";
        formAddCategory.style.display = "none";
    }

    function backAddCategory() {
        modalAddEdit.style.display = "none";
        formEditCategory.style.display = "none";
        formAddCategory.style.display = "none";
    }

    function modalOverlayAddEdit() {
        modalAddEdit.style.display = "none";
        formEditCategory.style.display = "none";
        formAddCategory.style.display = "none";
    }
</script>

<!-- Thêm danh mục -->
<script>
    $('#them-danh-muc').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.status == 'success') {
                        backAddCategory();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#nuoc-hoa-danh-muc').empty();
                        $('#nuoc-hoa-danh-muc').html(data.giao_dien_nuoc_hoa);
                        setNullValue();

                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#them-danh-muc').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Xóa danh mục -->
<script>
    function xoaDanhMuc(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa danh mục ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Xóa'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: urlRequest,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#nuoc-hoa-danh-muc').empty();
                            $('#nuoc-hoa-danh-muc').html(data.giao_dien_nuoc_hoa);
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        })
    }

    $(function() {
        $(document).on('click', '.xoa-danh-muc', xoaDanhMuc);
    });
</script>

<!-- Chi tiết danh mục -->
<script>
    function chiTietDanhMuc(event) {
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
        }).done(function(res) {
            if (res.status == 'success') {
                $('#edit-form__category').html(res.giao_dien_cap_nhat);
                EditCategory();
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: res.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    }
    $(function() {
        $(document).on('click', '.chi-tiet-danh-muc', chiTietDanhMuc);
    });
</script>
@endsection