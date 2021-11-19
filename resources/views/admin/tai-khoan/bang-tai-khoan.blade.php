<table class="table ">
    <thead>
        <tr class="title__account">
            <th scope="col ">STT</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Email</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Kích hoạt</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $stt => $itemUser)
        <tr class="content__account">
            <td scope="row">{{$stt+1}}</td>
            <td>{{$itemUser->ho_ten}}</td>
            <td>{{$itemUser->email}}</td>
            <td>{{$itemUser->chuc_vu == 'admin' ? 'Quản lý' : "Khách hàng"}}</td>
            <td>{{$itemUser->sdt}}</td>
            <td style="width: 20%">{{$itemUser->dia_chi}}</td>
            <td id="activate-{{$itemUser['id']}}">{{$itemUser->kich_hoat == '2' ? 'Khóa' : ($itemUser->kich_hoat == '0' ? 'Chưa kích hoạt' : 'Đã kích hoạt')}}</td>
            <td>
                @if($itemUser->kich_hoat == '2')
                <a data-url="{{route('quanly.mo-tai-khoan', $itemUser['id'])}}" class="action-unlock">
                    <i class="fas fa-lock lock__no-open" id="lock__no-open-{{$itemUser['id']}}"></i>
                </a>
                <a data-url="{{route('quanly.khoa-tai-khoan', $itemUser['id'])}}" class="action-lock-up">
                    <i class="fas fa-lock-open lock__open" id="lock__open-{{$itemUser['id']}}"></i>
                </a>
                @else
                <a data-url="{{route('quanly.mo-tai-khoan', $itemUser['id'])}}" class="action-unlock">
                    <i class="fas fa-lock lock__no-open d-none" id="lock__no-open-{{$itemUser['id']}}"></i>
                </a>
                <a data-url="{{route('quanly.khoa-tai-khoan', $itemUser['id'])}}" class="action-lock-up">
                    <i class="fas fa-lock-open lock__open d-inline" id="lock__open-{{$itemUser['id']}}"></i>
                </a>
                @endif
                <a href="{{route('quanly.thong-tin-tai-khoan', [Str::slug($itemUser['ho_ten'], '-'), $itemUser['id']])}}"><i class="far fa-eye icon__view-detail"></i></a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>