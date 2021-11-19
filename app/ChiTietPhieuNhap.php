<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietPhieuNhap extends Model
{
    use SoftDeletes;
    protected $table = 'chi_tiet_phieu_nhap';

    public function scopeQueryChiTietPhieuNhapThepIDPhieuNhap($query, $id_phieu_nhap) {
       return $query ->leftJoin('phieu_nhap', 'chi_tiet_phieu_nhap.phieu_nhap_id', 'phieu_nhap.id')
                     ->leftJoin('nuoc_hoa', 'chi_tiet_phieu_nhap.nuoc_hoa_id', 'nuoc_hoa.id')
                     ->select('chi_tiet_phieu_nhap.*', 'nuoc_hoa.ten_nuoc_hoa')
                     ->where('chi_tiet_phieu_nhap.phieu_nhap_id', $id_phieu_nhap);
    } 
}
