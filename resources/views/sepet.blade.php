@extends('layouts.master')
@section('title','Sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')
            @if(count(Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Adet Fiyatı</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                </tr>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $urunCartItem)
                <tr>
                    <td style="width: 120px">
                        <a href="{{route('urun',Str::slug($urunCartItem->name))}}">
                        <img src="http://via.placeholder.com/120x100?text=UrunResmi">
                        </a>
                    </td>
                    <td>
                        <a href="{{route('urun',Str::slug($urunCartItem->name))}}">
                            {{$urunCartItem->name}}
                        </a>
                        <form action="{{route('sepet.kaldir',$urunCartItem->rowId)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger btn-xs" value="Sepetten Kaldır">
                        </form>

                    </td>

                    <td>{{$urunCartItem->price}} TL</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty-1}}">-</a>
                        <span style="padding: 10px 20px">{{$urunCartItem->qty}}</span>
                        <a href="#" class="btn btn-xs btn-default urun-adet-arttir" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty+1}}">+</a>
                    </td>
                    <td class="text-right">
                        {{$urunCartItem->subtotal}} TL
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Alt Toplam</th>
                    <td class="text-right">{{Cart::subtotal()}} TL</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <td class="text-right">{{Cart::tax() }} TL</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <td class="text-right">{{Cart::total()}} TL</td>
                </tr>
            </table>
                <div>

                    <form action="{{route('sepet.bosalt')}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                    </form>

                    <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>
            @else
                <p>Sepetinizde ürün yok.</p>
            @endif


        </div>
    </div>
@endsection


@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>

    <script>
        setTimeout(function(){
            $('.alert').slideUp("slow");
        }, 3000);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.urun-adet-arttir, .urun-adet-azalt').on('click', function () {

            var id = $(this).attr('data-id');
            var adet = $(this).attr('data-adet');

            $.ajax({
                type: 'PATCH',
                url : '/sepet/guncelle/' + id,
                data : { adet: adet } ,
                success : function () {
                    window.location.href = '/sepet';
                }
            });
        });
    </script>
@endsection
