<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alkitab extends Model
{
    protected $table = "alkitab";
    protected $primaryKey = "id";

    public function scopeGetKitab($query)
    {
        $data = $query->groupBy("kitab")->select('kitab')->orderBy('id')->get();
        $data = $data->map(function($value, $key) {
            $value->kitab = strtoupper($value->kitab);
            return $value;
        });
        return $data;
    }

    public function scopeGetFirman($query,$kitab,$pasal,$ayat)
    {
        $data = $query->where('kitab',$kitab)
                    ->where('pasal',$pasal)
                    ->where('ayat',$ayat)
                    ->get();
        $data = $data->map(function($value,$key){
            $value->kitab = strtoupper($value->kitab);
            return $value;
        });
        return $data;
    }
}
