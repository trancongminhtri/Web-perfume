<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    protected $table = 'slideshow';
    public function scopeQueryDSSlideShow($query, $req){
        if(!empty($req['ten_slideshow'])){
            $query->where('ten', 'like', "%{$req['ten_slideshow']}%");
        }
        return $query->orderBy('id', 'DESC');
    }

    public function scopeQueryDSSlideShowTangDan($query){  
        return $query   ->where('trang_thai', '1')
                        ->orderBy('id', 'DESC');
    }
}
