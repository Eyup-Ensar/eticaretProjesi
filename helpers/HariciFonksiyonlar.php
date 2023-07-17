<?php

    /* BURADA SİTENİN TÜM AYARLARINI VE DİĞER FONKSİYONLARIMI BARINDIRIYOR */

    class HariciFonksiyonlar extends Model {
        
        public $sonuc, $title, $sayfaAciklama, $anahtarKelime, $sloganUst1, $sloganUst2, $sloganUst3, $sloganAlt1, $sloganAlt2, $sloganAlt3;
        
        public $encoksatan = [], $stoguazalan = [], $rastgelekategori = [];
        
        function __construct() {

            parent::__construct();

            $this->sonuc = $this->db->Listele("ayarlar");

            $this->title = $this->sonuc[0]["title"];

            $this->sayfaAciklama = $this->sonuc[0]["sayfaAciklama"];

            $this->anahtarKelime = $this->sonuc[0]["anahtarKelime"];

            $this->sloganUst1 = $this->sonuc[0]["sloganUst1"];

            $this->sloganUst2 = $this->sonuc[0]["sloganUst2"];

            $this->sloganUst3 = $this->sonuc[0]["sloganUst3"];

            $this->sloganAlt1 = $this->sonuc[0]["sloganAlt1"];

            $this->sloganAlt2 = $this->sonuc[0]["sloganAlt2"];

            $this->sloganAlt3 = $this->sonuc[0]["sloganAlt3"];

            $this->encoksatan = $this->db->listele("urunler");

            $this->encoksatan = $this->db->listele("urunler");

            $this->encoksatan = $this->db->listele("urunler", "order by satisadet desc LIMIT 8");

            $this->stoguazalan = $this->db->listele("urunler", "where stok < 200 order by stok asc LIMIT 8");

            $this->rastgelekategori = $this->db->listele("alt_kategori", "order by rand() LIMIT 8");

        }

        function seo($s) {
            $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
            $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','','-','');
            $s = str_replace($tr,$eng,$s);
            $s = strtolower($s);
            $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
            $s = preg_replace('/\s+/', '-', $s);
            $s = preg_replace('|-+|', '-', $s);
            $s = preg_replace('/#/', '', $s);
            $s = str_replace('.', '', $s);
            $s = trim($s, '-');
            return $s;
        }

        function LinkleriGetir() {
            
            $son = $this->db->prepare("select * from ana_kategori");

            $son->execute();
            
            while ($aktar=$son->fetch(PDO::FETCH_ASSOC)) :
            
                echo '<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$aktar["ad"].' <b class="caret"></b> </a> <ul class="dropdown-menu multi-column columns-3"> <div class="row">';
                
                $son2 = $this->db->prepare("select * from cocuk_kategori where ana_kat_id=".$aktar["id"]);
                
                $son2->execute();		
            
                while ($aktar2 = $son2->fetch(PDO::FETCH_ASSOC)) :
                
                    echo '<div class="col-sm-4"> <ul class="multi-column-dropdown"><h6>'.$aktar2["ad"].'</h6>';
                                        
                    $son3=$this->db->prepare("select * from alt_kategori where cocuk_kat_id=".$aktar2["id"]);

                    $son3->execute();		

                    while ($aktar3 = $son3->fetch(PDO::FETCH_ASSOC)) :			
                                                    
                        echo '<li> <a href="'.URL.'/urunler/kategori/'.$aktar3["id"].'/'.$this->seo($aktar3["ad"]).'">'.$aktar3["ad"].'</a></li>';			
                                            
                    endwhile;
                                    
                    echo'</ul> </div>';
                
                endwhile;
                
                echo'<div class="clearfix"></div> </div> </ul> </li>';
                
            endwhile;
            
        }

        function bulten () {
            ?>
            <div class="row">
                <div class="col-md-12" id="bulten">
                    <div class="join">
                        <h6>BÜLTENE KAYIT</h6>
                        <div class="sub-left-right">
                            <?php 
                            Form::_form(["id" => "bultenForm"]); 
                            Form::input(["type" => "text", "value" => "Mail Adresinizi Yazınız", "name" => "mailadres", "onfocus" => "this.value = '';", "onblur" => 'if (this.value == "") {this.value = "Mail Adresinizi Yazınız";}']); 
                            Form::input(["type" => "button", "value" => "KAYIT OL", "id" => "bultenBtn"]);  
                            echo "</form>";
                            ?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <?php
        }

        function urunCek ($id) {

            return $this->db->Listele("urunler", "where id=$id");

        }

        function yorumGetir ($dizi, $toplamveri, $toplamsayfa) {
            ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="alert alert-success" id="yorumSonuc"></div>
                    <?php echo count($dizi)>0 ? '<div class="alert alert-info">'.$toplamveri. " adet yorumunuz var</div>" : "<div class='alert alert-info'>Henüz hiçbir ürüne yorum yazmamışsınız.</div>";  ?> 
                    <?php if (count($dizi)>0): ?>
                        <table class="table">
                            <tbody>
                            <tr id="baslik">
                                <td>YORUMUNUZ</td>
                                <td>ÜRÜN</td>
                                <td>TARİH</td>
                                <td>DURUM</td>
                                <td>GÜNCELLE</td>
                                <td>SİL</td>
                            </tr>
                            <?php
                            foreach ($dizi as $deger) :	
                                $GelenUrun=$this->UrunCek($deger["urunid"]);
                                echo'<tr id="adresElemanlar">
                                    <td id="yorumtd'.$deger["id"].'"><span class="sp'.$deger["id"].'">'.$deger["icerik"].'</span></td>
                                    <td>'.$GelenUrun[0]["urunad"].'</td>
                                    <td>'.$deger["tarih"].'</td>
                                    <td>'; echo $deger["durum"]==1 ? "<span class='onaysiz'>Onaysız</span>" : "<span class='onayli'>Onaylı</span>"; 
                                    echo '<td id="anabuton"><input type="button" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" value="Güncelle"></td>
                                    <td><a onclick=urunSil("'.$deger["id"].'","yorumsil") class="btn btn-sm btn-danger">SİL</a></td>
                                </tr>';
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                        <?php if(isset($toplamsayfa)) : 
                            Pagination::paginationNumaralar($toplamsayfa, '/uye/yorumlarim/');
                            endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
 
        function adresGetir ($dizi, $toplamveri, $toplamsayfa) {
            ?>
            <div class="row">
                <div class="col-md-12 text-left" style="margin-bottom:4px;">
                    <a href="<?php echo URL."/uye/adresEkle"?>" class="bizimBtnA">Adres Ekle</a>
                </div>
                <div class="col-md-12 text-center">
                    <div class="alert alert-success" id="adresSonuc"></div>
                    <?php echo count($dizi)>0 ? '<div class="alert alert-info">'.$toplamveri. ' adet adresiniz kayıtlıdır</div>' : '<div class="alert alert-info">Kayıtlı adresiniz bulunmamaktadır.</div>'; ?> 
                </div> 
                <div class="col-md-12 text-center" style="margin-left:20px">
                    <?php 
                    foreach ($dizi as $deger) :	
                        echo 
                        '<div class="col-md-2 text-center" id="adresiskelet">
                            <div class="row">
                                <div class="col-md-12" class="asd" id="adresdiv'.$deger["id"].'"><span class="spA'.$deger["id"].'">'.$deger["adres"].'</span></div>
                                <br><br><br><br> 
                                <div class="col-md-6" id="adresbuton"><input type="button" id="AdresGuncelBtn" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" value="Güncelle"></div>
                                <div class="col-md-6"><a id="AdresSilBtn" onclick=urunSil("'.$deger["id"].'","adressil") class="btn btn-sm btn-danger">SİL</a></div><br><br>
                                <div class="col-md-12" id="varsayilanAdresBtn">';
                                echo $deger["varsayilan"]==0 ? 
                                '<input type="button" class="btn btn-sm btn-primary" data-value="'.$deger["id"].'" data-value2="'.$deger["uyeid"].'" value="Varsayılan Yap">' :
                                '<input type="submit" class="btn btn-sm btn-warning " value="Varsayılan Adres">';
                                echo '</div>
                            </div>
                        </div>';
                    endforeach;
                    ?>
                </div>
                <div class="col-md-12 text-center" style="margin-top:24px">
                <?php if(isset($toplamsayfa)) : 
                    Pagination::paginationNumaralar($toplamsayfa, '/uye/adreslerim/');
                    endif; ?>
                </div>
            </div>
            <?php        
        }

        function adresEkleGetir () {
            ?>
            <div class="alert alert-success text-center" id="adresEkleBilgiSonuc"></div> 
            <div class="row text-center">
                <div class="col-md-4"></div> 
                <div class="col-md-4 text-center" id="ortala">
                    <div class="row text-center" id="satirlar">
                        <?php Form::_form(["method" => "post", "id" => "adresEkleForm"]); ?>
                            <div class="col-md-12" id="satirlarbaslik">ADRES EKLEME</div>
                            <div class="col-md-12 text-info text-center" style="font-size:17px; padding:4px 0px;">Adreslerinizi Giriniz...</div>
                            <div class="col-md-12" style="padding:4px 4px;"><?php Form::textarea(["id" => "adres", "class" => "form-control"]) ?></div>
                            <div class="col-md-12">
                                <?php Form::input(["type" => "hidden", "value" => "".Session::get("uye").""]);
                                Form::input(["type" => "button", "id" => "adresBtn", "value" => "ADRES EKLE", "class" => "bizimBtn"]);?>
                            </div>
                        </form>
                    </div>	
                </div> 
                <div class="col-md-4"></div> 
            </div>
            <?php        
        }

        function hesapAyarlariGetir ($dizi) {
            ?>
            <div class="alert alert-success text-center" id="hesapbilgisonuc"></div> 
            <div class="row text-center">
                <div class="col-md-4"></div> 
                <div class="col-md-4 text-center" id="ortala">
                    <div class="row text-center" id="satirlar">
                        <?php Form::_form(["method" => "post", "id" => "hesapform"]); ?>
                            <div class="col-md-12" id="satirlarbaslik">HESAP AYARLARI</div>
                            <div class="col-md-5" ><label>Ad</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "text", "id" => "ad", "value" => "".$dizi['ad']."", "class" => "form-control"]) ?></div>
                            <div class="col-md-5"><label>Soyad</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "text", "id" => "soyad", "value" => "".$dizi['soyad']."", "class" => "form-control"]) ?></div>
                            <div class="col-md-5"><label>Mail adresiniz</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "text", "id" => "mail", "value" => "".$dizi['mail']."", "class" => "form-control"]) ?></div>
                            <div class="col-md-5"><label>Telefon</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "text", "id" => "telefon", "value" => "".$dizi['telefon']."", "class" => "form-control"]) ?></div>
                            <div class="col-md-12">
                                <?php Form::input(["type" => "hidden", "value" => "".$dizi['id'].""]);
                                Form::input(["type" => "button", "id" => "hesapbtn", "value" => "GÜNCELLE", "class" => "bizimBtn"]);?>
                            </div>
                        </form>
                    </div>	
                </div> 
                <div class="col-md-4"></div> 
            </div>
            <?php         
        }

        function sifreDegistirGetir ($dizi) {
            ?>
            <div class="alert alert-success text-center" id="SDsonuc"></div> 
            <div class="row text-center">
                <div class="col-md-4"></div> 
                <div class="col-md-4 text-center" id="ortala">
                    <div class="row text-center" id="satirlar">
                        <?php Form::_form(["method" => "post", "id" => "SDform"]); ?>
                            <div class="col-md-12" id="satirlarbaslik">ŞİFRE DEĞİŞTİR</div>
                            <div class="col-md-5" ><label>Mevcut Şifreniz</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "password", "id" => "mevcutsifre", "class" => "form-control"]) ?></div>
                            <div class="col-md-5"><label>Yeni Şifreniz</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "password", "id" => "yenisifre", "class" => "form-control"]) ?></div>
                            <div class="col-md-5"><label>Şifre (Tekrar)</label></div>
                            <div class="col-md-7"><?php Form::input(["type" => "password", "id" => "sifretekrar", "class" => "form-control"]) ?></div>
                            <div class="col-md-12">
                                <?php Form::input(["type" => "hidden", "value" => "".$dizi['id'].""]);
                                Form::input(["type" => "button", "id" => "hesapbtn", "value" => "DEĞİŞTİR", "class" => "bizimBtn"]);?>
                            </div>
                        </form>
                    </div>	
                </div> 
                <div class="col-md-4"></div> 
            </div>
            <?php         
        }

        function siparislerGetir($dizimiz) {
            $siparisnum=array();
            foreach ($dizimiz as $value) :	  
                $siparisnum[]=$value["siparis_no"];	  
            endforeach;	 
            $temizsiparisnumaralari=array_unique($siparisnum,SORT_STRING);
            foreach ($temizsiparisnumaralari as $value) :
                $siparisler=$this->db->listele("siparisler","where siparis_no=".$value);?>
                <div class="row arkaplan2  pb-0" >
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12  Uye_panel_siparisler">
                        <span>Sipariş No :</span> <span class="spantext"><?php echo $value; ?></span>
                    </div>                   
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 pt-3 Uye_panel_siparisler">
                        <span>Kargo Durumu :</span> 
                        <span class="spantext">
                            <?php switch ($siparisler[0]["kargodurum"]) :
                            case "0":
                                echo "Tedarik Sürecinde"; 
                            break;
                            case "1":
                                echo "Paketleniyor"; 
                            break;
                            case "2":
                                echo "Kargoya verildi"; 
                            break;
                            endswitch;?>
                        </span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 Uye_panel_siparisler">
                        <span>Ödeme Türü :</span> <span class="spantext"><?php echo $siparisler[0]["odemeturu"]; ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 Uye_panel_siparisler">
                        <span>Tarih :</span> <span class="spantext"><?php echo $siparisler[0]["tarih"]; ?></span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 Uye_panel_siparisler" id="detaygoster">
                        <a href="#" data-value="<?php echo $value; ?>" data-value2="<?php echo $siparisler[0]["adresid"]; ?>" data-toggle="modal" data-target="#exampleModalCenter" id="adres">Teslimat</a> |
                        <a href="#" data-value="<?php echo $value; ?>" id="iade">iade</a> 
                    </div>                                                 
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                        <div class="row p-5">                      
                            <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2 ">ÜRÜN ADI</div>
                            <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN ADET</div>
                            <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN FİYAT</div>
                            <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">TOPLAM FİYAT</div>
                        </div>
                        <?php $toplam=array();
                        for ($i=0; $i<count($siparisler); $i++):
                            echo '<div class="row border border-light">     
                                <div class="col-lg-3 urunler">'.$siparisler[$i]["urunad"].'</div>
                                <div class="col-lg-3 urunler">'.$siparisler[$i]["urunadet"].'</div>
                                <div class="col-lg-3 urunler">'.number_format($siparisler[$i]["urunfiyat"], 2, ',', '.').'</div>
                                <div class="col-lg-3 urunler">'.$siparisler[$i]["toplamfiyat"].'</div>             
                            </div> ';
                            $toplam[]=$siparisler[$i]["toplamfiyat"];		
                        endfor;?>
                        <div class="row"> 
                            <div class="col-lg-9 text-dark kalinyap p-2"></div>    
                            <div class="col-lg-2  siptoplam text-right p-2"><span>SİPARİŞ TOPLAMI :</span></div>  
                            <div class="col-lg-1  siptoplam text-left kalinyap p-2">
                            <span><?php echo number_format(array_sum($toplam), 2, ',', '.'); ?></span>
                            </div>        
                        </div>    
                        <div class="row">
                            <div class="col-12">
                                <div id="iadeIskelet"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        } 

        function uyebilgileri () { 

            return $this->db->Listele("uye", "where id=".Session::get("uye"));

        }

        function uyeadresleri () { 

            return $this->db->Listele("adresler", "where uyeid=".Session::get("uye"));

        }

    }

?>