<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ThongBao extends Model
{
    protected $table = 'thong_bao';

    // Danh sách thông báo mới trong 7 ngày 
    public function scopeQueryDSTrongBayNgay($query){  
        return $query   ->whereDate('created_at', '>=', Carbon::today('Asia/Ho_Chi_Minh')->subDay(7))
        ->orderBy('id', 'desc');
    }
}
