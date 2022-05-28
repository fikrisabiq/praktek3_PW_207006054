// $('.js-example-basic-single').select2();
$(document).ready(function(){
    $('.salah').hide();
    $('#nama_KK').change(function(){
        let id = $(this).select2().find(":selected").data("id");
        $('.pilihan').remove();
        $.ajax({
            url: 'http://localhost:8080/bayarzakat/getjumlah',
            data: {id: id},
            method: 'post',
            dataType: 'json',
            success: function(data){
                console.log(data.jumlah_tanggungan);
                for(i=1;i<=data.jumlah_tanggungan;i++){
                    $('#jumlah').append(`<option class="pilihan" value="${i}">${i}</option>`);
                }
                $('#jumlah_tanggungan').val(data.jumlah_tanggungan);
                $('#id_muzakki').val((data.id_muzakki));
            }
        });
    });

    if($('#jenis').val()==1){
        chose=2.5;
    }else{
        chose=30000;
    }

    $('#jumlahs').change(function(){
        $('#total').val(chose * $(this).val());
    })

    pilihan = 0;
    $('#jenis').change(function(){
        if ($(this).val() == 1){
            pilihan = 2.5;
            chose = 2.5;
            $('#total').val(pilihan * $('#jumlah').val());
            $('#total').val(chose * $('#jumlahs').val());
        } else{
            pilihan = 30000;
            chose = 30000;
            $('#total').val(pilihan * $('#jumlah').val());
            $('#total').val(chose * $('#jumlahs').val())
        }
    });
    $('#jumlah').change(function(){
        $('#total').val(pilihan * $(this).val());
    })

    $('#nama').change(function(){
        let id = $(this).select2().find(":selected").data("id");
        $.ajax({
            url: 'http://localhost:8080/bayarzakat/getjumlah',
            data: {id: id},
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('#id_muzakki').val((data.id_muzakki));
            }
        });
    });
    nilai=$('#kategori').find(':selected').data('hak');
    $('#haks').val((nilai))
    $('#kategori').change(function(){
        let kategori = $(this).val();
        $.ajax({
            url: 'http://localhost:8080/kategori/getKategoriById',
            data: {id: kategori},
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('#hak').val((data.jumlah_hak));
                $('#haks').val((data.jumlah_hak));
                $.ajax({
                    url: 'http://localhost:8080/warga/getBeras',
                    data: {hak: $('#hak').val()},
                    method: 'post',
                    dataType: 'json',
                    success: function(data){
                        // $('#hak').val((data.jumlah_hak));
                        if(data.beras<data.hak){
                            $('#tambah').prop('disabled',true);
                            $('.salah').show();
                        }else{
                            $('#tambah').prop('disabled',false);
                            $('.salah').hide();
                        }
                        // console.log(data);
                    }
                });
                $.ajax({
                    url: 'http://localhost:8080/warga/getBeras',
                    data: {hak: $('#haks').val()},
                    method: 'post',
                    dataType: 'json',
                    success: function(data){
                        // $('#hak').val((data.jumlah_hak));
                        if(data.beras<data.hak){
                            $('#tambah').prop('disabled',true);
                            $('.salah').show();
                        }else{
                            $('#tambah').prop('disabled',false);
                            $('.salah').hide();
                        }
                    }
                });
            }
        });
    });
})