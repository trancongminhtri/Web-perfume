<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col " style="width:5%">STT</th>
            <th style="width:10%">Ảnh</th>
            <th style="width:30%">Tiêu đề</th>
            <th style="width:35%">Mô Tả</th>
            <th style="width:10%">Trạng thái</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsBlog as $stt => $blog)
        <tr class="content__account">
            <td scope="row">{{$stt+1}}</td>
            <td><img src="../{{$blog['duong_dan']}}" alt="" style="width:70px; height:50px"></td>
            <td>{{$blog['tieu_de']}}</td>
            <td>{{$blog['mo_ta_noi_dung']}}</td>
            <td>{{$blog['trang_thai'] == true ? 'Hiện' : 'Ẩn'}}</td>
            <td>
                <a href="{{route('quanly.chi-tiet-blog', [Str::slug($blog['tieu_de'], '-'), $blog['id']])}}"><i class="fas fa-edit icon__edit" style="margin-left: 2px;"></i></a>
                <a data-url="{{route('quanly.xoa-blog', $blog['id'])}}" class="xoa__blog"><i class="fas fa-trash-alt icon"></i></a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>