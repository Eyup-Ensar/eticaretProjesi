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
          <div class="col-12 text-left p-2 mb-2">
            <h1 class="h4 mb-0 mvc-renk baslik"> 
              <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000" class="baslikPanel" style="margin-top:-5px;">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM20 4v13.17L18.83 16H4V4h16zM6 12h12v2H6zm0-3h12v2H6zm0-3h12v2H6z"/>
              </svg>
              MÜŞTERİ YORUMLARI
            </h1> 
            <!-- MÜŞTERİ YPRUMLARI OLMASI LAZIM -->
          </div>
        </div>
        <!-- BAŞLIK --> 	
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        <div class="row arkaplan p-1 mt-2 pb-0">
          <div class="col-xl-2 col-lg-2 col-6 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Üye Adı</span> 
          </div>
          <div class="col-xl-2 col-lg-2 col-6 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Ürün adı</span> 
          </div>
          <div class="col-xl-5 col-lg-5 col-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Yorum</span> 
          </div>
          <div class="col-xl-1 col-lg-1 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Tarih</span> 
          </div>
          <div class="col-xl-1 col-lg-1 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span >Durum</span> 
          </div>
          <div class="col-xl-1 col-lg-1 col-4 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span >İşlem</span> 
          </div>
          <!--  ÜRÜNLER-->
          <?php for ($i=0; $i<count($veri["data"]); $i++) : ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0 mvc-renk arkaplanhover">
              <div class="row border border-light">
                <div class="col-lg-2 col-xl-2 col-6 kalinyap p-2">
                  <?php echo (isset($veri["yorum_uyead"]) ? $veri["yorum_uyead"][$i][0] : "") ?>
                </div>
                <div class="col-xl-2 col-lg-2 col-6  kalinyap p-2">
                  <?php echo (isset($veri["yorum_urunad"]) ? $veri["yorum_urunad"][$i][0] : "") ?>
                </div>
                <div class="col-xl-5 col-lg-5 col-4 col-12 kalinyap p-2"><?php echo $veri["data"][$i]["icerik"] ?></div>
                <div class="col-xl-1 col-lg-1 col-4 kalinyap p-2"><?php echo $veri["data"][$i]["tarih"] ?></div> 
                <div class="col-xl-1 col-lg-1 col-4 kalinyap p-2">
                  <?php echo $veri["data"][$i]["durum"]==1 ? '<span class="text-success">Onaylı</span>' : '<span class="text-danger">Onaysız</span>';?>
                </div>
                <div class="col-xl-1 col-lg-1 col-4 kalinyap p-2 text-right">
                  <div class="row" id="yorumAyarla">
                  <?php if($veri["data"][$i]["durum"]!=1) : ?> 
                    <div class="col-6 text-right">
                        <span style="cursor:pointer; font-size:16px" id="yorumOnayBtn" data-value="<?php echo $veri["data"][$i]["id"] ?>" class="mt-1" >
                          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="rgb(81, 173, 25)" id="checkIcon">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                          </svg>
                        </span>
                    </div>
                    <?php else: ?>
                    <div class="col-3"></div>
                    <?php endif; ?>
                    <div class="col-6 text-left">
                      <span style="cursor:pointer; font-size:20px" id="yorumSilBtn" data-value="<?php echo $veri["data"][$i]["id"] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ff5353"  id="deleteIcon">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                        </svg>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endfor; ?>
          <?php if(isset($veri["toplamveri"])) : ?>
            <div class="col-12 p-2 mt-2 toplamveri">
              <h6 class="mb-0 pt-1 ">Toplam yorum : <?php echo $veri["toplamveri"]; ?></h6>
            </div>
          <?php endif; ?>
        </div>
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
        <?php
          if (isset($veri["arama"])) :
            $link="/panel/uyeyorumlararama/".$veri["arama"]."/";
          else:
            $link="/panel/uyeyorumlar/";		 
          endif;
          Pagination::paginationNumaralar($veri["toplamsayfa"], $link);
		    ?>  
      <?php endif; ?>
    </div> 
  </div>  
  <!-- /.row bitiyor -->
</div>
<!-- /.container-fluid -->
     
<?php require 'views/YonPanel/footer.php'; ?>