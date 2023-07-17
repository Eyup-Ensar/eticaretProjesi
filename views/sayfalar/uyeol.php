<?php require "views/header.php"; ?>
		<!-- registration-form -->

<?php if(!Session::get("kulad") && !Session::get("uye")): 
Session::oturumKontrol("uye", Session::get("kulad"), Session::get("uye"));
?>    

<div class="registration-form">
	<div class="container">
		<div class="dreamcrub">
			<ul class="breadcrumbs">
				<li class="home">
				<a href="<?php echo URL ?>" title="ANASAYFA">Anasayfa</a>&nbsp;
				<span>&gt;</span>
				</li>
				<li class="women">
				UYE OL
				</li>
			</ul>
			<ul class="previous">
				<li><a href="<?php echo URL?>">Geri dön</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<?php 
			if(isset($veri["bilgi"])):
				echo $veri["bilgi"];
			else:
		?>
		<h2>UYE KAYIT FORMU</h2>
		<div class="registration-grids">
			<?php 
				if(isset($veri["hata"])):
					echo "<div class='alert alert-danger mt-5'>";
					foreach($veri["hata"] as $value):
						echo ucfirst($value);
					endforeach;
					echo "</div>";
				endif;
			?>
			<div class="reg-form">
				<div class="reg">
					<p>Welcome, please enter the following details to continue.</p>
					<?php Form::_form(array("action" => URL."/uye/kayitKontrol", "method" => "POST")); ?>
						<ul>
							<li class="text-info">Adınız: </li>
							<li> <?php Form::input(array("type" => "text", "name" => "ad")); ?> </li>
						</ul>
						<ul>
							<li class="text-info">Soy Adınız: </li>
							<li> <?php Form::input(array("type" => "text", "name" => "soyad")); ?> </li>
						</ul>				 
						<ul>
							<li class="text-info">Mail Adresi: </li>
							<li> <?php Form::input(array("type" => "text", "name" => "email")); ?> </li>
						</ul>
						<ul>
							<li class="text-info">Şifre: </li>
							<li> <?php Form::input(array("type" => "password", "name" => "sifre")); ?> </li>
						</ul>
						<ul>
							<li class="text-info">Şifre Tekrar:</li>
							<li> <?php Form::input(array("type" => "password", "name" => "sifretekrar")); ?> </li>
						</ul>
						<ul>
							<li class="text-info">Telefon Numarası:</li>
							<li> <?php Form::input(array("type" => "text", "name" => "telefon")); ?> </li>
						</ul>	
						<!-- <ul>
							<li class="text-info">
								Güvenlik Kodu: 
								<img src="<?php echo $veri["kaynak"]; ?>" id="capt">
								<a onclick="_reload();" class="glyphicon glyphicon-refresh" id="reload"></a>
							</li>
							<li> <?php Form::input(array("type" => "text", "name" => "guvenlik")); ?> </li>
						</ul>						 -->
						<?php Form::input(array("type" => "submit", "value" => "Şimdi kayıt ol")); ?> 
						<p class="click">Üye olarak politikaları kabul etmiş olursunuz <a href="#">Fizlilik politikası</a></p> 
					</form>
				 </div>
			</div>
			<div class="reg-right">
				 <h3>Üyelik tamamen ücretsiz </h3>
				 <div class="strip"></div>
				 <p>Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio 
				 libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
				 <h3 class="lorem">Üyelik avantalları</h3>
				 <div class="strip"></div>
				 <p>Tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
    else:
        header("Location: ".URL);
    endif;
?>
<!-- registration-form -->
<?php require "views/footer.php"; ?>
