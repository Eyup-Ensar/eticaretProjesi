<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12 text-center"> 
      <?php if (isset($veri["bilgi"])) :
          echo $veri["bilgi"];
        endif; ?>
      <?php if (isset($veri["uyeGuncelle"])) :?>
	      <?php if (!$_POST) : ?>
          <!-- BAŞLIK -->
          <div class="row text-left border-bottom-mvc mb-2">  
        	  <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2"><h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> ÜYE GÜNCELLE </h1></div>
          </div>
          <?php $PanelHarici->icNavigasyon("uyeler", "Üyeler", "Üye Güncelleme") ?>
          <!-- BAŞLIK --> 	
          <!--  FORMUN İSKELETİ-->
          <div class="col-xl-12 col-md-12  text-center"> 
            <div class="row text-center">  
        	    <div class="col-xl-4 col-md-6 mx-auto">
             		<div class="row bg-gradient-beyazimsi">
             		  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Üye Bilgileri Güncelle</h4></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi mvc-renk">
                    <?php Form::_form(array("action" => URL."/panel/uyeGuncelleSon", "method" => "POST"));?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Adı</div>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                      <?php Form::input(array("type"=>"text", "name"=>"ad", "value"=>$veri["uyeGuncelle"][0]["ad"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Soyad</div>
                      <?php Form::input(array("type"=>"text", "name"=>"soyad", "value"=>$veri["uyeGuncelle"][0]["soyad"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Maili</div>
                      <?php Form::input(array("type"=>"text", "name"=>"mail", "value"=>$veri["uyeGuncelle"][0]["mail"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Telefonu</div>
                      <?php Form::input(array("type"=>"text", "name"=>"telefon", "value"=>$veri["uyeGuncelle"][0]["telefon"], "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Durumu</div>
                      <?php 	
                          Form::select(array("name"=>"durum", "class"=>"form-control"));
                            Form::option(array("value"=>1, $veri["uyeGuncelle"][0]["durum"]==1 ? "selected" : null), array("aktif"));
                            Form::option(array("value"=>0, $veri["uyeGuncelle"][0]["durum"]==0 ? "selected" : null), array("pasif"));
                          Form::selectkapat();	
                      ?>
                  </div>
                      <?php 		
                          Form::input(array("type"=>"submit","value"=>"Güncelle","class"=>"btn guncelbtn"));		
                          Form::input(array("type"=>"hidden","name"=>"id","value"=>$veri["uyeGuncelle"][0]["id"]));	 
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
      <?php if (isset($veri["uyeAdres"])) :?>
          <!-- BAŞLIK -->
          <div class="row text-left border-bottom-mvc mb-2">  
        	  <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2"><h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> ÜYE ADRESLERİ </h1></div>
          </div>
          <?php $PanelHarici->icNavigasyon("uyeler", "Üyeler", "Üye Adresleri") ?>
          <!-- BAŞLIK --> 	
          <!--  FORMUN İSKELETİ-->
          <div class="col-xl-12 col-md-12  text-center"> 
            <div class="row text-center">  
        	    <div class="col-xl-4 col-md-6 mx-auto">
             		<div class="row bg-gradient-beyazimsi">
             		  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Üye Adresleri</h4></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi mvc-renk">
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Adresleri</div>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                        <?php 
                          if(count($veri["uyeAdres"])!=0):
                            for ($i=0; $i < count($veri["uyeAdres"]) ; $i++) :
                              echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">'.$veri["uyeAdres"][$i]["adres"];
                                echo $veri["uyeAdres"][$i]["varsayilan"] == 1 ? "<br><span class='text-danger'>(Varsayılan)</span>" : null;
                              echo "</div>";
                            endfor;
                          else:
                            echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman"><span class="text-danger">Hiç bir adres bulunmamaktadır!</span></div>';

                          endif;
                        ?>
                  </div>
                  </div>  
             		</div>
              </div>
      			</div>
          </div>
           <!--  FORMUN İSKELETİ-->
	    <?php endif; ?> 
      <?php if (isset($veri["data"])) : ?>
        <!-- BAŞLIK -->
        <div class="row text-left border-bottom-mvc mb-2 mvc-renk">  
          <div class="col-lg-8 col-md-6 col-sm-5 col-5 p-2 mb-4">
            <h1 class="h4 mb-0 mvc-renk baslik"> 
               <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                  <path d="M0 0h24v24H0V0z" fill="none"/>
                  <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                </svg> 
                ÜYELER
              </h1>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-7 col-7">
              <?php Form::_form(array("action" => URL."/panel/uyearama", "method" => "POST")); ?>
              <div class="input-group">
                  <?php 
                      Form::input(array("type"=>"text","name"=>"ara","class"=>"form-control","placeholder"=>"Üye Ara"));
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
        <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        <div class="row arkaplan p-1 mt-2 pb-0 mvc-renk">
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6  p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Üye Adı</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6  p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Üye Soyadı</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12  p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Mail Adresi</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-6  p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Telefon</span> 
          </div>
          <div class="col-xl-1 col-lg-1 col-md-3 col-sm-3 col-6  p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Durum</span> 
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 p-2 pt-3 geneltext bg-gradient-mvc">
            <span >İşlemler</span> 
          </div>
          <!--  ÜRÜNLER-->
          <?php foreach ($veri["data"] as $value) : ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
            <?php 
              echo '
              <div class="row border border-light mvc-renk arkaplanhover">
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 kalinyap p-2">'.$value["ad"].'</div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 kalinyap p-2">'.$value["soyad"].'</div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 kalinyap p-2">'.$value["mail"].'</div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-6 kalinyap p-2">'.$value["telefon"].'</div> 
                <div class="col-xl-1 col-lg-1 col-md-3 col-sm-3 col-6 kalinyap p-2">';
                echo $value["durum"]==1 ? '<span class="text-success">aktif</span>' : '<span class="text-danger">pasif</span>';
                echo '</div>';
                ?>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2 col-4 kalinyap p-2 text-right">
                  <a href="<?php echo URL."/panel/uyeGuncelle/".$value['id'] ?>" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                      <path d="M0 0h24v24H0V0z" fill="none"/>
                      <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                    </svg>
                  </a>
                  </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2 col-4 kalinyap p-2 text-center">
                  <a href="<?php echo URL."/panel/uyeAdres/".$value['id'] ?>" class="mr-2">
                    <svg height="24px" viewBox="0 0 24 24" width="24px" fill="#31323b" id="addressIcon">
                      <path d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 12c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm6-1.8C18 6.57 15.35 4 12 4s-6 2.57-6 6.2c0 2.34 1.95 5.44 6 9.14 4.05-3.7 6-6.8 6-9.14zM12 2c4.2 0 8 3.22 8 8.2 0 3.32-2.67 7.25-8 11.8-5.33-4.55-8-8.48-8-11.8C4 5.22 7.8 2 12 2z"/>
                    </svg>
                  </a>
                  </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2 col-4 kalinyap p-2 text-left">
                    <a onclick="silmedenSor('<?php echo URL.'/panel/uyeSil/'.$value['id']; ?>'); return false" class="mr-2">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                          <path d="M0 0h24v24H0V0z" fill="none"/>
                          <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                      </svg>
                    </a>
                  </div>
                </div> 
              </div>
          <?php endforeach; ?>
          <?php if(isset($veri["toplamveri"])) : ?>
            <div class="col-12 p-2 mt-2 toplamveri">
              <h6 class="mb-0 pt-1 ">Toplam Üye : 
                <?php 
                  echo isset($veri["toplamveri"]) ? $veri["toplamveri"] : null;
                  echo isset($veri["aramatoplamveri"]) ? $veri["aramatoplamveri"] : null;
                ?>
              </h6>
            </div>
          <?php endif; ?>
        </div>
        <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
      <?php endif; ?>   
      <?php if(isset($veri["uyearama"])) : 
          $link = '/panel/uyearama/'.$Harici->seo($veri["uyearama"]).'/';
        else:
          $link = '/panel/uyeler/';
        endif;
        if(isset($veri["toplamsayfa"])) : 
          Pagination::paginationNumaralar($veri["toplamsayfa"], $link);
        endif; ?> 
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->
     
<?php require 'views/YonPanel/footer.php'; ?>