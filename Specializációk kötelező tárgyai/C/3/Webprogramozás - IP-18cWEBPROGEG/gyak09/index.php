<?php
include_once('contactstorage.php');

$cs = new ContactStorage();
$contacts = $cs->findAll();
//print_r($contacts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Névjegyek</h1>
    <h2>Lista</h2>
    <a href="add.php">Új névjegy</a>
    <table>
        <tr>
            <th>Név</th>
            <th>Email címek</th>
        </tr>
        <?php foreach ($contacts as $c) : ?>
            <tr>
                <td><?=  $c["name"] ?></td>
                <td><?= implode(", ",$c["emails"]) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>