<?php
session_start();
include_once("userstorage.php");
include_once("auth.php");
include_once("utils.php");
include_once("contactstorage.php");

$user_storage = new UserStorage();
$auth = new Auth($user_storage);

if (!$auth->is_authenticated()) {
  redirect("login.php");
}

$cs = new ContactStorage();

// Szűrő beolvasása GET-ből
$filter = $_GET["szuro"] ?? "";

// Kontaktok lekérése és szűrése
$contacts = $cs->findMany(function($contact) use ($filter) {
    // Csak a bejelentkezett user kontaktjai
    if ($contact["creator"] !== $_SESSION["user"]["id"]) {
        return false;
    }

    // Ha nincs filter, minden kontakt jó
    if ($filter === "") {
        return true;
    }

    // A keresett szöveg legyen kis/nagybetű független
    $filterLower = strtolower($filter);

    // SZŰRÉS NÉVRE
    if (stripos($contact["name"], $filter) !== false) {
        return true;
    }

    // SZŰRÉS EMAIL CÍMEKRE (az emails mező egy tömb!)
    foreach ($contact["emails"] as $email) {
        if (stripos($email, $filter) !== false) {
            return true;
        }
    }

    return false;
});
?>
<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Névjegyek</title>
</head>

<body>
  <h1>Névjegyek</h1>

  <p>Hello, <?= $_SESSION["user"]["fullname"] ?>!
    <a href="logout.php">Kijelentkezés</a>
  </p>

  <h2>Lista</h2>

  <form method="GET">
    Filter text:
    <input type="text" name="szuro" value="<?= htmlspecialchars($filter) ?>">
    <button>Szűr</button><br>
  </form>

  <a href="add.php">Új névjegy...</a>

  <table>
    <tr>
      <th>Név</th>
      <th>Email címek</th>
    </tr>

    <?php foreach ($contacts as $c) : ?>
      <tr>
        <td>
          <a href="detail.php?id=<?= $c["id"] ?>">
            <?= $c["name"] ?>
          </a>
        </td>
        <td><?= implode(", ", $c["emails"]) ?></td>
      </tr>
    <?php endforeach; ?>

  </table>
</body>

</html>
