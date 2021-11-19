<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GioiTinh extends Model
{
    use SoftDeletes;
    protected $table = 'gioi_tinh';
}
