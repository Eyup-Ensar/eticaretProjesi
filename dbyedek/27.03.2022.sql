SET NAMES utf8;DROP TABLE IF EXISTS 'adresler';

CREATE TABLE `adresler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uyeid` int(11) NOT NULL,
  `adres` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `varsayilan` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO adresler VALUES("10", "46", "istanbul / kadiköy", "0");
INSERT INTO adresler VALUES("9", "46", "istanbul / üsküdar", "0");
INSERT INTO adresler VALUES("27", "46", "istanbul / esenler", "1");
INSERT INTO adresler VALUES("12", "46", "istanbul / küçükçekmece", "0");
INSERT INTO adresler VALUES("17", "46", "İstanbul / Esenevler", "0");
INSERT INTO adresler VALUES("16", "48", "İstanbul / Zeytinburnu", "1");
INSERT INTO adresler VALUES("26", "46", "istanbul / topkapı sarayı", "0");
INSERT INTO adresler VALUES("19", "47", "Sivas / Suşehri", "0");
INSERT INTO adresler VALUES("21", "47", "İstanbul / Beylerbeyi", "1");
INSERT INTO adresler VALUES("24", "47", "asdasdasdas", "0");
INSERT INTO adresler VALUES("29", "46", "istanbul / yeşilköy", "0");



DROP TABLE IF EXISTS 'alt_kategori';

CREATE TABLE `alt_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cocuk_kat_id` int(11) NOT NULL,
  `ana_kat_id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO alt_kategori VALUES("1", "1", "1", "Tişört");
INSERT INTO alt_kategori VALUES("2", "1", "1", "Pantolon");
INSERT INTO alt_kategori VALUES("3", "1", "1", "Ceket");
INSERT INTO alt_kategori VALUES("4", "1", "1", "Gömlek");
INSERT INTO alt_kategori VALUES("5", "2", "1", "Atlet");
INSERT INTO alt_kategori VALUES("6", "2", "1", "Boxer");
INSERT INTO alt_kategori VALUES("10", "3", "1", "Klasik");
INSERT INTO alt_kategori VALUES("9", "3", "1", "Spor");
INSERT INTO alt_kategori VALUES("11", "4", "2", "Çamaşır");
INSERT INTO alt_kategori VALUES("12", "4", "2", "İçlik");
INSERT INTO alt_kategori VALUES("13", "5", "2", "Deri");
INSERT INTO alt_kategori VALUES("14", "5", "2", "Kumaş");
INSERT INTO alt_kategori VALUES("15", "6", "2", "Spor");
INSERT INTO alt_kategori VALUES("24", "4", "1", "klasik");
INSERT INTO alt_kategori VALUES("17", "6", "2", "Deri Kordon");
INSERT INTO alt_kategori VALUES("18", "7", "3", "Işıklı");
INSERT INTO alt_kategori VALUES("19", "7", "3", "Spor");
INSERT INTO alt_kategori VALUES("20", "7", "3", "İlk Adım");
INSERT INTO alt_kategori VALUES("21", "10", "3", "Araba");
INSERT INTO alt_kategori VALUES("22", "10", "3", "Bebek");
INSERT INTO alt_kategori VALUES("23", "8", "3", "tren");



DROP TABLE IF EXISTS 'ana_kategori';

CREATE TABLE `ana_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO ana_kategori VALUES("1", "ERKEK");
INSERT INTO ana_kategori VALUES("2", "KADIN");
INSERT INTO ana_kategori VALUES("3", "ÇOCUK");



DROP TABLE IF EXISTS 'ayarlar';

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sloganUst1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganAlt1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganUst2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganAlt2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganUst3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sloganAlt3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `sayfaAciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `anahtarKelime` text COLLATE utf8_turkish_ci NOT NULL,
  `uyelerVeriAdet` int(11) NOT NULL DEFAULT '10',
  `urunlerVeriAdet` int(11) NOT NULL DEFAULT '10',
  `urunlerGoruntuAdet` int(11) NOT NULL,
  `yorumlarGoruntuAdet` int(11) NOT NULL,
  `adreslerGoruntuAdet` int(11) NOT NULL,
  `siparislerGoruntuAdet` int(11) NOT NULL,
  `bakimTarih` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `yedekTarih` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `menuAcKapat` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO ayarlar VALUES("1", "DB-Üst Slogan 1", "DB-Alt Slogan 1", "DB-Üst Slogan  2", "DB-Alt Slogan 2", "DB-Üst Slogan 3", "DB-Alt Slogan 3", "MVC E-TİCARET UYGULAMASI", "Eyüp Ensar Yörük - Mehmet Emin Çumak");



DROP TABLE IF EXISTS 'bankabilgileri';

CREATE TABLE `bankabilgileri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankaAd` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hesapAd` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `hesapNo` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `ibanNo` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO bankabilgileri VALUES("1", "İŞ BANKASI", "ekin", "1234", "TR00 0000 0000 0000 0000 0000");
INSERT INTO bankabilgileri VALUES("2", "ZİRAAT BANKASI", "EYÜP", "54321", "TR10 0000 0000 0000 0000 0000");
INSERT INTO bankabilgileri VALUES("6", "AKBANK", "ENSAR-AKBANK", "222222", "TR20 0000 0000 0000 0000 0000");



