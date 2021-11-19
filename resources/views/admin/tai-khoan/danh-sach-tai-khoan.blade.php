@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- Loading -->
<div class="loading"></div>
<div class="content-admin">
    <div class="acount">
        <!-- Search -->
        <div class="search search__account">
            <label for="" class="search__title">Tìm kiếm</label>
            <div class="search-form">
                <form action="{{route('quanly.ql-tai-khoan')}}" method="GET">
                    <div class="search-form-left search__account-form">
                        <div class="filter__account-up">
                            <input type="text" class="search__name search__account-name" placeholder="Nhập email cần tìm" name="email" value="{{isset($inputSearch['email']) ? $inputSearch['email'] : null}}">
                        </div>
                        <div class="filter__account-down">
                            <input type="number" class="search__num-phone search__num-account" placeholder="Nhập số điện thoại cần tìm" name="sdt" value="{{isset($inputSearch['sdt']) ? $inputSearch['sdt'] : null}}">
                            <select id="" class="filter-position__list filter-position__account" name="chuc_vu" value="{{isset($inputSearch['chuc_vu']) ? $inputSearch['chuc_vu'] : null}}">
                                <option value="">Chức vụ</option>
                                <option value="admin">Quản lý</option>
                                <option value="user">Khách hàng</option>
                            </select>
                            <button type="submit" class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                            <a href="{{route('quanly.ql-tai-khoan')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                        </div>
                    </div>
                </form>
                <div class="search-form-right">
                    <a type="button" id="btn-add__account" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-tai-khoan">
            @include('admin.tai-khoan.bang-tai-khoan')
        </div>

        <!-- Change page -->
        @if(count($users) > 0)
        <div class="change-page">
            @if($users->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$users->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$users->currentPage()}}</span>
            @if($users->hasMorePages())
            <a class="change-page__link" href="{{$users->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@include('admin.tai-khoan.them-tai-khoan')
@endsection
@section('page-js')
<script type="text/javascript">
    var btnAddAccount = document.getElementById("btn-add__account"); //id nút thêm ở trang danh sách tài khoản
    var modalAddEdit = document.getElementById("modal-add-edit"); //id modal thêm tài khoản
    var modalOverlayAddEdit = document.getElementById("modal__overlay-add-edit"); //id modal-overlay thêm tài khoản
    var formAddAccount = document.getElementById("add-form__account");

    btnAddAccount.onclick = function() {
        modalAddEdit.style.display = "flex";
        formAddAccount.style.display = "block"
        document.querySelector('.input__name-account').focus();
    }

    function backAddAccount() {
        modalAddEdit.style.display = "none";
        // formAddAccount.style.display = "none"
    }

    modalOverlayAddEdit.onclick = function() {
        modalAddEdit.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalAddEdit) {
            modalAddEdit.style.display = "none"
            // formAddAccount.style.display = "none"
        }
    }
</script>

<!-- Thêm mới tài khoản -->
<script>
    $('#them-tai-khoan').submit(function(e) {
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
                        backAddAccount();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-tai-khoan').empty();
                        $('#bang-tai-khoan').html(data.giao_dien_bang);
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#them-tai-khoan').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Khóa tài khoản -->
<script>
    function actionLockUp(e) {
        e.preventDefault();
        let that = $(this);
        let urlRequest = $(this).data('url');
        let index = urlRequest.split("/").pop();
        Swal.fire({
            title: 'Bạn có chắc muốn khóa tài khoản ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Khóa'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: urlRequest,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            document.getElementById('lock__no-open-' + index).classList.remove('d-none');
                            document.getElementById('lock__open-' + index).classList.remove('d-inline');
                            document.getElementById('activate-' + index).innerHTML = 'Khóa';
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
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
        $(document).on('click', '.action-lock-up', actionLockUp);
    });
</script>

<!-- Mở khóa tài khoản -->
<script>
    function actionUnLock(e) {
        e.preventDefault();
        let that = $(this);
        let urlRequest = $(this).data('url');
        let index = urlRequest.split("/").pop();
        Swal.fire({
            title: 'Bạn có chắc muốn mở khóa tài khoản ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Mở'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: urlRequest,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            document.getElementById('lock__no-open-' + index).classList.add('d-none');
                            document.getElementById('lock__open-' + index).classList.add('d-inline');
                            document.getElementById('activate-' + index).innerHTML = 'Đã kích hoạt';
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
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
        $(document).on('click', '.action-unlock', actionUnLock);
    });
</script>
@endsection