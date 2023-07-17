<?php require 'views/header.php';  ?>

<?php if(isset($veri["siparisNo"]) && isset($veri["toplamTutar"]) && isset($veri["bankalar"])): ?>
<?php if (Session::get("kulad") && Session::get("uye")) : 
     Session::oturumKontrol("uye", Session::get("kulad"), Session::get("uye"));
?>
<div class="container" id="sipTamamlaİskelet" >
     <div class="row" id="tamamlandi">
          <div class="col-md-12">
               <h3 class="alert alert-success">TEŞEKKÜRLER Siparişiniz başarıyla oluşturulmuştur</h3>
               <p class="sipno">
                    Sipariş Numaranız : 
                    <?php echo $veri["siparisNo"]; ?>
                    <br />
                    Ödenecek Tutar : 
                    <?php echo number_format($veri["toplamTutar"],2,',','.').'₺'; ?>
               </p>
               <p>Siparişinizi numaranız ile takip edebilirsiniz. Siparişlerinizin kargoya verilebilmesi için aşağıda bulunan hesap numaralarımıza 3 (üç) iş günü içerisinde ödeme yapmanız ve açıklama kısmına sipariş numaranızı yazmanız gerekmektedir. Belirtilen süre içerisinde ödemesi yapılmayan siparişler sistem tarafından otomatik iptal edilecektir.</p>
          </div>
          <div class="col-md-12" id="bankalarinAnasi">
               <div class="row">
                    <?php foreach($veri["bankalar"] as $value): ?>
                         <div class="col-md-4" id="Bankcerceve">
                              <div class="row" >
                                   <div class="col-md-12" id="Bankbaslik"><?php echo $value["bankaAd"] ?></div>
                                   <div class="col-md-3">Hesap Adı</div> 
                                   <div class="col-md-9"><?php echo $value["hesapAd"] ?></div> 
                                   <div class="col-md-3">İBAN</div> 
                                   <div class="col-md-9"><?php echo $value["ibanNo"] ?></div>      
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </div>
</div>
<?php else: ?> <!-- Oturum kontrolü kontrolü -->
     <?php header("Location:".URL); ?>
<?php endif; ?>

<?php else: ?> <!-- Veriler geliyormu kontrolü -->
     <?php header("Location:".URL); ?>
<?php endif; ?>

<?php require 'views/footer.php'; ?> 		
        
        
        
       