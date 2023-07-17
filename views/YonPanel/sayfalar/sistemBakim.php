<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12 text-center"> 
    <?php if (isset($veri["bilgi"])) :
          echo $veri["bilgi"];
        endif; ?>
    <?php if (isset($veri["sistemBakim"])) :?>
          <!-- BAŞLIK -->
          <div class="row text-left border-bottom-mvc mb-2">  
        	  <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-3">
              <h1 class="h4 mb-0 mvc-renk baslik"> 
              <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
              </svg>    
              SİSTEM BAKIM </h1></div>
          </div>
          <!-- BAŞLIK --> 	
          <!--  FORMUN İSKELETİ-->

          <div class="col-xl-12 col-md-12  text-center"> 
            <div class="row text-center">  
        	    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 mx-auto">
             		<div class="row bg-gradient-beyazimsi">
             		  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black">
                    <h4>Sistem Bakımını Yap</h4>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                    <?php Form::_form(array("action" => URL."/panel/bakimYap", "method" => "POST"));?>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                      <?php 		
                          Form::input(array("type"=>"submit","value"=>"Bakımı Başlat","name"=>"yedekBtn","class"=>"btn btn-primary"));		
                        Form::formkapat("kapat");	 
                      ?>
                  </div>  
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi mvc-renk">
                      <?php 		
                        $geldi = $PanelHarici->listele("ayarlar", false);
                        echo "Son bakım zamanı : ".$geldi[0]["bakimTarih"];
                      ?>
                  </div>  
             		</div>
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