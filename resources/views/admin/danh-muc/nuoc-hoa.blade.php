<!-- Table list account -->
<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsDanhMuc as $stt => $danhMuc)
        <tr class="content__account">
            <td scope="row">{{$stt + 1}}</td>
            <td>{{$danhMuc['ten_danh_muc']}}</td>
            <td>{{ \Carbon\Carbon::parse($danhMuc['created_at'])->format('d-m-Y H:i:s')}}</td>
            <td>
                <a data-url="{{route('quanly.chi-tiet-danh-muc', $danhMuc['id'])}}" class="chi-tiet-danh-muc"><i class="fas fa-edit icon"></i></a>
                <a data-url="{{route('quanly.xoa-danh-muc', $danhMuc['id'])}}" class="xoa-danh-muc"><i class="fas fa-trash-alt icon"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>