<?php

    spl_autoload_register (function ($className) {

        $dir = __DIR__.'/libs/';

        $dosyayolu = $dir.$className.'.php';

        include($dosyayolu);

    });

    include "config/genel.php";

    include "config/database.php";

    include "helpers/HariciFonksiyonlar.php";

    include "helpers/PanelHarici.php";

    include "Route.php";

    $Route = new Route;

?>