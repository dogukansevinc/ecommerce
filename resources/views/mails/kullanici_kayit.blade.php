<h1>{{config('app.name')}}</h1>
<p> Merhaba {{$kullanici->adsoyad}}, kaydınız başarılı bir şekilde yapıldı.</p>
<p>Kaydınızı aktifleştirmek için <a href="{{config('app.name')}}/kullanici/aktiflestir/{{$kullanici->aktivasyon_anahtari}}">Tıklayın</a> vaya aşağıdaki bağlantıyı açın.</p>
<p>{{config('app.name')}}/kullanici/aktiflestir/{{$kullanici->aktivasyon_anahtari}}</p>
