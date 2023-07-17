<?php require 'views/header.php';  ?>

<?php

/* BU SAYFANIN GÖRÜNTÜLENMESİNDE OTURUM KONTROLÜ YANI SIRA SEPETTE ÜRÜN VARMI DİYE KONTROL
EDİLECEK VE SEPETTE ÜRÜN YOK İSE BU SAYFA GÖRÜNTÜLENEMEYECEK */ 
if($_COOKIE["urun"]):
if (Session::get("kulad") && Session::get("uye")) : 
    Session::oturumKontrol("uye", Session::get("kulad"), Session::get("uye"));
?>
<div class="container" id="sipTamamlaİskelet">
    <div class="row">
        <div class="col-md-7" id="soltaraf">
            <div class="row">
                <div class="col-md-6">
                    <div class="row" id="uyelik">
                        <div class="col-md-12"><h4>ÜYELİK BİLGİLERİ</h4></div>
                        <?php Form::_form(["action"=>"".URL."/uye/siparisTamamlandi", "method"=>"POST"]) ?>
                            <?php foreach($Harici->uyebilgileri() as $deger): ?>
                                <div class="col-md-3" id="label">Ad</div>
                                <div class="col-md-9" id="input"><?php Form::input(["type"=>"text", "name"=>"ad", "id"=>"sipAd", "value"=>"".$deger['ad']."", "class"=>"form-control"]) ?></div>
                                <div class="col-md-3" id="label">Soyad</div>
                                <div class="col-md-9" id="input"><?php Form::input(["type"=>"text", "name"=>"soyad", "id"=>"sipSoyad", "value"=>"".$deger['soyad']."", "class"=>"form-control"]) ?></div>
                                <div class="col-md-3" id="label">Mail</div>
                                <div class="col-md-9" id="input"><?php Form::input(["type"=>"text", "name"=>"mail", "id"=>"sipMail", "value"=>"".$deger['mail']."", "class"=>"form-control"]) ?></div>
                                <div class="col-md-3" id="label">Telefon</div>
                                <div class="col-md-9" id="input"><?php Form::input(["type"=>"text", "name"=>"telefon", "id"=>"sipTel", "value"=>"".$deger['telefon']."", "class"=>"form-control"]) ?></div>
                            <?php endforeach; ?>
                        <div class="col-md-12" id="radioBtnDiv">
                            <div id="radioBtn">
                                <label for="kullan" class="cursor">Üyelik bilgilerimi kullan</label>
                                <?php Form::input(["type"=>"radio", "name"=>"bilgiTercih", "id"=>"kullan", "class"=>"cursor", "value"=>false, "checked"=>"checked"]); ?>
                            </div>
                            <div id="radioBtn">
                                <label for="kullanma" class="cursor">Farklı bilgiler kullan</label>
                                <?php Form::input(["type"=>"radio", "name"=>"bilgiTercih", "id"=>"kullanma", "class"=>"cursor", "value"=>true]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row" id="uyelik">
                        <div class="col-md-12"><h4>ADRESLER</h4></div> 
                            <?php 
                                foreach($Harici->uyeadresleri() as $deger):
                                    echo '
                                    <div id="adresSecim">
                                        <div class="col-md-9" id="adresSatir">'.$deger["adres"].'</div>
                                        <div class="col-md-3" id="adresSatir">';
                                            if($deger["varsayilan"]==1):
                                                echo '<label for="sec'.$deger["id"].'" class="cursor">seç</label> ';
                                                Form::input(["type"=>"radio", "name"=>"adresTercih", "id"=>"sec".$deger['id']."", "class"=>"cursor", "value"=>"".$deger['id']."", "checked"=>"checked"]);
                                            else:
                                                echo '<label for="sec'.$deger["id"].'" class="cursor">seç</label> ';
                                                Form::input(["type"=>"radio", "name"=>"adresTercih", "id"=>"sec".$deger['id']."", "class"=>"cursor", "value"=>"".$deger['id'].""]);
                                            endif;
                                        echo '</div>';
                                    echo '</div>';
                                endforeach;
                            ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row" id="uyelik">
                        <div class="col-md-12"><h4>ÖDEME YÖNTEMİ</h4></div>
                        <div class="col-md-6" id="adresSatir">
                            <label for="havaleEFT" class="cursor">Havale/EFT</label>
                            <?php Form::input(["type"=>"radio", "name"=>"odeme", "value"=>1, "id"=>"havaleEFT", "class"=>"cursor", "checked"=>"checked"]); ?>
                        </div>
                        <div class="col-md-6" id="adresSatir">
                            <label for="kredikartı" class="cursor">Kredi Kartı (Yakında)</label>
                            <?php Form::input(["type"=>"radio", "name"=>"odeme", "id"=>"kredikartı", "class"=>"cursor", "disabled"=>"disabled"]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row" id="sagtaraf">
                <div class="col-md-12" id="baslik"><h3>SEPETTEKİ ÜRÜNLERİNİZ</h3></div>
                <div class="col-md-3" id="icbaslik">Ürün Ad</div>
                <div class="col-md-3" id="icbaslik">Adet</div>
                <div class="col-md-3" id="icbaslik">Birim Fiyat</div>
                <div class="col-md-3" id="icbaslik">Toplam</div>
                <!-- SEPETTEKİ ÜRÜNLER BURADA LİSTELENECEK -->
                <?php 
                    $toplamAdet = 0;
                    $toplamFiyat = 0;
                    echo "<form id='formaa'>";
                    foreach($_COOKIE['urun'] as $id => $adet):
                        $urun = $Harici->urunCek($id)[0];
                        $toplamAdet += $adet;
                        $toplamFiyat += ($urun["fiyat"] * $adet);
                        echo '<div class="col-md-3" id="icurunler">'.$urun["urunad"].'</div>
                        <div class="col-md-3" id="icurunler">'.$adet.'</div>
                        <div class="col-md-3" id="icurunler">'.number_format($urun["fiyat"],2,'.',',').'₺</div>
                        <div class="col-md-3" id="icurunler"> '.number_format($urun["fiyat"]*$adet,2,',','.').'₺</div>';
                    endforeach;
                    echo '<div class="col-md-3" id="toplam">Toplam Adet</div>
                    <div class="col-md-3" id="toplam">'.$toplamAdet.'</div>
                    <div class="col-md-3" id="toplam">Toplam Fiyat</div>
                    <div class="col-md-3" id="toplam"> '.number_format($toplamFiyat,2,',','.').'₺</div>';                    
                ?>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <?php
                        Form::input(["type"=>"hidden", "value"=>$toplamFiyat, "name"=>"toplamtutar"]);
                        Form::input(["type"=>"submit", "value"=>"Siparişi Tamamla", "class"=>"btn btn_siparis"]);
                        if(isset($veri["bilgi"])):
                            echo $veri["bilgi"];
                        endif;
                    ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php else: ?> <!-- Oturum kontrolü kontrolü -->
    <?php header("Location:".URL) ?>
<?php endif; ?>

<?php else: ?> <!-- Sepette ürün varmı kontrolü -->
    <?php header("Location:".URL) ?>
<?php endif; ?>

<?php require 'views/footer.php'; ?> 		
        
        
        
       