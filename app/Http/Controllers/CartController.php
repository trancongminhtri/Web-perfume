<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\NuocHoa;
use Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\DonHang;
use App\ChiTietDonHang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Events\ThongBaoMoi;
use App\ThongBao;
use Carbon\Carbon;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function AddCart(Request $req, $id){
        $nuocHoa = NuocHoa::queryThongTinNuocHoaID($id)->first();
        if($nuocHoa != null){
            // Cart là một key value thích đặt j đặt
            $oldcart = Session('Cart') ? Session('Cart') : null;  // giỏ hàng hiện tại
            $newCart = new Cart($oldcart); // giỏ hàng khi thêm mới
            
            $newCart->AddCart($nuocHoa, $id);
            $req->session()->put('Cart', $newCart);
        }
        $danh_sach_gio_hang = view('trang-gio-hang.danh-sach-gio-hang')->render();
        $gio_hang = view('gio-hang')->render();
        return response()->json([
                                    'danh-sach-gio-hang'=>$danh_sach_gio_hang,
                                    'gio-hang'=>$gio_hang,
                                ]);
    }

     // Xóa sản phẩm khỏi giỏ hàng
     public function DeleteItemCart(Request $req, $id){ 
        // Cart là một key value thích đặt j đặt
        $oldcart = Session('Cart') ? Session('Cart') : null;  // giỏ hàng hiện tại
        $newCart = new Cart($oldcart); // giỏ hàng khi thêm mới
        $newCart->DeleteItemCart($id);
        if(Count($newCart->dsNuocHoa) > 0){
            $req->session()->put('Cart', $newCart);
        }
        else{
            $req->session()->forget('Cart');
        }
        $danh_sach_gio_hang = view('trang-gio-hang.danh-sach-gio-hang')->render();
        $gio_hang = view('gio-hang')->render();
        return response()->json([
                                    'danh-sach-gio-hang'=>$danh_sach_gio_hang,
                                    'gio-hang'=>$gio_hang,
                                ]);
    }

    // Trang giỏ hàng
    public function trangGioHang(){
        return view('trang-gio-hang.trang-gio-hang');
    }

     // Xóa sản phẩm khỏi danh sách giỏ hàng
     public function DeleteItemListCart(Request $req, $id){ 
        // Cart là một key value thích đặt j đặt
        $oldcart = Session('Cart') ? Session('Cart') : null;  // giỏ hàng hiện tại
        $newCart = new Cart($oldcart); // giỏ hàng khi thêm mới
        $newCart->DeleteItemCart($id);
        if(Count($newCart->dsNuocHoa) > 0){
            $req->session()->put('Cart', $newCart);
        }
        else{
            $req->session()->forget('Cart');
        }
        $danh_sach_gio_hang = view('trang-gio-hang.danh-sach-gio-hang')->render();
        $gio_hang = view('gio-hang')->render();
        return response()->json([
                                    'danh-sach-gio-hang'=>$danh_sach_gio_hang,
                                    'gio-hang'=>$gio_hang,
                                ]);
    }

    // Cập nhật số lượng sản phẩm trong danh sách giỏ hàng
    public function UpdateItemListCart(Request $req, $id, $so_luong){ 
        // Cart là một key value thích đặt j đặt
        $oldcart = Session('Cart') ? Session('Cart') : null;  // giỏ hàng hiện tại
        $newCart = new Cart($oldcart); // giỏ hàng khi thêm mới
        $newCart->UpdateItemCart($id, $so_luong);
        $req->session()->put('Cart', $newCart);
        $danh_sach_gio_hang = view('trang-gio-hang.danh-sach-gio-hang')->render();
        $gio_hang = view('gio-hang')->render();
        return response()->json([
                                    'danh-sach-gio-hang'=>$danh_sach_gio_hang,
                                    'gio-hang'=>$gio_hang,
                                ]);
    }

    // Trang thanh toán 
    public function trangThanhToan(){
        if (Auth::check()) {
            return view('thanh-toan');
        }
    }

    // Thanh toán hóa đơn 
    public function thanhToanDonHang(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // Cột hóa đơn
        $tong_tien = $request->tong_tien;
        $tong_tien_giam = $request->tong_tien_giam;
        $tong_so_luong = $request->tong_so_luong;
        $tong_thanh_toan = $request->tong_thanh_toan;
        $dia_diem = $request->dia_diem;
        $sdt = $request->sdt;
        $ten_khach_hang = $request->ten_khach_hang;

        $ds_gio_hang = Session('Cart') ? Session('Cart') : null;
        if($ds_gio_hang != null){
            // Kiểm tra số lượng mua và số lượng trong kho
            foreach($ds_gio_hang->dsNuocHoa as $gio_hang){
                $kho_nuoc_hoa = NuocHoa::where('id',$gio_hang['thongTinNuocHoa']->id)->first();
                if($kho_nuoc_hoa->so_luong_ton < $gio_hang['soLuong']){
                    return response()->json([
                        'status' => 'error',
                        'message' => $kho_nuoc_hoa->ten_nuoc_hoa . ' còn ' . $kho_nuoc_hoa->so_luong_ton . ' sản phẩm!',
                    ],200);
                }
                
            }

            $them_don_hang = new DonHang();
            $them_don_hang->id = Str::uuid()->toString();
            $them_don_hang->khach_hang_id = auth()->user()->id;
            $them_don_hang->tong_tien = $tong_tien;
            $them_don_hang->tong_tien_giam = $tong_tien_giam;
            $them_don_hang->tong_so_luong = $tong_so_luong;
            $them_don_hang->tong_thanh_toan = $tong_thanh_toan;
            $them_don_hang->dia_diem = $dia_diem;
            $them_don_hang->sdt = $sdt;
            $them_don_hang->ten_khach_hang = $ten_khach_hang;
            $them_don_hang->trang_thai_id = 1;

            $them_don_hang->save();

            if($them_don_hang){
                $data = [
                    'id_don_hang' => $them_don_hang->id,
                    'sdt' => $them_don_hang->sdt,
                    'ten_khach_hang' => $them_don_hang->ten_khach_hang,
                    'dia_diem' => $them_don_hang->dia_diem,
                    'tong_tien' => $them_don_hang->tong_tien,
                    'tong_tien_giam' => $them_don_hang->tong_tien_giam,
                    'tong_so_luong' => $them_don_hang->tong_so_luong,
                    'tong_thanh_toan' => $them_don_hang->tong_thanh_toan,   
                    'ds_gio_hang' => $ds_gio_hang,
                    'trang_thai' => 'Đang xử lý đơn hàng',
                ];
                Mail::to(auth()->user()->email)->send(new \App\Mail\ThongTinDonHangMail($data));
                foreach($ds_gio_hang->dsNuocHoa as $gio_hang){
                    // Thêm thông tin vào bảng chi tiết nước hoa
                    $them_chi_tiet = new ChiTietDonHang();
                    $them_chi_tiet->don_hang_id = $them_don_hang->id;
                   
                    $them_chi_tiet->nuoc_hoa_id = $gio_hang['thongTinNuocHoa']->id;
                    $them_chi_tiet->so_luong_san_pham = $gio_hang['soLuong'];
                    $them_chi_tiet->gia_tien_goc = $gio_hang['thongTinNuocHoa']->gia_tien;
                    $them_chi_tiet->gia_tien_km = $gio_hang['giaKhuyenMai'];
                    $them_chi_tiet->thanh_toan = $gio_hang['giaTien'];

                    // Từ số lượng tồn trong nước hoa
                    $nuoc_hoa = NuocHoa::where('id', $them_chi_tiet->nuoc_hoa_id)->first();
                    $nuoc_hoa->so_luong_ton -= $gio_hang['soLuong'];
                    $nuoc_hoa->trang_thai      = $nuoc_hoa->so_luong_ton <= 4 ? false : true;
                    $nuoc_hoa->save();
                    $them_chi_tiet->save();
                    session()->forget('Cart');
                }
                $noi_dung_thong_bao = [
                    'nguoi_dung' => auth()->user()->email,
                    'don_hang_id' => $them_don_hang->id,
                    'thoi_gian' => Carbon::now('Asia/Ho_Chi_Minh'),
                ];
                // Lưu thông tin vào bảng thông báo
                $them_thong_bao = new ThongBao();
                $them_thong_bao->nguoi_dung_id = auth()->user()->id;
                $them_thong_bao->noi_dung = json_encode($noi_dung_thong_bao);
                // dd(json_decode($them_thong_bao->noi_dung, true));
                $them_thong_bao->save();

                event(new ThongBaoMoi($noi_dung_thong_bao));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Đơn Hàng Của Bạn Đã Được Xác Nhận
                                  Chúng Tôi Sẽ Liên Hệ Bạn Trong Ít Phút Nữa!',
                ],200);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Chưa Có Sản Phẩm Trong Giỏ Hàng!',
            ],200);
        }

        
    }
}
