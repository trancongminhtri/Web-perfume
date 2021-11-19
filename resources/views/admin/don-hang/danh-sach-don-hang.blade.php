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
                <form action="{{route('quanly.ql-don-hang')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-code" placeholder="Nhập mã đơn hàng" name="don_hang_id" value="{{isset($inputSearch['don_hang_id']) ? $inputSearch['don_hang_id'] : null}}">
                        <div class="filter-position">
                            <select id="" class="filter-position__list filter-position__list-order-list" name="trang_thai" value="{{isset($inputSearch['trang_thai']) ? $inputSearch['trang_thai'] : null}}">
                                <option value="">Trạng thái</option>
                                @foreach($dsTrangThai as $trangThai)
                                    <option value="{{$trangThai['id']}}">{{$trangThai['trang_thai']}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="search__btn "><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                            <a href="{{route('quanly.ql-don-hang')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table list account -->
        <table class="table ">
            <thead>
                <tr class="title__account">
                    <th scope="col ">STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Thanh toán</th>
                    <th>Ngày mua</th>
                    <th scope="col">Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsDonHang as $stt => $donHang)
                    <tr class="content__account">
                        <td scope="row">{{$stt + 1}}</td>
                        <td scope="row">{{$donHang['id']}}</td>
                        <td scope="row">{{number_format($donHang['tong_thanh_toan'])}} vnđ</td>
                        <td scope="row">{{ \Carbon\Carbon::parse($donHang['created_at'])->format('d-m-Y H:i:s')}}</td>
                        @foreach($dsTrangThai as $trangThai)
                            @if($trangThai['id'] == $donHang['trang_thai_id'])
                                <td>{{$trangThai['trang_thai']}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="{{route('quanly.chi-tiet-don-hang' , $donHang['id'])}}"><i class="fas fa-pencil-alt icon__edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Change page -->
        @if(count($dsDonHang) > 0)
        <div class="change-page">
            @if($dsDonHang->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsDonHang->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsDonHang->currentPage()}}</span>
            @if($dsDonHang->hasMorePages())
            <a class="change-page__link" href="{{$dsDonHang->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
@endsection