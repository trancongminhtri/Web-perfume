<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhanXetDanhGia extends Model
{
    protected $table = 'nhan_xet_va_danh_gia';

    public function scopeQueryDSNhanXetDanhGia($query, $id) {
        $query  ->leftJoin('nguoi_dung', 'nhan_xet_va_danh_gia.nguoi_dung_id', '=', 'nguoi_dung.id')
                ->where('nhan_xet_va_danh_gia.nuoc_hoa_id', $id)
                ->orderBy('nhan_xet_va_danh_gia.created_at', 'desc');
        return $query;
    }

    public function scopeQueryDSBinhLuanGiamDan($query, $req){
        $query  ->leftJoin('nguoi_dung', 'nhan_xet_va_danh_gia.nguoi_dung_id', '=', 'nguoi_dung.id')
                ->leftJoin('nuoc_hoa', 'nhan_xet_va_danh_gia.nuoc_hoa_id', '=', 'nuoc_hoa.id')
                ->select('nuoc_hoa.ten_nuoc_hoa', 'nguoi_dung.email', 'nhan_xet_va_danh_gia.*')
                ->orderBy('nhan_xet_va_danh_gia.id', 'desc');
                if(!empty($req['email_nguoi_dung'])){
                    $query->where('nguoi_dung.email', 'like', "%{$req['email_nguoi_dung']}%");
                }
                if(!empty($req['ten_nuoc_hoa'])){
                    $query->where('nuoc_hoa.ten_nuoc_hoa', 'like', "%{$req['ten_nuoc_hoa']}%");
                }
                if(!empty($req['diem_danh_gia'])){
                    $query->where('nhan_xet_va_danh_gia.diem_danh_gia', 'like', "%{$req['diem_danh_gia']}%");
                }
        return $query;
    }
}
