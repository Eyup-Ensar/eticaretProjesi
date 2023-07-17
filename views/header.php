<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php $Harici = new HariciFonksiyonlar();?>

<!DOCTYPE html>
<html>
<head>
<title> <?php echo $Harici->title ?> </title>
<link href="<?php echo URL; ?>/views/design/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo URL; ?>/views/design/js/jquery.min.js"></script>
<script src="<?php echo URL; ?>/views/design/js/ripple.js"></script>
<link href="<?php echo URL; ?>/views/design/css/component.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo URL; ?>/views/design/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="descriıtion" content="<?php echo $Harici->sayfaAciklama ?>">
<meta name="keywords" content="<?php echo $Harici->anahtarKelime ?>">
<script type="text/javascript" src="<?php echo URL ?>/views/design/js/bizim.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } } </script>

<!--webfont-->
<!-- for bootstrap working -->
	<script type="text/javascript" src="<?php echo URL ?>/views/design/js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<!-- cart -->
	<script src="<?php echo URL; ?>/views/design/js/simpleCart.min.js"> </script>
<!-- cart -->
<link rel="stylesheet" href="<?php echo URL; ?>/views/design/css/flexslider.css" type="text/css" media="screen" />

<script type="text/javascript">
	function _reload () {
		img = document.getElementById("capt");
		var deger = $('#capt').attr('src');
		var parcala = deger.split('&');
		img.src = parcala[0] + "&" + Math.random();	
	}
</script>
</head>
<body>
	<!-- header-section-starts -->
	<div class="header">
		<div class="header-top-strip">
			<div class="container">
				<div class="header-top-left">
					<ul>
						<?php 
							if(Session::get("kulad") && Session::get("uye")): 
							Session::oturumKontrol("uye", Session::get("kulad"), Session::get("uye"));
						?>
							<li><a href="<?php echo URL?>/uye/panel"><span class="glyphicon glyphicon-user"> </span> HESABIM </a></li>
						<?php else: ?>
							<li><a href="<?php echo URL?>/uye/giris"><span class="glyphicon glyphicon-user"> </span> Giriş </a></li>
							<li><a href="<?php echo URL?>/uye/hesapOlustur"><span class="glyphicon glyphicon-lock"> </span>Hesap Oluştur</a></li>		
						<?php endif; ?>
					</ul>
				</div>
				<div class="header-right">
					<div class="cart box_1" id="sepetDurum">
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- header-section-ends -->
	<div class="banner-top">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
	    		<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>		
					<div class="logo">
						<h1><a href="<?php echo URL ?>/magaza"><span>E</span> -Ticaret</a></h1>
					</div>
	    		</div>
	    		<!--/.navbar-header-->
	    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        		<ul class="nav navbar-nav">
						<li><a href="<?php echo URL?>/magaza">Anasayfa</a></li>
						<?php $Harici->LinkleriGetir() ?>
						<li><a href="<?php echo URL ?>/sayfalar/iletisim">İletişim</a></li>
	        		</ul>
	    		</div>
	    		<!--/.navbar-collapse-->
			</nav>
			<!--/.navbar-->
		</div>
	</div>
</div>