<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Tên nước hoa</th>
            <th scope="col">Email</th>
            <th scope="col">Điểm đánh giá</th>
            <th scope="col">Nội dung đánh giá</th>
            <th scope="col">Ngày đánh giá</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dsBinhLuan as $stt => $binhLuan)
        <tr class="content__account">
            <td style="width:5%" scope="row">{{$stt + 1}}</td>
            <td style="width:15%">{{$binhLuan['ten_nuoc_hoa']}}</td>
            <td style="width:15%">{{$binhLuan['email']}}</td>
            <td style="width:15%">{{$binhLuan['diem_danh_gia']}}</td>
            <td style="width:30%">{{$binhLuan['noi_dung_danh_gia']}}</td>
            <td style="width:20%">{{ \Carbon\Carbon::parse($binhLuan['created_at'])->format('d-m-Y H:i:s')}}</td>
            <td style="width:5%"><a data-url="{{route('quanly.xoa-danh-gia', $binhLuan['id'])}}" class="xoa-danh-gia"><i class="fas fa-trash-alt icon"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>