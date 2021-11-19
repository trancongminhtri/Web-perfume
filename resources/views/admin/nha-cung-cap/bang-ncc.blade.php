<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Tên nhà cung cấp</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsNCC as $stt => $ncc)
        <tr class="content__account">
            <td scope="row">{{$stt + 1}}</td>
            <td>{{$ncc['ten_ncc']}}</td>
            <td>{{$ncc['sdt_ncc']}}</td>
            <td>{{$ncc['email_ncc']}}</td>
            <td>{{$ncc['dia_chi_ncc']}}</td>
            <td>
                <a data-url="{{route('quanly.chi-tiet-ncc', $ncc['id'])}}" class="chi-tiet-ncc"><i class="fas fa-edit icon"></i></a>
                <a data-url="{{route('quanly.xoa-ncc', $ncc['id'])}}" class="xoa-ncc"><i class="fas fa-trash-alt icon"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>