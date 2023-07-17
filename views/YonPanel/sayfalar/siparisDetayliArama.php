<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
   <!-- Page Heading -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center"> 
         <?php if(isset($veri["bilgi"])):
               echo $veri["bilgi"];
            endif; ?>
         <!-- Detaylı arama kısmı başlat -->
                     <!-- BAŞLIK -->
                     <div class="row text-center border-bottom-mvc mb-2">  
               <div  div class="col-lg-12 col-xl-12 col-md-12 mb-12 border-left-mvc text-center p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <img src="<?php echo URL.'/views/YonPanel/img/search.svg' ?>" alt="" srcset=""> SİPARİŞ ARAMA </h1></div>
            </div>   
            <!-- BAŞLIK --> 
         <div class="row text-left border-bottom-mvc mb-2 arama-bg-gradient">
            <div class="col-xl-11 col-md-9 mb-12 text-left   ">
               <div class="row">
                  <div class="col-xl-2 p-3 eleman1"> Sipariş Numarası </div>
                  <div class="col-xl-2 p-2 eleman2">
                     <?php
                        Form::_form(array("action" => URL."/panel/siparisDetayliArama", "method" => "POST"));
                        Form::input(array("type" => "text", "name" => "siparis_no", "class" => "form-control p-1", "placeholder" => "Sipariş Numarası"));
                     ?>
                  </div>
                  <div class="col-xl-2 p-3 eleman1"> Bilgisi </div>
                  <div class="col-xl-2 p-2 eleman2">
                     <?php Form::input(array("type" => "text", "name" => "uyebilgi", "class" => "form-control p-1", "placeholder" => "Üye Bilgisi")); ?>
                  </div>
                  <div class="col-xl-2 p-3 eleman1"> Durum </div>
                  <div class="col-xl-2 p-2 eleman2">
                     <?php
                        Form::select(array("name" => "kargodurum", "class" => "form-control p-1"));
                           Form::option(array("value" => ""), array("Seçiniz"));
                           Form::option(array("value" => "1"), array("Tedarik Sürecinde"));
                           Form::option(array("value" => "2"), array("Paketleniyor"));
                           Form::option(array("value" => "3"), array("Kargolandı"));
                        Form::selectKapat();
                     ?>
                  </div>
                  <div class="col-xl-2 p-3 eleman1 noaltcizgi"> Ödeme Türü </div>
                  <div class="col-xl-2 p-2 eleman2 noaltcizgi">
                     <?php
                        Form::select(array("name" => "odemeturu", "class" => "form-control p-1"));
                           Form::option(array("value" => ""), array("Seçiniz"));
                           Form::option(array("value" => "Nakit"), array("Nakit"));
                           Form::option(array("value" => "Kredi Kartı"), array("Kredi Kartı"));
                        Form::selectKapat();
                     ?>
                  </div>
                  <div class="col-xl-2 p-3 eleman1 noaltcizgi"> Sipariş Sonucu </div>
                  <div class="col-xl-2 p-2 eleman2 noaltcizgi">
                     <?php
                        Form::select(array("name" => "kargosonuc", "class" => "form-control p-1"));
                           Form::option(array("value" => ""), array("Seçiniz"));
                           Form::option(array("value" => "1"), array("Tamamlanmış"));
                           Form::option(array("value" => "2"), array("İade"));
                           Form::option(array("value" => "3"), array("Onaylı İade"));
                        Form::selectKapat();
                     ?>
                  </div>
                  <div class="col-xl-2 p-2 eleman2 noaltcizgi">
                     <?php Form::input(array("type" => "date", "name" => "tarih1", "class" => "form-control p-1")); ?>
                  </div>
                  <div class="col-xl-2 p-2 eleman2 noaltcizgi">
                     <?php Form::input(array("type" => "date", "name" => "tarih2", "class" => "form-control p-1")); ?>
                  </div>
               </div>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-12 mb-12 p-2">
               <?php
               Form::input(array("type" => "submit", "value" => "ARA", "class" => "btn btn-sm arama-btn-mvc btn-block mt-4"));
               Form::formKapat();
               ?>
            </div>
         </div>
         <!-- Detaylı arama kısmı bitir -->
         <?php if(isset($veri["varsayilan"])): ?>
            <div class="alert alert-danger p-2 mt-5"><h4 class="pt-2">Lütfen Arama Kriteri Seçiniz</h4></div>   
         <?php endif ?>
         <!-- Siparişleri gösterme başlat -->
         <?php if(isset($veri["siparis"])): ?>
            <?php 
               $siparisNum = array();
               foreach ($veri["siparis"] as $value) :
                  $siparisNum[] = $value["siparis_no"];    
               endforeach;
               $uniqueSiparisNum = array_unique($siparisNum, SORT_STRING);
               $son = join(",", $uniqueSiparisNum);
               Session::set("numaralar", $son);
               echo '<div class="alert alert-danger p-1 mt-2"><h4 class="pt-2 h6">'.$veri["aramaSonuc"].' | <a href="'.URL.'/panel/siparisExcelAl">Excel Al</a></h4></div>';
            ?>	
            <?php foreach ($uniqueSiparisNum as $value) :
               $veriler = $PanelHarici->cokluBirlestirListele(
                  false, 
                  array("siparisler.kargodurum", "siparisler.odemeturu", "siparisler.tarih", "uye.ad", "adresler.adres", "adresler.id"),
                  array("siparisler", "uye", "adresler"),
                  "WHERE (siparisler.siparis_no = ".$value.") AND (siparisler.adresid = adresler.id) AND (siparisler.uyeid = uye.id) LIMIT 1"
               ); ?>
               <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
               <div class="row arkaplan" style="margin:0; padding:0; border:none;">
                  <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                     <span>Sipariş No :</span> <span class="spantext"><?php echo $value ?></span>
                  </div>
                  <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                     <span>Üye Adı :</span> <span class="spantext"><?php echo $veriler[0]["ad"] ?></span>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                     <span>Durum :</span> <span class="spantext">
                     <?php 
                        switch ($veriler[0]["kargodurum"]) {
                           case '1':
                              echo "Tedarik Sürecinde";
                           break;
                           case '2':
                              echo "Paketleniyor";
                           break;
                           case '3':
                             echo "Kargoya Verildi";
                           break;
                           default:
                             echo "Belirlenmedi";
                           break;
                        }
                     ?>
                     </span>
                  </div>
                  <!-- <div  class="col-xl-2 col-lg-2 col-md-6 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                     <span>Ödeme Türü :</span> <span class="spantext"><?php echo $veriler[0]["odemeturu"] ?></span>
                  </div> -->
                  <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                     <span>Tarih :</span> <span class="spantext"><?php echo date("d.m.Y", strtotime($veriler[0]["tarih"])); ?></span>
                  </div>
                  <div class="col-xl-1 col-lg-1 col-md-6 col-sm-12 geneltext bg-gradient-mvc text-right" id="detayGoster">
                     <a href="" class="btn btn-outline-dark" data-value="<?php echo $value ?>" data-value2="<?php echo $veriler[0]["id"] ?>" data-toggle="modal" data-target="#exampleModalCenter">
                        <svg viewBox="0 0 576 512" height="20px" width="20px" fill="#777" xmlns="http://www.w3.org/2000/svg"><path d="M294.2 277.8c17.1 5 34.62 13.38 49.5 24.62l161.5-53.75c8.375-2.875 12.88-11.88 10-20.25L454.8 47.25c-2.748-8.502-11.88-13-20.12-10.12l-61.13 20.37l33.12 99.38l-60.75 20.13l-33.12-99.38L251.2 98.13c-8.373 2.75-12.87 11.88-9.998 20.12L294.2 277.8zM574.4 309.9c-5.594-16.75-23.67-25.91-40.48-20.23l-202.5 67.51c-17.22-22.01-43.57-36.41-73.54-36.97L165.7 43.75C156.9 17.58 132.5 0 104.9 0H32C14.33 0 0 14.33 0 32s14.33 32 32 32h72.94l92.22 276.7C174.7 358.2 160 385.3 160 416c0 53.02 42.98 96 96 96c52.4 0 94.84-42.03 95.82-94.2l202.3-67.44C570.9 344.8 579.1 326.6 574.4 309.9zM256 448c-17.67 0-32-14.33-32-32c0-17.67 14.33-31.1 32-31.1S288 398.3 288 416C288 433.7 273.7 448 256 448z"/></svg>
                     </a>
                  </div>
                  <div class="col-xl-1 col-lg-1 col-md-6 col-sm-6 geneltext bg-gradient-mvc text-center" id="siparisGoster">
                     <a href="" class="btn btn-outline-primary" data-value="<?php echo $value ?>" data-value2="<?php echo $veriler[0]["id"] ?>" data-toggle="modal" data-target="#exampleModalCenter">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#4e73df"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 8h-1V3H6v5H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zM8 5h8v3H8V5zm8 12v2H8v-4h8v2zm2-2v-2H6v2H4v-4c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v4h-2z"/><circle cx="18" cy="11.5" r="1"/></svg>
                     </a>
                  </div>
                  <div class="col-xl-1 col-lg-1 col-md-6 col-sm-6 geneltext bg-gradient-mvc">
                     <a href="<?php echo URL.'/panel/siparisGuncelle/'.$value ?>" class="btn btn-sm guncelbtn mb-2">Güncelle</a>
                  </div>
                  <!--  ÜRÜNLER-->
                  <div class="col-xl-12 col-lg-12 col-md-4 col-sm-12 mt-2 p-0 mvc-renk">
                     <div class="row arkaplanhover">                      
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">ÜRÜN ADI</div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">ÜRÜN ADET</div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">ÜRÜN FİYAT</div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">TOPLAM FİYAT</div>
                     </div>
                     <?php 
                        $urunler = $PanelHarici->listele("siparisler", "where siparis_no=".$value);
                        $toplam = 0;
                        foreach($urunler as $deger):
                           echo '
                           <div class="row border border-light mvc-renk arkaplanhover">     
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">'.$deger["urunad"].'</div>
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">'.$deger["urunadet"].'</div>
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">'.number_format($deger["urunfiyat"],2,",",".").' TL </div>
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 kalinyap p-2">'.number_format($deger["toplamfiyat"],2,",",".").' TL</div>             
                           </div>';
                           $toplam += $deger["toplamfiyat"];
                        endforeach;
                     ?>
                     <div class="row arkaplanhover"> 
                        <div class="col-lg-9 text-dark kalinyap p-2"></div>    
                        <div class="col-lg-2 geneltext2 text-right p-2"><span>SİPARİŞ TOPLAMI :</span></div>  
                        <div class="col-lg-1 geneltext2 text-left kalinyap p-2"><span ><?php echo number_format($toplam,2,",",".").' TL' ?></span></div>        
                     </div>
                     <!--  ÜRÜNLER-->   
                  </div>
               </div>
               <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
            <?php endforeach; ?> 
         <?php endif; ?>
         <!-- Siparişleri gösterme bitir -->
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<?php require 'views/YonPanel/footer.php'; ?>



