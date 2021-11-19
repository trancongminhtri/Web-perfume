<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserRequest;
use App\NuocHoa;
use App\DanhMucSanPham;
use App\SlideShow;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CapNhatThongTinRequest;
use App\DonHang;
use App\ThuongHieu;
use App\GioiTinh;
use App\DungTich;
use App\KhuyenMai;
use App\ThongBao;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    //Trang chủ người dùng website
    public function trangChuNguoiDung(Request $request){
        if(Cookie::has('access_count') == false){
            $minute = (24 - Carbon::now('Asia/Ho_Chi_Minh')->hour)*60 - Carbon::now('Asia/Ho_Chi_Minh')->minute;
            Cookie::queue('access_count','Yes', $minute);
            $xoa_ma_khuyen_mai = KhuyenMai::queryXoaMaKhuyenMai()->get();
            if(count($xoa_ma_khuyen_mai) != 0){
                $xoa_ma_khuyen_mai = KhuyenMai::queryXoaMaKhuyenMai()->update(['nuoc_hoa.khuyen_mai_id' => null]);
            }
        }
        $inputSearch = [];
        $arrKey = [
            'gioi_tinh_id',
            'thuong_hieu_id',
            'dung_tich_id',
            'ten_nuoc_hoa',
            'gia_tien_lon',
            'gia_tien_nho',
        ];
       
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        if($request->ajax()){
            $dsNuocHoa = NuocHoa::queryDSNuocHoaMoi($request->toArray())->get();
            return view('trang-chu.nuoc-hoa', compact(['dsNuocHoa']));   
        }
        $lastId = '';
        $dsDanhMuc = DanhMucSanPham::queryDSDanhMucTangDan()->get();
        $dsKhuyenMai = KhuyenMai::queryDSKhuyenMaiTangDan()->get();
        $dsSlideShow = SlideShow::queryDSSlideShowTangDan()->get();
        $dsNuocHoa = NuocHoa::queryDSNuocHoaMoi($request->toArray())->get();
        $dsThuongHieu = ThuongHieu::queryDSThuongHieuTangDan()->get();
        $dsGioiTinh = GioiTinh::all();
        $dsDungTich = DungTich::all();
        $select_category = '';
        $select_promotion = '';
        return view('trang-chu.trang-chu', compact(['dsDanhMuc', 'dsSlideShow', 'dsNuocHoa', 'dsThuongHieu', 'dsGioiTinh', 'dsDungTich', 'inputSearch', 'select_category', 'lastId', 'dsKhuyenMai','select_promotion']));
    }

    // Trang quản ly tài khoản của admin
    public function quanLyTaiKhoan(Request $request){
        $arrKey = [
            'email',
            'sdt',
            'chuc_vu',
        ];
        $inputSearch = [];
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        $users = User::queryList($request->toArray(), auth()->user()->id)->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.tai-khoan.danh-sach-tai-khoan', compact(['users', 'inputSearch', 'thongBaoMoi']));
    }

    // Hàm đăng nhập tài khoản của admin và user
    public function dangNhapTaiKhoan(Request $request){
        $arrUser = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($arrUser, true)){
            if(auth()->user()->kich_hoat == 0)
            {
                Auth::guard('web')->logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tài khoản chưa được kích hoạt!'
                ],200);
            }
            else{
                if(auth()->user()->kich_hoat == 2)
                {
                    Auth::guard('web')->logout();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Tài khoản của Bạn đã bị khóa vui lòng liên hệ với bộ phận chăm sóc khách hàng!'
                    ],200);
                }
                else{
                    $check_user = User::where('email', $request->email)->first();
                    if($check_user->chuc_vu == 'admin'){
                        return response()->json([
                            'status' => 'success_admin',
                        ],200);
                    }
                    else{
                        if($check_user->chuc_vu == 'user')
                        {
                            return response()->json([
                                'status' => 'success_user',
                                'message' => 'Đăng nhập tài khoản thành công!'
                            ],200);
                        }   
                    }
                }
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Email hoặc mật khẩu không chính xác!'
            ],200);
        }
    }
    
    //Hàm đăng xuất tài khoản của admin và user
    public function dangXuatTaiKhoan(){
        Auth::guard('web')->logout();
        return redirect()->route('nguoidung.trang-chu-nguoi-dung');
    }

    // Hàm đăng ký của user
    public function dangKyTaiKhoan(UserRequest $request){
        $ho_ten = $request->ho_ten;
        $email = $request->email;
        $sdt = $request->sdt;
        $dia_chi = $request->dia_chi;
        $mat_khau = $request->mat_khau;
        $check_email = User::where('email', $email)->first();
        if($check_email)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Email Đã Tồn Tại!'
            ],200);
        }else{
            $dk_tai_khoan = new User();
            $dk_tai_khoan->ho_ten = $ho_ten;
            $dk_tai_khoan->email = $email;
            $dk_tai_khoan->sdt = $sdt;
            $dk_tai_khoan->dia_chi = $dia_chi;
            $dk_tai_khoan->chuc_vu = 'user';
            $dk_tai_khoan->password = Hash::make($mat_khau);
            $dk_tai_khoan->save();
            if($dk_tai_khoan){
                $email = $dk_tai_khoan->email;

                $code = bcrypt(md5(time().$email));
                $url = route('nguoidung.xac-nhan-tai-khoan', ['id' => $dk_tai_khoan->id, 'code' => $code]);

                $dk_tai_khoan->ma = $code;
                $dk_tai_khoan->save();

                $data = [
                    'email' => $email,
                    'ho_ten' => $ho_ten,
                    'mat_khau' => $mat_khau,
                    'route' => $url,
                ];
                Mail::to($email)->send(new \App\Mail\XacNhanTaiKhoanMail($data));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vui Lòng Qua Email Xác Nhận Tài Khoản!',
                ],200);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Đăng Ký Tài Khoản Thất Bại!'
        ],200);
    }

    // Xác thực tài khoản bằng cách kích hoạt tài khoản qua email
    public function xacNhanTaiKhoan(Request $request){
        $code = $request->code;
        $id = $request->id;
        $check_user = User::where([
            'ma' => $code,
            'id' => $id
        ])->first();
        if(!$check_user){
            return redirect()->route('nguoidung.trang-chu-nguoi-dung')->with('error_activate', 'Xin lỗi! Đường dẫn xác nhận tài khoản không tồn tại, bạn vui lòng thử lại sau.');
        }
        $check_user->kich_hoat = 1;
        $check_user->save();
        return redirect()->route('nguoidung.trang-chu-nguoi-dung')->with('success_activate', 'Xác nhận tài khoản thành công!');
    }

    // Gửi mail kèm mã otp cho người dùng
    public function guiMaOTP(Request $request){
        $email = $request->email;
        $check_email = User::where([
            'email' => $email,
            'chuc_vu' => 'user'
        ])->first();
        if($check_email){
            $check_email->ma = random_int(10000000,99999999);
            $check_email->save();
            $data = [
                'email' => $check_email->email,
                'ho_ten' => $check_email->ho_ten,
                'ma_otp' => $check_email->ma
            ];
            Mail::to($email)->send(new \App\Mail\GuiMaOTPMail($data));
            return response()->json([
                'status' => 'success',
                'message' => 'Vui Lòng Qua Email Để Nhận Mã OTP!'
            ],200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Email Không Tồn Tại!'
            ],200);
        }
    }
    // Nhập mã otp để được cấp mật khẩu mới
    public function nhapMaOTP(Request $request){
        $email = $request->email_otp;
        $code_otp = $request->code_otp;
        $check_otp = User::where([
            'email' => $email,
            'ma' => $code_otp,
        ])->first();
        if($check_otp){
            $mat_khau = random_int(10000000,99999999);
            $data = [
                'ho_ten' => $check_otp->ho_ten,
                'mat_khau' => $mat_khau
            ];
            Mail::to($email)->send(new \App\Mail\MatKhauMoiMail($data));
            $check_otp->password = Hash::make($mat_khau);
            $check_otp->ma = '';
            $check_otp->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Vui Lòng Qua Email Để Nhận Mật Khẩu Mới!'
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Mã OTP Không Đúng!'
        ],200);
    }

    // Thêm tài khoản admin
    public function themTaiKhoan(UserRequest $request){
        $ho_ten = $request->ho_ten;
        $email = $request->email;
        $sdt = $request->sdt;
        $dia_chi = $request->dia_chi;
        $mat_khau = $request->mat_khau;
        $mat_khau_lai = $request->mat_khau_lai;
        $check_email = User::where('email', $email)->first();
        if($check_email)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Email Đã Tồn Tại!'
            ],200);
        }else{
            if($mat_khau == $mat_khau_lai){
                $them_tai_khoan = new User();
                $them_tai_khoan->ho_ten = $ho_ten;
                $them_tai_khoan->email = $email;
                $them_tai_khoan->sdt = $sdt;
                $them_tai_khoan->dia_chi = $dia_chi;
                $them_tai_khoan->chuc_vu = 'admin';
                $them_tai_khoan->password = Hash::make($mat_khau);
                $them_tai_khoan->kich_hoat = '1';
                $them_tai_khoan->save();
                if($them_tai_khoan){
                    $users = User::queryList([], auth()->user()->id)->paginate(25);
                    $giao_dien_bang = view('admin.tai-khoan.bang-tai-khoan', compact(['users']))->render();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Thêm Tài Khoản Mới Thành Công!',
                        'giao_dien_bang' => $giao_dien_bang,
                    ],200);
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mất Khẩu Không Trùng Khớp!',
                ],200);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm Tài Khoản Mới Thất Bại!'
        ],200);
    }

    // Khóa tài khoản
    public function khoaTaiKhoan($id){
        $check_user = User::where('id', $id)->first();
        $check_user->kich_hoat = 2;
        $check_user->save();
        if($check_user){
            return response()->json([
                'status' => 'success',
                'message' => 'Khóa Tài Khoản Thành Công!',
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Khóa Tài Khoản Thất Bại!',
        ],200);
    }

    // Mở khóa tài khoản
    public function moTaiKhoan($id){
        $check_user = User::where('id', $id)->first();
        $check_user->kich_hoat = 1;
        $check_user->save();
        if($check_user){
            return response()->json([
                'status' => 'success',
                'message' => 'Mở Khóa Tài Khoản Thành Công!',
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Mở Khóa Tài Khoản Thất Bại!',
        ],200);
    }

    // Trang cập nhật thông tin cá nhân của admin
    public function trangCapNhatThongTin(){
        $item_user = User::find(auth()->user()->id);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.tai-khoan.cap-nhat-tai-khoan',compact(['item_user', 'thongBaoMoi']));
    }

    //Cập nhật thông tin cá nhân của admin
    public function capNhatThongTin(CapNhatThongTinRequest $request)
    {
        $ho_ten           = $request->ho_ten;
        $sdt              = $request->sdt;
        $dia_chi          = $request->dia_chi;
        $mat_khau_moi     = $request->mat_khau_moi;
        $mat_khau_lai     = $request->mat_khau_lai;
        $sua_thong_tin    = User::find(auth()->user()->id);
     
        // Xóa avatar thay đổi
        $data_add_avatar = $request->data_add_avatar;
        if(!empty($data_add_avatar)){
            $delete_file_avatar = public_path().'/'.$sua_thong_tin->anh_dai_dien;
            File::delete($delete_file_avatar);
        }
        // Cập nhật thông tin admin
        $sua_thong_tin->ho_ten = $ho_ten;
        $sua_thong_tin->sdt = $sdt;
        $sua_thong_tin->dia_chi = $dia_chi;
        if(!empty($mat_khau_moi)){
            if(!empty($mat_khau_lai)){
                if($mat_khau_moi == $mat_khau_lai){
                    $sua_thong_tin->password = Hash::make($mat_khau_moi);
                }else{
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Mật Khẩu Lại Không Trùng Khớp!'
                    ], 200);
                }
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vui Lòng Nhập Lại Mật Khẩu!'
                ], 200);
            }
        }
        if(!empty($data_add_avatar)){
            // Lưu avatar mới
            // Xử lý thông tin hình ảnh
            $originName = $data_add_avatar->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $data_add_avatar->getClientOriginalExtension();
            // thuộc tính trong cột
            $ten_file_avatar = $fileName . time() . '.' . $extension;
            $sua_thong_tin->anh_dai_dien = 'assets/img/img_avatar/' . $ten_file_avatar;
            $data_add_avatar->move(public_path('assets/img/img_avatar'), $ten_file_avatar);
        }
        $sua_thong_tin->save();
        if($sua_thong_tin){
            return response()->json([
                'status' => 'success',
                'message' => 'Cập Nhật Thông Tin Admin Thành Công!'
            ], 200);
        }     
        return response()->json([
            'status' => 'error',
            'message' => 'Cập Nhật Thông Tin Admin Thất Bại!'
        ], 200);
    }

    // Trang xem thông tin tài khoản của những khách hàng và admin
    public function thongTinTaiKhoan($slug, $id){
        $item_user = User::find($id);
        $dsDonHang = DonHang::queryDSDonHangIDNguoiDung($id)->get();
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.tai-khoan.thong-tin-tai-khoan',compact(['item_user', 'dsDonHang', 'thongBaoMoi']));
    }

    public function xemThemNuocHoa(Request $request){
        if ($request->ajax()) {
            $inputSearch = [
                'gioi_tinh_id' => $request->gioi_tinh_id,
                'thuong_hieu_id' => $request->thuong_hieu_id,
                'dung_tich_id' => $request->dung_tich_id,
                'gia_tien_lon' => $request->gia_tien_lon,
                'gia_tien_nho' => $request->gia_tien_nho,
            ];
            $lastId = '';
            $minId = NuocHoa::min('id');
            if($minId < $request->last_id){
                $dsNuocHoa = NuocHoa::queryDSNuocHoaXemThem('', $request->last_id, $inputSearch)->get();
                if(count($dsNuocHoa) != 0){
                    return view('trang-chu.nuoc-hoa', compact(['dsNuocHoa', 'lastId']));
                }
                return;
               
            }
        }
    }

    public function timKiemTheoTen(Request $request)
    {  
        $data = NuocHoa::queryTimKiemTuDong($request->value)->get();
        return response()->json($data); 
    }
}
