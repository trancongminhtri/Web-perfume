<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Tên thương hiệu</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsThuongHieu as $stt => $thuongHieu)
        <tr class="content__account">
            <td scope="row">{{$stt + 1}}</td>
            <td>{{$thuongHieu['ten_thuong_hieu']}}</td>
            <td>
                <a data-url="{{route('quanly.chi-tiet-thuong-hieu', $thuongHieu['id'])}}" class="chi-tiet-thuong-hieu"><i class="fas fa-edit icon"></i></a>
                <a data-url="{{route('quanly.xoa-thuong-hieu', $thuongHieu['id'])}}" class="xoa-thuong-hieu"><i class="fas fa-trash-alt icon"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>