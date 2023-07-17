$(document).ready(function(e) {

    $("#sepetDurum").load("http://localhost/E_TICARET/genelGorev/sepetKontrol");
    $("#yorumSonuc").hide();
    $("#hesapbilgisonuc").hide();
    $("#SDsonuc").hide();
    $("#adresSonuc").hide();
    $("#formAnasi").hide();
    $("#adresEkleBilgiSonuc").hide();
    $('#cocukKatSelectGuncelle').attr("disabled", true);
    $('#altKatSelectGuncelle').attr("disabled", true);
    $('#cocukKatSelect').attr("disabled", true);
    $('#altKatSelect').attr("disabled", true);
    $('#bultenTumunuSifirlaBtn').css("display", "none");
    
    if(window.innerWidth<=576) {
        $('.hesapEkleBtnMobile').val("Ekle");
    }

    $('#topluSilBtn').on("click", function(){
        var idler = "";
        $(':checkbox:checked').each(function () { 
            idler += $(this).val() + ",";
        });
        $.post("http://localhost/E_TICARET/genelGorev/bultenTopluSil", {"idler":idler}, function(cevap) {
            if(cevap){
                $(':checkbox:checked').parents('.mailcerceve').parents('.mailana').fadeOut(function(){
                    window.location.reload();
                }); 
             } else {  }
        });
    })

    $('#bultenTumunuSecBtn').click(function (e) {
        $('body input[type=checkbox]').attr("checked", true);
        $('#bultenTumunuSifirlaBtn').css("display", "inline-block");
        $(this).css("display", "none");
    })

    $('#bultenTumunuSifirlaBtn').click(function (e) {
        $('body input[type=checkbox]').attr("checked", false);
        $('#bultenTumunuSecBtn').css("display", "inline-block");
        $(this).css("display", "none");
    })

    // $('body #iade').on("click", function(){ // Kullanıcı arayüz sipariş iade 
    //     var sipNo = $(this).attr('data-value');
    //     var iskelet = $(this).parents(".arkaplan2").find("#iadeIskelet");
    //     var yazdir = "<div class='row alert alert-info text-center'>";
    //     yazdir += "<button class='btn btn-primary' id='iadeButton' data-value='"+sipNo+"'>İade Et</button> ";
    //     yazdir += "<button class='btn btn-danger' id='iadeIptalButton'>İptal Et</button>"
    //     yazdir += "</div>";
    //     iskelet.html(yazdir);
    //     $('body #iadeButton').click(function(e){
    //         var sipNo = $(this).attr('data-value');
    //         $.post("http://localhost/E_TICARET/genelGorev/iadeIslemi", {"sipNo":sipNo}, function(cevap) {
    //             iskelet.html(cevap)
    //         });
    //     });
    //     $('body #iadeIptalButton').click(function(e){
    //         iskelet.html("");
    //     });
    // })

    // $('body #iadeOnay').on("click", function(){ // Kullanıcı arayüz sipariş iade 
    //     var sipNo = $(this).attr('data-value');
    //     var iskelet = $(this).parents(".arkaplan");
    //     $.post("http://localhost/E_TICARET/genelGorev/iadeOnay", {"sipNo":sipNo}, function(cevap) {
    //         if(cevap){
    //             iskelet.fadeOut();
    //         }else{
    //             alert("iade onay başarısız");
    //         }
    //     });
    // })

    $('#detaygoster #adres').click(function(e){
        var sipNo = $(this).attr('data-value');
        var adresId = $(this).attr('data-value2');
        $.post("http://localhost/E_TICARET/genelGorev/teslimatGetir", {"sipNo":sipNo, "adresId":adresId}, function(e) {
            $('.modal-body').html(e);
        });
        $('#exampleModalLongTitle').html("Teslimat Adresi Ve Kişisel Bilgileri");
    });

    $('#siparisGoster a').click(function(e){
        var sipNo = $(this).attr('data-value');
        var adresId = $(this).attr('data-value2');
        $.post("http://localhost/E_TICARET/genelGorev/siparisGetir", {"sipNo":sipNo, "adresId":adresId}, function(e) {
            alert(e);
            $('.modal-body').html(e);
        });
        $('#exampleModalLongTitle').html("Sipariş Özeti");
    });

    jQuery.fn.extend({
        printElem: function() {
            var cloned = this.clone();
        var printSection = $('#printSection');
        if (printSection.length == 0) {
            printSection = $('<div id="printSection"></div>')
            $('body').append(printSection);
        }
        printSection.append(cloned);
        var toggleBody = $('body *:visible');
        toggleBody.hide();
        $('#printSection, #printSection *').show();
        window.print();
        printSection.remove();
        toggleBody.show();
        }
    });
    
    $(document).ready(function(){
        $(document).on('click', '#btnPrint', function(){
          $('#exampleModalCenter').printElem();
      });
    });
    
    $("#yorumEkle").click(function(e){
        $("#formAnasi").slideToggle();
    });

    $("#yorumGonder").click(function(){
        $.ajax({
            type: "POST",
            url: "http://localhost/E_TICARET/genelGorev/yorumFormKontrol",
            data: $("#yorumForm").serialize(),
            success: function (response) {
                $("#yorumForm").trigger("reset");
                $("#formSonuc").html(response);
                if($('#ok').html()=="KAYIT BAŞARILI"){
                    $("#formAnasi").fadeOut();
                }
            }
        });
    });

    $("#numb").keypress(function(evt) {
        // $("#numb").val("");
        evt.preventDefault();
    });

    $("#bultenBtn").click(function(e){
        $.ajax({
            type: "POST",
            url: "http://localhost/E_TICARET/genelGorev/bultenKayit",
            data: $("#bultenForm").serialize(),
            success: function (response) {
                $("#bultenForm").trigger("reset");
                $("#bulten").html(response);
                if($('#bultenok').html()=="Bültene başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz..."){
                }
            }
        });
    });

    $("#iletisimBtn").click(function(e){
        $.ajax({
            type: "POST",
            url: "http://localhost/E_TICARET/genelGorev/iletisimFormKontrol",
            data: $("#iletisimForm").serialize(),
            success: function (response) {
                $("#iletisimForm").trigger("reset");
                $("#iletisimUyari").html(response);
                if($('#iletisimok').html()=="Mesajınız başarılı bir şekilde gönderilmiştir. Teşekkür ederiz..."){
                    $("#iletisimForm").fadeOut();
                    $("#iletisimUyari").html(response);
                }
            }
        });
    });

    $("#sepetBtn").click(function(e){ 
        $.ajax({
            type: "POST",
            url: "http://localhost/E_TICARET/genelGorev/sepeteEkle",
            data: $("#sepetForm").serialize(),
            success: function (response) {
                $("html, body").animate({scrollTop : 0}, "slow");
                $("#sepetDurum").load("http://localhost/E_TICARET/genelGorev/sepetKontrol");
                $("#sepetUcur").html('<div class="alert alert-success mt-5 text-center">Sepete Eklendi</div>');
            }
        });
    });

    $('#guncelForm input[type="button"]').click(function(e){
        var id = $(this).attr('data-value');
        var adet = $('#guncelForm input[name="adet'+id+'"]').val();
        $.post("http://localhost/E_TICARET/genelGorev/urunGuncelle", {"urunid":id, "adet":adet}, function() {
            window.location.reload();
        });
    });

    $('#anabuton input[type="button"]').click(function(e){    //yorum güncelle
        var id = $(this).attr('data-value');
        $(`#yorumtd${id}`).html("<textarea></textarea>"); 
        $(`#yorumtd${id} textarea`).focus();
        $(`#yorumtd${id} textarea`).focusout(function(){
            $.post("http://localhost/E_TICARET/uye/yorumGuncelle", {"guncelyorumid":id, "guncelicerik":$(this).val()}, function(donen) {
                if(donen) {
                    $("#yorumSonuc").html("Yorum başarıyla güncellendi");
                }else {
                    $("#yorumSonuc").html("Güncelleme işleminde hata oluştu");
                    $("#yorumSonuc").addClass("alert-danger");
                }
                $("#yorumSonuc").fadeIn(1500, function () {
                    $("#yorumSonuc").fadeOut(1000, function () {
                        window.location.reload();
                    });
                });
            });
        });
    });

    $('#adresEkleForm input[type="button"]').click(function(e){    //adres ekle
        var id = $('#adresEkleForm input[type="hidden"]').val();
        var adres = $('#adresEkleForm #adres').val();
        $.post("http://localhost/E_TICARET/uye/adresEkleSon", {"id":id, "adres":adres}, function(donen) {
            if(donen) {
                $("#adresEkleBilgiSonuc").html("ADRES BAŞARIYLA EKLENDİ");
            }else {
                $("#adresEkleBilgiSonuc").html("LÜTFEN BOŞ ALAN BIRAKMAYINIZ");
                $("#adresEkleBilgiSonuc").addClass("alert-danger");
            }
            $("#adresEkleBilgiSonuc").fadeIn(2000, function () {
                $("#adresEkleBilgiSonuc").fadeOut(1500, function () {
                    window.location.reload();
                });
            });
        });
    });

    $('#adresbuton input[type="button"]').click(function(e){   //adres güncelle
        var id = $(this).attr('data-value');
        $(`#adresdiv${id}`).html("<textarea></textarea>"); 
        $(`#adresdiv${id} textarea`).focus();
        $(`#adresdiv${id} textarea`).focusout(function(){
            $.post("http://localhost/E_TICARET/uye/adresGuncelle", {"gunceladresid":id, "gunceladres":$(this).val()}, function(donen) {
                if(donen) {
                    $("#adresSonuc").html("Adres başarıyla güncellendi");
                }else {
                    $("#adresSonuc").html("Güncelleme işleminde hata oluştu");
                    $("#adresSonuc").addClass("alert-danger");
                }
                $("#adresSonuc").fadeIn(1500, function () {
                    $("#adresSonuc").fadeOut(1000, function () {
                        window.location.reload();
                    });
                });
            });
        });
    });
    
    $('#varsayilanAdresBtn input[type="button"]').click(function(e){   //varsayılan adres ayarla
        var id = $(this).attr('data-value');
        var uyeId = $(this).attr('data-value2');
        var tut = true;
        $.post("http://localhost/E_TICARET/uye/digerleriSifirYap", {"id":id, "uyeId":uyeId}, function(donen) {
            donen ? true : false;
        });
        if(tut){
            $.post("http://localhost/E_TICARET/uye/varsayilanAdresAyarla", {"id":id}, function(donen) {
                if(donen) {
                    window.location.reload();
                }else {
                    $("#adresSonuc").html("Varsayılan ayarlama sırasında hata oluştu");
                    $("#adresSonuc").addClass("alert-danger");
                    $("#adresSonuc").fadeIn(1500, function () {
                        $("#adresSonuc").fadeOut(1000, function () {
                            window.location.reload();
                        });
                    });
                }
            });
        }
        else{
            $("#adresSonuc").html("Varsayılan ayarlama sırasında hata oluştu");
            $("#adresSonuc").addClass("alert-danger");
            $("#adresSonuc").fadeIn(1500, function () {
                $("#adresSonuc").fadeOut(1000, function () {
                    window.location.reload();
                });
            });
        }
    });

    $('#hesapform input[type="button"]').click(function(e){    //hesap güncelle
        var id = $('#hesapform input[type="hidden"]').val();
        var ad = $('#hesapform #ad').val();
        var soyad = $('#hesapform #soyad').val();
        var mail = $('#hesapform #mail').val();
        var telefon = $('#hesapform #telefon').val();
        $.post("http://localhost/E_TICARET/uye/hesapGuncelle", {
        "id":id, "ad":ad, 'soyad':soyad, 'mail':mail, 'telefon':telefon}, function(donen) {
            if(donen) {
                $("#hesapbilgisonuc").html("BİLGİLERİNİZ BAŞARIYLA GÜNCELLENDİ");
            }else {
                $("#hesapbilgisonuc").html("LÜTFEN BOŞ ALAN BIRAKMAYINIZ");
                $("#hesapbilgisonuc").addClass("alert-danger");
            }
            $("#hesapbilgisonuc").fadeIn(2000, function () {
                $("#hesapbilgisonuc").fadeOut(1500, function () {
                    window.location.reload();
                });
            });
        });
    });

    $('#SDform input[type="button"]').click(function(e){     //şifre yenile
        var id = $('#SDform input[type="hidden"]').val();
        var mevcutsifre = $('#SDform #mevcutsifre').val();
        var yenisifre = $('#SDform #yenisifre').val();
        var sifretekrar = $('#SDform #sifretekrar').val();
        $.post("http://localhost/E_TICARET/uye/sifreyenile", {"id":id, "mevcutsifre":mevcutsifre, "yenisifre":yenisifre, 'sifretekrar':sifretekrar}, function(donen) {
            if(donen=="HATASIZ") {
                $("#SDsonuc").html("ŞİFRENİZ BAŞARIYLA DEĞİŞTİRİLDİ");
            }else if(donen=="BOSHATASI"){
                $("#SDsonuc").html("LÜTFEN BOŞ ALAN BIRAKMAYINIZ");
                $("#SDsonuc").addClass("alert-danger");
            }else if(donen=="TEKRARHATASI"){
                $("#SDsonuc").html("GİRDİĞİNİZ ŞİFRELER UYUŞMAMAKTADIR");
                $("#SDsonuc").addClass("alert-danger");
            }else if(donen=="MSHATASI"){
                $("#SDsonuc").html("MEVCUT ŞİFRENİZ HATALI");
                $("#SDsonuc").addClass("alert-danger");
            }else { null }
            $("#SDsonuc").fadeIn(2000, function () {
                $("#SDsonuc").fadeOut(1500, function () {
                    window.location.reload();
                });
            });
        });
    });

    var ad, soyad, mail, tel;

    $('input[name="bilgiTercih"]').on('change', function(e){     //şifre yenile
        var gelen = $(this).val();
        if(gelen) {
            ad = $('input[id="sipAd"]').val();
            soyad = $('input[id="sipSoyad"]').val();
            mail = $('input[id="sipMail"]').val();
            tel = $('input[id="sipTel"]').val();
            $('input[id="sipAd"]').val("");
            $('input[id="sipSoyad"]').val("");
            $('input[id="sipMail"]').val("");
            $('input[id="sipTel"]').val("");
        }else {
            $('input[id="sipAd"]').val(ad);
            $('input[id="sipSoyad"]').val(soyad);
            $('input[id="sipMail"]').val(mail);
            $('input[id="sipTel"]').val(tel);
        }
    });

    // YÖNETİM PANELİ İŞLEMLERİ 

    $('#aramaselect').on('change', function(){
        var secileniAl = $(this);
        var deger = secileniAl.val();
        if(deger=="sipno"){
            $('#inputAra').val("");
            $('#inputAra').attr("placeholder", "Sipariş numarası");
        }
        if(deger=="uyebilgi"){
            $('#inputAra').val("");
            $('#inputAra').attr("placeholder", "Üye bilgisi");
        }
    })

    $('#yorumAyarla #yorumOnayBtn').click(function(e){   //yorum onay
        var id = $(this).attr('data-value');
        $.post("http://localhost/E_TICARET/panel/uyeyorumlaronay", {"yorumid":id }, function(donen) {
            window.location.reload();
        });
    });

    $('#yorumAyarla #yorumSilBtn').click(function(e){   //yorum onay
        var id = $(this).attr('data-value');
        $.post("http://localhost/E_TICARET/panel/uyeyorumlarsil", {"yorumid":id }, function(donen) {
            window.location.reload();
        });
    });

    $('#yoneticiGuncelleTumunuSec').click(function (e) {
        $('#yoneticiGuncelleForm input[type=checkbox]').attr("checked", true);
    })

    $('#yoneticiGuncelleTumunuKaldir').click(function (e) {
        $('#yoneticiGuncelleForm input[type=checkbox]').attr("checked", false);
    })

    $('#yoneticiEkleTumunuSec').click(function (e) {
        $('#yoneticiEklemeForm input[type=checkbox]').attr("checked", true);
    })

    $('#yoneticiEkleTumunuKaldir').click(function (e) {
        $('#yoneticiEklemeForm input[type=checkbox]').attr("checked", false);
    })

    $('#anakKatSelect').change(function (e) {
        var id = $("#anaKatSelect option:selected").val();
    })

    $('#cocukKatSelect').change(function (e) {
        $("#cocukKatSelect option:selected").val();
    })

    $('#anaKatSelectGuncelle').on("change", function(){
        var anaKatId = $(this).val();
        $.post("http://localhost/E_TICARET/genelGorev/guncelKategoriBul", {"kriter":"cocukgetir", "anaKatId":anaKatId}, function(donen) {
            $('#cocukKatSelectGuncelle').html(donen);
            $('#cocukKatSelectGuncelle').attr("disabled", false);
            $('#altKatSelectGuncelle').attr("disabled", true).html('<option value="0">Seçiniz</option>');
        });
    }) 
      
    $('#cocukKatSelectGuncelle').on("change", function(){
        var cocukKatId = $(this).val();
        $.post("http://localhost/E_TICARET/genelGorev/guncelKategoriBul", {"kriter":"altgetir", "cocukKatId":cocukKatId}, function(donen) {
            $('#altKatSelectGuncelle').html(donen);
            $('#altKatSelectGuncelle').attr("disabled", false);
        });
    })

    $('#katSıfırla').on("click", function(){
        $('#cocukKatSelectGuncelle').html('<option value="0">Seçiniz</option>');
        $('#altKatSelectGuncelle').html('<option value="0">Seçiniz</option>');
    })

    $('#anaKatSelect').on("change", function(){
        var anaKatId = $(this).val();
        $.post("http://localhost/E_TICARET/genelGorev/KategoriBul", {"kriter":"cocukgetir", "anaKatId":anaKatId}, function(donen) {
            $('#cocukKatSelect').html(donen);
            $('#cocukKatSelect').attr("disabled", false);
            $('#altKatSelect').attr("disabled", true).html('<option value="0">Seçiniz</option>');
        });
    }) 
      
    $('#cocukKatSelect').on("change", function(){
        var cocukKatId = $(this).val();
        $.post("http://localhost/E_TICARET/genelGorev/KategoriBul", {"kriter":"altgetir", "cocukKatId":cocukKatId}, function(donen) {
            $('#altKatSelect').html(donen);
            $('#altKatSelect').attr("disabled", false);
        });
    })

    $('.menuackapat').on("click", function(){
        $.post("http://localhost/E_TICARET/genelGorev/menuAcKapat", {"onay":"onay"} ,function(donen) {
            console.log(donen);
        });
        
        for (let index = 0; index < $('.arrowli').length; index++) {
            const svg = $('.arrowli')[index].children[0].children[2];
            if(svg.classList.contains("arrowDisplayNone")==false){
                svg.classList.add("arrowDisplayNone");
            }else{
                svg.classList.remove("arrowDisplayNone");
            }
        }
        const arrow = this.children[0];
        if(arrow.classList.contains("bigArrowRotate")==false){
            arrow.classList.add("bigArrowRotate");
        }else{
            arrow.classList.remove("bigArrowRotate");
        }
    })

});

