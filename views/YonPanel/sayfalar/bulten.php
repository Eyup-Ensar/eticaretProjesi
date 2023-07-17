<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-12 text-center"> 
            <?php if (isset($veri["bilgi"])) :
                    echo $veri["bilgi"];
            endif; ?>
            <?php if (isset($veri["data"])) : ?>
                <!-- BAŞLIK -->
                <div class="row text-left border-bottom-mvc mb-2">  
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 text-left">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7 col-md-4 col-sm-6 col-6 text-left p-1 mb-3">
                                <h1 class="h4 mb-0 mvc-renk baslik"> 
                                <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                                </svg>
                                BÜLTEN</h1>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-8 col-sm-6 col-6 p-1 text-center dropDownAlign">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dosya
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="about-us">
                                        <li><a href="<?php echo URL."/panel/bultenExcelAl" ?>" class="dropdown-item"><i class="fas fa-file-export text-danger pt-2"></i> Excel</a></li>
                                        <li><a href="<?php echo URL."/panel/bultenTxtAl" ?>" class="dropdown-item"><i class="fas fa-file-export text-danger pt-2"></i> Txt</a></li>
                                    </ul>
                                </div>
                            </div>      
                        </div>      
                    </div>  
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 mb-12 text-right">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-7 col-sm-7">
                               <?php Form::_form(array("action"=>URL."/panel/tarihMailGetir", "method"=>"POST"));  ?>
                                <div class="input-group">
                                    <?php 
                                        Form::input(array("type"=>"date", "name"=>"tar1", "class"=>"form-control"));
                                        Form::input(array("type"=>"date","name"=>"tar2","class"=>"form-control")); 
                                        
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
                            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 mailAramaMobile">
                                <?php Form::_form(array("action" => URL."/panel/mailArama", "method" => "POST")); ?>
                                <div class="input-group">
                                    <?php Form::input(array("type"=>"text","name"=>"ara","class"=>"form-control","placeholder"=>"Mail Adresi Yazın")); ?>
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
                    <div class="col-lg-12 col-12">
                        <?php if(isset($veri["bultenarama"]) || isset($veri["tarih1"]) && isset($veri["tarih2"])): ?> 
                            <div class="alert alert-success alert-dismissible fade show  mt-1 bultenAramaKriteri">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php if(isset($veri["bultenarama"])): ?> 
                                    Aranan Kelime : <strong> <?php echo $veri["bultenarama"] ?> </strong>
                                <?php elseif(isset($veri["tarih1"]) && isset($veri["tarih2"])): ?>
                                    <strong><?php echo $veri["tarih1"] ?></strong> Ve  <strong><?php echo $veri["tarih2"] ?> </strong> Arasındaki Mailler
                                <?php endif; ?>
                            </div>  
                        <?php endif; ?>
                    </div>
                </div>
                <!-- BAŞLIK --> 	
      	        <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
                <div class="row arkaplan p-1 mt-2 pb-0">
                    <div class="col-md-7 col-5 p-2 pt-3 geneltext bg-gradient-mvc text-right">
                        <span class="bultenBaslik">MAİLLER</span>
                    </div>
                    <div class="col-md-5 col-7 p-2 pt-2 geneltext bg-gradient-mvc text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-outline-dark btn-sm" id="bultenTumunuSifirlaBtn">Sıfırla</button> 
                            <button class="btn btn-outline-dark btn-sm" id="bultenTumunuSecBtn">Tümünü Seç</button> 
                            <button class="btn btn-outline-danger btn-sm" id="topluSilBtn">Toplu Sil</button> 
                        </div>
                    </div>
                    <!--  ÜRÜNLER-->
                    <?php
                        foreach ($veri["data"] as $value) : 
                            echo '
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mt-2 mailana">
                                <div class="row m-1 mailcerceve arkaplanhover">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-1">
                                       Mail: '.$value["mailadres"].'<br>Tarih: '.$value["tarih"].'
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">';
                                    ?>
                                        <?php Form::input(["type"=>"checkbox", "class"=>"btn bultenCheckbox", "value"=>$value["id"], "name"=>"silme"]) ?>
                                        <a onclick="silmedenSor('<?php echo URL.'/panel/mailSil/'.$value['id'] ?>'); return false">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon" class="m-2">
                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                                            </svg>
                                        </a>
                                    <?php 
                                    echo '</div>
                                </div>
                            </div>';
                        endforeach;
                    ?>
                    <div class="col-12 p-2 mt-2 toplamveri">
                        <h6 class="mb-0 pt-1 ">Toplam Mail : <?php echo $veri["toplamveri"]; ?></h6>
                    </div>
                </div>
      	        <!-- SİPARİŞİN İSKELETİ BİTİYOR -->
            <?php endif; ?>  
        </div>  
    </div> 
    <?php if(isset($veri["bultenarama"])) : 
          $link = '/panel/mailArama/'.$Harici->seo($veri["bultenarama"]).'/';
         elseif(isset($veri["tarih1"]) && isset($veri["tarih2"])):
          $link = '/panel/tarihMailGetir/'.$Harici->seo($veri["tarih1"]).'/'.$Harici->seo($veri["tarih2"]).'/';
         else:
          $link = '/panel/bulten/';
         endif;
         if(isset($veri["toplamsayfa"])) : 
          Pagination::paginationNumaralar($veri["toplamsayfa"], $link);
         endif; ?>
    <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->

<?php require 'views/YonPanel/footer.php'; ?>