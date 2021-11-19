<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhuyenMai;
use App\Http\Requests\KhuyenMaiRequest;
use Exception;
use Carbon\Carbon;
use App\ThongBao;

class KhuyenMaiController extends Controller
{
    public function quanLyKhuyenMai(Request $request)
    {
        $arrKey = [
            'ten_khuyen_mai',
        ];
        $inputSearch = [];
        foreach ($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }
        $dsKhuyenMai = KhuyenMai::queryDSKhuyenMai($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.khuyen-mai.danh-sach-khuyen-mai', compact(['inputSearch', 'dsKhuyenMai', 'thongBaoMoi']));
    }

    // trang thêm khuyến mãi
    public function trangThemKhuyenMai()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d\TH:i');
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.khuyen-mai.them-khuyen-mai', compact(['now', 'thongBaoMoi']));
    }

    // Thêm khuyến mãi
    public function themKhuyenMai(KhuyenMaiRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ten_khuyen_mai     = $request->ten_khuyen_mai;
        $gia_khuyen_mai     = $request->gia_khuyen_mai;
        $ngay_bat_dau       = $request->ngay_bat_dau;
        $ngay_ket_thuc      = $request->ngay_ket_thuc;
        $vo_han             = $request->vo_han;

        $check_ten          = KhuyenMai::where('ten_khuyen_mai', $ten_khuyen_mai)->first();
        if($check_ten){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Khuyến Mãi Đã Tồn Tại!'
            ], 200);
        }else{
            $them_khuyen_mai = new KhuyenMai();
            $them_khuyen_mai->ten_khuyen_mai = $ten_khuyen_mai;
            $them_khuyen_mai->gia_khuyen_mai = $gia_khuyen_mai;
            $them_khuyen_mai->ngay_bat_dau = $ngay_bat_dau;
            if($vo_han == null){
                $them_khuyen_mai->ngay_ket_thuc = $ngay_ket_thuc;
            }
            $them_khuyen_mai->save();
            
            if($them_khuyen_mai){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Thêm Khuyến Mãi Mới Thành Công!'
                ], 200);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Thêm Khuyến Mãi Mới Thất Bại!'
            ], 200); 

        }

    }

    // Xóa Khuyến Mãi
    public function xoaKhuyenMai($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            // Cập nhật lại khuyến mãi nước hoa bằng null
            KhuyenMai::querycapNhapNuocHoa($id)->get();
            KhuyenMai::find($id)->delete();
            $dsKhuyenMai = KhuyenMai::queryDSKhuyenMai([])->paginate(25);
            $giao_dien_bang_khuyen_mai = view('admin.khuyen-mai.bang-khuyen-mai', compact(['dsKhuyenMai']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Khuyến Mãi Thành Công!',
                'giao_dien_bang_khuyen_mai' => $giao_dien_bang_khuyen_mai,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Khuyến Mãi Thất Bại!'
            ], 200);
        }
    }

    // Chi tiết khuyến mãi
    public function chiTietKhuyenMai($slug, $id){
        $timKhuyenMai = KhuyenMai::find($id);
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d\TH:i');
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.khuyen-mai.cap-nhat-khuyen-mai',compact(['timKhuyenMai', 'now', 'thongBaoMoi']));
    }

    // Cập nhật khuyến mãi
    public function capNhatKhuyenMai(KhuyenMaiRequest $request, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ten_khuyen_mai     = $request->ten_khuyen_mai;
        $gia_khuyen_mai     = $request->gia_khuyen_mai;
        $ngay_bat_dau       = $request->ngay_bat_dau;
        $ngay_ket_thuc      = $request->ngay_ket_thuc;
        $vo_han             = $request->vo_han;

        $sua_khuyen_mai     = KhuyenMai::where('id',$request->id)->first();

        $check_ten          = KhuyenMai::where([['ten_khuyen_mai',$ten_khuyen_mai],['id','!=',$id]])->first();
        if($check_ten){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Khuyến Mãi Đã Tồn Tại!'
            ], 200);
        }else{
            $sua_khuyen_mai->ten_khuyen_mai = $ten_khuyen_mai;
            $sua_khuyen_mai->gia_khuyen_mai = $gia_khuyen_mai;
            $sua_khuyen_mai->ngay_bat_dau = $ngay_bat_dau;
            if($vo_han == null){
                $sua_khuyen_mai->ngay_ket_thuc = $ngay_ket_thuc;
            }else{
                $sua_khuyen_mai->ngay_ket_thuc = null;
            }
            $sua_khuyen_mai->save();
            
            if($sua_khuyen_mai){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật Khuyến Mãi Thành Công!'
                ], 200);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Cập Nhật Khuyến Mãi Thất Bại!'
            ], 200); 

        }
    }
}
