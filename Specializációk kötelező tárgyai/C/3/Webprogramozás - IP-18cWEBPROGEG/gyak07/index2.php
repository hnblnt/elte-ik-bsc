<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //$name ="Sanyi";
        $name = $_GET['name2'] ?? 'Vendég';
        echo "<h1>Helló $name!</h1>";
    ?>
    <?= $name ?>
</body>
</html>