<?php require "views/header.php"; ?>

<div class="container">
	   <div class="products-page">
			<div class="products">
				<div class="product-listy">
					<h2>Stoğu Azalanlar</h2>
					<ul class="product-list">
                        <?php 
                            foreach($veri["data2"] as $value):
                                echo "<li><a href=".URL.'/urunler/detay/'.$value['id'].'/'.$Harici->seo($value['urunad']).">".$value["urunad"]."</a></li>";
                            endforeach;
                        ?>

					</ul>
				</div>
			</div>
			<div class="new-product">
				<div class="col-md-5 zoom-grid">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="<?php echo URL ?>/views/design/images/<?php echo $veri["data1"][0]["res1"] ?>">
								<div class="thumb-image"> <img src="<?php echo URL ?>/views/design/images/<?php echo $veri["data1"][0]["res1"] ?>" data-imagezoom="true" class="img-responsive" alt="<?php echo $veri["data1"][0]["urunad"] ?>" /> </div>
							</li>
							<li data-thumb="<?php echo URL ?>/views/design/images/<?php echo $veri["data1"][0]["res2"] ?>">
								<div class="thumb-image"> <img src="<?php echo URL ?>/views/design/images/<?php echo $veri["data1"][0]["res2"] ?>" data-imagezoom="true" class="img-responsive" alt="<?php echo $veri["data1"][0]["urunad"] ?>" /> </div>
							</li>
							<li data-thumb="<?php echo URL ?>/views/design/images/<?php echo $veri["data1"][0]["res3"] ?>">
							<div class="thumb-image"> <img src="<?php echo URL ?>/views/design/images/<?php echo $veri["data1"][0]["res3"] ?>" data-imagezoom="true" class="img-responsive" alt="<?php echo $veri["data1"][0]["urunad"] ?>" /> </div>
							</li> 
						</ul>
					</div>
				</div>
				<div class="col-md-7 dress-info">
					<div class="dress-name">
						<h3> <?php echo $veri["data1"][0]["urunad"] ?> </h3>
						<span><?php echo number_format($veri["data1"][0]["fiyat"], 2, '.', ',')."₺"?></span>
						<div class="clearfix"></div>
						<p><?php echo $veri["data1"][0]["aciklama"] ?></p>
					</div>
					<div class="span span1">
						<p class="left">KUMAŞ</p>
						<p class="right"><?php echo $veri["data1"][0]["kumas"] ?></p>
						<div class="clearfix"></div>
					</div>
					<div class="span span2">
						<p class="left">ÜRETİM YERİ</p>
						<p class="right"><?php echo $veri["data1"][0]["urtYeri"] ?></p>
						<div class="clearfix"></div>
					</div>
					<div class="span span3">
						<p class="left">RENK</p>
						<p class="right"><?php echo $veri["data1"][0]["renk"] ?></p>
						<div class="clearfix"></div>
					</div>
					<div class="purchase">
						<div class="row" id="sepetUcur">
							<div class="col-md-6" id="sepetSonuc"></div>
							<div class="col-md-3">
								<?php 
								Form::_form(["id" => "sepetForm"]); 
								Form::input(["type"=>"number", "min"=>"1", "max"=>"10", "value"=>"1", "name"=>"adet", "id"=>"numb", "class"=>"form-control"]);
								?>
								</div>
								<div class="col-md-3">
								<?php Form::input(["type"=>"hidden", "name"=>"id", "value"=>"".$veri["data1"][0]["id"].""]);
								Form::input(["type" => "button", "id" => "sepetBtn", "value" => "Sepete Ekle", "class" => "btn btn-success"]);?>
								</form>
                        	</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				<script src="<?php echo URL; ?>/views/design/js/imagezoom.js"></script>
					<!-- FlexSlider -->
					<script defer src="<?php echo URL; ?>/views/design/js/jquery.flexslider.js"></script>
					<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
					</script>
				</div>
				<div class="clearfix"></div>
					<div class="reviews-tabs">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#bilgi" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Daha fazla bilgi</a></li>
			  <li role="presentation" class=""><a href="#ozellik" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Özellikler</a></li>
    			  <li role="presentation" class=""><a href="#yorum" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Yorumlar - <?php echo count($veri["data4"]) ?></a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
			  <div role="tabpanel" class="tab-pane fade active in" id="bilgi" aria-labelledby="home-tab">
				<p><?php echo $veri["data1"][0]["ekstraBilgi"]; ?></p>
			  </div>
			  <div role="tabpanel" class="tab-pane fade " id="ozellik" aria-labelledby="profile-tab">
				<p><?php echo $veri["data1"][0]["ozellik"]; ?></p>
			  </div>
			  <div role="tabpanel" class="tab-pane fade" id="yorum" aria-labelledby="dropdown1-tab">
                 <!-- Yorum başla -->
				 <?php if(Session::get("kulad") && Session::get("uye")): ?>
					
					<div class="row" id="formSonuc"></div>
					<input type="button" value="Yorum yap" id="yorumEkle" class="btn btn-info">		
						<div class="row arkaplan" id="formAnasi">
							<?php Form::_form(["class" => "form", "id" => "yorumForm"]); ?>
								<div class="col-lg-12"><label class="hizala_1">Adınız</label></div>
								<div class="col-lg-12"><?php Form::input(["type"=>"text", "name"=>"ad", "value"=>"".Session::get("kulad")."", "class"=>"form-control", "readonly"=>"readonly"]) ?></div>
								<?php Form::input(["type"=>"hidden", "name"=>"urunid", "value"=>"".$veri["data1"][0]["id"].""]);
								Form::input(["type"=>"hidden", "name"=>"uyeid", "value"=>"".Session::get("uye").""]);?>
								<div class="col-lg-12"><label class="hizala_1">Yorumunuz</label></div>
								<div class="col-lg-12"><?php Form::textarea(["name"=>"icerik", "cols"=>"30", "rows"=>"10", "class"=>"form-control"]) ?></div>
								<div class="col-lg-12 text-center"><?php Form::input(["type"=>"button", "id"=>"yorumGonder", "value"=>"Gönder", "class"=>"Gönder"]) ?></div>
							</form>
						</div>
					<?php else: ?>
					<!-- Giriş yapılmadıysa yorum alanı kayıp -->
					<div class="alert alert-danger text-center">Yorum yapabilmek için giriş yapmanız gerekmektedir</div>	
					<?php endif; ?>
					<?php if(count($veri["data4"])==0): ?>
						<div class="alert alert-danger text-center">Bu ürüne ait yorum bulunmamaktadır</div>	
					<?php else: ?>
						<?php foreach($veri["data4"] as $value): ?>
							<div class="media response-info yorumlar">
								<div class="media-left response-text-left" id="yorumad">								
									<h5> <?php echo $value["ad"] ?> </h5>
								</div>
								<div class="media-body response-text-right">
									<p> <?php echo $value["icerik"] ?> </p>
									<ul>
										<li><?php echo $value["tarih"] ?></li>
									</ul>
								</div>
								<div class="clearfix"> </div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
			  </div>
			</div>
		   </div>
    <div class="clearfix"></div>
    </div>
   </div>
   <div class="other-products products-grid">
		<div class="container">
            <header>
                <h3 class="like text-center" style="margin-left:11%">BENZER ÜRÜNLER</h3>   
            </header>	
            <?php foreach($veri["data3"] as $value): ?>
                <div class="col-md-4 product simpleCart_shelfItem text-center">
                    <a href="<?php echo URL.'/urunler/detay/'.$value['id'].'/'.$Harici->seo($value['urunad']); ?>"><img src="<?php echo URL ?>/views/design/images/<?php echo $value["res1"] ?>" alt="<?php $value["urunad"] ?>" /></a>
                    <div class="mask">
                        <a href="<?php echo URL.'/urunler/detay/'.$value['id'].'/'.$Harici->seo($value['urunad']); ?>">İNCELE</a>
                    </div>
                    <a class="product_name" href="<?php echo URL.'/urunler/detay/'.$value['id'].'/'.$Harici->seo($value['urunad']); ?>"><?php $value["urunad"] ?></a>
                    <p><a class="item_add" href="#"><i></i> <span class="item_price"><?php echo number_format($value["fiyat"], 2, '.', ',')."₺" ?></span></a></p>
                </div>   
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
   <!-- content-section-ends -->
    <div class="news-letter">
        <div class="container">
			<?php $Harici->bulten() ?>
        </div>
    </div>
<?php require "views/footer.php"; ?>
