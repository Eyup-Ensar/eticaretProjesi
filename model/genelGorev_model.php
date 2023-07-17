<?php

    class genelGorev_model extends Model {

        function __construct () {

            parent:: __construct(); 

        }

        function listele ($tabload, $kosul) {

            return $this->db->Listele($tabload, $kosul);

        }

        function ekle($tabload, $sutunadlari, $veriler) {

            return $this->db->Ekle($tabload, $sutunadlari, $veriler);

        }

        function guncelle ($tabload, $sutunlar, $veri, $kosul) {

            return $this->db->GuncelSon($tabload, $sutunlar, $veri, $kosul); 
        
        }

        function sil ($tabload, $kosul) {

            return $this->db->Sil($tabload, $kosul);
            
        }

    }

?>