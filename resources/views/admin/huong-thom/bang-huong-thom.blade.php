<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Tên hương thơm</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsHuongThom as $stt => $huongThom)
        <tr class="content__account">
            <td scope="row">{{$stt + 1}}</td>
            <td>{{$huongThom['ten_huong_thom']}}</td>
            <td>
                <a data-url="{{route('quanly.chi-tiet-huong-thom', $huongThom['id'])}}" class="chi-tiet-huong-thom"><i class="fas fa-edit icon"></i></a>
                <a data-url="{{route('quanly.xoa-huong-thom', $huongThom['id'])}}" class="xoa-huong-thom"><i class="fas fa-trash-alt icon"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>