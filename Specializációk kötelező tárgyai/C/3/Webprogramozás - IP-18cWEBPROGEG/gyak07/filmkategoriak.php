<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        $categories = [
            [
                "id"=>1,
                "category"=>"Akció"
            ],
                        [
                "id"=>2,
                "category"=>"Dráma"
            ],
            [
                "id"=>13,
                "category"=>"Vígjáték"
            ]
        ];

        //print_r($categories);
    ?>

    <form action="" method="post">
        <select name="category" id="">
            <?php
                foreach ($categories as $c): ?>
                <option value="<?= $c["id"] ?>">
                    <?= $c["category"]?>
                </option>
            <?php endforeach ?>
        </select>
        <button>Küldés</button>
    </form>

    <form action="" method="post">
        <?php
            foreach ($categories as $c): ?>
                <input type="radio" name="category" id="<?=$c["id"]?>">
                <label for="<?=$c["id"]?>"><?=$c["category"]?></label>
            <?php endforeach ?>
            <button>Küldés</button>
    </form>

    <form action="" method="post">
        <?php
            foreach ($categories as $c): ?>
                <input type="checkbox" name="category" id="<?=$c["id"]?>">
                <label for="<?=$c["id"]?>"><?=$c["category"]?></label>
            <?php endforeach ?>
            <button>Küldés</button>
    </form>

</body>

</html>