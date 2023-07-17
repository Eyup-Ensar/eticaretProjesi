<?php

    class uye_model extends Model {

        function __construct () {

            parent:: __construct();

        }
        
        function giriskontrol ($tabload, $kosul) {

            return $this->db->GirisKontrol($tabload, $kosul);

        }
 
        function ekle ($tabload, $sutunadlari, $veriler) {

            return $this->db->Ekle($tabload, $sutunadlari, $veriler);

        }

        function listele ($tabload, $kosul) {

            return $this->db->Listele($tabload, $kosul);

        }

        function tabloSecListele ($getir, $tabload, $kosul) {

            return $this->db->TabloSecListele($getir, $tabload, $kosul); 
        
        }

        function sayfalama ($tabload, $kosul=false) {

            return $this->db->SayfalamaAdet($tabload, $kosul);

        }

        function sil ($tabload, $kosul) {

            return $this->db->Sil($tabload, $kosul);

        }
        
        function guncelle ($tabload, $sutunlar, $veri, $kosul) {

            return $this->db->GuncelSon($tabload, $sutunlar, $veri, $kosul); 
        
        }

        // * özel durum *

        function siparisTamamla ($veriler) {

            return $this->db->SiparisTamamla($veriler); 

        }

        function stokGuncelle ($veriler, $kosul) {

            return $this->db->StokGuncelle($veriler, $kosul); 

        }
        
        function topluIslemBaslat () {

            return $this->db->beginTransaction();

        }

        function topluIslemTamamla () {

            return $this->db->commit();

        }
 
    }

?>