<?php
session_start();
include_once("userstorage.php");
include_once("auth.php");
include_once("utils.php");
$user_storage = new UserStorage();
$auth = new Auth($user_storage);
$auth -> logout();
redirect("index.php");
?>