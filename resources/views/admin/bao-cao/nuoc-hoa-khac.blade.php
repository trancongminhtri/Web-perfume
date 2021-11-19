<table class="table table-bordered table__product-sold">
    <thead>
        <tr>
            <th scope="col" class="table__title">STT</th>
            <th scope="col" class="table__title">Tên nước hoa</th>
            <th scope="col" class="table__title">Số lượng bán ra</th>
            <th scope="col" class="table__title">Doanh thu trước giảm giá</th>
            <th scope="col" class="table__title">Doanh thu sau giảm giá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsNuocHoaDHMoi as $stt => $nuocHoa)
        <tr>
            <th class="table__content" scope="row">{{$stt + 1}}</th>
            <td>{{$nuocHoa['ten_nuoc_hoa']}}</td>
            <td class="table__content">{{$nuocHoa['tong_so_luong']}}</td>
            <td class="table__content">{{number_format($nuocHoa['tong_tien_goc'])}} VNĐ</td>
            <td class="table__content">{{number_format($nuocHoa['tong_thanh_toan'])}} VNĐ</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Change page -->
{!! $dsNuocHoaDHMoi->links() !!}