<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12 text-center"> 
      <?php if (isset($veri["bilgi"])) :
          echo $veri["bilgi"];
        endif; ?>
      <?php if (isset($veri["bankaBilgileriEkle"])) : ?>
        <!-- BAŞLIK -->
        <div class="row text-left border-bottom-mvc mb-2">  
            <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2">
              <h1 class="h4 mb-0 mvc-renk baslik"> 
              <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
              </svg>    
              BANKA HESABI EKLE </h1>
            </div>
        </div>
        <?php $PanelHarici->icNavigasyon("bankaBilgileri", "Banka Bilgileri", "Banka Hesabı Ekleme") ?>
        <!-- BAŞLIK --> 	
        <!--  FORMUN İSKELETİ-->
        <div class="col-xl-12 col-md-12  text-center"> 
            <div class="row text-center">  
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 mx-auto">
                  <div class="row bg-gradient-beyazimsi mvc-renk">
                    <div class="col-lg-12 col-md-12 col-lg-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black">
                        <h4>Banka Hesabı Ekle</h4>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Banka Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                        <?php 	
                          Form::_form(array("action" => URL."/panel/bankaBilgileriEkleSon","method" => "POST"));  
                          Form::input(array("type"=>"text","class"=>"form-control","name"=>"bankaAd"));	       
                        ?>  
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                      <?php Form::input(array("type"=>"text","class"=>"form-control","name"=>"hesapAd")); ?>  
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap Numarası</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                      <?php Form::input(array("type"=>"text","class"=>"form-control","name"=>"hesapNo")); ?>  
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">İban Numarası</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                      <?php Form::input(array("type"=>"text","class"=>"form-control","name"=>"ibanNo")); ?>  
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                        <?php 		
                          Form::input(array("type"=>"submit","value"=>"Banka Hesabı Ekle","class"=>"btn btn-primary"));		
                          Form::formkapat();	 
                        ?>
                    </div>  
                  </div>
              </div>
            </div>
        </div>
        <!--  FORMUN İSKELETİ-->
      <?php endif; ?> 
      <?php if (isset($veri["bankaBilgileriGuncelle"])) :?>
	      <?php if (!$_POST) : ?>
          <!-- BAŞLIK -->
          <div class="row text-left border-bottom-mvc mb-2">  
        	  <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2">
              <h1 class="h4 mb-0 mvc-renk baslik"> 
              <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
            </svg>    
              BANKA BİLGİLERİ GÜNCELLE </h1></div>
          </div>
          <?php $PanelHarici->icNavigasyon("bankaBilgileri", "Banka Bilgileri", "Banka Bilgileri Güncelleme") ?>
          <!-- BAŞLIK --> 	
          <!--  FORMUN İSKELETİ-->
          <div class="col-xl-12 col-md-12  text-center"> 
            <div class="row text-center">  
        	    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 mx-auto">
             		<div class="row bg-gradient-beyazimsi mvc-renk">
             		  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Banka Bilgileri Güncelle</h4></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                    <?php Form::_form(array("action" => URL."/panel/bankaBilgileriGuncelleSon", "method" => "POST"));?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Banka Adı</div>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                      <?php Form::input(array("type"=>"text", "name"=>"bankaAd", "value"=>$veri["bankaBilgileriGuncelle"][0]["bankaAd"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap Adı</div>
                      <?php Form::input(array("type"=>"text", "name"=>"hesapAd", "value"=>$veri["bankaBilgileriGuncelle"][0]["hesapAd"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap Numarası</div>
                      <?php Form::input(array("type"=>"text", "name"=>"hesapNo", "value"=>$veri["bankaBilgileriGuncelle"][0]["hesapNo"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">İban Numarası</div>
                      <?php Form::input(array("type"=>"text", "name"=>"ibanNo", "value"=>$veri["bankaBilgileriGuncelle"][0]["ibanNo"], "class"=>"form-control")); ?>
                  </div>
                      <?php 		
                          Form::input(array("type"=>"submit","value"=>"Güncelle","class"=>"btn guncelbtn"));		
                          Form::input(array("type"=>"hidden","name"=>"id","value"=>$veri["bankaBilgileriGuncelle"][0]["id"]));	 
                        Form::formkapat("kapat");	 
                      ?>
                  </div>  
             		</div>
              </div>
      			</div>
          </div>
           <!--  FORMUN İSKELETİ-->
        <?php endif; ?>
	    <?php endif; ?> 
      <?php if (isset($veri["data"])) : ?>
        <!-- BAŞLIK -->
        <div class="row text-left border-bottom-mvc mb-2">  
          <div class="col-9 p-2 mb-3">
            <h1 class="h4 mb-0 mvc-renk baslik"> 
            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
              <path d="M0 0h24v24H0V0z" fill="none"/>
              <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
            </svg>    
             BANKA HESAPLARI</h1>
          </div>
          <div class="col-3 text-right">
            <?php
              Form::_form(array("action" => URL."/panel/bankaBilgileriEkle", "method" => "POST"));  
                Form::input(array("type"=>"submit","value"=>"Hesap Ekle","class"=>"btn btn-primary btn-sm mt-1 hesapEkleBtnMobile"));		
              Form::formkapat();
            ?>
          </div>    
        </div>
        <!-- BAŞLIK --> 	
        <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        <div class="row arkaplan p-1 mt-2 pb-0 mvc-renk">
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Banka Adı</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Hesap Adı</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Hesap Numarası</span> 
          </div>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>İban Numarası</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 p-2 pt-3   geneltext bg-gradient-mvc">
            <span >İşlemler</span> 
          </div>
          <!--  ÜRÜNLER-->
          <?php foreach ($veri["data"] as $value) : ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0 arkaplanhover">
            <?php 
              echo '
              <div class="row border border-light">
                <div class="col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">'.$value["bankaAd"].'</div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">'.$value["hesapAd"].'</div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-4 kalinyap p-2">'.$value["hesapNo"].'</div>
                <div class="col-lg-4 col-md-12 kalinyap p-2">'.$value["ibanNo"].'</div>
                <div class="col-lg-1 col-6 kalinyap p-2">
                  <a href="'.URL.'/panel/bankaBilgileriGuncelle/'.$value["id"].'">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                      <path d="M0 0h24v24H0V0z" fill="none"/>
                      <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                    </svg>
                  </a>
                </div>
                <div class="col-lg-1 col-6 kalinyap p-2">';
                  ?>
                    <a onclick="silmedenSor('<?php echo URL.'/panel/bankaBilgileriSil/'.$value['id']; ?>'); return false">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                      </svg>
                    </a>
                  <?php
                 echo '</div>
                </div> 
              </div>'; 
            ?>
          <?php endforeach; ?>
        </div>
        <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
      <?php endif; ?>   
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->
     
<?php require 'views/YonPanel/footer.php'; ?>