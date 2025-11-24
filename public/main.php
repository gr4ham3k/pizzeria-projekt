<?php

    require_once '../templates/header.php';

    $db = new Database();

    $p = new Pizze($db);

    $result = $p->get_all_pizze_query();

    print("<div id='pizze'>");
    print("<b>Nazwa</b> <b>Cena</b><br>");
    foreach ($result as $item) {
        print("<p>$item[nazwa] $item[cena]</p><br>");
    }
    print("</div>");
    
    require_once '../templates/footer.php';

?>
