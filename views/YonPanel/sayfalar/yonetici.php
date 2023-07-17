<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
   <!-- Page Heading -->
   <div class="row ">
      <div class="col-xl-12 col-lg-12 col-md-12 mb-12 "> 
         <?php if (isset($veri["bilgi"])) :
               echo $veri["bilgi"];
         endif; ?>
         <?php if (isset($veri["yoneticiEkle"])) : ?>
            <!-- BAŞLIK -->
            <div class="row text-left border-bottom-mvc mb-2">  
        	      <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2">
                  <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> YÖNETİCİ EKLE </h1>
               </div>
            </div>
            <?php $PanelHarici->icNavigasyon("yonetici", "Kullanıcı Yönetimi", "Yönetici Ekleme") ?>
            <!-- BAŞLIK --> 	
            <!--  FORMUN İSKELETİ-->
            <div class="col-xl-12 col-md-12  text-center mt-3"> 
               <div class="row text-center">  
        	         <div class="col-xl-6 col-lg-8 mx-auto">
             			<div class="row bg-gradient-beyazimsi mvc-renk" id="yoneticiEklemeForm">
                        <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black">
                           <h4>Yönetici Ekle</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">Yönetici Adı</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                    	      <?php 	
                              Form::_form(array("action" => URL."/panel/yoneticiEkleSon","method" => "POST"));  
                              Form::input(array("type"=>"text","class"=>"form-control","name"=>"yoneticiAdi"));	       
                           ?>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">Şifre</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                    	      <?php Form::input(array("type"=>"password","class"=>"form-control","name"=>"sifre")); ?>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi nocizgi">Şifre (Tekrar)</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                           <?php Form::input(array("type"=>"password","class"=>"form-control","name"=>"sifreTekrar")); ?>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">Genel Yetki</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                           <?php
                              Form::select(array("class"=>"form-control","name"=>"yetki"));
                                 Form::option(array("value"=>1),array("Tam Yetki"));
                                 Form::option(array("value"=>2),array("Ürün Yetki"));
                                 Form::option(array("value"=>3),array("Üye Yetki"));
                              Form::selectKapat(array("class"=>"form-control","name"=>"yetki"));
                           ?> 

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Yetkileri Seçiniz</div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="siparisY">Sipariş Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"siparisY","class"=>"form-check-input","name"=>"siparisYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="KategoriY">Kategori Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"KategoriY","class"=>"form-check-input","name"=>"kategoriYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="uyeY">Üye Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"uyeY","class"=>"form-check-input","name"=>"uyeYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="urunY">Ürün Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"urunY","class"=>"form-check-input","name"=>"urunYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="muhasebeY">Muhasebe Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"muhasebeY","class"=>"form-check-input","name"=>"muhasebeYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="kullaniciY">Kullanıcı Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"kullaniciY","class"=>"form-check-input","name"=>"kullaniciYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="bultenY">Bülten Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"bultenY","class"=>"form-check-input","name"=>"bultenYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="sifredegistirY">Şifre Değiştir</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"sifredegistirY","class"=>"form-check-input","name"=>"sifreDegistir")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="sistemayarlariY">Sistem Ayarları</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"sistemayarlariY","class"=>"form-check-input","name"=>"sistemAyarlari")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="sistembakimY">Sistem Bakım</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"sistembakimY","class"=>"form-check-input","name"=>"sistemBakim")); ?>  
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 formeleman"><label class="text-success" style="cursor:pointer" id="yoneticiEkleTumunuSec">Tümünü Seç</label></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 formeleman"><label class="text-danger" style="cursor:pointer" id="yoneticiEkleTumunuKaldir">Tümünü Kaldır</label></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                           <?php 		
                              Form::input(array("type"=>"submit","value"=>"Yönetici Ekle","class"=>"btn btn-primary"));		
                              Form::formkapat();	 
                           ?>
                        </div>  
                     </div>
                  </div>
               </div>
            </div>
            <!--  FORMUN İSKELETİ-->
         <?php endif; ?> 
         <?php if (isset($veri["yoneticiGuncelle"])) : ?>
            <?php $yonetici = $veri["yoneticiGuncelle"][0]; ?>
            <!-- BAŞLIK -->
            <div class="row text-left border-bottom-mvc mb-2">  
        	      <div class="col-md-12 mb-12 border-left-mvc text-left p-2">
                  <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> YÖNETİCİ GÜNCELLE </h1>
               </div>
            </div>
            <?php $PanelHarici->icNavigasyon("yonetici", "Kullanıcı Yönetimi", "Yönetici Güncelleme") ?>
            <!-- BAŞLIK --> 	
            <!--  FORMUN İSKELETİ-->
            <div class="col-md-12 text-center mt-3"> 
               <div class="row text-center">  
        	         <div class="col-xl-6 col-lg-8 mx-auto mvc-renk">
             			<div class="row bg-gradient-beyazimsi" id="yoneticiGuncelleForm">
                        <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black">
                           <h4>Yönetici Güncelle</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">Yönetici Adı</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                    	      <?php 	
                              Form::_form(array("action" => URL."/panel/yoneticiGuncelleSon","method" => "POST"));  
                              Form::input(array("type"=>"text","class"=>"form-control","name"=>"yoneticiAdi","value"=>$yonetici["ad"]));	       
                           ?>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">Genel Yetki</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                           <?php
                              Form::select(array("class"=>"form-control","name"=>"yetki"));
                                 Form::option(array("value"=>1, $yonetici["yetki"]==1 ? "selected" : null),array("Tam Yetki"));
                                 Form::option(array("value"=>2, $yonetici["yetki"]==2 ? "selected" : null),array("Ürün Yetki"));
                                 Form::option(array("value"=>3, $yonetici["yetki"]==3 ? "selected" : null),array("Üye Yetki"));
                              Form::selectKapat(array("class"=>"form-control","name"=>"yetki"));
                           ?> 

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Yetkileri Seçiniz</div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="siparisY">Sipariş Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"siparisY", $yonetici["siparisYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"siparisYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="KategoriY">Kategori Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman">
                           <?php Form::input(array("type"=>"checkbox","id"=>"KategoriY", $yonetici["kategoriYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"kategoriYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="uyeY">Üye Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"uyeY", $yonetici["uyeYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"uyeYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="urunY">Ürün Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"urunY", $yonetici["urunYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"urunYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="muhasebeY">Muhasebe Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"muhasebeY", $yonetici["muhasebeYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"muhasebeYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="kullaniciY">Kullanıcı Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"kullaniciY", $yonetici["kullaniciYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"kullaniciYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="bultenY">Bülten Yönetimi</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"bultenY", $yonetici["bultenYonetim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"bultenYonetim")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="sifredegistirY">Şifre Değiştir</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"sifredegistirY", $yonetici["sifreDegistir"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"sifreDegistir")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="sistemayarlariY">Sistem Ayarları</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"sistemayarlariY", $yonetici["sistemAyarlari"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"sistemAyarlari")); ?>  
                        </div>
                        <div class="col-sm-5 col-8 formeleman yoneticiSecAd"><label class="form-check-label" for="sistembakimY">Sistem Bakım</label></div>
                        <div class="col-sm-1 col-4 formeleman yoneticiSec">
                           <?php Form::input(array("type"=>"checkbox","id"=>"sistembakimY", $yonetici["sistemBakim"]==1 ? "checked" : null, "class"=>"form-check-input","name"=>"sistemBakim")); ?>  
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 formeleman"><label class="text-success" style="cursor:pointer" id="yoneticiGuncelleTumunuSec">Tümünü Seç</label></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 formeleman"><label class="text-danger" style="cursor:pointer" id="yoneticiGuncelleTumunuKaldir">Tümünü Kaldır</label></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                           <?php 		
                              Form::input(array("type"=>"submit","value"=>"Yönetici Güncelle","class"=>"btn guncelbtn"));		
                              Form::input(array("type"=>"hidden","value"=>$yonetici["id"],"name"=>"id"));		
                              Form::formkapat();	 
                           ?>
                        </div>  
                     </div>
                  </div>
               </div>
            </div>
            <!--  FORMUN İSKELETİ-->
         <?php endif; ?> 
         <?php if (isset($veri["data"])) : ?>
            <!-- BAŞLIK -->
            <div class="row mb-2">  
               <div class="col-md-8 col-7 p-1 mb-4">
                  <h1 class="h4 mb-0 mvc-renk baslik">
                  <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                     <path d="M0 0h24v24H0V0z" fill="none"/>
                     <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                  </svg>   
                  YÖNETİCİLER</h1>
               </div>
               <div class="col-md-4 col-5 text-right"> 
                  <a href="<?php echo URL."/panel/yoneticiEkle";?>" class="btn btn-sm btn-primary yoneticiEkleBtnMobile" style="width:180px">Yönetici Ekle</a>
               </div>    
            </div>
            <!-- BAŞLIK --> 	
            <div class="col-xl-6 col-lg-8 col-md-12 mx-auto text-center"> 
               <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
               <div class="row arkaplan p-1 mt-2 pb-0 text-center mx-auto">
                  <div class="col-sm-12 p-2 pt-3 geneltext">
                     <span><h5 class="mvc-renk">Kayıtlı Yönetici Sayısı : <?php echo count($veri["data"]); ?></h5></span> 
                  </div> 
                  <div class="col-sm-4 col-6 p-2 pt-3 geneltext bg-gradient-mvc ">
                     <span>Yönetici Yetkisi</span> 
                  </div>
                  <div class="col-sm-5 col-6 p-2 pt-3 geneltext bg-gradient-mvc">
                     <span >Yönetici Adı</span> 
                  </div>
                  <div class="col-sm-3 col-12 p-2 pt-3 geneltext bg-gradient-mvc">
                     <span >İşlemler</span> 
                  </div>
                  <?php foreach ($veri["data"] as $value) : ?>
                     <?php 
                        echo '
                        <div class="col-sm-12 mt-2 p-0 mvc-renk arkaplanhover">
                           <div class="row border border-light">
                              <div class="col-sm-4 col-6 kalinyap p-2">';
                                 if($value["yetki"]==1):
                                    echo "<span>Tam Yetki</span>";
                                 elseif($value["yetki"]==2):
                                    echo "<span>Ürün Yetki</span>";
                                 elseif($value["yetki"]==3):
                                    echo "<span>Üye Yetki</span>";
                                 else:
                                    echo "Tanımlanamadı";
                                 endif;
                              echo '</div>
                              <div class="col-sm-5 col-6 kalinyap p-2">'.$value["ad"].'</div>
                              <div class="col-sm-3 kalinyap p-2">';
                              if(Session::get("AdminId")!=$value["id"]):
                                 ?>
                                    <div class="row">
                                       <div class="col-6">
                                          <a href="<?php echo URL."/panel/yoneticiGuncelle/".$value['id'];?>">
                                             <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                                             </svg>
                                          </a>
                                       </div>
                                       <div class="col-6">
                                          <a onclick="silmedenSor('<?php echo URL.'/panel/yoneticiSil/'.$value['id']; ?>'); return false">
                                             <svg height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353" id="deleteIcon">
                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                                             </svg>
                                          </a>
                                       </div>
                                    </div>
                              <?php  else: ?>
                                 <div class="row">
                                    <div class="col-6">
                                       <a href="<?php echo URL."/panel/yoneticiGuncelle/".$value['id'];?>">
                                          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIconDark">
                                             <path d="M0 0h24v24H0V0z" fill="none"/>
                                             <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                                          </svg>
                                       </a>
                                    </div>
                                    <div class="col-6">
                                       <a href="#">
                                          <svg height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIconDark">
                                             <path d="M0 0h24v24H0V0z" fill="none"/>
                                             <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                                          </svg>
                                       </a>
                                    </div>
                                 </div>
                                 <?php 
                              endif;
                              echo '</div>
                           </div>  
                        </div>';
                     ?>	
                  <?php	endforeach; ?>
               </div>
               <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
            </div>
         <?php endif; ?>  
   </div> 
</div>  
<!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->
     
<?php require 'views/YonPanel/footer.php'; ?>