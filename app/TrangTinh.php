<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrangTinh extends Model
{
    use SoftDeletes;
    protected $table = 'trang_tinh';
    public function scopeQueryDanhSachBlog($query, $request) {
        if(!empty($request['tieu_de_blog'])) {
            $query -> where('tieu_de', 'like', "%{$request['tieu_de_blog']}%");
        }
        return $query->orderBy('id', "DESC");
    }

    public function scopeQueryDSBlogTangDan($query){  
        return $query   ->where('trang_thai', '1')
                        ->orderBy('id', 'DESC')
                        ->limit(10);
    }

    public function scopeQueryDSBlogRandom($query){  
        return $query   ->where('trang_thai', '1');
    }

    public function scopeQueryDSBlogXemThem($query, $last_id) {
        $query  ->where('trang_thai', '1')
                ->orderBy('id', 'DESC')
                ->limit(10);

        if(!empty($last_id)){
            $query->where('id', '<',$last_id);
        }
        return $query;
    }

}
