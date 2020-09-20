require('./bootstrap');

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
