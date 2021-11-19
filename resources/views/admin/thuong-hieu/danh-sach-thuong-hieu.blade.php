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
                <form action="{{route('quanly.ql-thuong-hieu')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-trademark" placeholder="Nhập tên thương hiệu" name="ten_thuong_hieu" value="{{isset($inputSearch['ten_thuong_hieu']) ? $inputSearch['ten_thuong_hieu'] : null}}">

                        <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                        <a href="{{route('quanly.ql-thuong-hieu')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a type="button" onclick="AddTrademark()" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-thuong-hieu">
            @include('admin.thuong-hieu.bang-thuong-hieu')
        </div>

        <!-- Change page -->
        @if(count($dsThuongHieu) > 0)
        <div class="change-page">
            @if($dsThuongHieu->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsThuongHieu->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsThuongHieu->currentPage()}}</span>
            @if($dsThuongHieu->hasMorePages())
            <a class="change-page__link" href="{{$dsThuongHieu->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
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
        @include('admin.thuong-hieu.them-thuong-hieu')
        <div class="add-form add-form__add-trademark" id="edit-form__trademark">
    
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">

    var modalAddEdit = document.getElementById("modal-add-edit"); //id modal
    var formAddTrademark = document.getElementById("add-form__trademark"); //id form nội dung
    var formEditrademark = document.getElementById("edit-form__trademark"); //id form nội dung

    function AddTrademark() {
        modalAddEdit.style.display = "flex";
        formAddTrademark.style.display = "block"
        formEditrademark.style.display = "none";
        document.querySelector('.input__name-trademark').focus()
    }

    function EditTradeMark() {
        modalAddEdit.style.display = "flex";
        formEditrademark.style.display = "block";
        formAddTrademark.style.display = "none";
    }

    function backAddTrademark() {
        modalAddEdit.style.display = "none";
        formEditrademark.style.display = "none";
        formAddTrademark.style.display = "none";
    }

    function modalOverlayAddEdit() {
        modalAddEdit.style.display = "none";
        formEditrademark.style.display = "none";
        formAddTrademark.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalAddEdit) {
            modalAddEdit.style.display = "none";
            formEditrademark.style.display = "none";
            formAddTrademark.style.display = "none";
        }
    }
</script>

<!-- Thêm thương hiệu -->
<script>
    $('#them-thuong-hieu').submit(function(e) {
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
                        backAddTrademark()
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-thuong-hieu').empty();
                        $('#bang-thuong-hieu').html(data.giao_dien_bang);
                        setNullValue();
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#them-thuong-hieu').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Xóa thương hiệu -->
<script>
    function xoaThuongHieu(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa thương hiệu ?',
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
                            $('#bang-thuong-hieu').empty();
                            $('#bang-thuong-hieu').html(data.giao_dien_bang);
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: res.message,
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
        $(document).on('click', '.xoa-thuong-hieu', xoaThuongHieu);
    });
</script>

<!-- Chi tiết thương hiệu -->
<script>
    function chiTietThuongHieu(event) {
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
        }).done(function(res) {
            if (res.status == 'success') {
                $('#edit-form__trademark').html(res.giao_dien_cap_nhat);
                EditTradeMark();
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
        $(document).on('click', '.chi-tiet-thuong-hieu', chiTietThuongHieu);
    });
</script>
@endsection