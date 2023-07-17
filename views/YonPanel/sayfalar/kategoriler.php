<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
    <!-- row başlıyor -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-12 text-center">
            <!-- header -->
            <?php if(isset($veri["bilgi"])): ?>
                <?php  echo $veri["bilgi"]; ?>
            <?php endif; ?>
            <!-- header -->
            <!-- kategori liseteleme başlıyor -->
            <?php if(isset($veri["anaKat"]) && isset($veri["cocukKat"]) && isset($veri["altKat"])): ?>
                <div class="row text-left border-bottom-mvc mb-2">
                    <div class="col-xl-5 col-lg-5 col-md-12 p-2">
                        <h1 class="h4 mvc-renk baslik"> 
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                        </svg>
                        KATEGORİ YÖNETİMİ </h1>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <?php Form::_form(["action" => "".URL."/panel/kategoriarama", "method"=>"post"]); ?>
                        <div class="input-group">
                            <?php 
                                Form::select(array("name" => "aramatercih", "class" => "form-control", "id"=>"aramaselect"));
                                    Form::option(array("value" => "ana"), array("Ana kategori"));   
                                    Form::option(array("value" => "cocuk"), array("Çocuk kategori"));   
                                    Form::option(array("value" => "alt"), array("Alt kategori"));   
                                Form::selectKapat();
                                Form::input(["type"=>"text", "class"=>"form-control", "name"=>"ara", "id"=>"inputAra", "placeholder"=>"Kategori ara"]); 
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
                <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
                <div class="row p-1 mt-2 pb-0" id="kategoriListele">
                    <!--******* ANA KATEGORİLER**************** -->
                    <div class="col-xl-4 col-lg-6 col-md-12 geneltext">
                        <div class="row arkaplan m-3 p-1 mx-auto">
                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 bg-white p-2" style="font-size:16px; padding-top:14px !important">ANA KATEGORİ</div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 bg-white p-2">
                                <a href="<?php echo URL."/panel/kategoriEkle/ana"?>">
                                <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 0 24 24" width="24px" fill="#1f71db" id="addIcon">
                                    <path d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                                </svg>
                                </a>
                            </div>
                            <!-- Eleman -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12  Kategoriarkaplan"><h6>Kategori Adı</h6></div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 Kategoriarkaplan"><h6>İşlemler</h6></div>
                                </div>
                            </div>
                            <!-- Eleman -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-white">
                            <?php
                                if(isset($veri["anaKat"])):
                                    foreach ($veri["anaKat"] as $value) :
                                    ?>
                                        <div class="row border-top border-light arkaplanhover">
                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12 p-2 mvc-renk"><?php echo $value["ad"] ?></div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="<?php echo URL.'/panel/kategoriGuncelle/ana/'.$value['id'];?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a onclick="silmedenSor('<?php echo URL.'/panel/kategoriSil/ana/'.$value['id']; ?>'); return false">
                                                            <svg height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                endif;
                            ?>
                            </div>
                            <!-- Eleman -->
                        </div>
                    </div>
                    <!--********ANA KATEGORİLER BİTTİ*************** -->
                    <!--*********ÇOCUK KATEGORİLER************** -->
                    <div class="col-xl-4 col-lg-6 col-md-12 geneltext">
                        <div class="row arkaplan m-3 p-1 mx-auto">
                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 bg-white p-2" style="font-size:16px; padding-top:14px !important">ÇOCUK KATEGORİ</div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 bg-white p-2">
                                <a href="<?php echo URL."/panel/kategoriEkle/cocuk"?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#1f71db" id="addIcon">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                                    </svg>
                                </a>
                            </div>
                            <!-- Eleman -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row kategorieleman">
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 Kategoriarkaplan"><h6>Kategori Adı</h6></div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 Kategoriarkaplan"><h6>İşlemler</h6></div>
                                </div>
                            </div>
                            <!-- Eleman -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-white">
                            <?php
                                if(isset($veri["cocukKat"])):
                                    foreach ($veri["cocukKat"] as $value) :
                                    ?>
                                        <div class="row border-top border-light arkaplanhover mt-2" style="line-height: 36px;">
                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 mvc-renk"><?php echo $value["ad"] ?></div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="<?php echo URL."/panel/kategoriGuncelle/cocuk/".$value['id']; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a onclick="silmedenSor('<?php echo URL.'/panel/kategoriSil/cocuk/'.$value['id']; ?>'); return false">
                                                            <svg height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                endif;
                            ?>
                            </div>
                            <!-- Eleman -->
                        </div>
                    </div>
                    <!--******ÇOCUK KATEGORİLER BİTTİ***************** -->
                    <!--*******ALT KATEGORİLER**************** -->
                    <div class="col-xl-4 col-lg-6 col-md-12 geneltext">
                        <div class="row arkaplan m-3 p-1 mx-auto">
                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 bg-white p-2" style="font-size:16px; padding-top:14px !important">ALT KATEGORİ</div>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 bg-white p-2 text-center">
                                <a href="<?php echo URL."/panel/kategoriEkle/alt"?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#1f71db" id="addIcon">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                                    </svg>
                                </a>
                            </div>
                            <!-- Eleman -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row kategorieleman">
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  Kategoriarkaplan"><h6>Kategori Adı</h6></div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 Kategoriarkaplan"><h6>İşlemler</h6></div>
                                </div>
                            </div>
                            <!-- Eleman -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-white">
                                <?php
                                if(isset($veri["altKat"])):
                                    foreach ($veri["altKat"] as $value) :
                                    ?>
                                        <div class="row border-top border-light arkaplanhover mt-2" style="line-height: 36px;">
                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 mvc-renk" ><?php echo $value["ad"] ?></div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 ">
                                                <div class="row avsds">
                                                    <div class="col-6">
                                                        <a href="<?php echo URL."/panel/kategoriGuncelle/alt/".$value['id']; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#51ad19"  id="updateIcon">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M12 6v1.79c0 .45.54.67.85.35l2.79-2.79c.2-.2.2-.51 0-.71l-2.79-2.79c-.31-.31-.85-.09-.85.36V4c-4.42 0-8 3.58-8 8 0 1.04.2 2.04.57 2.95.27.67 1.13.85 1.64.34.27-.27.38-.68.23-1.04C6.15 13.56 6 12.79 6 12c0-3.31 2.69-6 6-6zm5.79 2.71c-.27.27-.38.69-.23 1.04.28.7.44 1.46.44 2.25 0 3.31-2.69 6-6 6v-1.79c0-.45-.54-.67-.85-.35l-2.79 2.79c-.2.2-.2.51 0 .71l2.79 2.79c.31.31.85.09.85-.35V20c4.42 0 8-3.58 8-8 0-1.04-.2-2.04-.57-2.95-.27-.67-1.13-.85-1.64-.34z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a onclick="silmedenSor('<?php echo URL.'/panel/kategoriSil/alt/'.$value['id']; ?>'); return false">
                                                            <svg height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                                                            </svg>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                endif;
                            ?>
                            </div>
                            <!-- Eleman -->
                        </div>
                    </div>
                    <!--*******ALT KATEGORİLER BİTTİ**************** -->
                </div>
                <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
            <?php endif; ?>
            <!-- kategori liseteleme bitiyor -->
            <!-- kategori güncelleme başlıyor -->
            <?php if(isset($veri["kategoriguncelle"]) && isset($veri["anaKat"]) && isset($veri["cocukKat"])): ?>
                <?php if(!$_POST): ?>
                    <div class="row text-left border-bottom-mvc mb-2">
                        <div class="col-xl-4 col-md-4 mb-12 border-left-mvc text-left p-2">
                            <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> KATEGORİ GÜNCELLE </h1>
                        </div>
                    </div>
                    <?php $PanelHarici->icNavigasyon("kategoriler", "Kategoriler", "Kategori Güncelleme") ?>
                    <?php
                        $katAd;
                        $kontorl = count($veri["kategoriguncelle"][0])/2;
                        if($kontorl==2):
                            $katAd = "ana";
                        elseif($kontorl==3):
                            $katAd = "cocuk";
                        elseif($kontorl==4):
                            $katAd = "alt";
                        else:
                            $katAd = "hata";
                        endif;
                    ?>
                    <!--  ANA KATEGORİ FORMUN İSKELETİ-->
                    <?php if($katAd=="ana"): ?>
                        <div class="col-xl-12 col-md-12  text-center">
                            <div class="row text-center">
                                <div class="col-xl-4 col-md-6 mx-auto">
                                    <div class="row bg-gradient-beyazimsi">
                                        <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Kategori Güncelle</h4></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Kategori Adı</div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                        <?php
                                            Form::_form(array("action" => URL."/panel/kategoriGuncelleSon", "method" => "POST", "class" => "form"));
                                            Form::input(array("type" => "text", "name"=>"ad", "value" => $veri["kategoriguncelle"][0]["ad"], "class"=>"form-control"));
                                        ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                        <?php
                                            Form::input(array("type" => "hidden", "name"=>"id", "value" => $veri["kategoriguncelle"][0]["id"]));
                                            Form::input(array("type" => "hidden", "name"=>"katAd", "value" => "ana" ));
                                            Form::input(array("type" => "submit", "value" => "Güncelle", "class"=>"btn guncelbtn"));
                                            Form::formKapat();
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--  ANA KATEGORİ FORMUN İSKELETİ-->
                    <!-- ÇOCUK KATEGORİ FORMUN İSKELETİ-->
                    <?php if($katAd=="cocuk"): ?>
                        <div class="col-xl-12 col-md-12  text-center">
                            <div class="row text-center">
                                <div class="col-xl-4 col-md-6 mx-auto">
                                    <div class="row bg-gradient-beyazimsi">
                                        <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Kategori Güncelle</h4></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Kategori Adı</div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                            <?php
                                                Form::_form(array("action" => URL."/panel/kategoriGuncelleSon", "method" => "POST", "class" => "form"));
                                                Form::input(array("type" => "text", "name"=>"ad", "value" => $veri["kategoriguncelle"][0]["ad"], "class"=>"form-control"));
                                            ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Ana Kategori</div>
                                            <?php
                                                Form::select(array("name" => "anaKatId", "class" => "form-control"));
                                                foreach ($veri["anaKat"] as $value) {
                                                    Form::option(array("value" => $value["id"], $value["id"]==$veri["kategoriguncelle"][0]["ana_kat_id"] ? "selected" : null), array($value["ad"]));
                                                }
                                                Form::selectKapat();
                                            ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                                <?php
                                                    Form::input(array("type" => "hidden", "name"=>"id", "value" => $veri["kategoriguncelle"][0]["id"]));
                                                    Form::input(array("type" => "hidden", "name"=>"katAd", "value" => "cocuk" ));
                                                    Form::input(array("type" => "submit", "value" => "Güncelle", "class"=>"btn guncelbtn"));
                                                    Form::formKapat();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--  ÇOCUK KATEGORİ FORMUN İSKELETİ -->
                    <!-- ALT KATEGORİ FORMUN İSKELETİ-->
                    <?php if($katAd=="alt"): ?>
                        <div class="col-xl-12 col-md-12  text-center">
                            <div class="row text-center">
                                <div class="col-xl-4 col-md-6 mx-auto">
                                    <div class="row bg-gradient-beyazimsi">
                                        <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Kategori Güncelle</h4></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Kategori Adı</div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                        <?php
                                            Form::_form(array("action" => URL."/panel/kategoriGuncelleSon", "method" => "POST", "class" => "form"));
                                            Form::input(array("type" => "text", "name"=>"ad", "value" => $veri["kategoriguncelle"][0]["ad"], "class"=>"form-control"));
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Ana Kategori</div>
                                        <?php
                                            Form::select(array("name" => "anaKatId", "class" => "form-control"));
                                                foreach ($veri["anaKat"] as $value) {
                                                    Form::option(array("value" => $value["id"], $value["id"]==$veri["kategoriguncelle"][0]["ana_kat_id"] ? "selected" : null), array($value["ad"]));
                                                }
                                            Form::selectKapat();
                                        ?> <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Çocuk Kategori</div> <?php
                                            Form::select(array("name" => "cocukKatId", "class" => "form-control"));
                                                foreach ($veri["cocukKat"] as $value) {
                                                    Form::option(array("value" => $value["id"], $value["id"]==$veri["kategoriguncelle"][0]["cocuk_kat_id"] ? "selected" : null), array($value["ad"]));
                                                }
                                            Form::selectKapat();
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                        <?php
                                            Form::input(array("type" => "hidden", "name"=>"id", "value" => $veri["kategoriguncelle"][0]["id"]));
                                            Form::input(array("type" => "hidden", "name"=>"katAd", "value" => "alt" ));
                                            Form::input(array("type" => "submit", "value" => "Güncelle", "class"=>"btn guncelbtn"));
                                            Form::formKapat();
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endif; ?>
                    <!--  ALT KATEGORİ FORMUN İSKELETİ -->
                <?php else: ?>
                <?php endif; ?>
            <?php endif; ?>
            <!-- kategori güncelleme bitiyor -->
            <!-- kategori ekleme başlıyor -->
            <?php if(isset($veri["kriter"]) && isset($veri["ana_kat"]) && isset($veri["cocuk_kat"])): ?>
                <!--  ANA KATEGORİ FORMUN İSKELETİ-->
                <div class="row text-left border-bottom-mvc mb-2">
                    <div class="col-xl-4 col-md-4 mb-12 border-left-mvc text-left p-2">
                        <h1 class="h4 mb-0 mvc-renk"> <img src="<?php echo URL."/views/YonPanel/img/panel.svg" ?>" style="margin-top:-5px;"> KATEGORİ EKLE </h1>
                    </div>
                </div>
                <?php $PanelHarici->icNavigasyon("kategoriler", "Kategoriler", "Kategori Ekleme") ?>
                <?php if($veri["kriter"]=="ana"): ?>
                    <div class="col-xl-12 col-md-12  text-center">
                        <div class="row text-center">
                            <div class="col-xl-4 col-md-6 mx-auto">
                                <div class="row bg-gradient-beyazimsi">
                                    <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Kategori Ekle</h4></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Kategori Adı</div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                    <?php
                                        Form::_form(array("action" => URL."/panel/kategoriEkleSon", "method" => "POST", "class" => "form"));
                                        Form::input(array("type" => "text", "name"=>"ad", "class"=>"form-control"));
                                    ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                    <?php
                                        Form::input(array("type" => "hidden", "name"=>"katAd", "value" => "ana" ));
                                        Form::input(array("type" => "submit", "value" => "Ekle", "class"=>"btn btn-primary pl-3 pr-3"));
                                        Form::formKapat();
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!--  ANA KATEGORİ FORMUN İSKELETİ-->
                <!-- ÇOCUK KATEGORİ FORMUN İSKELETİ-->
                <?php if($veri["kriter"]=="cocuk"): ?>
                    <div class="col-xl-12 col-md-12  text-center">
                        <div class="row text-center">
                            <div class="col-xl-4 col-md-6 mx-auto">
                                <div class="row bg-gradient-beyazimsi">
                                    <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Kategori Ekle</h4></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Kategori Adı</div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                        <?php
                                            Form::_form(array("action" => URL."/panel/kategoriEkleSon", "method" => "POST", "class" => "form"));
                                            Form::input(array("type" => "text", "name"=>"ad", "class"=>"form-control"));
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Ana Kategori</div>
                                        <?php
                                            Form::select(array("name" => "anaKatId", "class" => "form-control"));
                                            foreach ($veri["ana_kat"] as $value) {
                                                Form::option(array("value" => $value["id"]), array($value["ad"]));
                                            }
                                            Form::selectKapat();
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                            <?php
                                                Form::input(array("type" => "hidden", "name"=>"katAd", "value" => "cocuk" ));
                                                Form::input(array("type" => "submit", "value" => "Ekle", "class"=>"btn btn-primary pl-3 pr-3"));
                                                Form::formKapat();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!--  ÇOCUK KATEGORİ FORMUN İSKELETİ -->
                <!-- ALT KATEGORİ FORMUN İSKELETİ-->
                <?php if($veri["kriter"]=="alt"): ?>
                    <div class="col-xl-12 col-md-12  text-center">
                        <div class="row text-center">
                            <div class="col-xl-4 col-md-6 mx-auto">
                                <div class="row bg-gradient-beyazimsi">
                                    <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 mvc-black"><h4>Kategori Ekle</h4></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Kategori Adı</div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                        <?php
                                            Form::_form(array("action" => URL."/panel/kategoriEkleSon", "method" => "POST", "class" => "form"));
                                            Form::input(array("type" => "text", "name"=>"ad", "class"=>"form-control"));
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Ana Kategori</div>
                                        <?php
                                            Form::select(array("name" => "anaKatId", "class" => "form-control"));
                                                foreach ($veri["ana_kat"] as $value) {
                                                    Form::option(array("value" => $value["id"]), array($value["ad"]));
                                                }
                                            Form::selectKapat();
                                        ?> 
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman mvc-renk">Çocuk Kategori</div> 
                                        <?php
                                            Form::select(array("name" => "cocukKatId", "class" => "form-control"));
                                                foreach ($veri["cocuk_kat"] as $value) {
                                                    Form::option(array("value" => $value["id"]), array($value["ad"]));
                                                }
                                            Form::selectKapat();
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                                            <?php
                                                Form::input(array("type" => "hidden", "name"=>"katAd", "value" => "alt" ));
                                                Form::input(array("type" => "submit", "value" => "Ekle", "class"=>"btn btn-primary pl-3 pr-3"));
                                                Form::formKapat();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!--  ALT KATEGORİ FORMUN İSKELETİ -->
            <?php endif; ?>
            <!-- kategori ekleme bitiyor -->
            <!-- kategori arama başlıyor -->
            <?php if(isset($veri["kategoriarama"]) && isset($veri["kelime"])): ?>
                <?php
                    $katAd;
                    $kontorl = count($veri["kategoriarama"][0])/2;
                    if($kontorl==2):
                        $katAd = "ana";
                    elseif($kontorl==3):
                        $katAd = "cocuk";
                    elseif($kontorl==4):
                        $katAd = "alt";
                    else:
                        $katAd = "hata";
                    endif;
                ?>
                <div class="row text-left border-bottom-mvc mb-2">
                    <div class="col-xl-5 col-lg-5 col-md-12 p-2">
                        <h1 class="h4 mvc-renk baslik"> 
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                        </svg>
                        KATEGORİ YÖNETİMİ </h1>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="row">
                           <div class="col-xl-12">
                                <?php Form::_form(["action" => "".URL."/panel/kategoriarama", "method"=>"post"]); ?>
                                <div class="input-group">
                                    <?php 
                                        Form::select(array("name" => "aramatercih", "class" => "form-control", "id"=>"aramaselect"));
                                            Form::option(array("value" => "ana"), array("Ana kategori"));   
                                            Form::option(array("value" => "cocuk"), array("Çocuk kategori"));   
                                            Form::option(array("value" => "alt"), array("Alt kategori"));   
                                        Form::selectKapat();
                                        Form::input(["type"=>"text", "class"=>"form-control", "name"=>"ara", "id"=>"inputAra", "placeholder"=>"Kategori ara"]); 
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
                    </div>    
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext "></div>
                    <!--  ANA KATEGORİ FORMUN İSKELETİ-->
                    <?php if($katAd=="ana"): ?>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
                            <div class="row  m-2 p-2  ">
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 pt-3 bg-gradient-mvc">ARAMA SONUCU - <span class="text-warning">KELİME : <?php echo $veri["kelime"] ?></span></div>
                                <!-- Eleman -->
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row kategorieleman">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
                                    </div>
                                </div>
                                <!-- Eleman -->
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <?php
                                    if(isset($veri["kategoriarama"])):
                                        foreach ($veri["kategoriarama"] as $value) :
                                        ?>
                                            <div class="row kategorieleman">
                                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-3 yescizgi"><?php echo $value["ad"] ?></div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right">
                                                            <a href="<?php echo URL."/panel/kategoriGuncelle/ana/".$value['id'];?>" class="mt-2 p-1 guncelbuton"></a>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left">
                                                            <a href="<?php echo URL."/panel/kategoriSil/ana/".$value['id'];?>" class="mt-1 p-1 silbuton"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                    endif;
                                ?>
                                </div>
                                <!-- Eleman -->
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--  ANA KATEGORİ FORMUN İSKELETİ-->
                    <!--  ÇOCUK KATEGORİ FORMUN İSKELETİ-->
                    <?php if($katAd=="cocuk"): ?>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
                            <div class="row  m-2 p-2  ">
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 pt-3 bg-gradient-mvc">ARAMA SONUCU - <span class="text-warning">KELİME : <?php echo $veri["kelime"] ?></span></div>
                                <!-- Eleman -->
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row kategorieleman">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
                                    </div>
                                </div>
                                <!-- Eleman -->
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <?php
                                    if(isset($veri["kategoriarama"])):
                                        for ($i=0; $i<count($veri["kategoriarama"]); $i++):
                                        ?>
                                            <div class="row kategorieleman">
                                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  pt-3 yescizgi"><?php echo isset($veri["cocuk_anaKat"][$i][0]) ? $veri["cocuk_anaKat"][$i][0]."-".$veri["kategoriarama"][$i]["ad"] : $veri["kategoriarama"][$i]["ad"] ?></div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  ">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right">
                                                            <a href="<?php echo URL."/panel/kategoriGuncelle/cocuk/".$veri["kategoriarama"][$i]["id"];?>" class="fas fa-sync mt-2 p-1 guncelbuton"></a>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left">
                                                            <a href="<?php echo URL."/panel/kategoriSil/cocuk/".$veri["kategoriarama"][$i]["id"];?>" class="fas fa-times mt-1 p-1   silbuton"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endfor;
                                    endif;
                                ?>
                                </div>
                                <!-- Eleman -->
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--  ÇOCUK KATEGORİ FORMUN İSKELETİ-->
                    <!--  ALT KATEGORİ FORMUN İSKELETİ-->
                    <?php if($katAd=="alt"): ?>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
                            <div class="row  m-2 p-2  ">
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 pt-3 bg-gradient-mvc">ARAMA SONUCU - <span class="text-warning">KELİME : <?php echo $veri["kelime"] ?></span></div>
                                <!-- Eleman -->
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row kategorieleman">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
                                    </div>
                                </div>
                                <!-- Eleman -->
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <?php
                                    if(isset($veri["kategoriarama"])):
                                        for ($i=0; $i<count($veri["kategoriarama"]); $i++):
                                            ?>
                                                <div class="row kategorieleman">
                                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  pt-3 yescizgi"><?php echo (isset($veri["alt_anaKat"][$i][0]) && isset($veri["alt_cocukKat"][$i][0])) ? $veri["alt_anaKat"][$i][0]."-".$veri["alt_cocukKat"][$i][0]."-".$veri["kategoriarama"][$i]["ad"] : $veri["kategoriarama"][$i]["ad"] ?></div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  ">
                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right">
                                                                <a href="<?php echo URL."/panel/kategoriGuncelle/alt/".$veri["kategoriarama"][$i]["id"];?>" class="fas fa-sync mt-2 p-1 guncelbuton"></a>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left">
                                                                <a href="<?php echo URL."/panel/kategoriSil/alt/".$veri["kategoriarama"][$i]["id"];?>" class="fas fa-times mt-1 p-1   silbuton"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        endfor;
                                    endif;
                                ?>
                                </div>
                                <!-- Eleman -->
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--  ALT KATEGORİ FORMUN İSKELETİ-->
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext "></div>
                </div>
            <?php endif; ?>
            <!-- kategori arama bitiyor -->
        </div> 
    </div>
    <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->

<?php require 'views/YonPanel/footer.php'; ?>