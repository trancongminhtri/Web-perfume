<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrangThaiDonHang extends Model
{
    use SoftDeletes;
    protected $table = 'trang_thai_don_hang';
}
