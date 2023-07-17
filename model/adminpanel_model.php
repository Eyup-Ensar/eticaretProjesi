<?php

    class adminpanel_model extends Model {

        public $basliklar, $icerikler;

        function __construct () {

            parent:: __construct();

        }

        function veriAl ($tabload, $kosul=false) {

            return $this->db->Listele($tabload, $kosul);

        }

        function guncelle ($tabload, $sutunlar, $veri, $kosul) {

            return $this->db->GuncelSon($tabload, $sutunlar, $veri, $kosul); 
        
        }

        function arama ($tabload, $kosul) {

            return $this->db->Arama($tabload, $kosul); 
        
        }

        function gelismisArama ($getir, $tabload, $kosul) {

            return $this->db->GelismisArama($getir, $tabload, $kosul); 
        
        }

        function silme ($tabload, $kosul) {

            return $this->db->Sil($tabload, $kosul); 
        
        }

        function ekleme ($tabload, $sutunadlari, $veriler) {

            return $this->db->Ekle($tabload, $sutunadlari, $veriler);

        }

        function topluEkle ($tabload, $sutunadlari, $veriler) {

            return $this->db->TopluEkle($tabload, $sutunadlari, $veriler);

        }

        function topluGuncelle ($tabload, $sorgum) {

            return $this->db->TopluGuncelle($tabload, $sorgum);

        }
        
        function tabloSecListele ($getir, $tabload, $kosul) {

            return $this->db->TabloSecListele($getir, $tabload, $kosul);

        }

        function tabloBirlestirListele ($getir, $tabload1, $tabload2, $kosul) {

            return $this->db->TabloBirlestirListele($getir, $tabload1, $tabload2, $kosul);

        }

        function cokluBirlestirListele ($ekozellik=false, $sutungetir, $tabload, $kosul) {

            return $this->db->CokluBirlestirListele($ekozellik, $sutungetir, $tabload, $kosul);

        }
        
        function topluIslemBaslat () {

            return $this->db->beginTransaction();

        }

        function topluIslemTamamla () {

            return $this->db->commit();

        }

        function sistemBakim ($deger) {
             
            return $this->db->SistemBakim($deger);

        } 

        function veriTabaniYedekle ($deger) {
             
            return $this->db->VeriTabaniYedekle($deger);

        } 

        function sayfalama ($tabload, $kosul=false) {

            return $this->db->SayfalamaAdet($tabload, $kosul);

        }

        function excelAyarCek ($tabload, $bolum, $kosul=false) {

            switch ($bolum) {

                case 'bulten':

                    foreach($this->db->Listele($tabload, $kosul) as $degerler):

                        $this->icerikler[] = array($degerler["mailadres"]);
        
                    endforeach;

                break;

            }

            $icerikler = array();
            
        }

        function excelAyarCek2 ($getir, $tabload, $kosul) {
   
            $this->icerikler[] = $this->db->tabloSecListele($getir, $tabload, $kosul);

        }
 
    }

?>