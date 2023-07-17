<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4 mt-4">
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
      <!-- TOPLU ÜRÜN EKLEME -->
      <?php if(isset($veri["topluUrunEkleme"])): ?>
        <div class="row text-left border-bottom-mvc mb-2">
          <div class="col-xl-4 col-md-6 mb-12 border-left-mvc text-left p-2">
            <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> TOPLU ÜRÜN EKLEME </h1>
          </div>
        </div>
        <?php $PanelHarici->icNavigasyon("urunler", "Ürünler", "Toplu Ürün Ekleme") ?>
        <div class="row text-center">
          <div class="col-xl-4 col-md-8 mx-auto">
            <div class="row bg-gradient-beyazimsi">
              <div class="col-12 bg-gradient-mvc pt-2 mvc-black">
                <h4>Dosyaları Ekle</h4>
              </div>
              <div class="col-12 formeleman nocizgi mvc-renk form-check">
                <?php Form::_form(array("action" => URL."/panel/topluUrunEkle/son", "method" => "POST", "enctype"=>"multipart/form-data", "class" => "form")); ?>
                <label class="form-check-label">
                  <span style="margin:0 28px 0 4px;">XML</span>
                  <?php Form::input(array("type" => "radio", "name"=>"dosyaTercih", "value"=>"xml", "class"=>"form-check-input")); ?>
                </label>
                <label class="form-check-label">
                  <span style="margin:0 28px 0 30px;">JSON</span>
                  <?php Form::input(array("type" => "radio", "name"=>"dosyaTercih", "value"=>"json", "class"=>"form-check-input")); ?>
                </label>
              </div>
              <div class="col-12 mt-2">
                <?php Form::input(array("type" => "file", "name"=>"dosya", "class"=>"form-control")); ?>
              </div>
              <div class="col-12 formeleman mvc-renk nocizgi mt-2">Resimlerin Dosyası (ZİP)</div>
              <div class="col-12 mt-2">
                <?php Form::input(array("type" => "file", "name"=>"zipDosya", "class"=>"form-control")); ?>
              </div>
              <div class="col-12 formeleman nocizgi mt-2">
                <?php
                    Form::input(array("type" => "submit", "value" => "Yükle", "class"=>"btn btn-primary pl-3 pr-3"));
                    Form::formKapat();
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <!-- TOPLU ÜRÜN EKLEME -->
      <!-- TOPLU ÜRÜN GÜNCELLEME -->
      <?php if(isset($veri["topluUrunGuncelleme"])): ?>
        <div class="row text-left border-bottom-mvc mb-2">
          <div class="col-xl-6 col-md-6 mb-12 border-left-mvc text-left p-2">
            <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> TOPLU ÜRÜN GÜNCELLEME </h1>
          </div>
        </div>
        <?php $PanelHarici->icNavigasyon("urunler", "Ürünler", "Toplu Ürün Güncelleme") ?>
        <div class="row text-center">
          <div class="col-xl-4 col-md-8 mx-auto">
            <div class="row bg-gradient-beyazimsi">
              <div class="col-12 bg-gradient-mvc pt-2 mvc-black">
                <h4>Dosyaları Güncelle</h4>
              </div>
              <div class="col-12 formeleman nocizgi mvc-renk form-check">
                <?php Form::_form(array("action" => URL."/panel/topluUrunGuncelle/son", "method" => "POST", "enctype"=>"multipart/form-data", "class" => "form")); ?>
                <label class="form-check-label">
                  <span style="margin:0 28px 0 4px;">XML</span>
                  <?php Form::input(array("type" => "radio", "name"=>"dosyaGuncelleTercih", "value"=>"xml", "class"=>"form-check-input")); ?>
                </label>
                <label class="form-check-label">
                  <span style="margin:0 28px 0 30px;">JSON</span>
                  <?php Form::input(array("type" => "radio", "name"=>"dosyaGuncelleTercih", "value"=>"json", "class"=>"form-check-input")); ?>
                </label>
              </div>
              <div class="col-12 mt-2">
                <?php Form::input(array("type" => "file", "name"=>"Guncellemedosya", "class"=>"form-control")); ?>
              </div>
              <div class="col-12 formeleman mvc-renk nocizgi mt-2">Resimlerin Dosyası (ZİP)</div>
              <div class="col-12 mt-2">
                <?php Form::input(array("type" => "file", "name"=>"zipDosya", "class"=>"form-control")); ?>
              </div>
              <div class="col-12 formeleman nocizgi mt-2">
                <?php
                    Form::input(array("type" => "submit", "value" => "Güncelle", "class"=>"btn btn-primary pl-3 pr-3"));
                    Form::formKapat();
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <!-- TOPLU ÜRÜN GÜNCELLEME -->
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->

<?php require 'views/YonPanel/footer.php'; ?>