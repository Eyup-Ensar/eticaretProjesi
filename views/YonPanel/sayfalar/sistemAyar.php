<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center"> 
      <?php if (isset($veri["bilgi"])) :

            echo $veri["bilgi"]; 
        
        endif; ?>
      <?php if (isset($veri["sistemAyar"])) : ?>
        <!-- BAŞLIK -->
        <div class="row text-left border-bottom-mvc mb-2">  
          <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-3">
            <h1 class="h4 mb-0 mvc-renk baslik"> 
            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
            </svg>    
            SİSTEM AYARLARI</h1>
          </div>
        </div>
        <!-- BAŞLIK --> 	
        <!--  FORMUN İSKELETİ-->
        <div class="col-xl-12 col-md-12  text-center"> 
          <div class="row text-center">  
            <div class="col-lg-10 col-xl-10 col-md-12 mx-auto">
              <div class="row bg-gradient-beyazimsi">
                <?php Form::_form(array("action" => URL."/panel/sistemAyarGuncelle", "method" => "POST", "enctype"=>"multipart/form-data"));?>
                  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc mvc-black" style="padding-top: 10px; padding-bottom: 1px;"><h4>Sistem Ayarları Güncelle</h4></div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row mvc-renk">
                    <!-- SOL -->
                      <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 bloklararasi">
                        <div class="row">
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Slogan üst 1</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"sloganUst1", "value"=>$veri["sistemAyar"][0]["sloganUst1"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Slogan alt 1</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"sloganAlt1", "value"=>$veri["sistemAyar"][0]["sloganAlt1"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Slogan üst 2</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"sloganUst2", "value"=>$veri["sistemAyar"][0]["sloganUst2"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Slogan alt 2</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"sloganAlt2", "value"=>$veri["sistemAyar"][0]["sloganAlt2"], "class"=>"form-control")); ?>
                          </div>                       
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Slogan üst 3</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"sloganUst3", "value"=>$veri["sistemAyar"][0]["sloganUst3"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Slogan alt 3</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"sloganAlt3", "value"=>$veri["sistemAyar"][0]["sloganAlt3"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Üyeler panel adeti</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"number", "name"=>"uyelerVeriAdet", "value"=>$veri["sistemAyar"][0]["uyelerVeriAdet"], "class"=>"form-control")); ?>
                          </div>                       
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Ürünler panel adeti</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"number", "name"=>"urunlerVeriAdet", "value"=>$veri["sistemAyar"][0]["urunlerVeriAdet"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Ürünler görüntü adeti</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"number", "name"=>"urunlerGoruntuAdet", "value"=>$veri["sistemAyar"][0]["urunlerGoruntuAdet"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Yorumlar görüntü adeti</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"number", "name"=>"yorumlarGoruntuAdet", "value"=>$veri["sistemAyar"][0]["yorumlarGoruntuAdet"], "class"=>"form-control")); ?>
                          </div>  
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Adresler görüntü adeti</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"number", "name"=>"adreslerGoruntuAdet", "value"=>$veri["sistemAyar"][0]["adreslerGoruntuAdet"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlar">Siparişler görüntü adeti</div>
                          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"number", "name"=>"siparislerGoruntuAdet", "value"=>$veri["sistemAyar"][0]["siparislerGoruntuAdet"], "class"=>"form-control")); ?>
                          </div>   
                        </div>
                      </div>
                      <!-- SOL -->
                      <!-- SAĞ -->
                      <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 ">
                        <div class="row">
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Başlık</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"title", "class"=>"form-control", "rows"=>"6"), $veri["sistemAyar"][0]["title"]); ?>
                          </div>   
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Sayfa Açıklama</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"sayfaAciklama", "class"=>"form-control", "rows"=>"6"), $veri["sistemAyar"][0]["sayfaAciklama"]); ?>
                          </div> 
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Anahtar Kelimeler</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"anahtarKelime", "class"=>"form-control", "rows"=>"6"), $veri["sistemAyar"][0]["anahtarKelime"]); ?>
                          </div>                              
                        </div>
                      </div>
                      <!-- SAĞ -->
                    </div>
                    <!-- İÇ ROW -->
                  </div>
                  <!-- İÇ ANASI -->
                  <?php Form::input(array("type"=>"hidden","name"=>"id","value"=>$veri["sistemAyar"][0]["id"])); ?>
                  <div class="row">
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3"></div>
                    <div class="col-lg-6 col-xl-6 col-md-4 col-sm-6 uruneklemeBtn">
                    <?php Form::input(array("type"=>"submit","value"=>"Güncelle","class"=>"btn guncelbtn")); ?>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6 col-sm-3"></div>
                  </div>
                <?php Form::formkapat(); ?>
              </div> <!-- ROWWW -->
            </div>
          </div>
        </div>
        <!--  FORMUN İSKELETİ-->
      <?php endif; ?>   
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->

<?php require 'views/YonPanel/footer.php'; ?>