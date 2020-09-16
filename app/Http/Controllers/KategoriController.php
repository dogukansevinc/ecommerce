<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index($slug_kategoriadi){
        $kategori = Kategori::where('slug',$slug_kategoriadi)->firstOrFail();
        $alt_kategoriler = Kategori::where('ust_id',$kategori->id)->get();

        $order = \request('order');
        if ($order == 'coksatan')
        {
            $urunler = $kategori->urunler()
                ->join('urundetays','urundetays.urun_id','uruns.id')
                ->orderBy('urundetays.goster_cok_satan','desc')
                ->paginate(2);

        }
        elseif ($order == 'yeni')
        {
            $urunler = $kategori->urunler()->orderBy('updated_at','desc')->paginate(2);
        }
        else
        {
            $urunler = $kategori->urunler()->paginate(2);
        }


        return view('kategori',compact('kategori','alt_kategoriler','urunler'));


    }
}
