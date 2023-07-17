<?php

    class uye extends Controller {

        function __construct () {

            parent:: libsInclude(array("view", "form", "bilgi", "pagination"));

            Session::init();

            $this->ModelYukle("uye");

        }

        function giris () {

            $this->view->goster("sayfalar/giris");

        }

        function cikis () {

            Session::destroy();

            $this->bilgi->direktYonlen("/magaza");

        }

        function hesapOlustur () {

            $this->view->goster("sayfalar/uyeol");

        }

        function kayitKontrol () {

            $ad = $this->form->get("ad")->bosmu();

            $soyad = $this->form->get("soyad")->bosmu();

            $email = $this->form->get("email")->bosmu();

            $sifre = $this->form->get("sifre")->bosmu();

            $sifretekrar = $this->form->get("sifretekrar")->bosmu();

            $telefon = $this->form->get("telefon")->bosmu();

            $this->form->gercektenMailmi($email);

            $sifre = $this->form->sifreKarsilastir($sifre, $sifretekrar);

            if (!empty($this->form->error)) :

                $this->view->goster("sayfalar/uyeol", array('hata' => $this->form->error));
            
            else:

                $sonuc = $this->model->ekle("uye", array('ad', 'soyad', 'mail', 'sifre', 'telefon'), array($ad, $soyad, $email, $sifre, $telefon));

                if($sonuc==1):

                    $this->view->goster("sayfalar/uyeol", array("bilgi" => $this->bilgi->basarili("Kayıt başarılı!", "/uye/giris", 3)));

                else:

                    $this->view->goster("sayfalar/uyeol", array("bilgi" => $this->bilgi->uyari("danger", "Kayıt esnasında hata oluştu!")));

                endif;

            endif;

        }

        function giriskontrol () {

            if($_POST):

                if($_POST["girisTipi"]=="uyeGirisi"):

                    $ad = $this->form->get("ad")->bosmu();

                    $sifre = $this->form->get("sifre")->bosmu();
        
                    if (!empty($this->form->error)) :
        
                        $this->view->goster("sayfalar/giris", array('bilgi' =>  $this->bilgi->uyari("danger", "Ad veya şifre boş olamaz!!")));
        
                    else:
        
                        $sifre = $this->form->sifrele($sifre);
        
                        $sonuc = $this->model->giriskontrol("uye", "ad='$ad' and sifre='$sifre' and durum=1");
        
                        if($sonuc):
        
                            Session::init();
        
                            Session::set("kulad", $sonuc[0]["ad"]);
        
                            Session::set("uye", $sonuc[0]["id"]); // üyenin id'sini taşıyacağım
        
                            $this->bilgi->direktYonlen("/uye/panel");
        
                        else:
        
                            $this->view->goster("sayfalar/giris", array('bilgi' =>  $this->bilgi->uyari("danger", "Kullanıcı adı veya şifre hatalı!!")));
        
                        endif;
        
                    endif;

                elseif($_POST["girisTipi"]=="yoneticiGirisi"):

                    $AdminAd = $this->form->get("AdminAd")->bosmu();

                    $Adminsifre = $this->form->get("AdminSifre")->bosmu();
        
                    if (!empty($this->form->error)) :
        
                        $this->view->goster("YonPanel/sayfalar/index", array('bilgi' =>  $this->bilgi->uyari("danger", "Ad veya şifre boş olamaz!!")));
        
                    else:
        
                        $Adminsifre = $this->form->sifrele($Adminsifre);
        
                        $sonuc = $this->model->giriskontrol("yonetim", "ad='$AdminAd' and sifre='$Adminsifre'");
        
                        if($sonuc):
        
                            Session::init();
        
                            Session::set("AdminAd", $sonuc[0]["ad"]);
        
                            Session::set("AdminId", $sonuc[0]["id"]); // yönetici id'sini taşıyacağım
        
                            $this->bilgi->direktYonlen("/panel/siparisler");
        
                        else:
        
                            $this->view->goster("YonPanel/sayfalar/index", array('bilgi' =>  $this->bilgi->uyari("danger", "Kullanıcı adı veya şifre hatalı!!")));
        
                        endif;
        
                    endif;

                endif;

            else:

                $this->bilgi->direktYonlen("/");

            endif;

        }

        function panel () {

            $sonuc = $this->model->listele("siparisler", "where uyeid=".Session::get("uye"));

            $this->view->goster("sayfalar/panel", ["siparisler" => $sonuc]);

        }

        // ------------ ADRES AYARLARI ------------ \\

        // adres listele

        function adreslerim ($mevcutsayfa=false) {

            $sonuc = $this->model->listele("adresler", "where uyeid=".Session::get("uye"));

            $this->view->goster("sayfalar/panel", [
                "adres" => $sonuc,
                "toplamsayfa" => $this->pagination->toplamsayfa,
                "toplamveri" => $this->model->sayfalama("adresler", "where uyeid=".Session::get("uye"))
            ]);

        }

        // adres sil

        function adresSil () {

            if($_POST):

                echo $this->model->sil("adresler", "id=".$_POST["adresid"]);
            
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // adres ekle

        function adresEkle () {
            
            $this->view->goster("sayfalar/panel", ["adresEkle" => true]);

        }

        function adresEkleSon () {

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $adres = $this->form->get("adres")->bosmu();

                if (!empty($this->form->error)) :

                    echo false;

                else:

                    echo $this->model->ekle("adresler", array("uyeid", "adres"), array($id, $adres));

                endif;
                
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // adres güncelle

        function adresGuncelle () {

            if($_POST):

                $id = $this->form->get("gunceladresid")->bosmu();

                $adres = $this->form->get("gunceladres")->bosmu();

                if (!empty($this->form->error)) :

                    echo false;

                else:

                    echo $this->model->guncelle("adresler", array("adres"), array($adres), "id=".$id);

                endif;
                
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // varsayılan adres ayarla

        function digerleriSifirYap () {

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $uyeId = $this->form->get("uyeId")->bosmu();

                if (!empty($this->form->error)) :

                    echo false;

                else:

                    $sonuc = $this->model->guncelle("adresler", array("varsayilan"), array(0), "id<>".$id." and uyeid=".$uyeId);

                    echo $sonuc ? true : false;

                endif;

            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        function varsayilanAdresAyarla () {

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                if (!empty($this->form->error)) :

                    echo false;

                else:

                    $sonuc = $this->model->guncelle("adresler", array("varsayilan"), array(1), "id=".$id);

                    echo $sonuc ? true : false;

                endif;

            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // ------------ HESAP AYARLARI ------------ \\

        // hesap ayarları getir

        function hesapayarlarim () {

            $sonuc = $this->model->listele("uye", "where id=".Session::get("uye"));

            $this->view->goster("sayfalar/panel", ["ayarlar" => $sonuc]);

        }

        // hesap ayarları güncelle

        function hesapGuncelle () {

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $ad = $this->form->get("ad")->bosmu();

                $soyad = $this->form->get("soyad")->bosmu();

                $mail = $this->form->get("mail")->bosmu();

                $telefon = $this->form->get("telefon")->bosmu();

                if (!empty($this->form->error)) :

                    echo false;

                else:

                    echo $this->model->guncelle("uye", array("ad", "soyad", "mail", "telefon"), array($ad, $soyad, $mail, $telefon), "id=".$id);

                endif;
                
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }
        
        // ------------ ŞİFRE DEĞİŞTİR ------------ \\
        
        function sifredegistir () {

            $sonuc = $this->model->listele("uye", "where id=".Session::get("uye"));

            $this->view->goster("sayfalar/panel", ["sifredegistir" => $sonuc]);

        }

        // şifre değiştir

        function sifreyenile () {

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $mevcutsifre = $this->form->get("mevcutsifre")->bosmu();

                $yenisifre = $this->form->get("yenisifre")->bosmu();

                $sifretekrar = $this->form->get("sifretekrar")->bosmu();

                if (!empty($this->form->error)) :

                    echo "BOSHATASI";

                else:

                    if($yenisifre == $sifretekrar):

                        // sifrele

                        $mevcutsifre = $this->form->sifrele($mevcutsifre);

                        $yenisifre = $this->form->sifrele($yenisifre);

                        $sifretekrar = $this->form->sifrele($sifretekrar);

                        $sonuc = $this->model->guncelle("uye", array("sifre"), array($yenisifre), "id='$id' and sifre='$mevcutsifre'");
                        
                        echo ($sonuc) ? "HATASIZ" : "MSHATASI";

                    else:

                        echo "TEKRARHATASI";

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // ------------ SİPARİŞ İŞLEMLERİ ------------ \\

        // sipariş getir

        function siparislerim () {

            $sonuc = $this->model->listele("siparisler", "where uyeid=".Session::get("uye"));

            $this->view->goster("sayfalar/panel", ["siparisler" => $sonuc]);

        }

        // siparişi tamamla

        function siparisTamamlandi () {
            
            if($_POST && $_COOKIE['urun']):
                    
                $ad = $this->form->get("ad")->bosmu();

                $soyad = $this->form->get("soyad")->bosmu();

                $mail = $this->form->get("mail")->bosmu();

                $telefon = $this->form->get("telefon")->bosmu();

                $toplamTutar = $this->form->get("toplamtutar")->bosmu();

                $adresid = $this->form->get("adresTercih")->bosmu();
                
                $odeme = $this->form->get("odeme")->bosmu();

                $odemeturu = ($odeme==1) ? "Nakit" : "Hata";

                $tarih = date("d.m.Y");

                if (!empty($this->form->error)) :

                    $this->view->goster(
                    "sayfalar/siparistamamlandi", 
                    ["bilgi"=>$this->bilgi->uyari("danger", "Bilgiler eksiksiz doldurulmalıdır")]);

                else:

                    $siparisNo = mt_rand(0,99999999);

                    $uyeid = Session::get("uye");

                    $urun = $this->model->topluIslemBaslat();

                    foreach($_COOKIE['urun'] as $id => $adet):

                        $urun = $this->model->listele("urunler", "where id=".$id);

                        $this->model->stokGuncelle(
                            array($urun[0]["stok"] - $adet, $urun[0]["satisadet"] + $adet),
                            "id = ".$id
                        );

                        $this->model->siparisTamamla([ 
                            $siparisNo,
                            $adresid,
                            $uyeid,
                            $urun[0]["urunad"],
                            $adet,
                            $urun[0]["fiyat"],
                            $urun[0]["fiyat"] * $adet,
                            $odemeturu,
                            $tarih
                        ]);

                    endforeach;

                    $urun = $this->model->topluIslemTamamla();

                    Cookie::SepetiBosalt();

                    $teslimatSonuc = $this->model->ekle(
                        "teslimatbilgileri",
                        ["siparis_no", "ad", "soyad", "mail", "telefon"],
                        [$siparisNo, $ad, $soyad, $mail, $telefon]
                    );

                    if($teslimatSonuc):

                        $this->view->goster("sayfalar/siparistamamlandi", 
                        [
                            "siparisNo"=>$siparisNo,
                            "toplamTutar"=>$toplamTutar,
                            "bankalar" => $this->model->listele("bankabilgileri", false)
                        ]);
                    
                    else:

                        $this->view->goster("sayfalar/siparistamamlandi", 
                        ["bilgi"=>$this->bilgi->uyari("danger", "SİPARİŞ BAŞARISIZ!")]);

                    endif;

                endif;
            
            else:

                $this->bilgi->direktYonlen("/");

            endif;
            
        }
        
        // ------------ YORUM İŞLEMLERİ ------------ \\

        // yorum getir

        function yorumlarim ($mevcutsayfa=false) {

            $adet = $this->model->tabloSecListele("yorumlarGoruntuAdet", "ayarlar", false);

            $this->pagination->paginationOlustur($this->model->sayfalama("yorumlar", "where uyeid=".Session::get("uye")), $mevcutsayfa, $adet[0][0]);

            $sonuc = $this->model->listele("yorumlar", "where uyeid=".Session::get("uye")." LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet);
            
            $this->view->goster("sayfalar/panel", [
                "yorumlar" => $sonuc,
                "toplamsayfa" => $this->pagination->toplamsayfa,
                "toplamveri" => $this->model->sayfalama("yorumlar", "where uyeid=".Session::get("uye"))
            ]);

        }
        
        // yorum sil

        function yorumSil () {

            if($_POST):

                echo $this->model->sil("yorumlar", "id=".$_POST["yorumid"]);
                
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // yorum güncelle

        function yorumGuncelle () {

            if($_POST):

                $id = $this->form->get("guncelyorumid")->bosmu();

                $icerik = $this->form->get("guncelicerik")->bosmu();

                if (!empty($this->form->error)) :

                    echo false;

                else:

                    echo $this->model->guncelle("yorumlar", array("icerik", "durum"), array($icerik, "0"), "id=".$id);

                endif;
            
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

    }

?>