<?php

namespace App\Http\Controllers;

use App\Models\Sepet;
use App\Models\Urun;
use App\Models\Sepeturun;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class SepetController extends Controller
{
    public function index(){
        return view('sepet');
    }

    public function ekle(){
        $urun = Urun::find(\request('id'));
        $cartItem = Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati,0,['slug'=>$urun->slug]);

        if (auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            if (!isset($aktif_sepet_id)){
            $aktif_sepet = Sepet::create([
               'kullanici_id' => auth()->id()
            ]);
            $aktif_sepet_id = $aktif_sepet->id;
            session()->put('aktif_sepet_id',$aktif_sepet_id);
            }
            SepetUrun::updateOrCreate(
                ['sepet_id'=> $aktif_sepet_id,'urun_id'=>$urun->id],
                ['adet'=>$cartItem->qty,'fiyati'=>$urun->fiyati,'durum'=>'Beklemede']
            );
        }

        Cart::setGlobalTax(18);

        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepete eklendi.');
    }

    public function kaldir($rowId)
    {
        if (auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            $cart_item = Cart::get($rowId);
            Sepeturun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cart_item->id)->delete();
        }

        Cart::remove($rowId);
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepetten kaldırıldı.');
    }

    public function bosalt()
    {
        if (auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            Sepeturun::where('sepet_id',$aktif_sepet_id)->delete();
        }

        Cart::destroy();
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Sepetiniz boşaltıldı.');
    }

    public function guncelle($rowid){
        Cart::update($rowid,\request('adet'));
        session()->flash('mesaj-tur','success');
        session()->flash('mesaj','Adet bilgisi güncellendi.');
        return response()->json(['success'=>true]);

    }


}