DROP TABLE IF EXISTS 'bulten';

CREATE TABLE `bulten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mailadres` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO bulten VALUES("1", "eyupensar.yoruk@gmail.com", "2021-11-15");
INSERT INTO bulten VALUES("4", "eslemyoruk@gmail.com", "2021-11-12");
INSERT INTO bulten VALUES("5", "burakyoruk@gmail.com", "2022-11-12");



DROP TABLE IF EXISTS 'cocuk_kategori';

CREATE TABLE `cocuk_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ana_kat_id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO cocuk_kategori VALUES("1", "1", "Dış Giyim");
INSERT INTO cocuk_kategori VALUES("2", "1", "İç giyim");
INSERT INTO cocuk_kategori VALUES("3", "1", "Ayakkabı");
INSERT INTO cocuk_kategori VALUES("4", "1", "Gömlek");
INSERT INTO cocuk_kategori VALUES("5", "1", "pantolon");
INSERT INTO cocuk_kategori VALUES("6", "2", "saat");
INSERT INTO cocuk_kategori VALUES("7", "3", "Ayakkabı");
INSERT INTO cocuk_kategori VALUES("8", "3", "Oyuncak");
INSERT INTO cocuk_kategori VALUES("10", "3", "Giyim");



DROP TABLE IF EXISTS 'iletisim';

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO iletisim VALUES("1", "EYÜP ENSAR", "eyupensar.yoruk@gmail.com", "mesaj", "asdasd", "18-11-2021");
INSERT INTO iletisim VALUES("2", "EYÜP ENSAR", "eyupensar.yoruk@gmail.com", "mesaj", "asdasdasd", "18-11-2021");
INSERT INTO iletisim VALUES("3", "Eslem", "burak@gmail.com", "mesaj", "mesaj gönderdim.", "18-11-2021");
INSERT INTO iletisim VALUES("4", "hakan", "hakan@gmail.com", "mesaj", "asdasdasd", "18-11-2021");
INSERT INTO iletisim VALUES("5", "kaya", "kaya@gmail.com", "mesaj", "sadasdas", "18-11-2021");



DROP TABLE IF EXISTS 'siparisler';

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis_no` int(11) NOT NULL,
  `adresid` int(11) NOT NULL,
  `uyeid` int(11) NOT NULL,
  `urunad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `urunadet` int(11) NOT NULL,
  `urunfiyat` int(11) NOT NULL,
  `toplamfiyat` int(11) NOT NULL,
  `kargodurum` int(11) NOT NULL DEFAULT '1',
  `odemeturu` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO siparisler VALUES("65", "89047628", "16", "48", "Y MODEL", "1", "169", "169", "2", "Nakit", "30.12.2021");
INSERT INTO siparisler VALUES("64", "89047628", "16", "48", "Kara Tren", "3", "147", "441", "2", "Nakit", "30.12.2021");
INSERT INTO siparisler VALUES("63", "75816550", "16", "47", "Benekli", "2", "169", "338", "2", "Nakit", "24.12.2021");
INSERT INTO siparisler VALUES("62", "75816550", "16", "47", "Kot Pantolon", "3", "147", "441", "2", "Nakit", "24.12.2021");
INSERT INTO siparisler VALUES("61", "73550326", "1", "46", "Pamuk", "1", "169", "169", "2", "Nakit", "13.12.2021");
INSERT INTO siparisler VALUES("60", "73550326", "12", "46", "Kot Pantolon", "1", "147", "147", "2", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("59", "73550326", "1", "46", "Sarı Tişört", "1", "270", "270", "2", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("58", "85418760", "12", "46", "Beyaz Tişört", "1", "380", "380", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("35", "85418760", "9", "46", "Kumaş Pantolon", "1", "169", "169", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("36", "85418760", "9", "46", "Kot Pantolon", "3", "147", "441", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("37", "50977291", "9", "46", "Pamuk", "5", "169", "845", "2", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("38", "50977291", "9", "46", "Pamuklu", "2", "90", "180", "2", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("39", "50977291", "9", "46", "Yeni Doğan", "1", "140", "140", "2", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("40", "53745420", "9", "46", "Kumaş Pantolon", "1", "169", "169", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("41", "53745420", "9", "46", "Kot Pantolon", "3", "147", "441", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("42", "53745420", "9", "46", "Pamuk", "5", "169", "845", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("43", "53745420", "9", "46", "Pamuklu", "2", "90", "180", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("44", "53745420", "9", "46", "Yeni Doğan", "1", "140", "140", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("45", "40240407", "9", "46", "Kumaş Pantolon", "1", "169", "169", "3", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("46", "40240407", "9", "46", "Kot Pantolon", "3", "147", "441", "3", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("56", "36590166", "1", "46", "Yeni Doğan", "1", "140", "140", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("57", "68203210", "9", "46", "X MODEL", "1", "147", "147", "1", "Nakit", "09.12.2021");
INSERT INTO siparisler VALUES("66", "11657786", "9", "46", "Kot Pantolon", "3", "147", "441", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("67", "22369999", "9", "46", "Kot Pantolon", "3", "147", "441", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("68", "22369999", "9", "46", "Benekli", "2", "169", "338", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("69", "22369999", "9", "46", "Normal", "5", "90", "450", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("70", "22369999", "9", "46", "Yerli Üretim", "1", "147", "147", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("71", "59116533", "12", "46", "Kot Pantolon", "3", "90", "270", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("72", "59116533", "12", "46", "İthal", "1", "169", "169", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("73", "38032021", "12", "46", "Turkuaz", "1", "90", "90", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("74", "38032021", "12", "46", "0-3 Yaş", "1", "147", "147", "1", "Nakit", "30.01.2022");
INSERT INTO siparisler VALUES("86", "82945486", "26", "46", "Beyaz Tişört", "1", "380", "380", "1", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("87", "82945486", "26", "46", "dsadsad", "2", "231", "462", "1", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("88", "47380907", "9", "46", "Beyaz Tişört", "3", "380", "1140", "1", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("85", "75830938", "27", "46", "Keten Ceket", "2", "147", "294", "1", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("84", "75830938", "27", "46", "Kot Pantolon", "2", "90", "180", "1", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("89", "47380907", "9", "46", "dsadsad", "3", "231", "693", "1", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("90", "9515365", "27", "46", "Beyaz Tişört", "5", "380", "1900", "2", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("91", "9515365", "27", "46", "dsadsad", "3", "231", "693", "2", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("92", "70561860", "27", "46", "Beyaz Tişört", "5", "380", "1900", "2", "Nakit", "21.02.2022");
INSERT INTO siparisler VALUES("93", "70561860", "27", "46", "dsadsad", "3", "231", "693", "2", "Nakit", "21.02.2022");



DROP TABLE IF EXISTS 'teslimatbilgileri';

CREATE TABLE `teslimatbilgileri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis_no` int(11) NOT NULL,
  `ad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO teslimatbilgileri VALUES("1", "40240407", "ekin", "yılmaz", "ekin@gmail.com", "22222222");
