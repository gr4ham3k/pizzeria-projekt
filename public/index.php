<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria</title>
</head>
<body>
    <?php
    
        require_once '../classes/Pizze.php';
        require_once '../config/Db.php';

        $db = new Database();
        
        $p = new Pizze($db);

        $result = $p -> get_all_pizze_query();

        print("<b>Nazwa</b> <b>Cena</b><br>");
        foreach($result as $item)
        {
            print("<p>$item[nazwa] $item[cena]</p><br>");
        }
        
    ?>
</body>
</html>