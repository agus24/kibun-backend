<?php

namespace App\Http\Controllers\api;

use App\Alkitab;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlkitabController extends Controller
{
    public function getKitab()
    {
        $alkitab = Alkitab::groupBy("kitab")->select('kitab')->orderBy('id')->get();
        return response()->json($alkitab,200);
    }

    public function getPasalAyat($kitab)
    {
        $pasal = Alkitab::where('kitab',$kitab)->select('pasal','kitab',DB::raw('concat(kitab,"-",pasal) as kitab_pasal'))->groupBy('pasal')->get()->map(function($value,$key) {
            $value->ayat = Alkitab::where('pasal',$value->pasal)->where('kitab',$value->kitab)->select('*',DB::raw('concat(pasal,"-",ayat) as pasal_ayat'))->get();
            return $value;
        });
        return response()->json($pasal,200);
    }

    public function getFirman($kitab,$pasal,$ayat)
    {
        $firman = Alkitab::where('kitab',$kitab)
                            ->where('pasal',$pasal)
                            ->where('ayat',$ayat)
                            ->get();
        if(count($firman) > 0)
        {
            return response()->json($firman[0],200);
        }
        else
        {
            return response()->json('Pasal/Ayat Tidak Ditemukan', 500);
        }
    }
}
