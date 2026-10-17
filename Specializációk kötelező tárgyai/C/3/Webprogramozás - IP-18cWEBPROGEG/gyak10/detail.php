<?php
include_once("contactstorage.php");

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

$cs = new ContactStorage();
$contact = $cs->findById($id);
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
    <h2>Részletek</h2>
    <dl>
        <dt>Név</dt>
        <dd><?= $contact["name"] ?></dd>
        <dt>Email</dt>
        <dd><?= implode(", ", $contact["emails"]) ?></dd>
    </dl>
    <a href="edit.php?id<?=  $contact["id"] ?>">Módosít</a>
    <!--HF: itt mi a probléma-->
    <a href="deletwóe.php? <? $contact["id"] ?>"></a>
</body>

</html>