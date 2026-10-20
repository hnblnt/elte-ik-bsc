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
        'password' => trim($post["password"] ?? ''),
        'fullname' => trim($post["fullname"] ?? '')
    ];

    if ($data["username"] === "") {
        $errors["username"] = "A felhasználónév megadása kötelező.";
    }

    if ($data["password"] === "") {
        $errors["password"] = "A jelszó megadása kötelező.";
    }

    if ($data["fullname"] === "") {
        $errors["fullname"] = "A teljes név megadása kötelező.";
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
        if ($auth->user_exists($data["username"])) {
            $errors["global"] = "Ez a felhasználónév már létezik.";
        } else {

            // Create new user
            $new_user = [
                'username' => $data["username"],
                'password' => password_hash($data["password"], PASSWORD_DEFAULT),
                'fullname' => $data["fullname"],
                'roles' => ['user']
            ];

            $user_storage->add($new_user);
            $auth->login($new_user);

            redirect("index.php");
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
    <h2>Regisztráció</h2>
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
        Full name: <br>
        <input type="text" name="fullname" value="<?= $_POST['fullname'] ?? '' ?>" required>
        <?php if (isset($errors["fullname"])) : ?>
            <span><?= $errors["fullname"] ?></span>
        <?php endif ?>
        <br>
        <button>Regisztráció</button>
    </form>
</body>

</html>