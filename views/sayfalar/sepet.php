<?php require "views/header.php"; ?>
		<!-- checkout -->
        <div class="cart-items">
	<div class="container">
		<?php if(isset($_COOKIE['urun'])): ?>
			 <h2>SEPETİNİZDEKİ ÜRÜN - <?php echo count($_COOKIE['urun']) ?></h2>
			 <div>
			 <?php 
					$toplamAdet = 0;
					$toplamFiyat = 0;
					echo "<form id='guncelForm'>";
					foreach($_COOKIE['urun'] as $id => $adet):
						$urun = $Harici->urunCek($id)[0];
						$toplamAdet += $adet;
						$toplamFiyat += ($urun["fiyat"] * $adet);
						echo '
						<div class="cart-header">
							<div class="close1"> 
								<input type="button" class="btn btn-sm btn-success" data-value="'.$urun["id"].'" value="GÜNCELLE">
								<a onclick=urunSil("'.$urun["id"].'","sepetsil") class="btn btn-sm btn-danger">SİL</a>
							</div>
							<div class="cart-sec simpleCart_shelfItem">
								<div class="cart-item cyc">
									<img src="'.URL.'/views/design/images/'.$urun["res1"].'" class="img-responsive" alt="">
								</div>
								<div class="cart-item-info">
									<h3> <a href="#"> '.$urun["urunad"].' </a></h3>
									<ul class="qty">
										<li><h3>Ürün Fiyat</h3>
											<span>'.number_format($urun["fiyat"],2,'.',',').'₺</span></li>
										<li><h3>Ürün Adet</h3>
											<input type="number" min="1" max="10" value="'.$adet.'" name="adet'.$urun["id"].'" class="form-control" /> 
										</li>
									</ul>
									<div class="delivery">
										<span>Toplam Fiyat : '.number_format($urun["fiyat"]*$adet,2,',','.').'₺</span>
										<div class="clearfix"></div>
									</div>	
								</div>
								<div class="clearfix"></div>
							</div>
						</div>';
					endforeach;
					echo "</form>";
					echo '
					<div class="row toplamAlan_2">
						<div  class="col-md-2">
							<a style="margin-top:16px; padding:8px; font-size:14px" class="btn btn-sm btn-info" onclick="sepetiBosalt()" >SEPETİ BOSALT</a>
						</div>
						<div  class="col-md-10">
							<div>Toplam Adet: '.$toplamAdet.'</div>
							<div>Toplam Fiyat: '.number_format($toplamFiyat,2,',','.').'₺</div>
						</div>
					</div>
					<div class="row toplamAlan">
						<div class="col-md-12">
							<a href="'.URL.'" class="btn btn_1">ALIŞVERİŞE DEVAM ET</a>
							<a href="'.URL.'/sayfalar/siparisitamamla" class="btn btn_1">SİPARİŞİ TAMAMLA</a>
						</div>
					</div>';
				else:

					echo '<div class="alert alert-info text-center"><h3>SEPETİNİZDE ÜRÜN BULUNMAMAKTADIR</h3></div>';
					echo '<div class="row toplamAlan">
							<div class="col-md-12">
								<a href="'.URL.'" class="btn btn_1">ALIŞVERİŞE DEVAM ET</a>
							</div>
						</div>';
				endif;	 
			?>
			</div>
			 <script>$(document).ready(function(c) {
					$('.close2').on('click', function(c){
							$('.cart-header2').fadeOut('slow', function(c){
						$('.cart-header2').remove();
					});
					});	  
					});
			 </script>
			  <script>$(document).ready(function(c) {
					$('.close3').on('click', function(c){
							$('.cart-header3').fadeOut('slow', function(c){
						$('.cart-header3').remove();
					});
					});	  
					});
			 </script>
		</div>
	</div>
</div>

<!-- //checkout -->	
<?php require "views/footer.php"; ?>
