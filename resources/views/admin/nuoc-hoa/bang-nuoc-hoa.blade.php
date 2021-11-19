<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th>Tên nước hoa</th>
            <th scope="col">Giá gốc</th>
            <th scope="col">Khuyến mãi</th>
            <th scope="col">Giá khuyến mãi</th>
            <th scope="col">Số lượng tồn</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Danh mục</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsNuocHoa as $stt => $nuocHoa)
        <tr class="content__account">
            <td scope="row">{{$stt + 1}}</td>
            <td>{{$nuocHoa['ten_nuoc_hoa']}}</td>
            <td>{{number_format($nuocHoa['gia_tien']).'đ'}}</td>
            <td class="{{!empty($nuocHoa['ten_khuyen_mai']) ? '' : 'empty__admin'}}">
                {{!empty($nuocHoa['ten_khuyen_mai']) ? $nuocHoa['ten_khuyen_mai'] : 'Trống'}}
            </td>
            <td class="{{!empty($nuocHoa['gia_tien_khuyen_mai']) ? '' : 'empty__admin'}}">
                {{!empty($nuocHoa['gia_tien_khuyen_mai']) ? number_format($nuocHoa['gia_tien_khuyen_mai']).'đ' : 'Trống'}}
            </td>

            <td>{{$nuocHoa['so_luong_ton']}}</td>

            <td>{{$nuocHoa['trang_thai'] == 1 ? 'Còn hàng' : 'Sắp hết hàng'}}</td>

            @foreach($dsGioiTinh as $gioiTinh)
            @if($gioiTinh['id'] == $nuocHoa['gioi_tinh_id'])
            <td>{{$gioiTinh['ten_gioi_tinh']}}</td>
            @endif
            @endforeach

            <td class="{{!empty($nuocHoa['ten_danh_muc']) ? '' : 'empty__admin'}}">
                {{!empty($nuocHoa['ten_danh_muc']) ? $nuocHoa['ten_danh_muc'] : 'Trống'}}
            </td>
            <td>
                <a href="{{route('quanly.chi-tiet-nuoc-hoa' , [Str::slug($nuocHoa['ten_nuoc_hoa'], '-'), $nuocHoa['id']])}}"><i class="fas fa-edit icon"></i></a>
                <a data-url="{{route('quanly.xoa-nuoc-hoa', $nuocHoa['id'])}}" class="xoa-nuoc-hoa"><i class="fas fa-trash-alt icon"></i></a>
        </tr>
        @endforeach
    </tbody>
</table>