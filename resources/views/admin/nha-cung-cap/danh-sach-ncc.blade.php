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
                <form action="{{route('quanly.ql-ncc')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-ncc" placeholder="Nhập tên nhà cung cấp" name="ten_ncc" value="{{isset($inputSearch['ten_ncc']) ? $inputSearch['ten_ncc'] : null}}">

                        <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                        <a href="{{route('quanly.ql-ncc')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a type="button" onclick="AddNcc()" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-ncc">
            @include('admin.nha-cung-cap.bang-ncc')
        </div>

        <!-- Change page -->
        @if(count($dsNCC) > 0)
        <div class="change-page">
            @if($dsNCC->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsNCC->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsNCC->currentPage()}}</span>
            @if($dsNCC->hasMorePages())
            <a class="change-page__link" href="{{$dsNCC->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
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
    <div class="modal__overlay" id="modal__overlay-add-edit" onclick="modalOverlayAddEdit()">
        <!-- modal__overlay tạo lớp phủ mờ id="modal__overlay-add-edit" -->
    </div>
    <div class="modal__body" id="modal__body-add-edit">
        <!-- modal__body để canh chỉnh kích thước, vị trí khung chứa content  -->
        @include('admin.nha-cung-cap.them-ncc')

        <div class="add-form add-form__add-ncc" id="edit-form__ncc">
            
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">

    var modalAddEdit = document.getElementById("modal-add-edit"); //id modal thêm tài khoản
    var formAddNcc = document.getElementById("add-form__ncc");
    var formEditNcc = document.getElementById("edit-form__ncc");


    function AddNcc() {
        modalAddEdit.style.display = "flex";
        formAddNcc.style.display = "block"
        formEditNcc.style.display = "none";
        document.querySelector('.input__name-supplier').focus();
    }

    function EditNcc() {
        modalAddEdit.style.display = "flex";
        formEditNcc.style.display = "block";
        formAddNcc.style.display = "none";
    }


    function backAddNcc() {
        modalAddEdit.style.display = "none";
        formAddNcc.style.display = "none"
        formEditNcc.style.display = "none";

    }

    function modalOverlayAddEdit() {
        modalAddEdit.style.display = "none";
        formAddNcc.style.display = "none"
        formEditNcc.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalAddEdit) {
            modalAddEdit.style.display = "none"
            formAddNcc.style.display = "none"
            formEditNcc.style.display = "none";
        }
    }
</script>

<!-- Thêm nhà cung cấp -->
<script>
    $('#them-ncc').submit(function(e) {
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
                        backAddNcc();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-ncc').empty();
                        $('#bang-ncc').html(data.giao_dien_ncc);
                        setNullValue();
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#them-ncc').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Xóa nhà cung cấp -->
<script>
    function xoaNCC(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa nhà cung cấp ?',
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
                            $('#bang-ncc').empty();
                            $('#bang-ncc').html(data.giao_dien_ncc);
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
        $(document).on('click', '.xoa-ncc', xoaNCC);
    });
</script>

<!-- Chi tiết nhà cung cấp -->
<script>
    function chiTietNCC(event) {
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
        }).done(function(res) {
            if (res.status == 'success') {
                $('#edit-form__ncc').html(res.giao_dien_cap_nhat);
                EditNcc();
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
        $(document).on('click', '.chi-tiet-ncc', chiTietNCC);
    });
</script>
@endsection