<?php 

    class urunler extends Controller {

        function __construct () {

            parent:: libsInclude(array("view", "bilgi", "pagination"));

            Session::init();

            $this->ModelYukle("urunler");
 
        }

        function detay ($id, $veri) {

            $sonuc = $this->model->urunCek("urunler", "where id=".$id);

            if(isset($sonuc[0]["katid"])):

                $this->view->goster("sayfalar/urundetay", 
                array(
                    'data1' => $sonuc,
                    'data2' => $this->model->urunCek("urunler", "where katid=".$sonuc[0]["katid"]." and id!=".$id." and stok < 200 order by stok asc LIMIT 10"),
                    'data3' => $this->model->urunCek("urunler", "where katid=".$sonuc[0]["katid"]." and id<>".$id." LIMIT 3"),
                    'data4' => $this->model->urunCek("yorumlar", "where urunid=".$id." and durum=1")
                ));
            
            else:

                $this->bilgi->direktYonlen("/");

            endif;

        }

        function kategori ($id, $ad, $mevcutsayfa=false) {

            $sonuc = $this->model->urunCek("urunler", "where katid=".$id);

            $cocukKatBul = $this->model->urunCek("alt_kategori", "where id=".$id);

            $adet = $this->model->tabloSecListele("urunlerGoruntuAdet", "ayarlar", false);

            $this->pagination->paginationOlustur(count($sonuc), $mevcutsayfa, $adet[0][0]);

            if(count($sonuc)>0 && count($cocukKatBul)>0):

                $this->view->goster("sayfalar/kategori", 
                array(
                    'data1' => $this->model->urunCek("urunler", "where katid=".$id." LIMIT ".$this->pagination->limit.", ".$this->pagination->gosterilecekadet),
                    'data2' => $this->model->urunCek("alt_kategori", "where cocuk_kat_id=".$cocukKatBul[0]["cocuk_kat_id"]." and id!=".$id." LIMIT 10"),
                    'data3' => $this->model->urunCek("urunler", "where katid=".$id." and durum=1"),
                    'data4' => $this->model->urunCek("urunler", "where katid=".$id." and durum=2"),
                    "toplamsayfa" => [$this->pagination->toplamsayfa, $id, $ad],
                    "toplamveri" => count($sonuc)
                ));
            
            else:

                $this->bilgi->direktYonlen("/");

            endif;

        }

    }

?>