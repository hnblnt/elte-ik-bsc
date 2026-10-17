<?php
session_start();
include_once("userstorage.php");
include_once("auth.php");
include_once("utils.php");

//print_r($_POST);

// functions
function validate($post, &$data, &$errors): bool
{
    $data = [
        'username' => trim($post["username"] ?? ''),
        'password' => trim($post["password"] ?? '')
    ];

    if ($data["username"] === "") {
        $errors["username"] = "A felhasználónév megadása kötelező.";
    }

    if ($data["password"] === "") {
        $errors["password"] = "A jelszó megadása kötelező.";
    }

    return count($errors) === 0;
}
// main
$user_storage = new UserStorage();
$auth = new Auth($user_storage);
$data = [];
$errors = [];
if (count($_POST) > 0) {
    if (validate($_POST, $data, $errors)) {
        $auth_user = $auth->authenticate($data["username"], $data["password"]);
        if (!$auth_user) {
            $errors["global"] = "username - password páros nem megfelelő";
        } else {
            $auth->login($auth_user);

            if (isset($_GET["redirect_url"])) {
                redirect($_GET["redirect_url"]);
            } else {
                redirect("index.php");
            }
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input~span {
            color: red;
            font-size: smaller;
        }
    </style>
</head>

<body>
    <h1>Névjegyek</h1>
    <h2>Bejelentkezés</h2>
    <?php if (isset($errors["global"])) : ?>
        <p><span class="error"><?= $errors["global"] ?></span></p>
    <?php endif; ?>
    <form action="" method="post" novalidate>
        Username:<br> <input type="text" name="username" value="<?= $_POST['username'] ?? '' ?>" required>
        <?php if (isset($errors["username"])) : ?>
            <span><?= $errors["username"] ?></span>
        <?php endif ?>
        <br>
        Password: <br>
        <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" required>
        <?php if (isset($errors["password"])) : ?>
            <span><?= $errors["password"] ?></span>
        <?php endif ?>
        <br>
        <button>Bejelentkezés</button><br>
        <a href="register.php">Regisztráció</a>
    </form>
</body>

</html>