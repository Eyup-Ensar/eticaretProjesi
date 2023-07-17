<?php

    class Cookie {

        public static function SepeteEkle ($id, $adet) {
            
            setcookie('urun['.$id.']', $adet, time() + 60*60*24, "/");

            if(array_key_exists($id, $_COOKIE["urun"])):

                $adetal = $_COOKIE['urun'][$id];
    
                $sonadet = $adetal + $adet;

                setcookie('urun['.$id.']', $sonadet, time() + 60*60*24, "/");

            endif;

        }

        public static function UrunSil ($id) {

            if(isset($_COOKIE['urun'])):

                setcookie('urun['.$id.']', false, time() - 2, "/");

            endif;
            
        }

        public static function UrunGuncelle ($id, $adet) {

            if(isset($_COOKIE['urun'])):

                setcookie('urun['.$id.']', $adet, time() + 60*60*24, "/");

            endif;
            
        }

        public static function SepetiBosalt () {

            if(isset($_COOKIE['urun'])):

                foreach($_COOKIE['urun'] as $id => $adet):

                    setcookie('urun['.$id.']', $adet, time() - 2, "/"); 

                endforeach;

            endif;

            if(!isset($_COOKIE['urun'])):

                return true;

            endif;
        }

    }

?>