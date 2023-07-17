<?php require 'views/header.php'; ?>

<?php if(Session::get("kulad") && Session::get("uye")): 
    Session::oturumKontrol("uye", Session::get("kulad"), Session::get("uye"));
?>        
<div class="container" id="UyeCont">
    <div class="row">
        <div class="col-md-2" id="menu">
            <div class="row" id="uyepanel">
                <div class="col-md-12" id="baslik">İŞLEMLER</div>
                <ul>
                    <li><a href="<?php echo URL; ?>/uye/siparislerim"><span class="glyphicon glyphicon-user"> </span> Siparislerim</a></li>
                    <li><a href="<?php echo URL; ?>/uye/hesapayarlarim"><span class="glyphicon glyphicon-user"> </span> Hesap Ayarları</a></li>
                    <li><a href="<?php echo URL; ?>/uye/sifredegistir"><span class="glyphicon glyphicon-user"> </span> Şifre İşlemleri</a></li>
                    <li><a href="<?php echo URL?>/uye/adreslerim"><span class="glyphicon glyphicon-user"> </span> Adreslerim</a></li>
                    <li><a href="<?php echo URL?>/uye/yorumlarim"><span class="glyphicon glyphicon-user"> </span> Ürün Yorumlarım</a></li>
                    <li><a href="<?php echo URL?>/uye/cikis"><span class="glyphicon glyphicon-user"> </span> Oturumu Kapat </a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <?php if(isset($veri)): ?>
            <?php 
          	foreach ($veri as $key => $deger) :	
				switch ($key) :
                    case "yorumlar":
                        $Harici->yorumGetir($veri["yorumlar"], $veri["toplamveri"], $veri["toplamsayfa"]);
                    break;
                    case "adres":
                        $Harici->adresGetir($veri["adres"], $veri["toplamveri"], $veri["toplamsayfa"]);
                    break;
                    case "adresEkle":
                        $Harici->adresEkleGetir();
                    break;
                    case "ayarlar":
                        $Harici->hesapAyarlariGetir($deger[0]);
                    break;
                    case "sifredegistir":
                        $Harici->sifreDegistirGetir($deger[0]);
                    break;
                    case "siparisler": 
                        $Harici->siparislerGetir($veri["siparisler"]);
                    break;
				endswitch;
		    endforeach;
		    ?>
            <?php else: ?>
               <P>İŞLEMLER</P>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    else:
        header("Location: ".URL."");
    endif;
?>

<?php require 'views/footer.php'; ?> 		
        