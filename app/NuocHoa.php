<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NuocHoa extends Model
{
    use SoftDeletes;
    protected $table = 'nuoc_hoa';

    public function dungTich(){
        return $this->belongsTo('App\DungTich', 'id', 'dung_tich_id');
    }

    public function gioiTinh(){
        return $this->belongsTo('App\GioiTinh', 'id', 'gioi_tinh_id');
    }

    public function nongDo(){
        return $this->belongsTo('App\NongDo', 'id', 'nong_do_id');
    }

    public function thuongHieu(){
        return $this->belongsTo('App\ThuongHieu', 'id', 'thuong_hieu_id')->withTrashed();
    }

    public function huongThom(){
        return $this->belongsToMany('App\HuongThom', 'huong_thom_nuoc_hoa', 'nuoc_hoa_id', 'huong_thom_id')->withTrashed();
    }

    public function khuyenMai(){
        return $this->belongsTo('App\KhuyenMai','id','khuyen_mai_id')->withTrashed();
    }

    public function danhMucSanPham(){
        return $this->belongsTo('App\DanhMucSanPham','id','danh_muc_id')->withTrashed();
    }

    // Danh sách nước hoa được tìm kiếm, sắp xếp tăng dàng theo tên
    public function scopeQueryDSNuocHoa($query, $req){
        $query  ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                ->select([
                    'nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'khuyen_mai.ten_khuyen_mai', 'danh_muc_san_pham.ten_danh_muc',
                    'App\NuocHoa'::raw("nuoc_hoa.gia_tien - (nuoc_hoa.gia_tien * (khuyen_mai.gia_khuyen_mai / 100)) as gia_tien_khuyen_mai"),
                ]);
        if(!empty($req['ten_nuoc_hoa'])){
            $query->where('ten_nuoc_hoa', 'like', "%{$req['ten_nuoc_hoa']}%");
        }
        if(!empty($req['gioi_tinh_id'])){
            $query->where('gioi_tinh_id', "{$req['gioi_tinh_id']}");
        }
        if(!empty($req['nong_do_id'])){
            $query->where('nong_do_id', "{$req['nong_do_id']}");
        }
        if(!empty($req['thuong_hieu_id'])){
            $query->where('thuong_hieu_id', "{$req['thuong_hieu_id']}");
        }
        return $query->orderBy('nuoc_hoa.id', 'DESC');
    }

    // Danh sách nước hoa sắp xếp tằng dần theo tên
    public function scopeQueryDSNuocHoaTangDan($query){
        return $query->orderBy('id');
    }

    // Danh sách nước hoa sắp xếp giảm dần theo ngày tạo
    public function scopeQueryDSNuocHoaMoi($query, $req){
        $query  ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                ->leftJoin('nhan_xet_va_danh_gia', 'nuoc_hoa.id', '=', 'nhan_xet_va_danh_gia.nuoc_hoa_id')
                ->select(['nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan',  
                            'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                            'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu',
                            'App\NhanXetDanhGia'::raw("FLOOR(AVG(nhan_xet_va_danh_gia.diem_danh_gia)) as diem_danh_gia_tb"), 
                        ])
                ->groupBy('nuoc_hoa.id')
                ->limit(10);

                if(!empty($req['ten_nuoc_hoa'])){
                    $query->where('ten_nuoc_hoa', 'like', "%{$req['ten_nuoc_hoa']}%");
                }
                if(!empty($req['gioi_tinh_id'])){
                    $query->where('gioi_tinh_id', "{$req['gioi_tinh_id']}");
                }
                if(!empty($req['dung_tich_id'])){
                    $query->where('dung_tich_id', "{$req['dung_tich_id']}");
                }
                if(!empty($req['thuong_hieu_id'])){
                    $query->where('thuong_hieu_id', "{$req['thuong_hieu_id']}");
                }
                if(!empty($req['gia_tien_lon'])){
                    $query->where('gia_tien', '<=', "{$req['gia_tien_lon']}");
                }
                if(!empty($req['gia_tien_nho'])){
                    $query->where('gia_tien', '>=', "{$req['gia_tien_nho']}");
                }

        return $query->orderBy('nuoc_hoa.id', 'DESC');
    }

    // Thông tin nước hoa theo id
    public function scopeQueryThongTinNuocHoaID($query, $id){
        return $query   ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                        ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                        ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                        ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                        ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                        ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                        ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                        ->where('nuoc_hoa.id', $id)
                        ->select('nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan', 
                                    'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                                    'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu');
    }

    // Danh sách hình ảnh nước hoa
    public function dsAnhBiaNuocHoa(){
        return $this->hasMany('App\AnhBiaNuocHoa', 'nuoc_hoa_id', 'id');
    }

    // Danh sách nước hoa theo thương hiệu
    public function scopeQueryDSNuocHoaLienQuan($query, $thuong_hieu_id, $nuoc_hoa_id){
        return $query   ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                        ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                        ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                        ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                        ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                        ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                        ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                        ->leftJoin('nhan_xet_va_danh_gia', 'nuoc_hoa.id', '=', 'nhan_xet_va_danh_gia.nuoc_hoa_id')
                        ->select(['nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan', 
                                    'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                                    'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu','App\NhanXetDanhGia'::raw("FLOOR(AVG(nhan_xet_va_danh_gia.diem_danh_gia)) as diem_danh_gia_tb")
                                ])
                        ->where([
                                    ['thuong_hieu.id', $thuong_hieu_id],
                                    ['nuoc_hoa.id', '!=', $nuoc_hoa_id],
                                ])
                        ->groupBy('nuoc_hoa.id')
                        ->limit(10)
                        ->orderBy('nuoc_hoa.created_at', 'desc');
    }

    // Danh sách nước hoa theo danh mục
    public function scopeQueryDSNuocHoaDanhMuc($query, $req, $id){
        $query  ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                ->leftJoin('nhan_xet_va_danh_gia', 'nuoc_hoa.id', '=', 'nhan_xet_va_danh_gia.nuoc_hoa_id')
                ->select(['nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan',  
                            'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                            'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu',
                            'App\NhanXetDanhGia'::raw("FLOOR(AVG(nhan_xet_va_danh_gia.diem_danh_gia)) as diem_danh_gia_tb"),
                        ])
                ->where('nuoc_hoa.danh_muc_id', $id)
                ->groupBy('nuoc_hoa.id')
                ->limit(10);
                if(!empty($req['ten_nuoc_hoa'])){
                    $query->where('ten_nuoc_hoa', 'like', "%{$req['ten_nuoc_hoa']}%");
                }
                if(!empty($req['gioi_tinh_id'])){
                    $query->where('gioi_tinh_id', "{$req['gioi_tinh_id']}");
                }
                if(!empty($req['dung_tich_id'])){
                    $query->where('dung_tich_id', "{$req['dung_tich_id']}");
                }
                if(!empty($req['thuong_hieu_id'])){
                    $query->where('thuong_hieu_id', "{$req['thuong_hieu_id']}");
                }
                if(!empty($req['gia_tien_lon'])){
                    $query->where('gia_tien', '<=', "{$req['gia_tien_lon']}");
                }
                if(!empty($req['gia_tien_nho'])){
                    $query->where('gia_tien', '>=', "{$req['gia_tien_nho']}");
                }

        return $query->orderBy('nuoc_hoa.id', 'DESC');
    }

    // Danh sách nước hoa theo danh mục khi xem thêm
    public function scopeQueryDSNuocHoaXemThem($query, $id, $last_id, $req){
        $query  ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                ->leftJoin('nhan_xet_va_danh_gia', 'nuoc_hoa.id', '=', 'nhan_xet_va_danh_gia.nuoc_hoa_id')
                ->select('nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan',  
                            'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                            'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu',
                            'App\NhanXetDanhGia'::raw("FLOOR(AVG(nhan_xet_va_danh_gia.diem_danh_gia)) as diem_danh_gia_tb"))
                ->groupBy('nuoc_hoa.id')
                ->limit(10);

                if(!empty($id)){
                    $query->where('nuoc_hoa.danh_muc_id', '=',$id);
                }

                if(!empty($last_id)){
                    $query->where('nuoc_hoa.id', '<',$last_id);
                }
                
                if(!empty($req['gioi_tinh_id'])){
                    $query->where('gioi_tinh_id', "{$req['gioi_tinh_id']}");
                }
                if(!empty($req['dung_tich_id'])){
                    $query->where('dung_tich_id', "{$req['dung_tich_id']}");
                }
                if(!empty($req['thuong_hieu_id'])){
                    $query->where('thuong_hieu_id', "{$req['thuong_hieu_id']}");
                }
                if(!empty($req['gia_tien_lon'])){
                    $query->where('gia_tien', '<=', "{$req['gia_tien_lon']}");
                }
                if(!empty($req['gia_tien_nho'])){
                    $query->where('gia_tien', '>=', "{$req['gia_tien_nho']}");
                }
                
        return $query->orderBy('nuoc_hoa.id', 'DESC');
    }

    public function scopeQueryTimKiemTuDong($query, $req){
        $query  ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                ->where('ten_nuoc_hoa', 'like', '%' . $req . '%')
                ->groupBy('nuoc_hoa.id')
                ->select('nuoc_hoa.ten_nuoc_hoa as name', 'anh_bia_nuoc_hoa.duong_dan as img');
        return $query;
    }

    // Danh sách nước hoa theo khuyến mãi
    public function scopeQueryDSNuocHoaKhuyenMai($query, $req, $id){
        $query  ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                ->leftJoin('nhan_xet_va_danh_gia', 'nuoc_hoa.id', '=', 'nhan_xet_va_danh_gia.nuoc_hoa_id')
                ->select(['nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan',  
                            'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                            'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu',
                            'App\NhanXetDanhGia'::raw("FLOOR(AVG(nhan_xet_va_danh_gia.diem_danh_gia)) as diem_danh_gia_tb"),
                        ])
                ->where('nuoc_hoa.khuyen_mai_id', $id)
                ->groupBy('nuoc_hoa.id')
                ->limit(10);
                if(!empty($req['ten_nuoc_hoa'])){
                    $query->where('ten_nuoc_hoa', 'like', "%{$req['ten_nuoc_hoa']}%");
                }
                if(!empty($req['gioi_tinh_id'])){
                    $query->where('gioi_tinh_id', "{$req['gioi_tinh_id']}");
                }
                if(!empty($req['dung_tich_id'])){
                    $query->where('dung_tich_id', "{$req['dung_tich_id']}");
                }
                if(!empty($req['thuong_hieu_id'])){
                    $query->where('thuong_hieu_id', "{$req['thuong_hieu_id']}");
                }
                if(!empty($req['gia_tien_lon'])){
                    $query->where('gia_tien', '<=', "{$req['gia_tien_lon']}");
                }
                if(!empty($req['gia_tien_nho'])){
                    $query->where('gia_tien', '>=', "{$req['gia_tien_nho']}");
                }

        return $query->orderBy('nuoc_hoa.id', 'DESC');
    }

    // Danh sách nước hoa theo danh mục khi xem thêm
    public function scopeQueryNuocHoaKhuyenMaiXemThem($query, $id, $last_id, $req){
        $query  ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                ->leftJoin('khuyen_mai', 'nuoc_hoa.khuyen_mai_id', '=', 'khuyen_mai.id')
                ->leftJoin('danh_muc_san_pham', 'nuoc_hoa.danh_muc_id', '=', 'danh_muc_san_pham.id')
                ->leftJoin('gioi_tinh', 'nuoc_hoa.gioi_tinh_id', '=', 'gioi_tinh.id')
                ->leftJoin('nong_do', 'nuoc_hoa.nong_do_id', '=', 'nong_do.id')
                ->leftJoin('dung_tich', 'nuoc_hoa.dung_tich_id', '=', 'dung_tich.id')
                ->leftJoin('thuong_hieu', 'nuoc_hoa.thuong_hieu_id', '=', 'thuong_hieu.id')
                ->select('nuoc_hoa.*', 'khuyen_mai.gia_khuyen_mai', 'anh_bia_nuoc_hoa.duong_dan',  
                            'danh_muc_san_pham.ten_danh_muc', 'gioi_tinh.ten_gioi_tinh', 'nong_do.ten_nong_do',
                            'dung_tich.ten_dung_tich', 'thuong_hieu.ten_thuong_hieu')
                ->groupBy('nuoc_hoa.id')
                ->limit(10);

                if(!empty($id)){
                    $query->where('nuoc_hoa.khuyen_mai_id', '=',$id);
                }

                if(!empty($last_id)){
                    $query->where('nuoc_hoa.id', '<',$last_id);
                }
                
                if(!empty($req['gioi_tinh_id'])){
                    $query->where('gioi_tinh_id', "{$req['gioi_tinh_id']}");
                }
                if(!empty($req['dung_tich_id'])){
                    $query->where('dung_tich_id', "{$req['dung_tich_id']}");
                }
                if(!empty($req['thuong_hieu_id'])){
                    $query->where('thuong_hieu_id', "{$req['thuong_hieu_id']}");
                }
                if(!empty($req['gia_tien_lon'])){
                    $query->where('gia_tien', '<=', "{$req['gia_tien_lon']}");
                }
                if(!empty($req['gia_tien_nho'])){
                    $query->where('gia_tien', '>=', "{$req['gia_tien_nho']}");
                }
                
        return $query->orderBy('nuoc_hoa.id', 'DESC');
    }
}
