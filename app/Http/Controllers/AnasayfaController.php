<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Urun;
use App\Models\Urundetay;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index(){
        $kategoriler = Kategori::whereRaw('ust_id is null')->get();

        $urunler_slider =  Urun::select('uruns.*')
            ->join('urundetays','urundetays.urun_id','uruns.id')
            ->where('urundetays.goster_slider',1)
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();

        $urun_gunun_firsati = Urun::select('uruns.*')
            ->join('urundetays','urundetays.urun_id','uruns.id')
            ->where('urundetays.goster_gunun_firsati',1)
            ->orderBy('updated_at','desc')
            ->first();

        $urunler_one_cikan =  Urun::select('uruns.*')
            ->join('urundetays','urundetays.urun_id','uruns.id')
            ->where('urundetays.goster_one_cikan',1)
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();
        $urunler_cok_satan =  Urun::select('uruns.*')
            ->join('urundetays','urundetays.urun_id','uruns.id')
            ->where('urundetays.goster_cok_satan',1)
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();
        $urunler_indirimli =  Urun::select('uruns.*')
            ->join('urundetays','urundetays.urun_id','uruns.id')
            ->where('urundetays.goster_indirimli',1)
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();

        return view('anasayfa',compact('kategoriler','urunler_slider','urun_gunun_firsati','urunler_one_cikan','urunler_cok_satan','urunler_indirimli'));
    }
}
