<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-md-12 text-center"> 
      <?php if (isset($veri["bilgi"])) :
          if(is_array($veri["bilgi"])) :
            foreach($veri["bilgi"] as $value):
			        echo '<div class="alert alert-danger mt-5 text-center">'.$value.'</div><br>';
              echo $veri["yonlen"];
            endforeach;
          else:
            echo $veri["bilgi"]; 
          endif;
      endif; ?>
      <?php if (isset($veri["urunGuncelle"]) && isset($veri["altKat"])) : ?>
        <!-- BAŞLIK -->
        <div class="row text-left mb-2">  
          <div class="col-xl-12 col-md-12 text-left p-2">
            <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> ÜRÜN GÜNCELLE </h1>
          </div>
        </div>
        <?php $PanelHarici->icNavigasyon("urunler", "Ürünler", "Ürün Güncelleme") ?>
        <!-- BAŞLIK --> 	
        <!--  FORMUN İSKELETİ-->
        <div class="col-xl-12 col-md-12  text-center mt-3"> 
          <div class="row text-center">  
            <div class="col-lg-10 col-xl-10 col-md-12 mx-auto">
              <div class="row bg-gradient-beyazimsi">
                <?php Form::_form(array("action" => URL."/panel/urunGuncelleSon", "method" => "POST", "enctype"=>"multipart/form-data"));?>
                  <div class="col-12 bg-gradient-mvc pt-2 mvc-black"><h3>Ürün Güncelle</h3></div>
                  <div class="col-12">
                    <div class="row mvc-renk">
                    <!-- SOL -->
                      <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 bloklararasi">
                        <div class="row">
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Ürün Adı</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"urunad", "value"=>$veri["urunGuncelle"][0]["urunad"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Ana Kategori</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php 	
                              Form::select(array("name"=>"anaKatId", "class"=>"form-control", "id"=>"anaKatSelectGuncelle"));
                                foreach ($veri["anaKat"] as $value) {
                                  Form::option(array("value"=>$value["id"], $value["id"]==$veri["urunGuncelle"][0]["anakatid"] ? "selected" : null), array($value["ad"]));
                                }
                               Form::option(array("value"=>0), array("- - - - -"));
                              Form::selectkapat();	
                            ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Çocuk Kategori</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger" id="cocukKatSelectDiv">
                            <?php 	
                              Form::select(array("name"=>"cocukKatId", "class"=>"form-control", "id"=>"cocukKatSelectGuncelle"));
                                foreach ($veri["cocukKat"] as $value) {
                                  Form::option(array("value"=>$value["id"], $value["id"]==$veri["urunGuncelle"][0]["cocukkatid"] ? "selected" : null), array($value["ad"]));
                                }
                              Form::selectkapat();	
                            ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Kategori <span class="text-danger" style="cursor:pointer" id="katSıfırla">Sıfırla</span></div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php 	
                              Form::select(array("name"=>"altKatId", "class"=>"form-control", "id"=>"altKatSelectGuncelle"));
                                foreach ($veri["altKat"] as $value) {
                                  Form::option(array("value"=>$value["id"], $value["id"]==$veri["urunGuncelle"][0]["katid"] ? "selected" : null), array($value["ad"]));
                                }
                              Form::selectkapat();	
                            ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Kumaş</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"kumas", "value"=>$veri["urunGuncelle"][0]["kumas"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Üretim yeri</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"urtYeri", "value"=>$veri["urunGuncelle"][0]["urtYeri"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-43 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Renk</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"renk", "value"=>$veri["urunGuncelle"][0]["renk"], "class"=>"form-control")); ?>
                          </div>                   
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Fiyat</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"fiyat", "value"=>$veri["urunGuncelle"][0]["fiyat"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Stok</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"stok", "value"=>$veri["urunGuncelle"][0]["stok"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 uruneklemeElemanlar">Durum</div>
                          <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 uruneklemeElemanlarDiger">
                            <?php 	
                              Form::select(array("name"=>"durum", "class"=>"form-control"));
                                Form::option(array("value"=>0, $veri["urunGuncelle"][0]["durum"]==0 ? "selected" : null), array("standart"));
                                Form::option(array("value"=>1, $veri["urunGuncelle"][0]["durum"]==1 ? "selected" : null), array("en çok satanlar"));
                                Form::option(array("value"=>2, $veri["urunGuncelle"][0]["durum"]==2 ? "selected" : null), array("öne çıkanlar"));
                              Form::selectkapat();	
                            ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12" >
                            <img src="<?php echo URL.'/views/design/images/'.$veri["urunGuncelle"][0]["res1"]; ?>" class="img-fluid"/>
                            <?php Form::input(array("type"=>"file", "name"=>"res1", "class"=>"form-control")) ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12" >
                            <img src="<?php echo URL.'/views/design/images/'.$veri["urunGuncelle"][0]["res2"]; ?>" class="img-fluid"/>
                            <?php Form::input(array("type"=>"file", "name"=>"res2", "class"=>"form-control")) ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12 " >
                            <img src="<?php echo URL.'/views/design/images/'.$veri["urunGuncelle"][0]["res3"]; ?>" class="img-fluid"/>
                            <?php Form::input(array("type"=>"file", "name"=>"res3", "class"=>"form-control")) ?>
                          </div> 
                        </div>
                      </div>
                      <!-- SOL -->
                      <!-- SAĞ -->
                      <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12">
                        <div class="row">
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Açıklama</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"aciklama", "class"=>"form-control", "rows"=>"4"), $veri["urunGuncelle"][0]["aciklama"]); ?>
                          </div>   
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Özellik</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"ozellik", "class"=>"form-control", "rows"=>"4"), $veri["urunGuncelle"][0]["ozellik"]); ?>
                          </div> 
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Ekstra Bilgi</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"ekstraBilgi", "class"=>"form-control", "rows"=>"4"), $veri["urunGuncelle"][0]["ekstraBilgi"]); ?>
                          </div>                                   
                        </div>
                      </div>
                      <!-- SAĞ -->
                    </div>
                    <!-- İÇ ROW -->
                  </div>
                  <!-- İÇ ANASI -->
                  <?php Form::input(array("type"=>"hidden","name"=>"id","value"=>$veri["urunGuncelle"][0]["id"])); ?>
                  <div class="row">
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 uruneklemeBtn"></div>
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 uruneklemeBtn">
                      <?php Form::input(array("type"=>"submit","value"=>"Güncelle","class"=>"btn guncelbtn")); ?>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 uruneklemeBtn"></div>
                  </div>
                <?php Form::formkapat(); ?>
              </div> <!-- ROWWW -->
            </div>
          </div>
        </div>
        <!--  FORMUN İSKELETİ-->
      <?php endif; ?>   
      <?php if (isset($veri["urunEkle"]) && isset($veri["altKat"])) : ?>
        <!-- BAŞLIK -->
        <div class="row text-left mb-2">  
          <div class="col-xl-12 col-md-12 p-2 "><h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> ÜRÜN EKLE </h1></div>
        </div>
        <?php $PanelHarici->icNavigasyon("urunler", "Ürünler", "Ürün Ekleme") ?>
        <!-- BAŞLIK --> 	
        <!--  FORMUN İSKELETİ-->
        <div class="col-xl-12 col-md-12 text-center mt-3"> 
          <div class="row text-center">  
            <div class="col-lg-10 col-xl-10 col-md-12 mx-auto">
              <div class="row bg-gradient-beyazimsi">
                <?php Form::_form(array("action" => URL."/panel/urunEkleSon", "method" => "POST", "enctype"=>"multipart/form-data"));?>
                  <div class="col-12 bg-gradient-mvc pt-2 mvc-black"><h3>Ürün Ekle</h3></div>
                  <div class="col-12">
                    <div class="row mvc-renk">
                      <!-- SOL -->
                      <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 bloklararasi">
                        <div class="row">
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Ürün Adı</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"urunad", "value"=>$veri["urunEkle"][0]["urunad"], "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Kategori</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php 	
                              Form::select(array("name"=>"kategori", "class"=>"form-control"));
                                foreach ($veri["altKat"] as $value) {
                                  Form::option(array("value"=>$value["id"], $value["id"]==$veri["urunEkle"][0]["katid"] ? "selected" : null), array($value["ad"]));
                                }
                              Form::selectkapat();	
                            ?>
                          </div>
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Kumaş</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"kumas", "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Üretim yeri</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"urtYeri", "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Renk</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"renk", "class"=>"form-control")); ?>
                          </div>                   
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Fiyat</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"fiyat", "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Stok</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::input(array("type"=>"text", "name"=>"stok", "class"=>"form-control")); ?>
                          </div>
                          <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Durum</div>
                          <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                            <?php 	
                              Form::select(array("name"=>"durum", "class"=>"form-control"));
                                Form::option(array("value"=>0), array("standart"));
                                Form::option(array("value"=>1), array("en çok satanlar"));
                                Form::option(array("value"=>2), array("öne çıkanlar"));
                              Form::selectkapat();	
                            ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12" >
                            <?php Form::input(array("type"=>"file", "name"=>"res[]", "class"=>"form-control")) ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12" >
                            <?php Form::input(array("type"=>"file", "name"=>"res[]", "class"=>"form-control")) ?>
                          </div>
                          <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12 " >
                            <?php Form::input(array("type"=>"file", "name"=>"res[]", "class"=>"form-control")) ?>
                          </div> 
                        </div>
                      </div>
                      <!-- SOL -->
                      <!-- SAĞ -->
                      <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 ">
                        <div class="row">
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Açıklama</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"aciklama", "class"=>"form-control", "rows"=>"4")); ?>
                          </div>   
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Özellik</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"ozellik", "class"=>"form-control", "rows"=>"4")); ?>
                          </div> 
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Ekstra Bilgi</div>
                          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
                            <?php Form::textarea(array("name"=>"ekstraBilgi", "class"=>"form-control", "rows"=>"4")); ?>
                          </div>                                   
                        </div>
                      </div>
                      <!-- SAĞ -->
                    </div>
                    <!-- İÇ ROW -->
                  </div>
                  <!-- İÇ ANASI -->
                  <div class="row">
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 uruneklemeBtn"></div>
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 uruneklemeBtn">
                      <?php Form::input(array("type"=>"submit","value"=>"Ekle","class"=>"btn btn-primary pl-3 pr-3")); ?>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 uruneklemeBtn"></div>
                  </div>
                <?php Form::formkapat(); ?>
              </div> <!-- ROWWW -->
            </div>
          </div>
        </div>
        <!--  FORMUN İSKELETİ-->
      <?php endif; ?>    
      <!-- ürün güncelle bitiyor siparişin iskeleti bitiyor -->
      <?php if (isset($veri["data"]) && isset($veri["kategoriAdlari"])) : ?>
          <!-- BAŞLIK -->
          <div class="row text-left mb-2">  
            <div class="col-xl-4 col-md-12 text-center">
              <div class="row">
                <div class="col-xl-7 col-8 p-2 text-left mb-4">
                  <h1 class="h4 mb-0 mvc-renk baslik"> 
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                      <path d="M0 0h24v24H0V0z" fill="none"/>
                      <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                    </svg>  
                    ÜRÜNLER 
                  </h1>
                </div>
                <div class="col-xl-5 col-4 pt-1 text-left urunEkleBtn">
                  <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        İşlemler
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="about-us">
                      <li><a href="<?php echo URL."/panel/urunEkle" ?>" class="dropdown-item"> Tekli ürün ekle</a></li>
                      <li><a href="<?php echo URL."/panel/topluUrunEkle" ?>" class="dropdown-item">Toplu ürün ekle</a></li>
                      <li><a href="<?php echo URL."/panel/topluUrunGuncelle" ?>" class="dropdown-item">Toplu ürün güncelle</a></li>
                      <li><a href="<?php echo URL."/panel/topluUrunSil" ?>" class="dropdown-item">Toplu ürün silme</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-8 col-md-12 text-right">
              <div class="row">
                <div class="col-sm-8">
                  <?php Form::_form(["action" => URL."/panel/katgoregetir", "method" => "POST"]); ?>
                  <div class="input-group">
                    <?php 
                      Form::select(array("class"=>"form-control","id"=>"anaKatSelect"));
                        Form::option(array("value"=>0), array("Seçiniz"));
                        foreach ($veri["anaKategori"] as $deger):
                          Form::option(array("value"=>$deger["id"]), array($deger["ad"]));
                        endforeach;
                      Form::selectkapat();
                      Form::select(array("class"=>"form-control", "id"=>"cocukKatSelect"));
                        Form::option(array("value"=>0), array("Seçiniz"));
                        foreach ($veri["cocukKategori"] as $deger):
                          Form::option(array("value"=>$deger["id"]), array($deger["ad"]));
                        endforeach;
                      Form::selectkapat();	
                      Form::select(array("name"=>"katid","class"=>"form-control", "id"=>"altKatSelect"));
                        Form::option(array("value"=>0), array("Seçiniz"));
                        foreach ($veri["altKategori"] as $deger):
                          Form::option(array("value"=>$deger["id"]), array($deger["ad"]));
                        endforeach;
                      Form::selectkapat();
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
                <div class="col-sm-4 mailAramaMobile">
                    <?php Form::_form(["action" => URL."/panel/urunarama", "method" => "POST"]); ?>
                    <div class="input-group">
                        <?php 
                            Form::input(array("type"=>"text","name"=>"ara","class"=>"form-control","placeholder"=>"Arama Kriter"));
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
            </div>    
          </div>
          <!-- BAŞLIK --> 	
          <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
          <div class="row arkaplan p-1 pb-0 mt-3">
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
              <span>Ürün Ad</span> 
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
              <span>Kategori</span> 
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
              <span >Bölüm</span> 
            </div>
            <div class="col-xl-1 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
              <span >Satış Adeti</span> 
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
              <span >Fiyat</span> 
            </div>
            <div class="col-xl-1 col-lg-1 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
              <span >Stok</span> 
            </div>
            <div class="col-xl-2 col-12 p-2 pt-3 geneltext bg-gradient-mvc">
              <span >İşlemler</span> 
            </div>
            <!--  ÜRÜNLER-->
            <div class="col-12 mt-2 p-0" id="geldi"></div>
            <?php for ($i=0; $i<count($veri["data"]); $i++) : ?>
              <?php 
              echo '
              <div class="col-12 mt-2 p-0 mvc-renk arkaplanhover">
                <div class="row border border-black border-light">
                  <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">'.$veri["data"][$i]["urunad"].'</div>
                  <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 kalinyap p-2">';
                    $sayac = 0;
                    for ($j=0; $j<count($veri["kategoriAdlari"]); $j++) :
                      if($veri["data"][$i]["katid"]==$veri["kategoriAdlari"][$j][0]):
                        echo "<div style='text-transform:lowercase;'>";
                          echo "<span>".$veri["kategoriAdlari"][$j][3]." "."</span>";
                          echo "<span>".$veri["kategoriAdlari"][$j][2]." "."</span>";
                          echo "<span>".$veri["kategoriAdlari"][$j][1]."</span>";
                        echo "</div>";
                      else:
                        $sayac++;
                      endif;
                    endfor;
                    if($sayac==count($veri["kategoriAdlari"])):
                      echo "<span class='text-danger'>Kategori Bulunamadı!</span>";
                    endif;
                  echo '</div>
                  <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">';
                    echo $veri["data"][$i]["durum"]==0 ? "<span class='text-info'>Standart</span>" : "";
                    echo $veri["data"][$i]["durum"]==1 ? "<span class='text-danger'>En çok satanlar</span>" : "";
                    echo $veri["data"][$i]["durum"]==2 ? "<span class='text-success'>Öne çıkanlar</span>" : "";
                  echo '</div>
                  <div class="col-xl-1 col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">'.$veri["data"][$i]["satisadet"].'</div>
                  <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">'.number_format($veri["data"][$i]["fiyat"],2,'.',',').' TL</div> 
                  <div class="col-xl-1 col-lg-1 col-md-4 col-sm-4 col-4 kalinyap p-2">'.$veri["data"][$i]["stok"].'</div> 
                  ' ; ?>
                  <div class="col-xl-1 col-lg-6 col-md-6 col-6 p-2 text-right kategoriIcons">
                    <a href="<?php echo URL.'/panel/urunGuncelle/'.$veri['data'][$i]['id']; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                      </svg>
                    </a>
                  </div>
                  <div class="col-xl-1 col-lg-6 col-md-6 col-6 p-2 text-left kategoriIcons">
                    <a onclick="silmedenSor('<?php echo URL.'/panel/urunSil/'.$veri['data'][$i]['id']; ?>'); return false">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                      </svg>
                    </a>
                  </div>
                </div> 
              </div>
            <?php endfor; ?>
            <?php if(isset($veri["toplamveri"])) : ?>
              <div class="col-12 p-2 mt-2 toplamveri">
                <h6 class="mb-0 pt-1">Toplam Ürün : <?php echo $veri["toplamveri"]; ?></h6>
              </div>
             <?php endif; ?>
          </div>
          <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
      <?php endif; ?>  
      <?php if(isset($veri["urunarama"])) : ?>
          <?php $link = '/panel/urunarama/'.$Harici->seo($veri["urunarama"]).'/';
        elseif(isset($veri["urunkategori"])):
          $link = '/panel/katgoregetir/'.$veri["urunkategori"].'/';
        else:
          $link = '/panel/urunler/';
        endif;
        if(isset($veri["toplamsayfa"])) : 
          Pagination::paginationNumaralar($veri["toplamsayfa"], $link); ?>
      <?php endif; ?>
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->

<?php require 'views/YonPanel/footer.php'; ?>