function urunSil(id, kriter) {
    switch (kriter) {
        case "sepetsil":
            $.post("http://localhost/E_TICARET/genelGorev/urunSil", {"urunid":id}, function() {
                window.location.reload();
            });
        break;
        case "adressil":
            $.post("http://localhost/E_TICARET/uye/adresSil", {"adresid":id}, function(donen) {
                if(donen) {
                    $("#adresSonuc").html("Adres başarıyla silindi");
                }else {
                    $("#adresSonuc").html("Silme işleminde hata oluştu");
                    $("#adresSonuc").addClass("alert-danger");
                }
                $("#adresSonuc").fadeIn(1500, function () {
                    $("#adresSonuc").fadeOut(1000, function () {
                        window.location.reload();
                    });
                });
            });
        break;
        case "yorumsil":
            $.post("http://localhost/E_TICARET/uye/yorumSil", {"yorumid":id}, function(donen) {
                if(donen) {
                    $("#yorumSonuc").html("Yorum başarıyla silindi");
                }else {
                    $("#yorumSonuc").html("Silme işleminde hata oluştu");
                    $("#yorumSonuc").addClass("alert-danger");
                }
                $("#yorumSonuc").fadeIn(1500, function () {
                    $("#yorumSonuc").fadeOut(1000, function () {
                        window.location.reload();
                    });
                });
            });
        break;
        default:
        break;
    }
}

function BilgiPenceresi(linkAdres,sonucbaslik,sonucmetin,sonuctur) {
    swal(sonucbaslik, sonucmetin, sonuctur, {
        buttons: {
            catch: {
                text: "KAPAT",
                value: "tamam",
            }
        },
    })
    .then((value) => {
        if (value=="tamam") {
            window.location.href = linkAdres;
        }		
    });
}

function silmedenSor (gidilecekLink) {
    swal({
        title: "Silmek istediğine emin misin?",
        text: "Silinen kayıt geri alınamaz.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href =  gidilecekLink; 
        } else {
            swal({title:"Silme işleminden vazgeçtiniz", icon: "warning",});
        }
    });
}

function arrowRotateControl(event) {
    const svg = event.children[2];
    const svgs = document.getElementsByClassName("arrowRotate");
    if(svg.classList.contains("arrowRotate")==false){
        svg.classList.add("arrowRotate");
    }else{
        svg.classList.remove("arrowRotate");
    }
    for (let i = 0; i < svgs.length; i++) {
        const element = svgs[i];
        console.log(element);
        element.classList.remove("arrowRotate");
        svg.classList.add("arrowRotate");
    }
}

