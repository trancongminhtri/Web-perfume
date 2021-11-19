<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    protected $table = 'phieu_nhap';


    // Danh sách đơn hàng theo id
    public function scopeQueryPhieuNhapTheoID($query, $id){
        $query  ->leftJoin('nha_cung_cap', 'phieu_nhap.ncc_id', '=', 'nha_cung_cap.id')
                ->leftJoin('nguoi_dung', 'phieu_nhap.quan_ly_id', '=', 'nguoi_dung.id')
                ->where('phieu_nhap.id', 'like', $id)
                ->select('phieu_nhap.*', 'nha_cung_cap.ten_ncc', 'nguoi_dung.ho_ten');
        return $query;
    }

    public function scopeQueryDSPhieuNhap($query, $req) {
        $query ->leftJoin('nha_cung_cap', 'phieu_nhap.ncc_id', '=', 'nha_cung_cap.id')
               ->leftJoin('nguoi_dung', 'phieu_nhap.quan_ly_id', '=', 'nguoi_dung.id')
               ->select('phieu_nhap.*', 'nguoi_dung.ho_ten', 'nha_cung_cap.ten_ncc')
               ->orderBy('ngay_nhap', 'desc');
               if(!empty($req['from_date'])){
                        $query->where('App\PhieuNhap'::raw('Date(phieu_nhap.ngay_nhap)'), $req['from_date']);
                    }
        return $query;
    }
}
