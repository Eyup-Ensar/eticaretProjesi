<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
   <!-- Page Heading -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center"> 
         <?php if(isset($veri["bilgi"])):
               echo $veri["bilgi"];
            endif; ?>
         <!-- sipariş güncelle başlat -->
         <?php if(isset($veri["siparisguncelle"])): ?>
            <?php if(!$_POST): ?>
               <!-- BAŞLIK -->
               <div class="row text-left border-bottom-mvc mb-2">  
                  <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2"><h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="padding-bottom:6px;"> SİPARİŞ DURUMU GÜNCELLE</h1></div>
               </div>
               <?php $PanelHarici->icNavigasyon("siparisler", "Siparişler", "Sipariş Güncelleme") ?>
               <!-- BAŞLIK --> 
               <!--  FORMUN İSKELETİ-->
               <div class="col-xl-12 col-md-12 text-center"> 
                  <div class="row text-center">  
                     <div class="col-xl-4 col-md-6 mx-auto">
                        <div class="row bg-gradient-beyazimsi">
                           <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Sipariş Durum Güncelle</h4></div>
                           <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Mevcut Sipariş Durumu</div>
                           <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                              <?php
                                 Form::_form(array("action" => URL."/panel/siparisGuncelleSon", "method" => "POST", "class" => "form"));
                                    Form::select(array("name" => "durum", "class" => "form-control"));
                                       Form::option(array("value" => 1, $veri["siparisguncelle"][0]["kargodurum"]=="1" ? "selected" : null), array("Tedarik Sürecinde"));   
                                       Form::option(array("value" => 2, $veri["siparisguncelle"][0]["kargodurum"]=="2" ? "selected" : null), array("Paketleniyor"));   
                                       Form::option(array("value" => 3, $veri["siparisguncelle"][0]["kargodurum"]=="3" ? "selected" : null), array("Kargoya Verildi"));   
                                    Form::selectKapat();
                             ?>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                              <?php
                                    Form::input(array("type" => "submit", "value" => "Güncelle", "class"=>"btn guncelbtn"));
                                    Form::input(array("type" => "hidden", "name"=>"sipno", "value" => $veri["siparisguncelle"][0]["siparis_no"]));
                                 Form::formKapat();
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--  FORMUN İSKELETİ-->
  
            <?php else: ?>

            <?php endif; ?>

         <?php endif; ?>
         <!-- sipariş güncelle bitir -->
         <!-- Siparişleri gösterme başlat -->
         <?php if(isset($veri["siparis"])): ?>
            <?php 
               $siparisNum = array();
               foreach ($veri["siparis"] as $value) :
                  $siparisNum[] = $value["siparis_no"];    
               endforeach;
               $uniqueSiparisNum = array_unique($siparisNum, SORT_STRING);
            ?>
            <!-- BAŞLIK -->
            <div class="row text-left border-bottom-mvc mb-2">  
               <div class="col-lg-5 col-xl-5 col-md-5 p-2 mb-4">
                  <h1 class="h4 mb-0 mvc-renk baslik"> 
                  <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                     <path d="M0 0h24v24H0V0z" fill="none"/>
                     <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                  </svg>
                  SİPARİŞLER </h1>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-7">
                  <?php Form::_form(array("action" => URL."/panel/siparisarama", "method" => "POST")); ?>
                  <div class="input-group">
                     <?php 
                        Form::select(array("name" => "aramatercih", "class" => "form-control", "id"=>"aramaselect"));
                           Form::option(array("value" => "sipno"), array("Sipariş numarası"));   
                           Form::option(array("value" => "uyebilgi"), array("Üye bilgisi"));   
                        Form::selectKapat();
                        Form::input(["type"=>"text", "class"=>"form-control", "name"=>"ara", "id"=>"inputAra", "placeholder"=>"Sipariş numarası"]); 
                     ?>
                     <div class="input-group-append">
                           <?php
                              Form::button(array("type"=>"submit","class"=>"btn btn-outline-secondary searchHover"), 
                              '<svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#858796">
                                 <path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                              </svg>'
                              );
                           ?>
                     </div>
                  </div> 
                  <?php Form::formkapat(); ?>
               </div>
            </div>
            <!-- BAŞLIK --> 	
            <?php foreach ($uniqueSiparisNum as $value) :
               $veriler = $PanelHarici->cokluBirlestirListele(
                  false, 
                  array("siparisler.kargodurum", "siparisler.odemeturu", "siparisler.tarih", "uye.ad", "adresler.adres", "adresler.id"),
                  array("siparisler", "uye", "adresler"),
                  "WHERE (siparisler.siparis_no = ".$value.") AND (siparisler.adresid = adresler.id) AND (siparisler.uyeid = uye.id) LIMIT 1"
               ); ?>
               <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
               <div class="row arkaplan mt-4" style="margin:0; padding:0; border:none;">
                  <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                     <span>Sipariş No :</span> <span class="spantext"><?php echo $value ?></span>
                  </div>
                  <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 pt-3 geneltext bg-gradient-mvc">
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
                  <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 pt-3 pb-2 geneltext bg-gradient-mvc">
                     <span>Tarih :</span> <span class="spantext"><?php echo date("d.m.Y", strtotime($veriler[0]["tarih"])); ?></span>
                  </div>
                  <div class="col-xl-1 col-lg-4 col-md-4 col-sm-4 col-4 geneltext bg-gradient-mvc text-center" id="detayGoster">
                     <a href="" class="btn btn-outline-dark" data-value="<?php echo $value ?>" data-value2="<?php echo $veriler[0]["id"] ?>" data-toggle="modal" data-target="#exampleModalCenter">
                        <svg viewBox="0 0 576 512" height="18px" width="18px" fill="#777" xmlns="http://www.w3.org/2000/svg"><path d="M294.2 277.8c17.1 5 34.62 13.38 49.5 24.62l161.5-53.75c8.375-2.875 12.88-11.88 10-20.25L454.8 47.25c-2.748-8.502-11.88-13-20.12-10.12l-61.13 20.37l33.12 99.38l-60.75 20.13l-33.12-99.38L251.2 98.13c-8.373 2.75-12.87 11.88-9.998 20.12L294.2 277.8zM574.4 309.9c-5.594-16.75-23.67-25.91-40.48-20.23l-202.5 67.51c-17.22-22.01-43.57-36.41-73.54-36.97L165.7 43.75C156.9 17.58 132.5 0 104.9 0H32C14.33 0 0 14.33 0 32s14.33 32 32 32h72.94l92.22 276.7C174.7 358.2 160 385.3 160 416c0 53.02 42.98 96 96 96c52.4 0 94.84-42.03 95.82-94.2l202.3-67.44C570.9 344.8 579.1 326.6 574.4 309.9zM256 448c-17.67 0-32-14.33-32-32c0-17.67 14.33-31.1 32-31.1S288 398.3 288 416C288 433.7 273.7 448 256 448z"/></svg>
                     </a>
                  </div>
                  <div class="col-xl-1 col-lg-4 col-md-4 col-sm-4 col-4 geneltext bg-gradient-mvc">
                     <a href="<?php echo URL.'/panel/siparisGuncelle/'.$value ?>" class="btn btn-sm guncelbtn mb-2">Güncelle</a>
                  </div>
                  <div class="col-xl-1 col-lg-4 col-md-4 col-sm-4 col-4 geneltext bg-gradient-mvc text-center" id="siparisGoster">
                     <a href="" class="btn btn-outline-primary" data-value="<?php echo $value ?>" data-value2="<?php echo $veriler[0]["id"] ?>" data-toggle="modal" data-target="#exampleModalCenter">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#4e73df"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 8h-1V3H6v5H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zM8 5h8v3H8V5zm8 12v2H8v-4h8v2zm2-2v-2H6v2H4v-4c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v4h-2z"/><circle cx="18" cy="11.5" r="1"/></svg>
                     </a>
                  </div>
                  <!--  ÜRÜNLER-->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0 mvc-renk">
                     <div class="row arkaplanhover">                      
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">ÜRÜN ADI</div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">ÜRÜN ADET</div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">ÜRÜN FİYAT</div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">TOPLAM FİYAT</div>
                     </div>
                     <?php 
                        $urunler = $PanelHarici->listele("siparisler", "where siparis_no=".$value);
                        $toplam = 0;
                        foreach($urunler as $deger):
                           echo '
                           <div class="row border border-light mvc-renk arkaplanhover">     
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">'.$deger["urunad"].'</div>
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">'.$deger["urunadet"].'</div>
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">'.number_format($deger["urunfiyat"],2,",",".").' TL </div>
                              <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-6 kalinyap p-2">'.number_format($deger["toplamfiyat"],2,",",".").' TL</div>             
                           </div>';
                           $toplam += $deger["toplamfiyat"];
                        endforeach;
                     ?>
                     <div class="row arkaplanhover"> 
                        <div class="col-xl-9 col-lg-8 col-md-6 col-sm-6 col-0"></div>    
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 geneltext2 text-center mb-1"><span>SİPARİŞ TOPLAMI : <?php echo number_format($toplam,2,",",".").' TL' ?></span></span></div>  
                     </div>
                     <!--  ÜRÜNLER-->   
                  </div>
               </div>
               <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
            <?php endforeach; ?> 
            <?php if(isset($veri["toplamveri"])) : ?>
               <div class="col-12 p-2 mt-2 toplamveri">
               <h6 class="mb-0 pt-1 ">Toplam Sipariş : 
                  <?php 
                     echo isset($veri["toplamveri"]) ? $veri["toplamveri"] : null;
                     echo isset($veri["aramatoplamveri"]) ? $veri["aramatoplamveri"] : null;
                  ?>
               </h6>
               </div>
            <?php endif; ?>
         <?php endif; ?>
         <!-- Siparişleri gösterme bitir -->
      </div>
   </div>
   <!-- /.container-fluid -->
   <?php if(isset($veri["siparisarama"])) : 
          $link = '/panel/siparisarama/'.$Harici->seo($veri["siparisarama"]).'/';
        else:
          $link = '/panel/siparisler/';
        endif;
        if(isset($veri["toplamsayfa"])) : 
          Pagination::paginationNumaralar($veri["toplamsayfa"], $link);
        endif; ?>
</div>
<?php require 'views/YonPanel/footer.php'; ?>
