<table class="table ">
            <thead>
                <tr class="title__account">
                    <th scope="col ">STT</th>
                    <th scope="col">Tên khuyến mãi</th>
                    <th scope="col">Giá khuyến mãi</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsKhuyenMai as $stt => $khuyenMai)
                <tr class="content__account">
                    <td scope="row">{{$stt + 1}}</td>
                    <td>{{$khuyenMai['ten_khuyen_mai']}}</td>
                    <td>{{$khuyenMai['gia_khuyen_mai']}}%</td>
                    <td>{{ \Carbon\Carbon::parse($khuyenMai['ngay_bat_dau'])->format('d-m-Y')}}</td>

                    <!-- Ngày kết thúc khuyến mãi -->
                    @if($khuyenMai['ngay_ket_thuc'] == null)
                    <td style="color: red;">Vô hạn</td>
                    @else
                    <td>{{ \Carbon\Carbon::parse($khuyenMai['ngay_ket_thuc'])->format('d-m-Y')}}</td>
                    @endif

                    <td>
                        <a href="{{route('quanly.chi-tiet-khuyen-mai', [Str::slug($khuyenMai['ten_khuyen_mai'], '-'), $khuyenMai['id']])}}"><i class="fas fa-edit icon"></i></a>
                        <a data-url="{{route('quanly.xoa-khuyen-mai', $khuyenMai['id'])}}" class="xoa-khuyen-mai"><i class="fas fa-trash-alt icon"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>