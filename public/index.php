<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria</title>
</head>
<body>
    <?php
    
        require_once '../config/Db.php';
        $db = new Database;
        $conn = $db->getConnection();

        $stmt = $conn->query("SELECT * FROM get_all_pizze()");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        print("<b>Nazwa</b> <b>Cena</b><br>");
        foreach($result as $item)
        {
            print("<p>$item[nazwa] $item[cena]</p><br>");
        }
    ?>
</body>
</html>