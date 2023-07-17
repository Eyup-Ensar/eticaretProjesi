<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-md-12 mb-12 text-center"> 
      <?php if (isset($veri["bilgi"])) :
          echo $veri["bilgi"];
        endif; ?>
      <?php if (isset($veri["sifreDegistir"])) :?>
	      <?php if (!$_POST) : ?>
          <!-- BAŞLIK -->
          <div class="row text-left border-bottom-mvc mb-2">  
        	  <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-3">
              <h1 class="h4 mb-0 mvc-renk"><img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> ŞİFRE DEĞİŞTİR </h1>
            </div>
          </div>
          <!-- BAŞLIK --> 	
          <!--  FORMUN İSKELETİ-->
          <div class="col-xl-12 col-md-12  text-center"> 
            <div class="row text-center">  
        	    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 mx-auto">
             		<div class="row bg-gradient-beyazimsi">
             		  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Şifre Değiştir</h4></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi mvc-renk">
                    <?php Form::_form(array("action" => URL."/panel/sifreDegistirSon", "method" => "POST"));?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Mevcut Şifre</div>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                      <?php Form::input(array("type"=>"password", "name"=>"mevcutSifre", "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Yeni Şifre</div>
                      <?php Form::input(array("type"=>"password", "name"=>"yeniSifre", "class"=>"form-control")); ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Yeni Şifre (Tekrar)</div>
                      <?php Form::input(array("type"=>"password", "name"=>"sifreTekrar", "class"=>"form-control")); ?>
                  </div>
                      <?php 		
                          Form::input(array("type"=>"submit","value"=>"Şifre Değiştir","class"=>"btn guncelbtn"));		
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
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->
     
<?php require 'views/YonPanel/footer.php'; ?>