<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Nhà cung cấp</th>
            <th scope="col">Người nhập</th>
            <th scope="col">Tổng tiền nhập</th>
            <th scope="col">Tổng nhập</th>
            <th scope="col">Ngày nhập</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsPhieuNhap as $stt => $phieuNhap)
        <tr class="content__account">
            <td scope="row">{{$stt + 1}}</td>
            <td>{{$phieuNhap['ten_ncc']}}</td>
            <td>{{$phieuNhap['ho_ten']}}</td>
            <td>{{number_format($phieuNhap['tong_tien'])}}đ</td>
            <td>{{$phieuNhap['tong_so_luong']}}</td>
            <td>{{ \Carbon\Carbon::parse($phieuNhap['ngay_nhap'])->format('d-m-Y')}}</td>
            <td><a href="{{route('quanly.chi-tiet-phieu-nhap', $phieuNhap['id'])}}" class="chi-tiet-phieu-nhap"><i class="far fa-eye icon__view-detail"></i></a></td>
        </tr>
        @endforeach    
    </tbody>
</table>