<?php

    /* BURADA SİTENİN TÜM AYARLARINI VE DİĞER FONKSİYONLARIMI BARINDIRIYOR */

    class PanelHarici extends Model {

        public $sonuc, $siparisYonetim, $kategoriYonetim, $uyeYonetim, $urunYonetim, $muhasebeYonetim, $kullaniciYonetim, $bultenYonetim, $sifreDegistir, $sistemAyarlari, $sistemBakim, $yoneticiYetki, $oturumYetki, $ackapat;
        
        function __construct() {

            parent::__construct();

            $this->sonuc = $this->db->Listele("yonetim", "where id=".Session::get("AdminId"));

            $this->siparisYonetim = $this->sonuc[0]["siparisYonetim"];

            $this->kategoriYonetim = $this->sonuc[0]["kategoriYonetim"];

            $this->uyeYonetim = $this->sonuc[0]["uyeYonetim"];

            $this->urunYonetim = $this->sonuc[0]["urunYonetim"];

            $this->muhasebeYonetim = $this->sonuc[0]["muhasebeYonetim"];

            $this->kullaniciYonetim = $this->sonuc[0]["kullaniciYonetim"];

            $this->bultenYonetim = $this->sonuc[0]["bultenYonetim"];

            $this->sifreDegistir = $this->sonuc[0]["sifreDegistir"];

            $this->sistemAyarlari = $this->sonuc[0]["sistemAyarlari"];

            $this->sistemBakim = $this->sonuc[0]["sistemBakim"];

            $this->yoneticiYetki = $this->sonuc[0]["yetki"];

            $this->oturumYetki = $this->sonuc[0]["oturumYonetim"];


        }

        function MenuKontrol ($ackapat) {

            $url = $_SERVER['REQUEST_URI'];
            
            $dizi = explode("/", $url);

            $url = isset($dizi[3]) ? $dizi[3] : $dizi[2];

            if($this->siparisYonetim==1): ?>
                <li class="nav-item iconli<?php echo (strstr($url, "siparis") !== false || strstr($url, "panel") !== false) ? ' menuozellik' : ''; ?> arrowli">
                    <a class="nav-link<?php echo (strstr($url, "siparis") !== false) ? '' : ' collapsed'; ?>" href="#" data-toggle="collapse" onclick="arrowRotateControl(this)" data-target="#collapsesiparisler" aria-expanded="true" aria-controls="collapseTwo">
                        <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M16.625 17.625H27.792Q28.083 17.625 28.292 17.417Q28.5 17.208 28.5 16.917Q28.5 16.625 28.292 16.417Q28.083 16.208 27.792 16.208H16.625Q16.333 16.208 16.146 16.417Q15.958 16.625 15.958 16.917Q15.958 17.25 16.146 17.438Q16.333 17.625 16.625 17.625ZM16.625 22.25H21.875Q22.167 22.25 22.354 22.042Q22.542 21.833 22.542 21.542Q22.542 21.25 22.354 21.042Q22.167 20.833 21.875 20.833H16.625Q16.333 20.833 16.146 21.042Q15.958 21.25 15.958 21.542Q15.958 21.833 16.146 22.042Q16.333 22.25 16.625 22.25ZM16.625 13H27.792Q28.083 13 28.292 12.812Q28.5 12.625 28.5 12.292Q28.5 12 28.292 11.792Q28.083 11.583 27.792 11.583H16.625Q16.333 11.583 16.146 11.792Q15.958 12 15.958 12.333Q15.958 12.625 16.146 12.812Q16.333 13 16.625 13ZM12.75 28.833Q11.75 28.833 11.042 28.125Q10.333 27.417 10.333 26.417V7.417Q10.333 6.417 11.042 5.708Q11.75 5 12.75 5H31.75Q32.75 5 33.458 5.708Q34.167 6.417 34.167 7.417V26.417Q34.167 27.417 33.458 28.125Q32.75 28.833 31.75 28.833ZM12.75 27.417H31.75Q32.167 27.417 32.458 27.146Q32.75 26.875 32.75 26.417V7.417Q32.75 7 32.458 6.708Q32.167 6.417 31.75 6.417H12.75Q12.292 6.417 12.021 6.708Q11.75 7 11.75 7.417V26.417Q11.75 26.875 12.021 27.146Q12.292 27.417 12.75 27.417ZM8.25 33.333Q7.25 33.333 6.542 32.625Q5.833 31.917 5.833 30.917V11.208Q5.833 10.917 6.042 10.708Q6.25 10.5 6.542 10.5Q6.833 10.5 7.042 10.708Q7.25 10.917 7.25 11.208V30.917Q7.25 31.333 7.542 31.625Q7.833 31.917 8.25 31.917H27.958Q28.25 31.917 28.458 32.125Q28.667 32.333 28.667 32.625Q28.667 32.917 28.458 33.125Q28.25 33.333 27.958 33.333ZM11.75 6.417Q11.75 6.417 11.75 6.708Q11.75 7 11.75 7.417V26.417Q11.75 26.875 11.75 27.146Q11.75 27.417 11.75 27.417Q11.75 27.417 11.75 27.146Q11.75 26.875 11.75 26.417V7.417Q11.75 7 11.75 6.708Q11.75 6.417 11.75 6.417Z"/></svg>
                        <span class="mvc-text">Sipariş Yönetimi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 0 24 24" width="16px" fill="#777" style="margin-left: 23px; transition: 0.1s;"  class="arrow <?php echo $ackapat ? 'arrowDisplayNone' : '' ?><?php echo (strstr($url, "siparis") !== false) ? ' arrowRotate' : ''; ?>">
                            <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
                            <path d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z"/>
                        </svg>
                    </a>
                    <div id="collapsesiparisler" class="collapse<?php echo (strstr($url, "siparis") !== false) ? ' show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white collapse-inner" >
                            <a class="collapse-item<?php echo (strstr($url, "siparisler") !== false) ? ' menuozellik' : ''; ?>" href="<?php echo URL."/panel/siparisler";?>">Siparişler</a>
                            <a class="collapse-item<?php echo (strstr($url, "siparisDetayliArama") !== false) ? ' menuozellik' : ''; ?>"  href="<?php echo URL."/panel/siparisDetayliArama";?>">Detaylı Arama</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if($this->kategoriYonetim==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "kategori") !== false) ? 'menuozellik' : ''; ?>">
                    <a class="nav-link" href="<?php echo URL."/panel/kategoriler";  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M15.333 16.958Q14.625 16.958 14.271 16.333Q13.917 15.708 14.292 15.125L18.958 7.458Q19.292 6.875 20 6.875Q20.708 6.875 21.083 7.458L25.75 15.125Q26.125 15.708 25.75 16.333Q25.375 16.958 24.708 16.958ZM29.25 35.375Q26.625 35.375 24.875 33.604Q23.125 31.833 23.125 29.25Q23.125 26.625 24.875 24.875Q26.625 23.125 29.25 23.125Q31.833 23.125 33.604 24.875Q35.375 26.625 35.375 29.25Q35.375 31.833 33.604 33.604Q31.833 35.375 29.25 35.375ZM7.5 34.458Q6.958 34.458 6.625 34.125Q6.292 33.792 6.292 33.25V25.125Q6.292 24.625 6.646 24.271Q7 23.917 7.5 23.917H15.625Q16.167 23.917 16.5 24.271Q16.833 24.625 16.833 25.125V33.25Q16.833 33.792 16.479 34.125Q16.125 34.458 15.625 34.458ZM29.25 33.958Q31.208 33.958 32.583 32.583Q33.958 31.208 33.958 29.25Q33.958 27.25 32.583 25.896Q31.208 24.542 29.25 24.542Q27.25 24.542 25.896 25.896Q24.542 27.25 24.542 29.25Q24.542 31.208 25.896 32.583Q27.25 33.958 29.25 33.958ZM7.708 33.083H15.417V25.333H7.708ZM15.625 15.542H24.417L20 8.542ZM20 15.542ZM15.417 25.333ZM29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Q29.25 29.25 29.25 29.25Z"/></svg>
                    <span class="mvc-text">Kategori Yönetimi</span></a>
                </li>
            <?php endif; ?>

            <?php if($this->uyeYonetim==1): ?>
                <li class="nav-item iconli<?php echo (strstr($url, "uye") !== false) ? ' menuozellik' : ''; ?> arrowli" >
                    <a class="nav-link<?php echo (strstr($url, "uye") !== false) ? '' : ' collapsed'; ?>" href="#"  onclick="arrowRotateControl(this)" data-toggle="collapse" data-target="#collapseuyeler" aria-expanded="true" aria-controls="collapseTwo">
                        <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M5.5 31.042Q5 31.042 4.646 30.688Q4.292 30.333 4.292 29.792V28.5Q4.292 27.333 4.896 26.5Q5.5 25.667 6.583 25.167Q8.875 24.125 10.958 23.542Q13.042 22.958 15.958 22.958Q18.917 22.958 20.979 23.542Q23.042 24.125 25.375 25.167Q26.417 25.667 27.021 26.5Q27.625 27.333 27.625 28.5V29.792Q27.625 30.333 27.271 30.688Q26.917 31.042 26.417 31.042ZM30.167 31.042Q30.417 30.833 30.562 30.521Q30.708 30.208 30.708 29.792V28.542Q30.708 26.833 30.021 25.562Q29.333 24.292 28.167 23.417Q29.625 23.667 30.979 24.125Q32.333 24.583 33.417 25.125Q34.458 25.667 35.083 26.562Q35.708 27.458 35.708 28.542V29.792Q35.708 30.333 35.354 30.688Q35 31.042 34.5 31.042ZM15.958 18.958Q13.917 18.958 12.5 17.562Q11.083 16.167 11.083 14.083Q11.083 12 12.5 10.604Q13.917 9.208 15.958 9.208Q18.042 9.208 19.438 10.604Q20.833 12 20.833 14.083Q20.833 16.167 19.438 17.562Q18.042 18.958 15.958 18.958ZM27.542 14.083Q27.542 16.167 26.167 17.562Q24.792 18.958 22.708 18.958Q22.583 18.958 22.479 18.938Q22.375 18.917 22.25 18.917Q23.083 17.958 23.5 16.729Q23.917 15.5 23.917 14.083Q23.917 12.708 23.458 11.521Q23 10.333 22.25 9.292Q22.375 9.25 22.479 9.229Q22.583 9.208 22.708 9.208Q24.792 9.208 26.167 10.604Q27.542 12 27.542 14.083ZM5.708 29.625H26.208V28.5Q26.208 27.875 25.875 27.354Q25.542 26.833 24.708 26.417Q22.625 25.333 20.625 24.854Q18.625 24.375 15.958 24.375Q13.292 24.375 11.312 24.854Q9.333 25.333 7.208 26.417Q6.417 26.833 6.062 27.354Q5.708 27.875 5.708 28.5ZM15.958 17.542Q17.417 17.542 18.417 16.542Q19.417 15.542 19.417 14.083Q19.417 12.625 18.417 11.625Q17.417 10.625 15.958 10.625Q14.5 10.625 13.5 11.625Q12.5 12.625 12.5 14.083Q12.5 15.542 13.5 16.542Q14.5 17.542 15.958 17.542ZM15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083Q15.958 14.083 15.958 14.083ZM15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Q15.958 24.375 15.958 24.375Z"/></svg>
                        <span class="mvc-text">Üye Yönetimi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 0 24 24" width="16px" fill="#777" style="margin-left: 43px; transition: 0.1s;"  class="arrow <?php echo $ackapat ? 'arrowDisplayNone' : '' ?><?php echo (strstr($url, "uye") !== false) ? ' arrowRotate' : ''; ?>">
                            <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
                            <path d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z"/>
                        </svg>
                    </a>
                    <div id="collapseuyeler" class="collapse<?php echo (strstr($url, "uye") !== false) ? ' show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white collapse-inner" >
                            <a class="collapse-item<?php echo (strstr($url, "uyeyorumlar") === false && strstr($url, "uye") !== false) ? ' menuozellik' : ''; ?>" href="<?php echo URL."/panel/uyeler";  ?>">Üyeler</a>
                            <a class="collapse-item<?php echo (strstr($url, "uyeyorumlar") !== false) ? ' menuozellik' : ''; ?>" href="<?php echo URL."/panel/uyeyorumlar";  ?>">Müşteri yorumları</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if($this->urunYonetim==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "urun") !== false || strstr($url, "katgoregetir") !== false) ? 'menuozellik' : ''; ?>">
                    <a class="nav-link" href="<?php echo URL."/panel/urunler";  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M9.083 35Q8.083 35 7.375 34.271Q6.667 33.542 6.667 32.542V14.458Q6.083 14.375 5.542 13.688Q5 13 5 12.125V9.083Q5 8.083 5.708 7.375Q6.417 6.667 7.417 6.667H32.583Q33.583 6.667 34.292 7.375Q35 8.083 35 9.083V12.125Q35 13 34.458 13.688Q33.917 14.375 33.333 14.458V32.542Q33.333 33.542 32.625 34.271Q31.917 35 30.917 35ZM8.083 14.583V32.583Q8.083 33 8.375 33.292Q8.667 33.583 9.083 33.583H30.917Q31.333 33.583 31.625 33.292Q31.917 33 31.917 32.583V14.583ZM32.583 13.167Q33 13.167 33.292 12.875Q33.583 12.583 33.583 12.125V9.083Q33.583 8.667 33.292 8.375Q33 8.083 32.583 8.083H7.417Q7 8.083 6.708 8.375Q6.417 8.667 6.417 9.083V12.125Q6.417 12.583 6.708 12.875Q7 13.167 7.417 13.167ZM16.333 22H23.667Q23.958 22 24.167 21.792Q24.375 21.583 24.375 21.292Q24.375 21 24.167 20.792Q23.958 20.583 23.667 20.583H16.333Q16.042 20.583 15.833 20.792Q15.625 21 15.625 21.292Q15.625 21.625 15.833 21.812Q16.042 22 16.333 22ZM8.083 33.583Q8.083 33.583 8.083 33.292Q8.083 33 8.083 32.583V14.583V32.583Q8.083 33 8.083 33.292Q8.083 33.583 8.083 33.583Z"/></svg>
                    <span class="mvc-text">Ürün Yönetimi</span></a>
                </li>
            <?php endif; ?>

            <?php if($this->muhasebeYonetim==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "bankaBilgileri") !== false) ? 'menuozellik' : ''; ?> arrowli">
                    <a class="nav-link<?php echo (strstr($url, "bankaBilgileri") !== false) ? '' : ' collapsed'; ?>" href="#" data-toggle="collapse" onclick="arrowRotateControl(this)" data-target="#collapsemuhasebe" aria-expanded="true" aria-controls="collapseTwo">
                        <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M11.5 14.667H17.417Q17.708 14.667 17.896 14.458Q18.083 14.25 18.083 13.958Q18.083 13.667 17.896 13.479Q17.708 13.292 17.417 13.292H11.5Q11.208 13.292 11 13.5Q10.792 13.708 10.792 14Q10.792 14.292 11 14.479Q11.208 14.667 11.5 14.667ZM22.958 28.333H28.958Q29.25 28.333 29.438 28.146Q29.625 27.958 29.625 27.667Q29.625 27.375 29.438 27.188Q29.25 27 28.958 27H22.958Q22.667 27 22.479 27.167Q22.292 27.333 22.292 27.667Q22.292 27.958 22.479 28.146Q22.667 28.333 22.958 28.333ZM22.958 24.083H28.958Q29.25 24.083 29.438 23.875Q29.625 23.667 29.625 23.375Q29.625 23.083 29.438 22.896Q29.25 22.708 28.958 22.708H22.958Q22.667 22.708 22.479 22.917Q22.292 23.125 22.292 23.417Q22.292 23.708 22.479 23.896Q22.667 24.083 22.958 24.083ZM14.458 29.667Q14.75 29.667 14.938 29.458Q15.125 29.25 15.125 28.958V26.208H17.875Q18.167 26.208 18.354 26.021Q18.542 25.833 18.542 25.542Q18.542 25.25 18.354 25.062Q18.167 24.875 17.875 24.875H15.125V22.083Q15.125 21.792 14.917 21.604Q14.708 21.417 14.417 21.417Q14.125 21.417 13.938 21.604Q13.75 21.792 13.75 22.083V24.875H11Q10.708 24.875 10.521 25.062Q10.333 25.25 10.333 25.542Q10.333 25.833 10.521 26.021Q10.708 26.208 11 26.208H13.75V28.958Q13.75 29.25 13.958 29.458Q14.167 29.667 14.458 29.667ZM23.042 16.875Q23.292 17.083 23.542 17.083Q23.792 17.083 24 16.875L25.917 14.958L27.875 16.917Q28.042 17.083 28.312 17.083Q28.583 17.083 28.833 16.875Q29.042 16.625 29.042 16.354Q29.042 16.083 28.792 15.875L26.875 14L28.875 12Q29.042 11.833 29.042 11.583Q29.042 11.333 28.792 11.083Q28.583 10.875 28.312 10.875Q28.042 10.875 27.833 11.083L25.917 13L23.958 11.042Q23.792 10.833 23.542 10.854Q23.292 10.875 23.042 11.083Q22.792 11.333 22.792 11.583Q22.792 11.833 23.042 12.083L24.958 14L23 15.958Q22.792 16.125 22.792 16.375Q22.792 16.625 23.042 16.875ZM9.083 33.333Q8.083 33.333 7.375 32.625Q6.667 31.917 6.667 30.917V9.083Q6.667 8.083 7.375 7.375Q8.083 6.667 9.083 6.667H30.917Q31.917 6.667 32.625 7.375Q33.333 8.083 33.333 9.083V30.917Q33.333 31.917 32.625 32.625Q31.917 33.333 30.917 33.333ZM9.083 31.917H30.917Q31.292 31.917 31.604 31.604Q31.917 31.292 31.917 30.917V9.083Q31.917 8.708 31.604 8.396Q31.292 8.083 30.917 8.083H9.083Q8.708 8.083 8.396 8.396Q8.083 8.708 8.083 9.083V30.917Q8.083 31.292 8.396 31.604Q8.708 31.917 9.083 31.917ZM8.083 31.917Q8.083 31.917 8.083 31.604Q8.083 31.292 8.083 30.917V9.083Q8.083 8.708 8.083 8.396Q8.083 8.083 8.083 8.083Q8.083 8.083 8.083 8.396Q8.083 8.708 8.083 9.083V30.917Q8.083 31.292 8.083 31.604Q8.083 31.917 8.083 31.917Z"/></svg>
                        <span class="mvc-text">Muhasebe</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 0 24 24" width="16px" fill="#777" style="margin-left: 62px; transition: 0.1s;"  class="arrow <?php echo $ackapat ? 'arrowDisplayNone' : '' ?> <?php echo (strstr($url, "uye") !== false) ? ' arrowRotate' : ''; ?> <?php echo (strstr($url, "bankaBilgileri") !== false) ? ' arrowRotate' : ''; ?>">
                            <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
                            <path d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z"/>
                        </svg>
                    </a>
                    <div id="collapsemuhasebe" class="collapse<?php echo (strstr($url, "bankaBilgileri") !== false) ? ' show' : ''; ?>" onclick="arrowRotateNone(this)" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo (strstr($url, "bankaBilgileri") !== false) ? 'menuozellik' : ''; ?>" href="<?php echo URL."/panel/bankaBilgileri";  ?>">Banka bilgileri</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if($this->kullaniciYonetim==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "yonetici") !== false) ? 'menuozellik' : ''; ?>">
                    <a class="nav-link" href="<?php echo URL."/panel/yonetici";  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M16.667 18.917Q14.583 18.917 13.188 17.521Q11.792 16.125 11.792 14.042Q11.792 11.958 13.188 10.563Q14.583 9.167 16.667 9.167Q18.75 9.167 20.146 10.563Q21.542 11.958 21.542 14.042Q21.542 16.125 20.146 17.521Q18.75 18.917 16.667 18.917ZM6.25 30.958Q5.667 30.958 5.333 30.604Q5 30.25 5 29.75V28.458Q5 27.292 5.583 26.479Q6.167 25.667 7.25 25.125Q9.583 24.042 11.688 23.479Q13.792 22.917 16.667 22.917Q16.875 22.917 17.042 22.917Q17.208 22.917 17.375 22.875Q17.25 23.25 17.167 23.583Q17.083 23.917 17.042 24.292H16.667Q14 24.292 11.958 24.792Q9.917 25.292 7.917 26.375Q7.042 26.792 6.729 27.312Q6.417 27.833 6.417 28.458V29.583H17.125Q17.208 29.917 17.354 30.292Q17.5 30.667 17.708 30.958ZM16.667 17.5Q18.125 17.5 19.125 16.5Q20.125 15.5 20.125 14.042Q20.125 12.583 19.125 11.583Q18.125 10.583 16.667 10.583Q15.208 10.583 14.208 11.583Q13.208 12.583 13.208 14.042Q13.208 15.5 14.208 16.5Q15.208 17.5 16.667 17.5ZM16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042Q16.667 14.042 16.667 14.042ZM17.125 29.583Q17.125 29.583 17.125 29.583Q17.125 29.583 17.125 29.583Q17.125 29.583 17.125 29.583Q17.125 29.583 17.125 29.583Q17.125 29.583 17.125 29.583Q17.125 29.583 17.125 29.583ZM27.875 28.458Q29.125 28.458 30 27.562Q30.875 26.667 30.875 25.458Q30.875 24.167 30 23.292Q29.125 22.417 27.875 22.417Q26.625 22.417 25.75 23.292Q24.875 24.167 24.875 25.458Q24.875 26.708 25.75 27.583Q26.625 28.458 27.875 28.458ZM27.167 29.833Q26.375 29.667 25.688 29.292Q25 28.917 24.5 28.333L23.042 28.875Q22.875 28.917 22.729 28.854Q22.583 28.792 22.5 28.583L22.417 28.417Q22.292 28.292 22.333 28.125Q22.375 27.958 22.5 27.875L23.75 26.875Q23.5 26.25 23.5 25.438Q23.5 24.625 23.75 24L22.542 22.958Q22.417 22.833 22.375 22.667Q22.333 22.5 22.458 22.333L22.542 22.167Q22.625 22.042 22.771 21.979Q22.917 21.917 23.083 22L24.5 22.542Q24.958 21.917 25.667 21.542Q26.375 21.167 27.167 21.042L27.292 19.458Q27.375 19.292 27.5 19.167Q27.625 19.042 27.792 19.042H28Q28.208 19.042 28.333 19.146Q28.458 19.25 28.5 19.458L28.625 21.042Q29.375 21.167 30.104 21.542Q30.833 21.917 31.292 22.5L32.667 22Q32.875 21.917 33.021 22Q33.167 22.083 33.292 22.25L33.375 22.375Q33.458 22.542 33.417 22.688Q33.375 22.833 33.25 22.917L32.042 23.958Q32.292 24.667 32.292 25.458Q32.292 26.25 32.042 26.875L33.292 27.875Q33.458 27.958 33.438 28.146Q33.417 28.333 33.333 28.5L33.25 28.667Q33.167 28.792 33.021 28.854Q32.875 28.917 32.708 28.875L31.292 28.333Q30.792 28.917 30.083 29.292Q29.375 29.667 28.625 29.833L28.5 31.417Q28.458 31.583 28.333 31.708Q28.208 31.833 28 31.833H27.792Q27.625 31.833 27.5 31.708Q27.375 31.583 27.292 31.417Z"/></svg>
                    <span class="mvc-text">Kullanıcı Yönetimi</span></a>
                </li>
            <?php endif; ?>

            <?php if($this->bultenYonetim==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "bulten") !== false || strstr($url, "mail") !== false || strstr($url, "Mail") !== false) ? 'menuozellik' : ''; ?>">
                    <a class="nav-link" href="<?php echo URL."/panel/bulten";  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M7.417 31.667Q6.417 31.667 5.708 30.958Q5 30.25 5 29.25V10.75Q5 9.75 5.708 9.042Q6.417 8.333 7.417 8.333H32.583Q33.583 8.333 34.292 9.042Q35 9.75 35 10.75V29.25Q35 30.25 34.292 30.958Q33.583 31.667 32.583 31.667ZM33.583 10.875 20.708 19.458Q20.542 19.542 20.354 19.604Q20.167 19.667 20 19.667Q19.833 19.667 19.646 19.604Q19.458 19.542 19.333 19.458L6.417 10.875V29.25Q6.417 29.667 6.708 29.958Q7 30.25 7.417 30.25H32.583Q33 30.25 33.292 29.958Q33.583 29.667 33.583 29.25ZM20 18.292 33.042 9.75H7ZM6.417 10.875V11.208Q6.417 11.083 6.417 10.875Q6.417 10.667 6.417 10.458Q6.417 10.208 6.417 10.104Q6.417 10 6.417 10.167V9.75V10.167Q6.417 10 6.417 10.083Q6.417 10.167 6.417 10.417Q6.417 10.625 6.417 10.854Q6.417 11.083 6.417 11.208V10.875V29.25Q6.417 29.667 6.417 29.958Q6.417 30.25 6.417 30.25Q6.417 30.25 6.417 29.958Q6.417 29.667 6.417 29.25Z"/></svg>
                    <span class="mvc-text">Bülten Yönetimi</span></a>
                </li>
            <?php endif; ?>

            <?php if($this->sistemAyarlari==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "sistemAyar") !== false || strstr($url, "sistemBakim") !== false || strstr($url, "veriTabaniYedekle") !== false) ? 'menuozellik' : ''; ?> arrowli">
                    <a class="nav-link<?php echo (strstr($url, "sistemAyar") !== false || strstr($url, "sistemBakim") !== false || strstr($url, "veriTabaniYedekle") !== false) ? '' : ' collapsed'; ?>" href="#" data-toggle="collapse"  onclick="arrowRotateControl(this)" data-target="#collapsesistemayar" aria-expanded="true" aria-controls="collapseTwo">
                        <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M21.792 35H18.167Q17.75 35 17.396 34.708Q17.042 34.417 16.958 33.958L16.458 30.208Q15.583 29.958 14.542 29.375Q13.5 28.792 12.792 28.125L9.375 29.667Q8.917 29.833 8.479 29.688Q8.042 29.542 7.833 29.125L5.958 25.917Q5.75 25.5 5.854 25.062Q5.958 24.625 6.333 24.333L9.375 22.083Q9.292 21.583 9.229 21.042Q9.167 20.5 9.167 20.042Q9.167 19.583 9.229 19.062Q9.292 18.542 9.375 17.917L6.333 15.667Q5.958 15.375 5.854 14.938Q5.75 14.5 5.958 14.083L7.833 10.917Q8.083 10.542 8.5 10.375Q8.917 10.208 9.333 10.417L12.75 11.917Q13.583 11.208 14.562 10.646Q15.542 10.083 16.417 9.833L16.958 6.042Q17.042 5.583 17.396 5.292Q17.75 5 18.167 5H21.792Q22.25 5 22.604 5.292Q22.958 5.583 23.042 6.042L23.542 9.833Q24.542 10.208 25.417 10.688Q26.292 11.167 27.125 11.917L30.667 10.417Q31.083 10.208 31.521 10.354Q31.958 10.5 32.167 10.917L34.042 14.083Q34.25 14.5 34.167 14.938Q34.083 15.375 33.667 15.667L30.5 18Q30.667 18.542 30.688 19.042Q30.708 19.542 30.708 20Q30.708 20.417 30.667 20.917Q30.625 21.417 30.5 22.042L33.625 24.333Q34 24.583 34.104 25.042Q34.208 25.5 33.958 25.917L32.125 29.125Q31.875 29.542 31.438 29.688Q31 29.833 30.583 29.625L27.125 28.083Q26.292 28.792 25.396 29.354Q24.5 29.917 23.542 30.167L23.042 33.958Q22.958 34.417 22.604 34.708Q22.25 35 21.792 35ZM19.917 24.042Q21.625 24.042 22.792 22.875Q23.958 21.708 23.958 20Q23.958 18.292 22.792 17.125Q21.625 15.958 19.917 15.958Q18.25 15.958 17.062 17.125Q15.875 18.292 15.875 20Q15.875 21.708 17.062 22.875Q18.25 24.042 19.917 24.042ZM19.917 22.625Q18.833 22.625 18.062 21.854Q17.292 21.083 17.292 20Q17.292 18.917 18.062 18.146Q18.833 17.375 19.917 17.375Q21.042 17.375 21.792 18.146Q22.542 18.917 22.542 20Q22.542 21.083 21.792 21.854Q21.042 22.625 19.917 22.625ZM20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20Q20 20 20 20ZM18.292 33.583H21.667L22.292 29Q23.542 28.667 24.604 28.062Q25.667 27.458 26.75 26.417L30.958 28.25L32.625 25.375L28.917 22.583Q29.083 21.833 29.167 21.229Q29.25 20.625 29.25 20Q29.25 19.333 29.167 18.75Q29.083 18.167 28.917 17.458L32.708 14.625L31.042 11.75L26.708 13.583Q25.917 12.708 24.667 11.938Q23.417 11.167 22.25 11L21.708 6.417H18.292L17.75 10.958Q16.458 11.25 15.375 11.854Q14.292 12.458 13.208 13.542L8.958 11.75L7.292 14.625L11.042 17.375Q10.833 17.958 10.75 18.625Q10.667 19.292 10.667 20.042Q10.667 20.708 10.75 21.333Q10.833 21.958 11 22.583L7.292 25.375L8.958 28.25L13.208 26.458Q14.167 27.5 15.271 28.104Q16.375 28.708 17.75 29.042Z"/></svg>
                        <span class="mvc-text">Sistem Ayarları</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 0 24 24" width="16px" fill="#777" style="margin-left: 28px; transition: 0.1s;" class="arrow <?php echo $ackapat ? 'arrowDisplayNone' : '' ?> <?php echo  (strstr($url, "sistemAyar") !== false || strstr($url, "sistemBakim") !== false || strstr($url, "veriTabaniYedekle") !== false) ? ' arrowRotate' : ''; ?>">
                            <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
                            <path d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z"/>
                        </svg>
                    </a>
                    <div id="collapsesistemayar" class="collapse<?php echo (strstr($url, "sistemAyar") !== false || strstr($url, "sistemBakim") !== false || strstr($url, "veriTabaniYedekle") !== false) ? ' show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo (strstr($url, "sistemAyar") !== false) ? 'menuozellik' : ''; ?>" href="<?php echo URL."/panel/sistemAyar"; ?>">Ayarlar</a>
                            <a class="collapse-item <?php echo (strstr($url, "sistemBakim") !== false) ? 'menuozellik' : ''; ?>" href="<?php echo URL."/panel/sistemBakim";  ?>">Bakım</a>
                            <a class="collapse-item <?php echo (strstr($url, "veriTabaniYedekle") !== false) ? 'menuozellik' : ''; ?>" href="<?php echo URL."/panel/veriTabaniYedekle";  ?>">Yedek</a>
                            <a class="collapse-item <?php echo (strstr($url, "sifreDegistir") !== false) ? 'menuozellik' : ''; ?>" href="<?php echo URL."/panel/sifreDegistir";  ?>">Şifre Değiştir</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <?php if($this->oturumYetki==1): ?>
                <li class="nav-item iconli <?php echo (strstr($url, "cikis") !== false) ? 'menuozellik' : ''; ?> arrowli">
                    <a class="nav-link<?php echo (strstr($url, "cikis") !== false) ? '' : ' collapsed'; ?>" href="#" data-toggle="collapse"  onclick="arrowRotateControl(this)" data-target="#collapseoturum" aria-expanded="true" aria-controls="collapseTwo">
                        <svg xmlns="http://www.w3.org/2000/svg" height="27" width="27" viewBox="0 0 40 40" style="margin-right:10px;"><path d="M15.583 20.125H30.292L26.417 16.25L27.417 15.25L33 20.833L27.458 26.417L26.417 25.417L30.292 21.542H15.583ZM20.25 6.667V8.083H9.417Q9.042 8.083 8.729 8.396Q8.417 8.708 8.417 9.083V32.583Q8.417 32.958 8.729 33.271Q9.042 33.583 9.417 33.583H20.25V35H9.417Q8.417 35 7.708 34.292Q7 33.583 7 32.583V9.083Q7 8.083 7.708 7.375Q8.417 6.667 9.417 6.667Z"/></svg>
                        <span class="mvc-text">Oturum İşlemleri</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 0 24 24" width="16px" fill="#777" style="margin-left: 17px; transition: 0.1s;" class="arrow <?php echo $ackapat ? 'arrowDisplayNone' : '' ?> <?php echo  (strstr($url, "cikis") !== false) ? ' arrowRotate' : ''; ?>">
                            <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
                            <path d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z"/>
                        </svg>
                    </a>
                    <div id="collapseoturum" class="collapse<?php echo (strstr($url, "sistemAyar") !== false || strstr($url, "sistemBakim") !== false || strstr($url, "veriTabaniYedekle") !== false) ? ' show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo (strstr($url, "cikis") !== false) ? 'menuozellik' : ''; ?>" href="<?php echo URL."/panel/cikis" ?>" >Oturumu Kapat</a>
                        </div>
                    </div>
                </li>
            <?php endif; 
        }

        function yetkiBak ($alan) {

            if($this->$alan!=1):
                
                header("Location:".URL."/panel");

                exit();

            endif;

        }

        function listele ($tabload, $kosul) {

            return $this->db->Listele($tabload, $kosul);

        }

        function cokluBirlestirListele ($ekozellik="", $sutungetir, $tabload, $kosul) {

            return $this->db->CokluBirlestirListele($ekozellik, $sutungetir, $tabload, $kosul);

        }

        function icNavigasyon($analink,$anaisim,$bulununanyer) {
            echo '
            <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 navigasyonunanasi">
            <a href="'.URL.'/panel/'.$analink.'" class="navigasyon">'.$anaisim.'</a> / '.$bulununanyer."</div>";
        }

    }

?>