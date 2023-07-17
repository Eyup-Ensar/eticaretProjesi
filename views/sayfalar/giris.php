<?php require "views/header.php"; ?>

    <!-- content-section-starts -->
<?php if(!Session::get("kulad") || !Session::get("uye")): 
    Session::oturumKontrol("uye", Session::get("kulad"), Session::get("uye"));
?>        
<div class="content">
    <div class="container">
        <div class="login-page">
            <div class="dreamcrub">
            <ul class="breadcrumbs">
                <li class="home">
                <a href="<?php echo URL ?>" title="ANASAYFA">Anasayfa</a>&nbsp;
                <span>&gt;</span>
                </li>
                <li class="women">
                Login
                </li>
            </ul>
            <ul class="previous">
                <li><a href="<?php echo URL?>">Geri dön</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="account_grid">
        <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
            <h2>HEMEN ÜYE OL</h2>
            <p>Yeni üye olarak avantajları yakalayabilirsin</p>
            <a class="acount-btn" href="<?php echo URL?>/uye/hesapOlustur">Hesap Oluştur</a>
        </div>
        <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
            <h3>ÜYE GİRİŞİ</h3>
            <p>Üye girişi yapın</p>
            <?php Form::_form(["action"=>"".URL."/uye/giriskontrol", "method"=>"post"]) ?>
				<div>
                    <span>Kullanıcı Adı<label>*</label></span>
					<?php Form::input(["type"=>"text", "name"=>"ad"]) ?>
                    <?php Form::input(array("type"=>"hidden","name"=>"girisTipi","value"=>"uyeGirisi")); ?>
				</div>
				<div>
                    <span>Şifre<label>*</label></span>
					<?php Form::input(["type"=>"password", "name"=>"sifre"]) ?> 
				</div>
                <?php if(isset($veri["bilgi"])): ?> 
                    <?php 
                        if(is_array($veri["bilgi"])):
                            foreach($veri["bilgi"] as $value):
                                echo $value."<br>";
                            endforeach;
                        else:
                            echo $veri["bilgi"];
                        endif; 
                    ?>
                <?php endif; ?>
                <a class="forgot" href="#">Şifremi Unuttum?</a>
                <?php Form::input(["type"=>"submit", "value"=>"Giriş"]) ?> 
            </form>
        </div>	
        <div class="clearfix"> </div>
        </div>
    </div>
</div>

<?php
    else:
        header("Location: ".URL);
    endif;
?>

<?php require "views/footer.php"; ?>
