<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hang';
    // protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = null;

    // Danh sách đơn hàng theo id người dùng sắp xếp theo ngày
    public function scopeQueryDSDonHangIDNguoiDung($query, $id_nguoi_dung){
        return $query   ->leftJoin('trang_thai_don_hang', 'trang_thai_id', '=', 'trang_thai_don_hang.id')
                        ->where('khach_hang_id', $id_nguoi_dung)
                        ->select('don_hang.*', 'trang_thai_don_hang.trang_thai')
                        ->orderBy('don_hang.created_at', 'desc');
    }

    // Danh sách đơn hàng và tìm kiếm đơn thàng theo trạng thái, mã đơn hàng
    public function scopeQueryDSDonHang($query, $req){
        if(!empty($req['don_hang_id'])){
            $query->where('id', 'like', "%{$req['don_hang_id']}%");
        }
        if(!empty($req['trang_thai'])){
            $query->where('trang_thai_id', 'like', "%{$req['trang_thai']}%");
        }
        return $query->orderBy('created_at' , 'desc');
    }

    public function khachHang(){
        return $this->belongsTo('App\User', 'khach_hang_id', 'id');
    }

    // Danh sách các đơn hàng hoàn thành trong ngày hiện tại
    public function scopeQueryHoanThanhNgayHienTai($query, $req){
        $query  ->whereBetween('App\DonHang'::raw('Date(updated_at)'), [$req['tu_ngay'], $req['den_ngay']])
                ->where('trang_thai_id', 3);
        return $query;
    }

    // Danh sách các đơn hàng mới trong ngày hiện tại
    public function scopeQueryDHMoiNgayHienTai($query, $req){
        $query  ->whereBetween('App\DonHang'::raw('Date(created_at)'), [$req['tu_ngay'], $req['den_ngay']])
                ->where('trang_thai_id','!=', 3);
        return $query;
    }

    public function scopeQueryKiemTraDonHang($query, $req){
        return $query   ->leftJoin('chi_tiet_don_hang', 'id', '=', 'chi_tiet_don_hang.don_hang_id')
                        ->where([
                            ['khach_hang_id','=' ,$req['khach_hang_id']],
                            ['chi_tiet_don_hang.nuoc_hoa_id','=' ,$req['nuoc_hoa_id']], 
                            ['don_hang.trang_thai_id', 3],
                        ]);
    }

    public function scopeQueryTimDonHang($query, $id){
        return $query   ->Join('nguoi_dung', 'don_hang.khach_hang_id', '=', 'nguoi_dung.id')
                        ->select(['don_hang.*', 'nguoi_dung.email'])
                        ->where('don_hang.id', $id);
    }
}
