<!-- Table list account -->
<table class="table">
            <thead>
                <tr class="title__account">
                    <th scope="col ">STT</th>
                    <th scope="col">Tên slideshow</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsSlideShow as $stt => $slideshow)
                <tr class="content__account">
                    <td scope="row">{{$stt + 1}}</td>
                    <td>{{$slideshow['ten']}}</td>
                    <td><img src="../{{$slideshow['duong_dan']}}" width="150px" height="75px"></td>
                    @if($slideshow['trang_thai'] == 0)
                    <td>Ẩn slideshow</td>
                    @else
                    <td>Hiện slideshow</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($slideshow['created_at'])->format('d-m-Y H:i:s')}}</td>
                    <td>
                        <a href="{{route('quanly.chi-tiet-slideshow' , [Str::slug($slideshow['ten'], '-'), $slideshow['id']])}}"><i class="fas fa-edit icon"></i></a>
                        <a data-url="{{route('quanly.xoa-slideshow', $slideshow['id'])}}" class="xoa-slideshow"><i class="fas fa-trash-alt icon"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>