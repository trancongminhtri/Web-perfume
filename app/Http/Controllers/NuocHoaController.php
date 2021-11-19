<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DungTich;
use App\GioiTinh;
use App\HuongThom;
use App\HuongThomNuocHoa;
use App\NongDo;
use App\ThuongHieu;
use App\NuocHoa;
use App\AnhBiaNuocHoa;
use App\DanhMucSanPham;
use App\KhuyenMai;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ThemNuocHoaRequest;
use App\Http\Requests\CapNhatNuocHoaRequest;
use Exception;
use Illuminate\Support\Facades\File;
use App\ThongBao;
class NuocHoaController extends Controller
{
    public function quanLyNuocHoa(Request $request)
    {
        $arrKey = [
            'ten_nuoc_hoa',
            'gioi_tinh_id',
            'thuong_hieu_id',
            'nong_do_id'
        ];
        $inputSearch = [];
        foreach ($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }
        $dsGioiTinh = GioiTinh::all();
        $dsHuongThom = HuongThom::queryDSHuongThomTangDan()->get();
        $dsNongDo = NongDo::all();
        $dsThuongHieu = ThuongHieu::queryDSThuongHieuTangDan()->get();
        $dsNuocHoa = NuocHoa::queryDSNuocHoa($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        
        return view('admin.nuoc-hoa.danh-sach-nuoc-hoa', compact(['dsGioiTinh', 'dsHuongThom', 'dsNongDo', 'dsThuongHieu', 'dsNuocHoa', 'inputSearch', 'thongBaoMoi']));
    }

    // Trang thêm nước hoa
    public function trangThemNuocHoa()
    {
        $dsDungTich = DungTich::all();
        $dsGioiTinh = GioiTinh::all();
        $dsHuongThom = HuongThom::queryDSHuongThomTangDan()->get();
        $dsNongDo = NongDo::all();
        $dsThuongHieu = ThuongHieu::queryDSThuongHieuTangDan()->get();
        $dsKhuyenMai = KhuyenMai::queryDSKhuyenMaiTangDan()->get();
        $dsDanhMuc = DanhMucSanPham::queryDSDanhMucTangDan()->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();

        return view('admin.nuoc-hoa.them-nuoc-hoa', compact(['dsDungTich', 'dsGioiTinh', 'dsHuongThom', 'dsNongDo', 'dsThuongHieu', 'dsKhuyenMai', 'dsDanhMuc', 'now', 'thongBaoMoi']));
    }

    // Thêm nước hoa
    public function themNuocHoa(ThemNuocHoaRequest $request)
    {
        $ten_nuoc_hoa           = $request->ten_nuoc_hoa;
        $nam_phat_hanh          = $request->nam_phat_hanh;
        $nha_pha_che            = $request->nha_pha_che;
        $gia_tien               = $request->gia_tien;
        $so_luong_ton           = $request->so_luong_ton;
        $gioi_tinh_id           = $request->gioi_tinh;
        $danh_muc_id            = $request->danh_muc;
        $thuong_hieu_id         = $request->thuong_hieu;
        $nong_do_id             = $request->nong_do;
        $dung_tich_id           = $request->dung_tich;
        $khuyen_mai_id          = $request->khuyen_mai;
        $bai_viet               = $request->bai_viet;
        $checkTen = NuocHoa::where('ten_nuoc_hoa', $ten_nuoc_hoa)->first();
        if ($checkTen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Nước Hoa Đã Tồn Tại!'
            ], 200);
        } else {
            // Thêm nước hoa
            $them_nuoc_hoa = new NuocHoa();
            $them_nuoc_hoa->ten_nuoc_hoa    = $ten_nuoc_hoa;
            $them_nuoc_hoa->nam_phat_hanh   = !empty($nam_phat_hanh) ? Carbon::createFromFormat('Y', $nam_phat_hanh) : null;
            $them_nuoc_hoa->nha_pha_che     = $nha_pha_che;
            $them_nuoc_hoa->gia_tien        = $gia_tien;
            $them_nuoc_hoa->so_luong_ton    = $so_luong_ton;
            $them_nuoc_hoa->gioi_tinh_id    = $gioi_tinh_id;
            $them_nuoc_hoa->danh_muc_id     = $danh_muc_id;
            $them_nuoc_hoa->thuong_hieu_id  = $thuong_hieu_id;
            $them_nuoc_hoa->nong_do_id      = $nong_do_id;
            $them_nuoc_hoa->dung_tich_id    = $dung_tich_id;
            $them_nuoc_hoa->khuyen_mai_id   = $khuyen_mai_id;
            $them_nuoc_hoa->bai_viet        = $bai_viet;
            $them_nuoc_hoa->trang_thai      = $so_luong_ton <= 4 ? false : true;
            $them_nuoc_hoa->save();
            if ($them_nuoc_hoa) {
                // Lưu ảnh bìa nước hoa
                $data_input_banner = $request->data_input_banner;
                for ($i = 0; $i < count($data_input_banner); $i++) {
                    $them_banner = new AnhBiaNuocHoa();
                    // Xử lý thông tin hình ảnh
                    $originName = $data_input_banner[$i]->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $data_input_banner[$i]->getClientOriginalExtension();
                    // thuộc tính trong cột
                    $them_banner->ten = $fileName . time() . '.' . $extension;
                    $them_banner->duong_dan = 'assets/img/img_banner/' . $them_banner->ten;
                    $them_banner->nuoc_hoa_id = $them_nuoc_hoa->id;
                    $data_input_banner[$i]->move(public_path('assets/img/img_banner'), $them_banner->ten);
                    $them_banner->save();
                }
                // Lưu ảnh hương thơm
                $data_input_checkbox = $request->data_input_checkbox;
                if ($data_input_checkbox != null) {
                    for ($i = 0; $i < count($data_input_checkbox); $i++) {
                        $them_hth_nh = new HuongThomNuocHoa();
                        $them_hth_nh->nuoc_hoa_id = $them_nuoc_hoa->id;
                        $them_hth_nh->huong_thom_id = $data_input_checkbox[$i];
                        $them_hth_nh->save();
                    }
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Thêm Nước Hoa Mới Thành Công!'
                ], 200);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Thêm Nước Hoa Mới Thất Bại!'
            ], 200);
        }
    }

    // Ckeditor Upload
    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('assets/img/img_ckeditor'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/assets/img/img_ckeditor/' . $fileName);
            $msg = 'Image upload successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    // Xóa nước hoa
    public function xoaNuocHoa($id)
    {
        try {
            NuocHoa::find($id)->delete();
            $dsNuocHoa = NuocHoa::queryDSNuocHoa([])->paginate(25);
            $dsGioiTinh = GioiTinh::all();
            $giao_dien_bang_nuoc_hoa = view('admin.nuoc-hoa.bang-nuoc-hoa', compact(['dsNuocHoa', 'dsGioiTinh']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Nước Hoa Thành Công!',
                'giao_dien_bang_nuoc_hoa' => $giao_dien_bang_nuoc_hoa,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Nước Hoa Thất Bại!'
            ], 200);
        }
    }

    // Chi tiết nước hoa
    public function chiTietNuocHoa($slug, $id){
        $dsDungTich = DungTich::all();
        $dsGioiTinh = GioiTinh::all();
        $dsHuongThom = HuongThom::queryDSHuongThomTangDan()->get();
        $dsNongDo = NongDo::all();
        $dsThuongHieu = ThuongHieu::queryDSThuongHieuTangDan()->get();
        $dsKhuyenMai = KhuyenMai::queryDSKhuyenMaiTangDan()->get();
        $dsDanhMuc = DanhMucSanPham::queryDSDanhMucTangDan()->get();
        $timNuocHoa = NuocHoa::find($id);
        $dsBanner = AnhBiaNuocHoa::where('nuoc_hoa_id', $timNuocHoa->id)->get();
        $maxBanner = AnhBiaNuocHoa::where('nuoc_hoa_id', $timNuocHoa->id)->max('id');
        $dsHThomNHoa = HuongThomNuocHoa::where('nuoc_hoa_id', $id)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();

        return view("admin.nuoc-hoa.cap-nhat-nuoc-hoa",compact(['dsDungTich', 'dsGioiTinh', 'dsHuongThom', 'dsNongDo', 'dsThuongHieu', 'dsKhuyenMai', 'dsDanhMuc', 'timNuocHoa', 'dsBanner', 'maxBanner', 'dsHThomNHoa', 'now', 'thongBaoMoi']));
    }
    
    // Cập nhật nước hoa
    public function capNhatNuocHoa(CapNhatNuocHoaRequest $request, $id)
    {
        $sua_nuoc_hoa            = NuocHoa::where('id',$request->id)->first();
        $ten_nuoc_hoa            = $request->ten_nuoc_hoa;
        $nam_phat_hanh           = $request->nam_phat_hanh;
        $nha_pha_che             = $request->nha_pha_che;
        $gia_tien                = $request->gia_tien;
        $so_luong_ton            = $request->so_luong_ton;
        $gioi_tinh_id            = $request->gioi_tinh;
        $danh_muc_id             = $request->danh_muc;
        $thuong_hieu_id          = $request->thuong_hieu;
        $nong_do_id              = $request->nong_do;
        $dung_tich_id            = $request->dung_tich;
        $khuyen_mai_id           = $request->khuyen_mai;
        $bai_viet                = $request->bai_viet;

        $checkTen = NuocHoa::where([['ten_nuoc_hoa',$ten_nuoc_hoa],['id','!=',$id]])->first();
        if($checkTen){
            return response()->json([
                'status'=>'error',
                'message'=>'Tên Nước Hoa Đã Tồn Tại !'
            ],200);
        }
        else {
            // Cập nhật nước hoa
                $sua_nuoc_hoa->ten_nuoc_hoa    = $ten_nuoc_hoa;
                $sua_nuoc_hoa->nam_phat_hanh   = !empty($nam_phat_hanh) ? Carbon::createFromFormat('Y', $nam_phat_hanh) : null;
                $sua_nuoc_hoa->nha_pha_che     = $nha_pha_che;
                $sua_nuoc_hoa->gia_tien        = $gia_tien;
                $sua_nuoc_hoa->so_luong_ton    = $so_luong_ton;
                $sua_nuoc_hoa->gioi_tinh_id    = $gioi_tinh_id;
                $sua_nuoc_hoa->danh_muc_id     = $danh_muc_id;
                $sua_nuoc_hoa->thuong_hieu_id  = $thuong_hieu_id;
                $sua_nuoc_hoa->nong_do_id      = $nong_do_id;
                $sua_nuoc_hoa->dung_tich_id    = $dung_tich_id;
                $sua_nuoc_hoa->khuyen_mai_id   = $khuyen_mai_id;
                $sua_nuoc_hoa->bai_viet        = $bai_viet;
                $sua_nuoc_hoa->trang_thai      = $so_luong_ton <= 4 ? false : true;
                $sua_nuoc_hoa->save();

            if ($sua_nuoc_hoa) {
                // Xóa ảnh bìa thay đổi
                $xoa_id_banner = $request->data_delete_banner;
                if(!empty($xoa_id_banner)){
                    for($i = 0; $i < count($xoa_id_banner); $i++){
                        $check_banner = AnhBiaNuocHoa::where('id', $xoa_id_banner[$i])->first();
                        $duong_dan_banner = public_path().'/assets/img/img_banner/'.$check_banner->ten;
                        File::delete($duong_dan_banner);
                        $check_banner->delete();
                    }
                }
                // Lưu ảnh bìa nước hoa
                $data_add_banner  = $request->data_add_banner;
                if($data_add_banner != null){
                    for($i = 0; $i < count($data_add_banner); $i++){
                        $them_banner = new AnhBiaNuocHoa();
                        // Xử lý thông tin hình ảnh
                        $originName = $data_add_banner[$i]->getClientOriginalName();
                        $fileName = pathinfo($originName, PATHINFO_FILENAME);
                        $extension = $data_add_banner[$i]->getClientOriginalExtension();
                        // thuộc tính trong cột
                        $them_banner->ten = $fileName . time() . '.' . $extension;
                        $them_banner->duong_dan = 'assets/img/img_banner/' . $them_banner->ten;
                        $them_banner->nuoc_hoa_id = $sua_nuoc_hoa->id;
                        $data_add_banner[$i]->move(public_path('assets/img/img_banner'), $them_banner->ten);
                        $them_banner->save();
                    }
                }

                // Lưu ảnh hương thơm
                $data_input_checkbox = $request->data_input_checkbox;
                if ($data_input_checkbox != null) {
                    // Xóa hương thơm
                    $ds_hthom_nhoa = HuongThomNuocHoa::where('nuoc_hoa_id', $sua_nuoc_hoa->id)->delete();
                    for ($i = 0; $i < count($data_input_checkbox); $i++) {
                        $them_hth_nh = new HuongThomNuocHoa();
                        $them_hth_nh->nuoc_hoa_id = $sua_nuoc_hoa->id;
                        $them_hth_nh->huong_thom_id = $data_input_checkbox[$i];
                        $them_hth_nh->save();
                    }
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật Nước Hoa Thành Công!'
                ], 200);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Cập Nhật Nước Hoa Thất Bại!'
            ], 200);
        }
    }
}