INSERT INTO teslimatbilgileri VALUES("2", "19886074", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("3", "13424267", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("4", "83195173", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("5", "36516735", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("6", "86551494", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("7", "37051460", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("8", "36590166", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("9", "54286307", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("10", "68203210", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("11", "85418760", "ekin", "yılmaz", "ekin@gmail.com", "1341ewds");
INSERT INTO teslimatbilgileri VALUES("12", "27167118", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("13", "75491283", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("14", "73550326", "ekin", "yılmaz", "ekin@gmail.com", "111111111");
INSERT INTO teslimatbilgileri VALUES("15", "75816550", "Ahmet", "ünlü", "ahmet30@gmail.com", "05419876618");
INSERT INTO teslimatbilgileri VALUES("16", "89047628", "irem", "çakıcı", "irem10@gmail.com", "5418502841");
INSERT INTO teslimatbilgileri VALUES("17", "22369999", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("18", "59116533", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("19", "38032021", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("20", "35797742", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("21", "45374475", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("22", "89436642", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("23", "18756691", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("24", "75830938", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("25", "82945486", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("26", "47380907", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("27", "9515365", "ekin", "yılmaz", "ekin@gmail.com", "1111111");
INSERT INTO teslimatbilgileri VALUES("28", "70561860", "ekin", "yılmaz", "ekin@gmail.com", "1111111");



DROP TABLE IF EXISTS 'urunler';

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anakatid` int(11) DEFAULT NULL,
  `cocukkatid` int(11) DEFAULT NULL,
  `katid` int(11) NOT NULL,
  `urunad` varchar(80) CHARACTER SET utf8 NOT NULL,
  `res1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `res2` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `res3` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '0',
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `kumas` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `urtYeri` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `renk` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  `stok` int(11) NOT NULL,
  `ozellik` text COLLATE utf8_turkish_ci NOT NULL,
  `ekstraBilgi` text COLLATE utf8_turkish_ci NOT NULL,
  `satisadet` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO urunler VALUES("1", "2", "6", "0", "Beyaz Tişört", "f0c2a401ce3e3c3f73e9c845d5981045.png", "e13b8cbcdfc297b2157ad6d2ed19c401.png", "8c66c4cc34537f528e82ed42dc318386.png", "1", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "keten", "Çin", "Mavi", "380", "95", "Beyaz Tişört için özellikler", "Beyaz Tişört için ekstra bilgi", "15");
INSERT INTO urunler VALUES("3", "1", "1", "2", "Kumaş Pantolon", "7.png", "8.png", "9.png", "2", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "1000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "8");
INSERT INTO urunler VALUES("4", "3", "8", "23", "Kot Pantolon", "10.png", "11.png", "12.png", "2", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "92", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "96");
INSERT INTO urunler VALUES("5", "3", "10", "22", "Keten Ceket", "13.png", "14.png", "15.png", "2", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "188", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "192");
INSERT INTO urunler VALUES("7", "1", "4", "12", "Siyah Tişört", "p7.jpg", "l3.jpg", "p7.jpg", "1", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "Siyah", "570", "170", "Siyah Tişört için özellikler", "Siyah Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("9", "1", "2", "6", "Mor Tişört", "p9.jpg", "l1.jpg", "p9.jpg", "1", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Mor", "157", "1000", "Mor Tişört için özellikler", "Mor Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("10", "1", "1", "4", "Keten Gömlek", "19.png", "20.png", "21.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Beyaz", "380", "10000", "Beyaz Tişört için özellikler", "Beyaz Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("11", "1", "1", "4", "Yazlık Gömlek", "22.png", "23.png", "24.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Sarı", "270", "10000", "Sarı Tişört için özellikler", "Sarı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("12", "1", "2", "5", "Beyaz Atlet", "25.png", "26.png", "27.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "10000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("13", "1", "2", "5", "Kırmızı Atlet", "28.png", "29.png", "30.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("14", "1", "2", "6", "Keten Ceket", "31.png", "32.png", "33.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("15", "1", "2", "6", "Kumaş Ceket", "34.png", "35.png", "36.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("16", "1", "3", "10", "Sarı", "37.png", "38.png", "39.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "10000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("17", "1", "3", "10", "Kahverengi", "40.png", "41.png", "42.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("18", "1", "3", "9", "Nike-Beyaz", "43.png", "44.png", "45.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("19", "1", "3", "9", "Adidas-Mavi", "46.png", "47.png", "48.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("20", "2", "4", "11", "Çamaşır-1", "49.png", "50.png", "51.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "Mavi", "1400", "10000", "Pembe Tişört için özellikleri", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("21", "2", "4", "11", "Çamaşır-1", "52.png", "53.png", "54.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("22", "2", "4", "12", "X MODEL", "55.png", "56.png", "57.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("23", "2", "4", "12", "Y MODEL", "58.png", "59.png", "60.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("24", "2", "5", "13", "Timsah Derisi", "61.png", "62.png", "63.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "10000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("25", "2", "5", "13", "Sinek Derisi", "64.png", "65.png", "66.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("26", "2", "5", "14", "Keten", "67.png", "68.png", "69.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("2", "2", "5", "14", "Bez", "70.png", "71.png", "72.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("28", "2", "6", "15", "Kırmızı", "73.png", "74.png", "75.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "10000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("29", "2", "6", "15", "Turkuaz", "76.png", "77.png", "78.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("30", "1", "2", "16", "X MODEL", "79.png", "80.png", "81.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("31", "1", "2", "16", "Y MODEL", "82.png", "83.png", "84.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("32", "2", "6", "17", "Yerli Üretim", "85.png", "86.png", "87.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("33", "2", "6", "17", "İthal", "88.png", "89.png", "90.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("34", "3", "7", "18", "Mavi", "91.png", "92.png", "93.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("35", "3", "7", "18", "Kırmızı", "94.png", "95.png", "96.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("36", "3", "7", "19", "Işıklı", "97.png", "98.png", "99.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "10000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("37", "3", "7", "19", "Normal", "100.png", "101.png", "102.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("38", "3", "7", "20", "0-3 Yaş", "103.png", "104.png", "105.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("39", "3", "7", "20", "3-6 Yaş", "106.png", "107.png", "108.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("40", "3", "10", "21", "Metal", "109.png", "110.png", "111.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("41", "3", "10", "21", "Tahta", "112.png", "113.png", "114.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("42", "3", "10", "22", "Barby", "115.png", "116.png", "117.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("43", "3", "10", "22", "Benekli", "118.png", "119.png", "120.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("44", "3", "8", "23", "Kara Tren", "121.png", "122.png", "123.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("45", "3", "8", "23", "Tahta Tren", "124.png", "125.png", "126.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("46", "1", "4", "24", "Yeni Doğan", "127.png", "128.png", "129.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Likra", "Afrika", "pembe", "140", "10000", "Pembe Tişört için özellikler", "Pembe Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("47", "1", "4", "24", "Pamuklu", "130.png", "131.png", "132.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Saten", "Kamboçya", "Sarı", "90", "10000", "Kırmızı Tişört için özellikler", "Kırmızı Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("48", "1", "3", "25", "Polo", "133.png", "134.png", "135.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("49", "1", "3", "25", "Pamuk", "136.png", "137.png", "138.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Keten", "Uganda", "Mavi", "169", "10000", "Mavi Tişört için özellikler", "Mavi Tişört için ekstra bilgi", "0");
INSERT INTO urunler VALUES("50", "1", "3", "25", "Kot Pantolon", "139.png", "140.png", "141.png", "0", "ÜRÜN HAKKINDA AÇIKLAMA=Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever", "Pamuk", "Çin", "Gri", "147", "190", "Gri Tişört için özellikler", "Gri Tişört için ekstra bilgi", "0");



DROP TABLE IF EXISTS 'uye';

CREATE TABLE `uye` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO uye VALUES("46", "ekin", "yılmaz", "ekin@gmail.com", "ZWtpbjEw", "111111", "0");
INSERT INTO uye VALUES("47", "ahmet", "ünlü", "ahmet30@gmail.com", "YWhtZXQxMA==", "05419876618", "0");
INSERT INTO uye VALUES("45", "elif", "karataş", "elif@gmail.com", "ZWxpZg==", "1123123", "1");
INSERT INTO uye VALUES("48", "irem", "çakıcı", "irem10@gmail.com", "aXJlbTEw", "5418502841", "1");
INSERT INTO uye VALUES("38", "EYÜP ENSAR", "yörük", "eyupensar.yor", "MTIz", "1231231", "0");
INSERT INTO uye VALUES("49", "kasım", "efe", "kasimefe10@gmail.com", "a2FzaW0xMA==", "1111222", "1");
INSERT INTO uye VALUES("52", "EYÜP ENSAR", "YÖRÜK", "eyupensar.yoruk@gmail.com", "MTEx", "213123", "1");
INSERT INTO uye VALUES("51", "olcay", "efen", "eyuuk@gmail.com", "MTEx", "213123", "1");



DROP TABLE IF EXISTS 'yonetim';

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `yetki` int(11) NOT NULL,
  `siparisYonetim` int(11) NOT NULL DEFAULT '0',
  `kategoriYonetim` int(11) NOT NULL DEFAULT '0',
  `uyeYonetim` int(11) NOT NULL DEFAULT '0',
  `urunYonetim` int(11) NOT NULL DEFAULT '0',
  `muhasebeYonetim` int(11) NOT NULL DEFAULT '0',
  `kullaniciYonetim` int(11) NOT NULL DEFAULT '0',
  `bultenYonetim` int(11) NOT NULL DEFAULT '0',
  `sifreDegistir` int(11) NOT NULL DEFAULT '0',
  `sistemAyarlari` int(11) NOT NULL DEFAULT '0',
  `sistemBakim` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO yonetim VALUES("46", "ekin", "ZWtpbjEw", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1");
INSERT INTO yonetim VALUES("55", "ali", "YWxpMTA=", "3", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1");
INSERT INTO yonetim VALUES("56", "merve", "bWVydmUxMA==", "3", "0", "1", "1", "0", "1", "0", "1", "1", "0", "0");
INSERT INTO yonetim VALUES("57", "Eyüp", "ZXl1cDEw", "2", "1", "1", "1", "0", "0", "0", "0", "0", "0", "1");
INSERT INTO yonetim VALUES("60", "eslem", "ZXNsZW0xMA==", "2", "0", "1", "1", "0", "0", "0", "0", "1", "0", "0");



DROP TABLE IF EXISTS 'yorumlar';

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uyeid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO yorumlar VALUES("1", "45", "10", "olcay", "deneme6olcay", "11.5.2019", "1");



