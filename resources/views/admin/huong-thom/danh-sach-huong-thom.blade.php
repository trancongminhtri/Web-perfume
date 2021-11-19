@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<div class="content-admin">
    <div class="acount">
        <!-- Search -->
        <div class="search">
            <label for="" class="search__title">Tìm kiếm</label>
            <div class="search-form">
                <form action="{{route('quanly.ql-huong-thom')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-flavor" placeholder="Nhập tên hương thơm" name="ten_huong_thom" value="{{isset($inputSearch['ten_huong_thom']) ? $inputSearch['ten_huong_thom'] : null}}">
                        <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                        <a href="{{route('quanly.ql-huong-thom')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a type="button" onclick="AddFlavor()" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-huong-thom">
            @include('admin.huong-thom.bang-huong-thom')
        </div>

        <!-- Change page -->
        @if(count($dsHuongThom) > 0)
        <div class="change-page">
            @if($dsHuongThom->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsHuongThom->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsHuongThom->currentPage()}}</span>
            @if($dsHuongThom->hasMorePages())
            <a class="change-page__link" href="{{$dsHuongThom->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
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
        @include('admin.huong-thom.them-huong-thom')
        <div class="add-form add-form__add-flavor" id="edit-form__flavor">
   
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">

    var modalAddEdit = document.getElementById("modal-add-edit"); //id modal
    var formAddFlavor = document.getElementById("add-form__flavor"); //id form nội dung
    var formEditFlavor = document.getElementById("edit-form__flavor");

    function AddFlavor() {
        modalAddEdit.style.display = "flex";
        formAddFlavor.style.display = "block";
        formEditFlavor.style.display = "none";
        document.querySelector('.input__name-flavor').focus();
    }

    function EditFlavor() {
        modalAddEdit.style.display = "flex";
        formEditFlavor.style.display = "block"
        formAddFlavor.style.display = "none";
    }

    function backAddFlavor() {
        modalAddEdit.style.display = "none";
        formEditFlavor.style.display = "none"
        formAddFlavor.style.display = "none"
    }

    function modalOverlayAddEdit() {
        modalAddEdit.style.display = "none";
        formEditFlavor.style.display = "none"
        formAddFlavor.style.display = "none"
    }

    window.onclick = function(event) {
        if (event.target == modalAddEdit) {
            modalAddEdit.style.display = "none"
            formEditFlavor.style.display = "none"
            formAddFlavor.style.display = "none"
        }
    }
</script>

<!-- Thêm hương thơm -->
<script>
    $('#them-huong-thom').submit(function(e) {
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
                        backAddFlavor();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-huong-thom').empty();
                        $('#bang-huong-thom').html(data.giao_dien_bang);
                        setNullValue();
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#them-huong-thom').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Xóa hương thơm -->
<script>
    function xoaHuongThom(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa hương thơm ?',
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
                            $('#bang-huong-thom').empty();
                            $('#bang-huong-thom').html(data.giao_dien_bang);
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
        $(document).on('click', '.xoa-huong-thom', xoaHuongThom);
    });
</script>

<!-- Chi tiết hương thơm -->
<script>
    function chiTietHuongThom(event) {
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
        }).done(function(res) {
            if (res.status == 'success') {
                $('#edit-form__flavor').html(res.giao_dien_cap_nhat);
                EditFlavor();
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
        $(document).on('click', '.chi-tiet-huong-thom', chiTietHuongThom);
    });
</script>

@endsection