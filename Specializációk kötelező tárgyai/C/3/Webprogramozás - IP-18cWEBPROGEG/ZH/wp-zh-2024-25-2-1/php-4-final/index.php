<?php
include_once('finalists_array.php');

$qual = 0;
$big5 = 0;
$host = 0;
foreach ($finalists as $finalist):
    if($finalist["method"] == "qualified"){
        $qual +=1;
    }
    if($finalist["method"] == "big5"){
        $big5 +=1;
    }
    if($finalist["method"] == "host"){
        $host +=1;
    }
endforeach
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>4. feladat</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <h1>4. Döntő</h1>
    <div id="main">
        <div id="information">
            <div id="qualified">Bejutott: <?=$qual ?></div>
            <div id="big5"><?=$big5 = 5 ? "Minden Big5 jelen van." : "Hiányos Big5!" ?></div>
            <div id="host"><?=$host >=1 ? "A rendező is fellép." : "A rendező nem indít versenyzőt!" ?></div>
        </div>
        <div id="contestants">
            <?php
            foreach ($finalists as $finalist) : ?>
                <div class="card <?=$finalist["method"] ?>">
                    <span class="flag"><?=$finalist["flag"] ?></span>
                    <h2><?=$finalist["country"]?></h2>
                    <span class="contestant"><?=$finalist["contestant"]?></span>
                    <span class="method"><?=$finalist["method"]?></span>
                </div>
        <?php endforeach ?>
        </div>
    </div>
</body>

</html>