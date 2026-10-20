<?php
include_once("contactstore.php");
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = $_GET["id"];
$cs = new ContactStorage();
$contact = $cs->delete($id);
header("Location: index.php");
exit();