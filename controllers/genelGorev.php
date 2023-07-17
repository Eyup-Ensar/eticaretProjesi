<?php 

    class genelGorev extends Controller {

        function __construct () {

            parent:: libsInclude(array("form", "bilgi"));

            Session::init();

            $this->ModelYukle("genelGorev");
            
        }

        function yorumFormKontrol () {

            if($_POST):
            
                $uyeid = $this->form->get("uyeid")->bosmu();

                $urunid = $this->form->get("urunid")->bosmu();

                $urunid = $this->form->get("urunid")->bosmu();

                $ad = $this->form->get("ad")->bosmu();

                $icerik = $this->form->get("icerik")->bosmu();

                $tarih = date("d-m-Y");

                if (!empty($this->form->error)) :

                    echo $this->bilgi->uyari("danger", "LÜTFEN BOŞ ALAN BIRAKMAYINIZ");

                else:

                    $sonuc = $this->model->ekle("yorumlar", array('uyeid', 'urunid', 'ad', 'icerik', 'tarih'), array($uyeid, $urunid, $ad, $icerik, $tarih));
                    
                    if($sonuc==1):
                        
                        echo $this->bilgi->uyari("success", "Yorum yapma işleminiz başarıyla gerçekleşti. Teşekkür ederiz!", "id='ok'");

                    else:

                        echo $this->bilgi->uyari("danger", "HATA OLUŞTU LÜTFEN TEKRAR DENEYİNİZ");

                    endif;

                endif;

            else:

                $this->bilgi->direktYonlen("/");

            endif;
            
        }

        function bultenKayit () {

            if($_POST):

                $mailadres = $this->form->get("mailadres")->bosmu();
            
                $this->form->gercektenMailmi($mailadres);

                $tarih = date("Y-m-d");

                if (!empty($this->form->error)) :

                    echo $this->bilgi->uyari("danger", "GİRİLEN MAİL ADRESİ GEÇERSİZ");

                else:

                    $sonuc = $this->model->ekle("bulten", array('mailadres', 'tarih'), array($mailadres, $tarih));
                    
                    if($sonuc==1):
                        
                        echo $this->bilgi->uyari("success", "Bültene başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz...", "id='bultenok'");

                    else:

                        echo $this->bilgi->uyari("danger", "HATA OLUŞTU LÜTFEN TEKRAR DENEYİNİZ");

                    endif;

                endif;
            else:

                $this->bilgi->direktYonlen("/");

            endif;
        }

        function iletisimFormKontrol () {

            if($_POST):

                $ad = $this->form->get("ad")->bosmu();

                $mailadres = $this->form->get("mail")->bosmu();

                $konu = $this->form->get("konu")->bosmu();

                $mesaj = $this->form->get("mesaj")->bosmu();
            
                @$this->form->gercektenMailmi($mailadres);

                $tarih = date("d-m-Y");

                if (!empty($this->form->error)) :

                    echo $this->bilgi->uyari("danger", "formda hata var!");

                else:

                    $sonuc = $this->model->ekle("iletisim", array('ad', 'mail', 'konu', 'mesaj', 'tarih'), array($ad, $mailadres, $konu, $mesaj, $tarih));
                    
                    if($sonuc==1):
                        
                        echo $this->bilgi->uyari("success", "Mesajınız başarılı bir şekilde gönderilmiştir. Teşekkür ederiz...", "id='iletisimok'");

                    else:

                        echo $this->bilgi->uyari("danger", "HATA OLUŞTU LÜTFEN TEKRAR DENEYİNİZ");

                    endif;

                endif;

            else:

                $this->bilgi->direktYonlen("/");

            endif;
            
        }

        function sepeteEkle() {

            if($_POST):

                $id = $this->form->get("id")->bosmu();

                $adet = $this->form->get("adet")->bosmu();

                Cookie::SepeteEkle($id, $adet);

            else:

                $this->bilgi->direktYonlen("/");

            endif;

        }

        function urunSil() {
            
            Cookie::UrunSil($_POST["urunid"]);

        }

        function urunGuncelle() {
            
            Cookie::urunGuncelle($_POST["urunid"], $_POST["adet"]);
            
        }

        function sepetiBosalt() {

            Cookie::SepetiBosalt();

        }

        function sepetKontrol() {
            echo 
            '<a href="'.URL.'/sayfalar/sepet">
                <h3><img src="'.URL.'/views/design/images/bag.png" alt=""></h3>
                <p>';
                    if(isset($_COOKIE["urun"])):
                        echo count($_COOKIE["urun"]);
                    else:
                        echo 'Sepetiniz Boş';   
                    endif;
                echo '</p>
            </a>';
        }

        function teslimatGetir() {

            if($_POST):

                $sipNo = $this->form->get("sipNo")->bosmu();

                $adresId = $this->form->get("adresId")->bosmu();
            
                $teslimatSonuc = $this->model->listele("teslimatbilgileri", "where siparis_no=".$sipNo);

                $adreslerSonuc = $this->model->listele("adresler", "where id=".$adresId);
                
                if(isset($teslimatSonuc[0]["id"]) && $adreslerSonuc[0]["id"]):

                    echo '<div class="row">
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-dark">
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 text-center">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2">
                                            <h5>KİŞİSEL BİLGİLER</h5>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <span class="font-weight-bold">Ad : '.$teslimatSonuc[0]["ad"].'</span>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <span class="font-weight-bold">Soyad : '.$teslimatSonuc[0]["soyad"].'</span>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <span class="font-weight-bold">Mail :  '.$teslimatSonuc[0]["mail"].'</span>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <span class="font-weight-bold">Telefon : '.$teslimatSonuc[0]["telefon"].'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 text-center">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2">
                                            <h5>ADRES BİLGİSİ</h5>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <span class="font-weight-bold">Adres : '.$adreslerSonuc[0]["adres"].'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

                else:
                    
                    echo '<div class="row">
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-dark text-center">
                            <span class="text-danger">TESLİMAT BİLGİLERİNDE EKSİKLİK VAR!</span>
                        </div>
                    </div>';

                endif;

            else:

                $this->bilgi->direktYonlen("/");

            endif;

        }

        function siparisGetir ()  {

            if ($_POST) :		

            $sipno=$this->form->get("sipNo")->bosmu();

            $adresid=$this->form->get("adresId")->bosmu();

            $siparisGetir=$this->model->listele("siparisler","where siparis_no=".$sipno);

            ?><div class="row arkaplan p-1 mt-2 pb-0 text-center">  
                <div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>ÜRÜN AD</span> </div>
                <div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>ÜRÜN ADET</span> </div>
                <div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>ÜRÜN FİYAT</span> </div>
                <div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>TOPLAM FİYAT</span> </div> 
            </div><?php

            $toplam=array();

            foreach ($siparisGetir as $deger):
                echo '<div class="row border border-light text-center">     
                    <div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">'.$deger["urunad"].'</div>
                    <div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">'.$deger["urunadet"].'</div>
                    <div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">
                    '.number_format($deger["urunfiyat"],2,",",".").' TL</div>
                    <div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">'.number_format($deger["toplamfiyat"],2,",",".").' TL</div>             
                </div> ';
                $toplam[]=$deger["toplamfiyat"];	
            endforeach;?>
            
            <div class="row"> 
                <div class="col-lg-12  geneltext2 text-right kalinyap p-2 border-bottom border-secondary">
                    <span>SİPARİŞ TOPLAMI <?php print_r(number_format(array_sum($toplam),2,",","."). " TL"); ?></span>
                </div>        
            </div> <?php
            
            $teslimatbilgileriGetir=$this->model->listele("teslimatbilgileri","where siparis_no=".$sipno);
            
            $AdresGetir=$this->model->listele("adresler", "where id=".$adresid);

            echo '<div class="row">		
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-dark">
                    <div class="row">					
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 text-left">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2 geneltext2">
                                    <h5>KİŞİSEL BİLGİLER</h5>
                                </div>					
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    <span class="font-weight-bold">Ad : </span>'.$teslimatbilgileriGetir[0]["ad"].'
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    <span class="font-weight-bold">Soyad : </span>'.$teslimatbilgileriGetir[0]["soyad"].'
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    <span class="font-weight-bold">Mail :  </span>'.$teslimatbilgileriGetir[0]["mail"].'
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    <span class="font-weight-bold">Telefon : </span>'.$teslimatbilgileriGetir[0]["telefon"].'
                                </div>					
                            </div>							
                        </div>	
                        <hr>
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 text-left">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2 geneltext2">
                                    <h5>ADRES BİLGİSİ</h5>
                                </div>					
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    <span class="font-weight-bold">Adres : </span>'.$AdresGetir[0]["adres"].'
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>';

            else:	
            
                $this->bilgi->direktYonlen("/");
            
            endif;
            
        }	

        function KategoriBul () {
            
            if($_POST) :

                $kriter = $this->form->get("kriter")->bosmu();

                if($kriter == "cocukgetir"):

                    $anaKatId = $this->form->get("anaKatId")->bosmu();

                    $cocukKat = $this->model->listele("cocuk_kategori", "where ana_kat_id=".$anaKatId);
                    
                    $opt = "";
                    
                    $opt .= '<option value="0">Seçiniz</option>';

                    foreach ($cocukKat as $value) :

                        $opt .= '<option value="'.$value["id"].'">'.$value["ad"].'</option>';

                    endforeach;

                    echo $opt;

                elseif($kriter == "altgetir"):    
                
                    $cocukKatId = $this->form->get("cocukKatId")->bosmu();

                    $altKat = $this->model->listele("alt_kategori", "where cocuk_kat_id=".$cocukKatId);
                    
                    $opt = "";

                    $opt .= '<option value="0">Seçiniz</option>';

                    foreach ($altKat as $value) :

                        $opt .= '<option value="'.$value["id"].'">'.$value["ad"].'</option>';

                    endforeach;

                    echo $opt;

                endif;

            else:

                $this->bilgi->direktYonlen("/panel/urunler");
                
            endif;

        }

        function GuncelKategoriBul () {
            
            if($_POST) :

                $kriter = $this->form->get("kriter")->bosmu();

                if($kriter == "cocukgetir"):

                    $anaKatId = $this->form->get("anaKatId")->bosmu();

                    $cocukKat = $this->model->listele("cocuk_kategori", "where ana_kat_id=".$anaKatId);
                    
                    $opt = "";

                    foreach ($cocukKat as $value) :

                        $opt .= '<option value="'.$value["id"].'">'.$value["ad"].'</option>';

                    endforeach;

                    echo $opt;

                elseif($kriter == "altgetir"):    
                
                    $cocukKatId = $this->form->get("cocukKatId")->bosmu();

                    $altKat = $this->model->listele("alt_kategori", "where cocuk_kat_id=".$cocukKatId);
                    
                    $opt = "";

                    foreach ($altKat as $value) :

                        $opt .= '<option value="'.$value["id"].'">'.$value["ad"].'</option>';

                    endforeach;

                    echo $opt;

                endif;

            else:

                $this->bilgi->direktYonlen("/panel/urunler");
                
            endif;

        }
        
        function menuAcKapat () {
            
            if($_POST) :

                $yeniBool = true;

                $bool = $this->model->listele("ayarlar", false);

                // echo $bool[0]["menuAcKapat"];

                $yeniBool = $bool[0]["menuAcKapat"] ? false : true;

                // echo $yeniBool;

                $sonuc = $this->model->guncelle("ayarlar", array("menuAcKapat"), array($yeniBool), "id=1");
                
                // if($yeniBool) :
                //     echo $bool;
                // else:
                //     echo "başarısız";
                // endif;

            else:

                $this->bilgi->direktYonlen("/panel/siparisler");
                
            endif;

        }

        function bultenTopluSil () {

            if($_POST):

                $idler = rtrim($_POST["idler"], ",");

                echo $this->model->sil("bulten", "id IN(".$idler.")");
                    
            else:

                $this->bilgi->direktYonlen("/");

            endif;
            
        }

    }

?>