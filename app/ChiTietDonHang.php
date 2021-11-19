<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hang';

    // Danh sách chi tiết đơn hàng theo id hóa đơn
    public function scopeQueryDSChiTietDonHangTheoIDHD($query, $id_hoa_don){
        return $query   ->leftJoin('nuoc_hoa', 'chi_tiet_don_hang.nuoc_hoa_id', '=', 'nuoc_hoa.id')
                        ->leftJoin('anh_bia_nuoc_hoa', 'nuoc_hoa.id', '=', 'anh_bia_nuoc_hoa.nuoc_hoa_id')
                        ->select('chi_tiet_don_hang.*', 'nuoc_hoa.ten_nuoc_hoa', 'anh_bia_nuoc_hoa.duong_dan')
                        ->where('don_hang_id', $id_hoa_don)
                        ->groupBy('nuoc_hoa.id');
    }

    // Thống kê các nước hoa trong đơn hàng hoàn thành trong ngày hiện tại
    public function scopeQueryHoanThanhNgayHienTai($query, $req){
        $query  ->leftJoin('don_hang', 'chi_tiet_don_hang.don_hang_id', '=', 'don_hang.id')
                ->leftJoin('nuoc_hoa', 'chi_tiet_don_hang.nuoc_hoa_id', '=', 'nuoc_hoa.id')
                ->whereBetween('App\DonHang'::raw('Date(don_hang.updated_at)'), [$req['tu_ngay'], $req['den_ngay']])
                ->where('trang_thai_id', 3)
                ->select([
                    'nuoc_hoa.id', 'nuoc_hoa.ten_nuoc_hoa',
                    'App\ChiTietDonHang'::raw("SUM(chi_tiet_don_hang.so_luong_san_pham) as tong_so_luong"),
                    'App\ChiTietDonHang'::raw("SUM(chi_tiet_don_hang.gia_tien_goc * chi_tiet_don_hang.so_luong_san_pham) as tong_tien_goc"),
                    'App\ChiTietDonHang'::raw("SUM(chi_tiet_don_hang.thanh_toan) as tong_thanh_toan"), 
                    ])
                ->groupBy('nuoc_hoa.id')
                ->orderBy('tong_so_luong', 'desc');
        return $query;
    }

     // Thống kê các nước hoa trong đơn hàng mới trong ngày hiện tại
     public function scopeQueryDHMoiNgayHienTai($query, $req){
        $query  ->leftJoin('don_hang', 'chi_tiet_don_hang.don_hang_id', '=', 'don_hang.id')
                ->leftJoin('nuoc_hoa', 'chi_tiet_don_hang.nuoc_hoa_id', '=', 'nuoc_hoa.id')
                ->whereBetween('App\DonHang'::raw('Date(don_hang.created_at)'), [$req['tu_ngay'], $req['den_ngay']])
                ->where([
                            ['trang_thai_id', '!=', 3],
                            ['trang_thai_id', '!=', 4],
                        ])
                ->select([
                    'nuoc_hoa.id', 'nuoc_hoa.ten_nuoc_hoa',
                    'App\ChiTietDonHang'::raw("SUM(chi_tiet_don_hang.so_luong_san_pham) as tong_so_luong"),
                    'App\ChiTietDonHang'::raw("SUM(chi_tiet_don_hang.gia_tien_goc * chi_tiet_don_hang.so_luong_san_pham) as tong_tien_goc"),
                    'App\ChiTietDonHang'::raw("SUM(chi_tiet_don_hang.thanh_toan) as tong_thanh_toan"), 
                    ])
                ->groupBy('nuoc_hoa.id')
                ->orderBy('tong_so_luong', 'desc');
        return $query;
    }
}
