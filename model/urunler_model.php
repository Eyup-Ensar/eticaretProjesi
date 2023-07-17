<?php

    class urunler_model extends Model {

        function __construct () {

            parent:: __construct(); 

        }

        function urunCek ($tabload, $kosul) {

            return $this->db->Listele($tabload, $kosul);

        }

        function tabloSecListele ($getir, $tabload, $kosul) {

            return $this->db->TabloSecListele($getir, $tabload, $kosul); 
        
        }

        function sayfalama ($tabload, $kosul=false) {

            return $this->db->SayfalamaAdet($tabload, $kosul);

        }

    }

?>