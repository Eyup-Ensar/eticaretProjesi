<?php

    class panel extends Controller {

        public $yetkiKontrol;

        function __construct () {

            parent::libsInclude(array("view", "form", "bilgi", "upload", "pagination", "DosyaCikti", "DosyaIslemleri"));

            Session::init();

            $this->ModelYukle("adminpanel");

            if(!Session::get("AdminAd") || !Session::get("AdminId")): 

                $this->giris();

                exit();

            else:

                $this->yetkiKontrol = new PanelHarici();

            endif;

        }

        // ------------ GİRİŞ ------------ \\

        function giris () {

            if(Session::get("AdminAd") && Session::get("AdminId")): 

                $this->bilgi->direktYonlen("/panel/siparisler");

            else:

                $this->view->goster("YonPanel/sayfalar/index");

            endif;
            
        }

        function giriskontrol () {

            echo $_POST["AdminAd"];
            
        }

        // ------------ VARSAYILAN FONKSİYON------------ \\

        function Index () {

            if($this->yetkiKontrol->yoneticiYetki==1):

                $this->siparisler();

            elseif($this->yetkiKontrol->yoneticiYetki==2):
                
                $this->urunler();

            elseif($this->yetkiKontrol->yoneticiYetki==3):

                $this->uyeler();

            endif;

        }

        // ------------ SİPARİŞLER ------------ \\

        // sipariş listele

        function siparisler () {

            $this->yetkiKontrol->yetkiBak("siparisYonetim");
            
            $this->view->goster("YonPanel/sayfalar/siparis", array(
                "siparis" => $this->model->tabloSecListele("siparis_no", "siparisler", false),
                "toplamveri" => $this->model->sayfalama("siparisler")
            ));

        }

        // sipariş güncelleme 

        function siparisGuncelle ($sipno) {

            $this->yetkiKontrol->yetkiBak("siparisYonetim");

            $this->view->goster("YonPanel/sayfalar/siparis", ["siparisguncelle" => $this->model->veriAl("siparisler", "where siparis_no=".$sipno)]);

        }

        function siparisGuncelleSon () {

            $this->yetkiKontrol->yetkiBak("siparisYonetim");

            if($_POST):

                $sipno = $this->form->get("sipno")->bosmu();

                $kargodurum = $this->form->get("durum")->bosmu();

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/siparis", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/siparisler", "BAŞARISIZ", "SİPARİŞ DURUMU SEÇİLMELİDİR", "warning"))
                    ); 

                else:

                    $sonuc = $this->model->guncelle("siparisler", array("kargodurum"), array($kargodurum), "siparis_no=".$sipno);

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/siparis",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/siparisler", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/siparis", 
                        array(
                            "kargoguncelle" => $this->model->veriAl("siparisler", "where siparis_no=".$sipno),
                            "bilgi" => $this->bilgi->sweetAlert(URL."/panel/siparisler", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning")
                        )); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/siparisler");
                
            endif;

        }

        // sipariş arama 

        function siparisarama () {

            $this->yetkiKontrol->yetkiBak("siparisYonetim");

            if($_POST):

                $aramatercih = $this->form->get("aramatercih")->bosmu();

                $ara = $this->form->get("ara")->bosmu();

                if(!empty($this->form->error)):
                    
                    $this->view->goster(
                        "YonPanel/sayfalar/siparis", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/siparisler", "BAŞARISIZ", $aramatercih=="uyebilgi" ? "ÜYE BİLGİSİ BOŞ OLAMAZ" : "SİPARİŞ NUMARASI BOŞ OLAMAZ", "warning"))
                    ); 

                else:

                    if($aramatercih=="sipno"):

                        $bilgicek = $this->model->arama(
                            "siparisler", 
                            "where siparis_no like '%".$ara."%'"
                        );

                        if(isset($bilgicek[0]["id"])):

                            $this->view->goster(
                                "YonPanel/sayfalar/siparis",
                                [
                                    "siparis" => $this->model->arama("siparisler", "where siparis_no like '%".$ara."%'"),
                                    "toplamveri" => $this->model->sayfalama("siparisler")
                                ]
                            );

                        else:
                            
                            $this->view->goster(
                                "YonPanel/sayfalar/siparis", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/siparisler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                            ); 

                        endif;

                    elseif($aramatercih=="uyebilgi"):

                        $bilgicek = $this->model->arama("uye", 
                            "where id like '".$ara."' or
                            ad like '%".$ara."%' or
                            soyad like '%".$ara."%' or
                            telefon like '".$ara."'" 
                        );

                        if(isset($bilgicek[0]["id"])):

                            $this->view->goster(
                                "YonPanel/sayfalar/siparis",
                                [
                                    "siparis" => $this->model->gelismisArama(
                                        "S.*",
                                        "uye U, siparisler S",
                                        "where (U.ad like '%".$ara."%' or
                                        U.soyad like '%".$ara."%' or
                                        U.telefon like '%".$ara."%') 
                                        and U.id = S.uyeid"
                                    ),
                                    "toplamveri" => $this->model->sayfalama("siparisler")
                                ]
                            );

                        else:
                            
                            $this->view->goster(
                                "YonPanel/sayfalar/siparis", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/siparisler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                            ); 

                        endif;
                    
                    endif;

                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/siparisler");
                
            endif;
            
        }

        // sipariş detaylı arama 

        function siparisDetayliArama () {

            $this->yetkiKontrol->yetkiBak("siparisYonetim");

            if($_POST):

                $siparis_no = $this->form->get("siparis_no", true);

                $uyebilgi = $this->form->get("uyebilgi", true);

                $kargodurum = $this->form->get("kargodurum", true);

                $odemeturu = $this->form->get("odemeturu", true);

                $kargosonuc = $this->form->get("kargosonuc", true);

                $tarih1 = $this->form->get("tarih1", true);

                $tarih2 = $this->form->get("tarih2", true);

                $tarihSorgusu = "";

                $aramaDegeri = "";

                $aramaDegeri .= !empty($siparis_no) ? "<b>Sipariş Numarası:</b> ".$siparis_no : "";
                
                $aramaDegeri .= !empty($uyebilgi) ? " <b>Üye Bilgisi:</b> ".$uyebilgi : "";
                
                if(!empty($kargodurum)) : 

                    switch($kargodurum):

                        case '1': $aramaDegeri .= " <b>Kargo Durum: </b> Tedarik Sürecinde"; break;

                        case '2': $aramaDegeri .= " <b>Kargo Durum:</b> Paketleniyor"; break;

                        case '3': $aramaDegeri .= " <b>Kargo Durum:</b> Kargolandı"; break;    
                        
                    endswitch;

                endif;
                
                $aramaDegeri .= !empty($odemeturu) ? " <b>Ödeme Türü:</b> ".$odemeturu : "";
                
                if(!empty($kargosonuc)) : 

                    switch($kargosonuc):

                        case '1': $aramaDegeri .= " <b>Kargo Sonuç:</b> Tedarik Sürecinde"; break;

                        case '2': $aramaDegeri .= " <b>Kargo Sonuç:</b> Paketleniyor"; break;

                    endswitch;

                endif;                    

                if(!empty($tarih1) && !empty($tarih2)):

                    $tarihSorgusu =  " and DATE(tarih) BETWEEN '".$tarih1."' and '".$tarih2."'";

                    $aramaDegeri =  " <b>Başlangıç Tarihi:</b> ".$tarih1." <b>Bitiş Tarihi:</b> ".$tarih2;

                endif;

                if(!empty($uyebilgi)):
                    
                    $bilgicek = $this->model->arama("uye", 
                        "where id like '".$uyebilgi."' or
                        ad like '%".$uyebilgi."%' or
                        soyad like '%".$uyebilgi."%' or
                        telefon like '%".$uyebilgi."%'" 
                    );

                    if($bilgicek):

                        $this->view->goster("YonPanel/sayfalar/siparisDetayliArama", [
                            "siparis" => $this->model->arama("siparisler", 
                            "where uyeid='".$bilgicek[0]["id"]."' and
                            siparis_no like '%".$siparis_no."%' and
                            kargodurum like '%".$kargodurum."%' and
                            kargosonuc like '%".$kargosonuc."%' and
                            odemeturu like '%".$odemeturu."%'".$tarihSorgusu
                            ), "aramaSonuc" => $aramaDegeri ]);

                    endif;

                elseif(!empty($siparis_no)):

                    $this->view->goster(
                        "YonPanel/sayfalar/siparisDetayliArama",
                        ["siparis" => $this->model->arama("siparisler", "where siparis_no like ".$siparis_no), "aramaSonuc" => $aramaDegeri]
                    );   

                else:

                    $this->view->goster("YonPanel/sayfalar/siparisDetayliArama", [
                        "siparis" => $this->model->arama("siparisler", 
                        "where kargodurum like '%".$kargodurum."%' and 
                        kargosonuc like '%".$kargosonuc."%' and 
                        odemeturu like '%".$odemeturu."%'".$tarihSorgusu
                    ), "aramaSonuc" => $aramaDegeri]);

                endif;

            else:

                $this->view->goster("YonPanel/sayfalar/siparisDetayliArama", array(
                    "varsayilan" => true
                ));
                
            endif;

        }

        //sipariş excel çıktı

        function siparisExcelAl () {

            $this->yetkiKontrol->yetkiBak("siparisYonetim");

            $gelenNumaralar = Session::get("numaralar");

            $this->model->excelAyarCek2("siparis_no, urunad, urunadet, urunfiyat, toplamfiyat, kargodurum, odemeturu, kargosonuc, tarih", "siparisler", "where siparis_no in(".$gelenNumaralar.")");

            $this->DosyaCikti->excelAl("Siparişler",
            array(
                "Sipariş numarası",
                "Ürün ad",
                "Ürün adet",
                "Ürün fiyat",
                "Toplam fiyat",
                "Kargo durum",
                "Ödeme türü",
                "Sipariş sonuç",
                "Tarih"
            ),
             $this->model->icerikler[0]);

        }

        // ------------ KATEGORİLER ------------ \\

        // kategori listele 

        function kategoriler () {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");

            $this->view->goster(
                "YonPanel/sayfalar/kategoriler", 
                [
                    "anaKat" => $this->model->veriAl("ana_kategori", false),
                    "cocukKat" => $this->model->veriAl("cocuk_kategori", false),
                    "altKat" => $this->model->veriAl("alt_kategori", false)
                ]
            );

        }

        // kategori güncelle

        function kategoriGuncelle ($kriter, $id) {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");

            $this->view->goster(
                "YonPanel/sayfalar/kategoriler", 
                [
                    "kategoriguncelle" => $this->model->veriAl($kriter."_kategori", " where id=".$id),
                    "anaKat" => $this->model->veriAl("ana_kategori", false),
                    "cocukKat" => $this->model->veriAl("cocuk_kategori", false)
                ]
            );

        }

        function kategoriGuncelleSon () {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");

            if($_POST):

                $ad = $this->form->get("ad")->bosmu();
                
                $id = $this->form->get("id")->bosmu();

                $katAd = $this->form->get("katAd")->bosmu();

                if(isset($_POST["anaKatId"])):

                    $anaKatId = $this->form->get("anaKatId")->bosmu();
                
                endif;

                if(isset($_POST["cocukKatId"])):

                    $cocukKatId = $this->form->get("cocukKatId")->bosmu();
                
                endif;

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/kategoriler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "KATEGORİ ADI BOŞ OLAMAZ", "warning"))
                    ); 

                else:

                    if($katAd=="ana"):

                        $sonuc = $this->model->guncelle("ana_kategori", array("ad"), array($ad), "id=".$id);

                    elseif($katAd=="cocuk"):

                        $sonuc = $this->model->guncelle("cocuk_kategori", array("ana_kat_id", "ad"), array($anaKatId, $ad), "id=".$id); 

                    elseif($katAd=="alt"):

                        $sonuc = $this->model->guncelle("alt_kategori", array("cocuk_kat_id", "ana_kat_id", "ad"), array($cocukKatId, $anaKatId, $ad), "id=".$id); 

                    endif;
                    
                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/kategoriler",
                        array(
                        "bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success")
                        ));

                    else:

                        $this->view->goster("YonPanel/sayfalar/kategoriler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning")));

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/kategoriler");
                
            endif;

        }

        // kategori sil

        function kategoriSil ($kriter, $id) {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");
            
            $sonuc = $this->model->silme($kriter."_kategori", "id=".$id);

            if ($sonuc):
            
                $this->view->goster(
                    "YonPanel/sayfalar/kategoriler", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARILI", "SİLME İŞLEMİ BAŞARILI", "success"))
                    
                ); 
            
            else:

                $this->view->goster(
                    "YonPanel/sayfalar/kategoriler", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "SİLME SIRASINDA HATA OLUŞTU", "warning"))
                ); 

            endif;

        }

        // kategori ekle

        function kategoriEkle ($kriter) {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");

            $this->view->goster(
                "YonPanel/sayfalar/kategoriler", 
                [
                    "kriter" => $kriter,
                    "ana_kat" => $this->model->veriAl("ana_kategori", false),
                    "cocuk_kat" => $this->model->veriAl("cocuk_kategori", false)
                ]
            );

        }

        function kategoriEkleSon () {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");

            if($_POST):

                $ad = $this->form->get("ad")->bosmu();
                
                $katAd = $this->form->get("katAd")->bosmu();

                if(isset($_POST["anaKatId"])):

                    $anaKatId = $this->form->get("anaKatId")->bosmu();
                
                endif;

                if(isset($_POST["cocukKatId"])):

                    $cocukKatId = $this->form->get("cocukKatId")->bosmu();
                
                endif;

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/kategoriler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "KATEGORİ ADI GİRİLMELİDİR", "warning"))
                    ); 

                else:

                    if($katAd=="ana"):

                        $sonuc = $this->model->ekleme("ana_kategori", array("ad"), array($ad));

                    elseif($katAd=="cocuk"):

                        $sonuc = $this->model->ekleme("cocuk_kategori", array("ana_kat_id", "ad"), array($anaKatId, $ad)); 

                    elseif($katAd=="alt"):

                        $sonuc = $this->model->ekleme("alt_kategori", array("cocuk_kat_id", "ana_kat_id", "ad"), array($cocukKatId, $anaKatId, $ad)); 

                    endif;
                    
                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/kategoriler",
                        array(
                            "bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARILI", "EKLEME BAŞARILI", "success")
                        ));

                    else:

                        $this->view->goster("YonPanel/sayfalar/kategoriler", 
                        array(
                            "bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "EKLEME SIRASINDA HATA OLUŞTU", "warning")
                        )); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/kategoriler");
                
            endif;

        }

        // kategori arama 

        function kategoriarama () {

            $this->yetkiKontrol->yetkiBak("kategoriYonetim");

            if($_POST):

                $aramatercih = $this->form->get("aramatercih")->bosmu();

                $ara = $this->form->get("ara")->bosmu();

                if(!empty($this->form->error)):
                    
                    $this->view->goster(
                        "YonPanel/sayfalar/kategoriler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "KATEGORİ ARA KISMI BOŞ BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    if($aramatercih=="ana"):

                        $bilgicek = $this->model->arama(
                            "ana_kategori", 
                            "where ad like '%".$ara."%'"
                        );

                        if(isset($bilgicek[0]["id"])):

                            $this->view->goster(
                                "YonPanel/sayfalar/kategoriler",
                                [
                                    "kategoriarama" => $this->model->arama("ana_kategori", "where ad like '%".$ara."%'"),
                                    "kelime" => $ara
                                ]
                            );

                        else:
                            
                            $this->view->goster(
                                "YonPanel/sayfalar/kategoriler", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                            ); 

                        endif;

                    elseif($aramatercih=="cocuk"):

                        $bilgicek = $this->model->arama(
                            "cocuk_kategori", 
                            "where ad like '%".$ara."%'"
                        );

                        if(isset($bilgicek[0]["id"])):

                            $anakat = $this->model->tabloBirlestirListele(
                                "ana_kategori.ad", "ana_kategori", "cocuk_kategori",
                                "where ana_kategori.id = cocuk_kategori.ana_kat_id and cocuk_kategori.ad like '%".$ara."%'"
                            );

                            $this->view->goster(
                                "YonPanel/sayfalar/kategoriler",
                                [
                                    "kategoriarama" => $this->model->arama("cocuk_kategori", "where ad like '%".$ara."%'"),
                                    "kelime" => $ara,
                                    "cocuk_anaKat" => $anakat
                                ]
                            );

                        else:
                            
                            $this->view->goster(
                                "YonPanel/sayfalar/kategoriler", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                            ); 

                        endif;

                    elseif($aramatercih=="alt"):

                        $bilgicek = $this->model->arama(
                            "alt_kategori", 
                            "where ad like '%".$ara."%'"
                        );

                        if(isset($bilgicek[0]["id"])):

                            $anakat = $this->model->tabloBirlestirListele(
                                "ana_kategori.ad", "ana_kategori", "alt_kategori",
                                "where ana_kategori.id = alt_kategori.ana_kat_id and alt_kategori.ad like '%".$ara."%'"
                            );

                            $cocukKat = $this->model->tabloBirlestirListele(
                                "cocuk_kategori.ad", "cocuk_kategori", "alt_kategori",
                                "where cocuk_kategori.id = alt_kategori.cocuk_kat_id and alt_kategori.ad like '%".$ara."%'"
                            );

                            $this->view->goster(
                                "YonPanel/sayfalar/kategoriler",
                                [
                                    "kategoriarama" => $this->model->arama("alt_kategori", "where ad like '%".$ara."%'"),
                                    "kelime" => $ara,
                                    "alt_anaKat" => $anakat,
                                    "alt_cocukKat" => $cocukKat
                                ]
                            );

                        else:
                            
                            $this->view->goster(
                                "YonPanel/sayfalar/kategoriler", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/kategoriler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                            ); 

                        endif;

                    endif;

                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/kategoriler");
                
            endif;
            
        }

        // ------------ ÜYELER ------------ \\

        // üye listele

        function uyeler ($mevcutsayfa=false) {
            
            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            $adet = $this->model->gelismisArama("uyelerVeriAdet", "ayarlar", false);

            $this->pagination->paginationOlustur($this->model->sayfalama("uye"), $mevcutsayfa, $adet[0][0]);

            $this->view->goster(
                "YonPanel/sayfalar/uyeler",
                [
                    "data" => $this->model->veriAl("uye", " LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                    "toplamsayfa" => $this->pagination->toplamsayfa,
                    "toplamveri" => $this->model->sayfalama("uye")
                ]
            );

        }

        // üye arama

        function uyearama ($kelime=false, $mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            if($_POST || isset($kelime)):

                if($_POST):

                    $ara = $this->form->get("ara")->bosmu();

                    $kosul = !empty($this->form->error);

                else:

                    $ara = $kelime;

                    $kosul = empty($kelime);

                endif;

                $adet = $this->model->gelismisArama("uyelerVeriAdet", "ayarlar", false);

                if($kosul):
                    
                    $this->view->goster(
                        "YonPanel/sayfalar/uyeler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARISIZ", "ARAMA KISMI BOŞ BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $sorgu = "where id like '".$ara."' or
                    ad like '%".$ara."%' or
                    soyad like '%".$ara."%' or
                    mail like '%".$ara."%' or
                    telefon like '".$ara."'";

                    $bilgicek = $this->model->arama("uye", $sorgu);

                    if(isset($bilgicek[0]["id"])):

                        $this->pagination->paginationOlustur($this->model->sayfalama("uye", $sorgu), $mevcutsayfa, $adet[0][0]);

                        $this->view->goster(
                            "YonPanel/sayfalar/uyeler",
                            [
                                "data" => $this->model->veriAl("uye", $sorgu." LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                                "toplamsayfa" => $this->pagination->toplamsayfa,
                                "toplamveri" => $this->model->sayfalama("uye", $sorgu),
                                "uyearama" => $ara
                            ]
                        );

                    else:
                        
                        $this->view->goster(
                            "YonPanel/sayfalar/uyeler", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                        ); 

                    endif;

                endif;

            else:

                $this->bilgi->direktYonlen("/panel/uyeler");
                
            endif;
            
        }

        // üye güncelleme 

        function uyeGuncelle ($id) {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            $this->view->goster("YonPanel/sayfalar/uyeler", ["uyeGuncelle" => $this->model->veriAl("uye", "where id=".$id)]);

        }

        function uyeGuncelleSon () {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $ad = $this->form->get("ad")->bosmu();

                $soyad = $this->form->get("soyad")->bosmu();

                $mail = $this->form->get("mail")->bosmu();

                $telefon = $this->form->get("telefon")->bosmu();

                $durum = $this->form->get("durum")->bosmu();

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/uyeler", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                        ); 

                else:

                    $sonuc = $this->model->guncelle("uye", array("ad", "soyad", "mail", "telefon", "durum"), array($ad, $soyad, $mail, $telefon, $durum), "id=".$id);

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/uyeler",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/uyeler", 
                        array(
                            "bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning")
                        )); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/uyeler");
                
            endif;

        }

        // üye adres güncelle

        function uyeAdres ($id) {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            $this->view->goster("YonPanel/sayfalar/uyeler", ["uyeAdres" => $this->model->veriAl("adresler", "where uyeid=".$id)]);

        }

        // üye sil

        function uyeSil ($id) {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");
        
            $sonuc = $this->model->silme("uye", "id=".$id);

            if ($sonuc):
            
                $this->view->goster(
                    "YonPanel/sayfalar/uyeler", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARILI", "SİLME İŞLEMİ BAŞARILI", "success"))
                ); 
            
            else:

                $this->view->goster(
                    "YonPanel/sayfalar/uyeler", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/uyeler", "BAŞARISIZ", "SİLME SIRASINDA HATA OLUŞTU", "warning"))
                ); 

            endif;

        }

        // ------------ BANKA BİLGİLERİ ------------ \\

        // banka bilgileri listele

        function bankaBilgileri () {

            $this->yetkiKontrol->yetkiBak("muhasebeYonetim");

            $this->view->goster(
                "YonPanel/sayfalar/bankaBilgileri",
                [
                    "data" => $this->model->veriAl("bankaBilgileri", false),
                    "bankaBilgileri" 
                ]
            );

        }

        // banka bilgileri güncelleme 

        function bankaBilgileriGuncelle ($id) {

            $this->yetkiKontrol->yetkiBak("muhasebeYonetim");

            $this->view->goster("YonPanel/sayfalar/bankaBilgileri", ["bankaBilgileriGuncelle" => $this->model->veriAl("bankaBilgileri", "where id=".$id)]);

        }

        function bankaBilgileriGuncelleSon () {

            $this->yetkiKontrol->yetkiBak("muhasebeYonetim");

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $bankaAd = $this->form->get("bankaAd")->bosmu();

                $hesapAd = $this->form->get("hesapAd")->bosmu();

                $hesapNo = $this->form->get("hesapNo")->bosmu();

                $ibanNo = $this->form->get("ibanNo")->bosmu();

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/bankaBilgileri", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                        ); 

                else:

                    $sonuc = $this->model->guncelle("bankaBilgileri", array("bankaAd", "hesapAd", "hesapNo", "ibanNo"), array($bankaAd, $hesapAd, $hesapNo, $ibanNo), "id=".$id);

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/bankaBilgileri",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/bankaBilgileri", 
                        array(
                            "bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning")
                        )); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/bankaBilgileri");
                
            endif;

        }

        // yönetici ekleme 

        function bankaBilgileriEkle () {

            $this->yetkiKontrol->yetkiBak("muhasebeYonetim");

            $this->view->goster("YonPanel/sayfalar/bankaBilgileri",
                [
                    "bankaBilgileriEkle" => true
                ]
            );

        }

        function bankaBilgileriEkleSon () {

            $this->yetkiKontrol->yetkiBak("muhasebeYonetim");

            if($_POST):

                $bankaAd = $this->form->get("bankaAd")->bosmu();

                $hesapAd = $this->form->get("hesapAd")->bosmu();

                $hesapNo = $this->form->get("hesapNo")->bosmu();

                $ibanNo = $this->form->get("ibanNo")->bosmu();

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/bankaBilgileri", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $sonuc = $this->model->ekleme("bankaBilgileri", array("bankaAd", "hesapAd", "hesapNo", "ibanNo"),array($bankaAd, $hesapAd, $hesapNo, $ibanNo));

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/bankaBilgileri",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARILI", "EKLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/bankaBilgileri", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARISIZ", "EKLEME SIRASINDA HATA OLUŞTU", "warning"))
                        ); 

                    endif;

                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/bankaBilgileri");
                
            endif;

        }

        // banka bilgileri sil

        function bankaBilgileriSil ($id) {

            $this->yetkiKontrol->yetkiBak("muhasebeYonetim");
        
            $sonuc = $this->model->silme("bankaBilgileri", "id=".$id);

            if ($sonuc):
            
                $this->view->goster(
                    "YonPanel/sayfalar/bankaBilgileri", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARILI", "SİLME İŞLEMİ BAŞARILI", "success"))
                ); 
            
            else:

                $this->view->goster(
                    "YonPanel/sayfalar/bankaBilgileri", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bankaBilgileri", "BAŞARISIZ", "SİLME İŞLEMİ SIRASINDA HATA OLUŞTU", "warning"))
                ); 

            endif;

        }

        // ------------ ÜYE YORUMLAR ------------ \\

        // yorumlar

        function uyeyorumlar ($mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            $adet = $this->model->gelismisArama("uyelerVeriAdet", "ayarlar", false);

            $this->pagination->paginationOlustur($this->model->sayfalama("yorumlar"), $mevcutsayfa, $adet[0][0]);

            $this->view->goster(
                "YonPanel/sayfalar/uyeyorumlar",
                [
                    "data" => $this->model->veriAl("yorumlar", " LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                    "toplamsayfa" => $this->pagination->toplamsayfa,
                    "toplamveri" => $this->model->sayfalama("yorumlar"),
                    "yorum_uyead" => $this->model->tabloBirlestirListele("uye.ad", "uye", "yorumlar", "where uye.id = yorumlar.uyeid"),
                    "yorum_urunad" => $this->model->tabloBirlestirListele("urunler.urunad", "urunler", "yorumlar", "where urunler.id = yorumlar.urunid")
                ]
            );
        
        }

        // üye yorumları onay

        function uyeyorumlaronay () {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            if($_POST):

                echo $this->model->guncelle("yorumlar", ["durum"], [1], "id=".$_POST["yorumid"]);
            
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // üye yorumları sil

        function uyeyorumlarsil () {

            $this->yetkiKontrol->yetkiBak("uyeYonetim");

            if($_POST):

                echo $this->model->silme("yorumlar", "id=".$_POST["yorumid"]);
            
            else:

                $this->bilgi->direktYonlen("/");
                
            endif;

        }

        // ------------ ÜRÜNLER ------------ \\

        // ürün listele

        function urunler ($mevcutsayfa = false) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");

            $adet = $this->model->gelismisArama("urunlerVeriAdet", "ayarlar", false);

            $this->pagination->paginationOlustur($this->model->sayfalama("urunler"), $mevcutsayfa, $adet[0][0]);

            $kategoriAdlari = $this->model->cokluBirlestirListele(
                "DISTINCT", 
                array("urunler.katid", "alt_kategori.ad", "cocuk_kategori.ad", "ana_kategori.ad"),
                array("urunler", "alt_kategori", "cocuk_kategori", "ana_kategori"),
                "WHERE urunler.katid = alt_kategori.id && alt_kategori.cocuk_kat_id = cocuk_kategori.id && cocuk_kategori.ana_kat_id = ana_kategori.id ORDER BY alt_kategori.id asc"
            );

            $this->view->goster(
                "YonPanel/sayfalar/urunler",
                [
                    "data" => $this->model->veriAl("urunler", " order by id asc LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                    "anaKategori" => $this->model->veriAl("ana_kategori", false),
                    "cocukKategori" => $this->model->veriAl("cocuk_kategori", false),
                    "altKategori" => $this->model->veriAl("alt_kategori", false),
                    "kategoriAdlari" => $kategoriAdlari,
                    "toplamsayfa" => $this->pagination->toplamsayfa,
                    "toplamveri" => $this->model->sayfalama("urunler"),
                ]
            );

        }

        // ürün getir

        function katgoregetir ($kelime=false, $mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");
            
            if($_POST):

                $katid = $this->form->get("katid")->bosmu();
                
                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $adet = $this->model->gelismisArama("urunlerVeriAdet", "ayarlar", false);

                    $this->pagination->paginationOlustur($this->model->sayfalama("urunler", " where katid=".$katid), $mevcutsayfa, $adet[0][0]);
                    
                    $kategoriAdlari = $this->model->cokluBirlestirListele(
                        "DISTINCT", 
                        array("urunler.katid", "alt_kategori.ad", "cocuk_kategori.ad", "ana_kategori.ad"),
                        array("urunler", "alt_kategori", "cocuk_kategori", "ana_kategori"),
                        "WHERE urunler.katid = alt_kategori.id && alt_kategori.cocuk_kat_id = cocuk_kategori.id && cocuk_kategori.ana_kat_id = ana_kategori.id ORDER BY alt_kategori.id asc"
                    );

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler",
                        [
                            "data" => $this->model->veriAl("urunler", " where katid=".$katid." order by id asc LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                            "anaKategori" => $this->model->veriAl("ana_kategori", false),
                            "cocukKategori" => $this->model->veriAl("cocuk_kategori", false),
                            "altKategori" => $this->model->veriAl("alt_kategori", false),
                            "kategoriAdlari" => $kategoriAdlari,
                            "toplamsayfa" => $this->pagination->toplamsayfa,
                            "toplamveri" => $this->model->sayfalama("urunler", " where katid=".$katid),
                            "urunkategori" => $katid
                        ]
                    );
                
                endif;

            elseif(isset($kelime)):

                $kategoriAdlari = $this->model->cokluBirlestirListele(
                    "DISTINCT", 
                    array("urunler.katid", "alt_kategori.ad", "cocuk_kategori.ad", "ana_kategori.ad"),
                    array("urunler", "alt_kategori", "cocuk_kategori", "ana_kategori"),
                    "WHERE urunler.katid = alt_kategori.id && alt_kategori.cocuk_kat_id = cocuk_kategori.id && cocuk_kategori.ana_kat_id = ana_kategori.id ORDER BY alt_kategori.id asc"
                );

                $adet = $this->model->gelismisArama("urunlerVeriAdet", "ayarlar", false);

                $this->pagination->paginationOlustur($this->model->sayfalama("urunler", "where katid=".$kelime), $mevcutsayfa, $adet[0][0]);

                $this->view->goster(
                    "YonPanel/sayfalar/urunler",
                    [
                        "data" => $this->model->veriAl("urunler", " where katid=".$kelime." order by id asc LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                        "anaKategori" => $this->model->veriAl("ana_kategori", false),
                        "cocukKategori" => $this->model->veriAl("cocuk_kategori", false),
                        "altKategori" => $this->model->veriAl("alt_kategori", false),
                        "kategoriAdlari" => $kategoriAdlari,
                        "toplamsayfa" => $this->pagination->toplamsayfa,
                        "toplamveri" => $this->model->sayfalama("urunler", " where katid=".$kelime),
                        "urunkategori" => $kelime
                    ]
                );
                
            else:

                $this->bilgi->direktYonlen("/panel/urunler");
                
            endif;
        }

        // ürün arama

        function urunarama ($kelime=false, $mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");
            
            if($_POST || isset($kelime)):

                if($_POST):

                    $ara = $this->form->get("ara")->bosmu();

                    $kosul = !empty($this->form->error);

                else:

                    $ara = $kelime;

                    $kosul = empty($kelime);

                endif;

                if ($kosul) :

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "ARAMA KISMI BOŞ OLAMAZ", "warning"))
                    ); 

                else:

                    $sorgu = " where urunad like '%".$ara."%' or
                    kumas like '%".$ara."%' or
                    renk like '%".$ara."%' or
                    fiyat like '".$ara."' or
                    stok like '".$ara."'";

                    $bilgicek = $this->model->arama("urunler", $sorgu);

                    if(isset($bilgicek[0]["id"])):

                        $adet = $this->model->gelismisArama("urunlerVeriAdet", "ayarlar", false);

                        $this->pagination->paginationOlustur($this->model->sayfalama("urunler", $sorgu), $mevcutsayfa, $adet[0][0]);
                        
                        $kategoriAdlari = $this->model->cokluBirlestirListele(
                            "DISTINCT", 
                            array("urunler.katid", "alt_kategori.ad", "cocuk_kategori.ad", "ana_kategori.ad"),
                            array("urunler", "alt_kategori", "cocuk_kategori", "ana_kategori"),
                            "WHERE urunler.katid = alt_kategori.id && alt_kategori.cocuk_kat_id = cocuk_kategori.id && cocuk_kategori.ana_kat_id = ana_kategori.id ORDER BY alt_kategori.id asc"
                        );

                        $this->view->goster(
                            "YonPanel/sayfalar/urunler",
                            [
                                "data" => $this->model->veriAl("urunler", $sorgu." order by id asc LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                                "anaKategori" => $this->model->veriAl("ana_kategori", false),
                                "cocukKategori" => $this->model->veriAl("cocuk_kategori", false),
                                "altKategori" => $this->model->veriAl("alt_kategori", false),
                                "kategoriAdlari" => $kategoriAdlari,
                                "toplamsayfa" => $this->pagination->toplamsayfa,
                                "toplamveri" => $this->model->sayfalama("urunler", $sorgu),
                                "urunarama" => $ara
                            ]
                        );

                    else:
                        
                        $this->view->goster(
                            "YonPanel/sayfalar/urunler", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE EŞLEŞMEMİŞTİR", "warning"))
                        ); 

                    endif;
                
                endif;

            else:

                $this->bilgi->direktYonlen("/panel/urunler");
                
            endif;
        }

        // ürün sil

        function urunSil ($id) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");

            $sonuc = $this->model->silme("urunler", "id=".$id);

            if ($sonuc):
            
                $this->view->goster(
                    "YonPanel/sayfalar/urunler", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARILI", "SİLME İŞLEMİ BAŞARILI", "success"))
                ); 
            
            else:

                $this->view->goster(
                    "YonPanel/sayfalar/urunler", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "SİLME SIRASINDA HATA OLUŞTU", "warning"))
                );                    


            endif;

        }

        // ürün ekleme 

        function urunEkle () {

            $this->yetkiKontrol->yetkiBak("urunYonetim");

            $this->view->goster("YonPanel/sayfalar/urunler",
                [
                    "urunEkle" => 0,
                    "altKat" => $this->model->veriAl("alt_kategori", false)
                ]
            );

        }

        function urunEkleSon () {

            $this->yetkiKontrol->yetkiBak("urunYonetim");

            if($_POST):

                $urunad = $this->form->get("urunad")->bosmu();
                
                $kategori = $this->form->get("kategori")->bosmu();

                $durum = $this->form->get("durum")->bosmu();

                $kumas = $this->form->get("kumas")->bosmu();

                $renk = $this->form->get("renk")->bosmu();

                $fiyat = $this->form->get("fiyat")->bosmu();

                $stok = $this->form->get("stok")->bosmu();

                $urtYeri = $this->form->get("urtYeri")->bosmu();

                $aciklama = $this->form->get("aciklama")->bosmu();

                $ozellik = $this->form->get("ozellik")->bosmu();

                $ekstraBilgi = $this->form->get("ekstraBilgi")->bosmu();

                $this->upload->dosyaEkle("res", 3);

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                elseif (!empty($this->upload->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler", 
                        array("bilgi" => $this->upload->error)
                    ); 

                else:

                    $res = $this->upload->yukle();
        
                    $sonuc = $this->model->ekleme(
                        "urunler",
                        array("katid", "urunad", "res1", "res2", "res3", "durum", "aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok" , "ozellik", "ekstraBilgi"),
                        array($kategori, $urunad, $res[0], $res[1], $res[2], $durum, $aciklama, $kumas, $urtYeri, $renk, $fiyat, $stok, $ozellik, $ekstraBilgi)
                    );

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/urunler",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARILI", "EKLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/urunler", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "EKLEME İŞLEMİNDE HATA OLUŞTU", "warning"))
                        ); 

                    endif;
                
                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/urunler");
                
            endif;

        }

        // ürün güncelleme 

        function urunGuncelle ($id) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");

            $this->view->goster("YonPanel/sayfalar/urunler",
                [
                    "urunGuncelle" => $this->model->veriAl("urunler", "where id=".$id),
                    "anaKat" => $this->model->veriAl("ana_kategori", false),
                    "cocukKat" => $this->model->veriAl("cocuk_kategori", false),
                    "altKat" => $this->model->veriAl("alt_kategori", false)
                ]
            );

        }

        function urunGuncelleSon () {

            $this->yetkiKontrol->yetkiBak("urunYonetim");

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $urunad = $this->form->get("urunad")->bosmu();
                
                $anaKatId = $this->form->get("anaKatId")->bosmu();

                $cocukKatId = $this->form->get("cocukKatId")->bosmu();

                $altKatId = $this->form->get("altKatId")->bosmu();

                $durum = $this->form->selectBoxGet("durum");

                $kumas = $this->form->get("kumas")->bosmu();

                $renk = $this->form->get("renk")->bosmu();

                $fiyat = $this->form->get("fiyat")->bosmu();

                $stok = $this->form->get("stok")->bosmu();

                $urtYeri = $this->form->get("urtYeri")->bosmu();

                $aciklama = $this->form->get("aciklama")->bosmu();

                $ozellik = $this->form->get("ozellik")->bosmu();

                $ekstraBilgi = $this->form->get("ekstraBilgi")->bosmu();

                if($this->upload->uploadControl("res1")) : $this->upload->dosyaGuncelle("res1");  endif;

                if($this->upload->uploadControl("res2")) : $this->upload->dosyaGuncelle("res2");  endif;

                if($this->upload->uploadControl("res3")) : $this->upload->dosyaGuncelle("res3");  endif;

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                elseif (!empty($this->upload->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/urunler", 
                        array(
                            "bilgi" => $this->upload->error,
                            "yonlen" => $this->bilgi->sureliYonlen("/panel/urunler")
                        )
                    ); 

                else:

                    $sutunlar = array("anaKatId", "cocukKatId", "katid", "urunad", "durum", "aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok" , "ozellik", "ekstraBilgi");
                    
                    $veriler = array($anaKatId, $cocukKatId, $altKatId, $urunad, $durum, $aciklama, $kumas, $urtYeri, $renk, $fiyat, $stok, $ozellik, $ekstraBilgi);
                
                    if($this->upload->uploadControl("res1")) :

                        $sutunlar[] = "res1";

                        $veriler[] = $this->upload->yukle("res1", true);

                    endif;

                    if($this->upload->uploadControl("res2")) :

                        $sutunlar[] = "res2";

                        $veriler[] = $this->upload->yukle("res2", true);

                    endif;

                    if($this->upload->uploadControl("res3")) :

                        $sutunlar[] = "res3";

                        $veriler[] = $this->upload->yukle("res3", true);

                    endif;

                    $sonuc = $this->model->guncelle(
                        "urunler",
                        $sutunlar,
                        $veriler,
                        "id=".$id
                    );

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/urunler",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/urunler", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning"))
                        ); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/urunler");
                
            endif;

        }

        // toplu ürün ekleme

        function topluUrunEkle ($son = false) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");
            // dosyaTercih
            if($son):

                $tercih = $this->form->radioButtonGet("dosyaTercih");

                if($tercih=="xml"):

                    $sorgum = $this->DosyaIslemleri->verileriAyikla(
                        "dosya",
                        "/urunler/urun",
                        array("anakatid", "cocukkatid", "katid","urunad", "res1", "res2", "res3", "durum","aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok" , "ozellik", "ekstraBilgi"),
                        // text değerler için özel tanımlama
                        array(false, false, false, true, true, true, true, false, true, true, true, true, false, false , true, true)
                    );

                else:

                    $sorgum = $this->DosyaIslemleri->jsonVerileriAyikla("dosya");

                endif;
                
                if(!empty($this->DosyaIslemleri->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/topluUrunIslemleri", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "YÜKLENEN XML DOSYASI AÇILAMADI", "warning"))
                    ); 

                else:

                    $zipSonuc = $this->upload->zipControl("zipDosya");

                    if(!empty($this->DosyaIslemleri->error)) :

                        $this->view->goster(
                            "YonPanel/sayfalar/topluUrunIslemleri", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "YÜKLENEN ZİP DOSYASI AÇILAMADI", "warning"))
                        ); 

                    else:

                        $sonuc = $this->model->topluEkle(
                            "urunler",
                            array("anakatid", "cocukkatid", "katid", "urunad", "res1", "res2", "res3", "durum", "aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok" , "ozellik", "ekstraBilgi"),
                            $sorgum
                        );

                        if($sonuc):

                            $this->upload->zipYukle("zipDosya", $zipSonuc);
                        
                            $this->view->goster("YonPanel/sayfalar/topluUrunIslemleri",
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARILI", "EKLEME BAŞARILI", "success"))
                            );
        
                        else:
        
                            $this->view->goster("YonPanel/sayfalar/topluUrunIslemleri", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "EKLEME İŞLEMİNDE HATA OLUŞTU", "warning"))
                            ); 
        
                        endif;

                    endif;

                endif;

            else:

                $this->view->goster("YonPanel/sayfalar/topluUrunIslemleri",
                    [ "topluUrunEkleme" => true ]
                );

            endif;

        }

        // toplu ürün ekleme

        function topluUrunGuncelle ($son = false) {

            $this->yetkiKontrol->yetkiBak("urunYonetim");
            // dosyaTercih
            if($son):

                $tercih = $this->form->radioButtonGet("dosyaGuncelleTercih");

                if($tercih=="xml"):

                    $sorgum = $this->DosyaIslemleri->guncelleVerileriAyikla(
                        "Guncellemedosya",
                        "/urunler/urun",
                        array("anakatid", "cocukkatid", "katid", "urunad", "res1", "res2", "res3", "durum","aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok" , "ozellik", "ekstraBilgi"),
                    );

                else:

                    $sorgum = $this->DosyaIslemleri->jsonVerileriAyikla("dosya");

                endif;
                
                if(!empty($this->DosyaIslemleri->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/topluUrunIslemleri", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "YÜKLENEN XML DOSYASI AÇILAMADI", "warning"))
                    ); 

                else:

                    $zipSonuc = $this->upload->zipControl("zipDosya");

                    if(!empty($this->DosyaIslemleri->error)) :

                        $this->view->goster(
                            "YonPanel/sayfalar/topluUrunIslemleri", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "YÜKLENEN ZİP DOSYASI AÇILAMADI", "warning"))
                        ); 

                    else:

                        $sonuc = $this->model->topluGuncelle(
                            "urunler",
                            $sorgum
                        );

                        if($sonuc):

                            $this->upload->zipYukle("zipDosya", $zipSonuc);
                        
                            $this->view->goster("YonPanel/sayfalar/topluUrunIslemleri",
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARILI", "EKLEME BAŞARILI", "success"))
                            );
        
                        else:
        
                            $this->view->goster("YonPanel/sayfalar/topluUrunIslemleri", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/urunler", "BAŞARISIZ", "EKLEME İŞLEMİNDE HATA OLUŞTU", "warning"))
                            ); 
        
                        endif;

                    endif;

                endif;

            else:

                $this->view->goster("YonPanel/sayfalar/topluUrunIslemleri",
                    [ "topluUrunGuncelleme" => true ]
                );

            endif;

        }

        // ------------ BÜLTEN ------------ \\

        // bülten listele

        function bulten ($mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("bultenYonetim");

            $adet = $this->model->gelismisArama("bultenVeriAdet", "ayarlar", false);

            $this->pagination->paginationOlustur($this->model->sayfalama("bulten"), $mevcutsayfa, $adet[0][0]);

            $this->view->goster(
                "YonPanel/sayfalar/bulten",
                [
                    "data" => $this->model->veriAl("bulten", " LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                    "toplamsayfa" => $this->pagination->toplamsayfa,
                    "toplamveri" => $this->model->sayfalama("bulten"),
                ]
            );

        }

        function bultenExcelAl () {

            $this->model->excelAyarCek("bulten", "bulten");

            $this->DosyaCikti->excelAl("Mailler", array("Mail Adresi"), $this->model->icerikler);

        }

        function bultenTxtAl () {

            $this->DosyaCikti->txtOlustur($this->model->veriAl("bulten", false));

        }

        function mailSil ($id) {
            
            $this->yetkiKontrol->yetkiBak("bultenYonetim");
            
            $sonuc = $this->model->silme("bulten", "id=".$id);

            if ($sonuc):
            
                $this->view->goster(
                    "YonPanel/sayfalar/bulten", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bulten", "BAŞARILI", "SİLME İŞLEMİ BAŞARILI", "success"))
                    
                ); 
            
            else:

                $this->view->goster(
                    "YonPanel/sayfalar/bulten", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bulten", "BAŞARISIZ", "SİLME SIRASINDA HATA OLUŞTU", "warning"))
                ); 

            endif;

        }

        function mailArama ($kelime=false, $mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("bultenYonetim");

            if($_POST || isset($kelime)):

                if($_POST):

                    $ara = $this->form->get("ara")->bosmu();

                    $kosul = !empty($this->form->error);

                else:

                    $ara = $kelime;

                    $kosul = empty($kelime);

                endif;

                if ($kosul) :

                    $this->view->goster(
                        "YonPanel/sayfalar/bulten", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bulten", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $sorgu = "where mailadres like '%".$ara."%'";

                    $bilgicek = $this->model->arama("bulten", $sorgu);

                    $adet = $this->model->gelismisArama("bultenVeriAdet", "ayarlar", false);

                    if(isset($bilgicek[0]["id"])):

                        $this->pagination->paginationOlustur($this->model->sayfalama("bulten", $sorgu), $mevcutsayfa, $adet[0][0]);

                        $this->view->goster(
                            "YonPanel/sayfalar/bulten",
                            [
                                "data" => $this->model->veriAl("bulten", $sorgu." LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                                "toplamsayfa" => $this->pagination->toplamsayfa,
                                "toplamveri" => count($bilgicek),
                                "bultenarama" => $ara
                            ]
                        );

                    else:
                        
                        $this->view->goster(
                            "YonPanel/sayfalar/bulten", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bulten", "BAŞARISIZ", "HİÇ BİR BİLGİ İLE UYUŞMADI", "warning"))
                        ); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/bulten");
                
            endif;

        }

        function tarihMailGetir ($tarih1=false, $tarih2=false, $mevcutsayfa=false) {

            $this->yetkiKontrol->yetkiBak("bultenYonetim");

            if($_POST || (isset($tarih1) && isset($tarih2))):

                if($_POST):

                    $tar1 = $this->form->get("tar1")->bosmu();
                
                    $tar2 = $this->form->get("tar2")->bosmu();

                    $kosul = !empty($this->form->error);

                else:

                    $tar1 = $tarih1;
                
                    $tar2 = $tarih2;

                    $kosul = empty($tar1) || empty($tar2);

                endif;

                if ($kosul) :

                    $this->view->goster(
                        "YonPanel/sayfalar/bulten", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bulten", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $sorgu = "where DATE(tarih) between '".$tar1."' and '".$tar2."'";

                    $bilgicek = $this->model->arama("bulten", $sorgu);

                    if(isset($bilgicek[0]["id"])):

                        $adet = $this->model->gelismisArama("bultenVeriAdet", "ayarlar", false);

                        $this->pagination->paginationOlustur($this->model->sayfalama("bulten", $sorgu), $mevcutsayfa, $adet[0][0]);

                        $this->view->goster(
                            "YonPanel/sayfalar/bulten",
                            [
                                "data" => $this->model->arama("bulten", $sorgu." LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                                "toplamsayfa" => $this->pagination->toplamsayfa,
                                "toplamveri" => count($bilgicek),
                                "tarih1" => $tar1,
                                "tarih2" =>  $tar2
                            ]
                        );

                    else:
                        
                        $this->view->goster(
                            "YonPanel/sayfalar/bulten", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/bulten", "BAŞARISIZ", "BU TARİH ARALIĞINDA BİR MAİL BULUNAMADI", "warning"))
                        ); 

                    endif;
                    
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/bulten");
                
            endif;

        }

        // ------------ SİSTEM AYARLARI ------------ \\

        // sistem ayarları listele

        function sistemAyar () {

            $this->yetkiKontrol->yetkiBak("sistemAyarlari");

            $this->view->goster(
                "YonPanel/sayfalar/sistemAyar",
                [
                    "sistemAyar" => $this->model->veriAl("ayarlar", "order by id asc"),
                ]
            );

        }

        // sistem ayarları güncelle

        function sistemAyarGuncelle () {

            $this->yetkiKontrol->yetkiBak("sistemAyarlari");

            if($_POST):

                $sloganUst1 = $this->form->get("sloganUst1")->bosmu();
                
                $sloganAlt1 = $this->form->get("sloganAlt1")->bosmu();

                $sloganUst2 = $this->form->get("sloganUst2")->bosmu();

                $sloganAlt2 = $this->form->get("sloganAlt2")->bosmu();

                $sloganUst3 = $this->form->get("sloganUst3")->bosmu();

                $sloganAlt3 = $this->form->get("sloganAlt3")->bosmu();

                $uyelerVeriAdet = $this->form->get("uyelerVeriAdet")->bosmu();

                $urunlerVeriAdet = $this->form->get("urunlerVeriAdet")->bosmu();

                $urunlerGoruntuAdet = $this->form->get("urunlerGoruntuAdet")->bosmu();

                $yorumlarGoruntuAdet = $this->form->get("yorumlarGoruntuAdet")->bosmu();

                $adreslerGoruntuAdet = $this->form->get("adreslerGoruntuAdet")->bosmu();

                $siparislerGoruntuAdet = $this->form->get("siparislerGoruntuAdet")->bosmu();

                $title = $this->form->get("title")->bosmu();

                $sayfaAciklama = $this->form->get("sayfaAciklama")->bosmu();

                $anahtarKelime = $this->form->get("anahtarKelime")->bosmu();

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/sistemAyar", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sistemAyar", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $sonuc = $this->model->guncelle(
                        "ayarlar",
                        array("sloganUst1", "sloganAlt1", "sloganUst2", "sloganAlt2", "sloganUst3", "sloganAlt3", "title", "sayfaAciklama", "anahtarKelime", "uyelerVeriAdet", "urunlerVeriAdet", "urunlerGoruntuAdet", "yorumlarGoruntuAdet", "adreslerGoruntuAdet", "siparislerGoruntuAdet"),
                        array($sloganUst1, $sloganAlt1, $sloganUst2, $sloganAlt2, $sloganUst3, $sloganAlt3, $title, $sayfaAciklama, $anahtarKelime, $uyelerVeriAdet, $urunlerVeriAdet, $urunlerGoruntuAdet, $yorumlarGoruntuAdet, $adreslerGoruntuAdet, $siparislerGoruntuAdet),
                        "id=1"
                    );

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/sistemAyar",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sistemAyar", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/sistemAyar", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sistemAyar", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning"))
                        ); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/sistemAyar");
                
            endif;

        }

        // ------------ SİSTEM BAKIM ------------ \\

        // sistem bakım listele

        function sistemBakim () {

            $this->yetkiKontrol->yetkiBak("sistemBakim");

            $this->view->goster(
                "YonPanel/sayfalar/sistemBakim",
                [
                    "sistemBakim" => true,
                ]
            );

        }

        function bakimYap () {

            $this->yetkiKontrol->yetkiBak("sistemBakim");

            if($_POST["sistemBtn"]):

                $bakim = $this->model->sistemBakim(DB_NAME);

                if($bakim):
                            
                    $this->view->goster("YonPanel/sayfalar/SistemBakim",
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/SistemBakim", "BAŞARILI", "SİSTEM BAKIMI BAŞARIYLA TAMAMLANDI", "success"))
                    );

                else:

                    $this->view->goster("YonPanel/sayfalar/SistemBakim", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/SistemBakim", "BAŞARISIZ", "BAKIM SIRASINDA HATA OLUŞTU", "warning"))
                    ); 

                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/SistemBakim");
                
            endif;

        }

        // ------------ VERİ TABANI YEDEKLEME ------------ \\

        // veri tabanı yedekleme getir

        function veriTabaniYedekle () {

            $this->yetkiKontrol->yetkiBak("sistemBakim");

            $this->view->goster(
                "YonPanel/sayfalar/veriTabaniYedekle",
                [
                    "veriTabaniYedekle" => true,
                ]
            );

        } 

        function dbYedekAl ($deger) {

            $this->DosyaCikti->veriTabaniYedekIndir($deger);


        }

        function yedekAl () {

            $this->yetkiKontrol->yetkiBak("sistemBakim");

            if($_POST["yedekBtn"]):

                $yedek = $this->model->veriTabaniYedekle(DB_NAME);

                $yedekTercih = $this->form->radioButtonGet("yedekTercih");

                if($yedek[0]):

                    if($yedekTercih=="local"):

                        $yol = fopen(YEDEKYOL.date("d.m.Y").".sql", "w+");
    
                        fwrite($yol, $yedek[1]);
    
                        fclose($yol);
        
                        $this->DosyaCikti->veriTabaniYedekIndir($yedek[1]);
          
                        $this->view->goster("YonPanel/sayfalar/veriTabaniYedekle",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/veriTabaniYedekle", "BAŞARILI", "VERİ TABANI YEDEKLEME BAŞARIYLA TAMAMLANDI", "success"))
                        );

                    else:

                        $this->dbYedekAl($yedek[1]);

                    endif;

                else:
    
                    $this->view->goster("YonPanel/sayfalar/veriTabaniYedekle", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/veriTabaniYedekle", "BAŞARISIZ", "VERİ TABANI YEDEKLEME SIRASINDA HATA OLUŞTU", "warning"))
                    ); 

                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/veriTabaniYedekle");
                
            endif;

        }

        // ------------ OTURUM ÇIKIŞ ------------ \\

        function cikis () {

            Session::destroy();

            $this->bilgi->direktYonlen("/panel/giris");

        }

        // ------------ ŞİFRE DEĞİŞTİRME ------------ \\

        function sifreDegistir () {

            $this->yetkiKontrol->yetkiBak("sifreDegistir");
            
            $this->view->goster("YonPanel/sayfalar/sifreDegistir", 
                ["sifreDegistir" => $this->model->veriAl("yonetim", "where id=".Session::get("AdminId"))]
            );

        }

        function sifreDegistirSon () {

            $this->yetkiKontrol->yetkiBak("sifreDegistir");

            if($_POST):

                $mevcutSifre = $this->form->get("mevcutSifre")->bosmu();

                $yeniSifre = $this->form->get("yeniSifre")->bosmu();

                $sifreTekrar = $this->form->get("sifreTekrar")->bosmu();

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/sifreDegistir", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sifreDegistir", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    if($yeniSifre == $sifreTekrar):

                        // sifrele

                        $mevcutSifre = $this->form->sifrele($mevcutSifre);

                        $yeniSifre = $this->form->sifrele($yeniSifre);

                        $sifreTekrar = $this->form->sifrele($sifreTekrar);

                        $sonuc = $this->model->guncelle("yonetim", array("sifre"), array($yeniSifre), "id='".Session::get("AdminId")."' and sifre='".$mevcutSifre."'");
                        
                        if($sonuc):
                        
                            $this->view->goster("YonPanel/sayfalar/siparis",
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sifreDegistir", "BAŞARILI", "ŞİFRE DEĞİŞTİRME BAŞARILI", "success"))
                            );
        
                        else:
        
                            $this->view->goster("YonPanel/sayfalar/sifreDegistir", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sifreDegistir", "BAŞARISIZ", "MEVCUT ŞİFRE HATALIDIR", "warning"))
                            ); 
        
                        endif;

                    else:

                        $this->view->goster("YonPanel/sayfalar/sifreDegistir", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/sifreDegistir", "BAŞARISIZ", "ŞİFRE TEKRARINDA HATA YAPTINIZ", "warning"))
                        ); 

                    endif;
                
                endif;
                
            else:

                $this->bilgi->direktYonlen("/panel/sifreDegistir");
                
            endif;

        }

        // ------------ YÖNETİCİ İŞLEMLERİ ------------ \\

        // yönetici listele

        function yonetici () {
            
            $this->yetkiKontrol->yetkiBak("kullaniciYonetim");
            
            $this->view->goster(
                "YonPanel/sayfalar/yonetici",
                [
                    "data" => $this->model->veriAl("yonetim", "order by id asc"),
                ]
            );

        }

        // yönetici sil

        function yoneticiSil ($id) {

            $this->yetkiKontrol->yetkiBak("kullaniciYonetim");

            $sonuc = $this->model->silme("yonetim", "id=".$id);

            if ($sonuc):
            
                $this->view->goster(
                    "YonPanel/sayfalar/yonetici", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARILI", "SİLME İŞLEMİ BAŞARILI", "success"))
                ); 
            
            else:

                $this->view->goster(
                    "YonPanel/sayfalar/yonetici", 
                    array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARISIZ", "SİLME SIRASINDA HATA OLUŞTU", "warning"))
                ); 

            endif;

        }

        // yönetici ekleme 

        function yoneticiEkle () {

            $this->yetkiKontrol->yetkiBak("kullaniciYonetim");

            $this->view->goster("YonPanel/sayfalar/yonetici",
                [
                    "yoneticiEkle" => true
                ]
            );

        }

        function yoneticiEkleSon () {

            $this->yetkiKontrol->yetkiBak("kullaniciYonetim");

            if($_POST):

                $yoneticiAdi = $this->form->get("yoneticiAdi")->bosmu();
                
                $sifre = $this->form->get("sifre")->bosmu();
                
                $sifreTekrar = $this->form->get("sifreTekrar")->bosmu();

                $siparisYonetim = $this->form->checkBoxGet("siparisYonetim");

                $kategoriYonetim = $this->form->checkBoxGet("kategoriYonetim");

                $uyeYonetim = $this->form->checkBoxGet("uyeYonetim");

                $urunYonetim = $this->form->checkBoxGet("urunYonetim");

                $muhasebeYonetim = $this->form->checkBoxGet("muhasebeYonetim");

                $kullaniciYonetim = $this->form->checkBoxGet("kullaniciYonetim");

                $bultenYonetim = $this->form->checkBoxGet("bultenYonetim");

                $sifreDegistir = $this->form->checkBoxGet("sifreDegistir");

                $sistemAyarlari = $this->form->checkBoxGet("sistemAyarlari");

                $sistemBakim = $this->form->checkBoxGet("sistemBakim");

                $yetki = $this->form->selectBoxGet("yetki");

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/yonetici", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    if($sifre == $sifreTekrar):

                        $sifre = $this->form->sifrele($sifre);

                        $sonuc = $this->model->ekleme(
                            "yonetim",
                            array("ad","sifre","yetki","siparisYonetim","kategoriYonetim","uyeYonetim","urunYonetim","muhasebeYonetim","kullaniciYonetim","bultenYonetim","sifreDegistir","sistemAyarlari","sistemBakim"),
                            array($yoneticiAdi,$sifre,$yetki,$siparisYonetim,$kategoriYonetim,$uyeYonetim,$urunYonetim,$muhasebeYonetim,$kullaniciYonetim,$bultenYonetim,$sifreDegistir,$sistemAyarlari,$sistemBakim)
                        );

                        if($sonuc):
                            
                            $this->view->goster("YonPanel/sayfalar/yonetici",
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARILI", "EKLEME BAŞARILI", "success"))
                            );

                        else:

                            $this->view->goster("YonPanel/sayfalar/yonetici", 
                                array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARISIZ", "EKLEME SIRASINDA HATA OLUŞTU", "warning"))
                            ); 

                        endif;

                    else :

                        $this->view->goster("YonPanel/sayfalar/yonetici", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARISIZ", "ŞİFRE TEKRARINDA HATA YAPTINIZ", "warning"))
                        );
                        
                    endif;
                
                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/yonetici");
                
            endif;

        }

        // yönetici güncelle 

        function yoneticiGuncelle ($id) {

            $this->yetkiKontrol->yetkiBak("kullaniciYonetim");

            $this->view->goster("YonPanel/sayfalar/yonetici",
                [
                    "yoneticiGuncelle" => $this->model->veriAl("yonetim", "where id=".$id)
                ]
            );

        }

        function yoneticiGuncelleSon () {
            
            $this->yetkiKontrol->yetkiBak("kullaniciYonetim");

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $yoneticiAdi = $this->form->get("yoneticiAdi")->bosmu();

                $siparisYonetim = $this->form->checkBoxGet("siparisYonetim");

                $kategoriYonetim = $this->form->checkBoxGet("kategoriYonetim");

                $uyeYonetim = $this->form->checkBoxGet("uyeYonetim");

                $urunYonetim = $this->form->checkBoxGet("urunYonetim");

                $muhasebeYonetim = $this->form->checkBoxGet("muhasebeYonetim");

                $kullaniciYonetim = $this->form->checkBoxGet("kullaniciYonetim");

                $bultenYonetim = $this->form->checkBoxGet("bultenYonetim");

                $sifreDegistir = $this->form->checkBoxGet("sifreDegistir");

                $sistemAyarlari = $this->form->checkBoxGet("sistemAyarlari");

                $sistemBakim = $this->form->checkBoxGet("sistemBakim");

                $yetki = $this->form->selectBoxGet("yetki");

                if (!empty($this->form->error)) :

                    $this->view->goster(
                        "YonPanel/sayfalar/yonetici", 
                        array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARISIZ", "BOŞ ALAN BIRAKILAMAZ", "warning"))
                    ); 

                else:

                    $sonuc = $this->model->guncelle(
                        "yonetim",
                        array("ad","yetki","siparisYonetim","kategoriYonetim","uyeYonetim","urunYonetim","muhasebeYonetim","kullaniciYonetim","bultenYonetim","sifreDegistir","sistemAyarlari","sistemBakim"),
                        array($yoneticiAdi,$yetki,$siparisYonetim,$kategoriYonetim,$uyeYonetim,$urunYonetim,$muhasebeYonetim,$kullaniciYonetim,$bultenYonetim,$sifreDegistir,$sistemAyarlari,$sistemBakim),
                        "id=".$id
                    );

                    if($sonuc):
                        
                        $this->view->goster("YonPanel/sayfalar/yonetici",
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARILI", "GÜNCELLEME BAŞARILI", "success"))
                        );

                    else:

                        $this->view->goster("YonPanel/sayfalar/yonetici", 
                            array("bilgi" => $this->bilgi->sweetAlert(URL."/panel/yonetici", "BAŞARISIZ", "GÜNCELLEME SIRASINDA HATA OLUŞTU", "warning"))
                        ); 

                    endif;
                
                endif;
            
            else:

                $this->bilgi->direktYonlen("/panel/yonetici");
                
            endif;

        }

    }

?>