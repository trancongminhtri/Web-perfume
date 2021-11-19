@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- Loading -->
<div class="loading"></div>
<div class="content-admin">
    <div class="acount">
        <div class="grid_g">
            <div class="row_g">
                <div class="col_g l-12_g m-12_g" style="width:100%;">
                    <!-- Search -->
                    <div class="search search__perfume">
                        <label for="" class="search__title">Tìm kiếm</label>
                        <div class="search-form">
                            <form action="{{route('quanly.ql-nuoc-hoa')}}" method="GET">
                                <div class="search-form-left search__perfume">
                                    <div class="filter-position__up">
                                        <input type="text" class="search__name search__perfume-name" placeholder="Nhập tên cần tìm" name="ten_nuoc_hoa" value="{{isset($inputSearch['ten_nuoc_hoa']) ? $inputSearch['ten_nuoc_hoa'] : null}}">

                                        <select id="" class="filter-position__list filter-position__list-perfume" name="gioi_tinh_id" value="{{isset($inputSearch['gioi_tinh_id']) ? $inputSearch['gioi_tinh_id'] : null}}">
                                            <option value="">Giới tính</option>
                                            @foreach($dsGioiTinh as $gioiTinh)
                                            <option value="{{$gioiTinh['id']}}">{{$gioiTinh['ten_gioi_tinh']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="filter-position__down">
                                        <select id="" class="filter-position__list filter-position__list-perfume" name="thuong_hieu_id" value="{{isset($inputSearch['thuong_hieu_id']) ? $inputSearch['thuong_hieu_id'] : null}}">
                                            <option value="">Thương hiệu</option>
                                            @foreach($dsThuongHieu as $thuongHieu)
                                            <option value="{{$thuongHieu['id']}}">{{$thuongHieu['ten_thuong_hieu']}}</option>
                                            @endforeach
                                        </select>

                                        <select id="" class="filter-position__list filter-position__list-perfume" name="nong_do_id" value="{{isset($inputSearch['nong_do_id']) ? $inputSearch['nong_do_id'] : null}}">
                                            <option value="">Nồng độ</option>
                                            @foreach($dsNongDo as $nongDo)
                                            <option value="{{$nongDo['id']}}">{{$nongDo['ten_nong_do']}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                                        <a href="{{route('quanly.ql-nuoc-hoa')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                                    </div>
                                </div>
                            </form>
                            <div class="search-form-right" style="margin-bottom: 6px;">
                                <a type="button" href="{{route('quanly.trang-them-nuoc-hoa')}}" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table list account -->
        <div id="bang-nuoc-hoa-id">
            @include('admin.nuoc-hoa.bang-nuoc-hoa')
        </div>


        <!-- Change page -->
        @if(count($dsNuocHoa) > 0)
        <div class="change-page">
            @if($dsNuocHoa->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsNuocHoa->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsNuocHoa->currentPage()}}</span>
            @if($dsNuocHoa->hasMorePages())
            <a class="change-page__link" href="{{$dsNuocHoa->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
<!-- Xóa nước hoa -->
<script>
    function xoaNuocHoa(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa nước hoa ?',
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
                            $('#bang-nuoc-hoa-id').empty();
                            $('#bang-nuoc-hoa-id').html(data.giao_dien_bang_nuoc_hoa);
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
        $(document).on('click', '.xoa-nuoc-hoa', xoaNuocHoa);
    });
</script>
@endsection