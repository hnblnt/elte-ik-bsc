<?php
// Beemeli a nations.php fájlt, ami valószínűleg a $nations tömböt tartalmazza az országok adataival.
require_once 'nations.php';

// Létrehozunk egy üres tömböt a hibáknak.
$errors = [];

// A validáló (ellenőrző) függvény.
// A '&' jel az $errors és $data előtt azt jelenti, hogy REFERENCIA szerint adjuk át őket.
// Tehát ha a függvényen belül módosítjuk őket, az az eredeti változót is megváltoztatja kint.
function check(&$errors,&$data,$nations) : bool {
    
    // 1. Cég nevének ellenőrzése
    // A logika itt kicsit furcsa: azt vizsgálja, hogy a hossz NEM 3-e.
    if(!strlen($data["company"]) == 3){
        $errors["comapany"] = "A cég neve nem megfelelő!";
    };

    // 2. Ország ellenőrzése
    // Meghívja az isCountryInList segédfüggvényt. Ha nincs benne a listában, hiba.
    if(!isCountryInList($nations,$data["nation"])){
        $errors["nation"] = "A megadott ország nem szerepel a rendszerben!";
    }

    // 3. Újságírók számának ellenőrzése
    // Ha NEM egész szám, VAGY nincs 1 és 10 között...
    if(!is_int($data["reporters"]) || ($data["reporters"] < 1 && $data["reporters"] > 10)){
        
        // ...akkor lekéri az ország kódját.
        $code = getCountryCode($nations,$data["nation"]);
        
        // Megnézi, hogy az ország "Big5" tag-e (Nagy-Britannia, Olasz, Spanyol, Német, Francia)
        // ÉS a létszám 20 alatt van-e.
        if(($code == "GBR" || $code == "ITA" || $code == "ESP" || $code == "DEU" || $code == "FRA") && $data["reporters"] <= 20){
            // Ha ez igaz, akkor ÜRES a blokk -> vagyis ez ELFOGADHATÓ (kivétel a Big5-nek).
        }
        else{
            // Minden más esetben hibaüzenet.
            $errors["reporters"] = "Az újságírók számának megadása kötelező!";
        }
    }

    // 4. Szerződés típusának ellenőrzése
    // Ha nem "subsidiary" és nem "independent", VAGY egyáltalán nincs beállítva -> Hiba.
    if(!($data["contract"] == "subsidiary" || $data["contract"] == "independent") || !isset($data["contract"])){
        $errors["contract"] = "A szerződés típusát kötelező kiválasztani!";
    };

    // 5. Speciális szabály: Big5 csak alvállalkozó lehet
    $code = getCountryCode($nations,$data["nation"]);
    // Ha Big5 országról van szó ÉS a szerződés NEM "subsidiary" (leányvállalat/alvállalkozó)...
    if(($code == "GBR" || $code == "ITA" || $code == "ESP" || $code == "DEU" || $code == "FRA") && !$data["contract"] == "subsidiary"){
        $errors["contract"] = "Big5 csak alvállalkozóként érkezhet!";
    }

    // Visszatérési érték: Ha az $errors tömb üres (== 0), akkor true (sikeres), amúgy false.
    return $errors == 0;
}

// Segédfüggvény: Benne van-e az ország a listában?
function isCountryInList($nations, $data) : bool {
    foreach ($nations as $nation):
        // Itt a $data-t (ami valószínűleg az ID vagy Flag kód) hasonlítja a $nation["flag"]-hez.
        if($data == $nation["flag"]){
            return true;
        }
    endforeach;
    return false;  
}

// Segédfüggvény: Országkód lekérése
function getCountryCode($nations, $data){
    foreach ($nations as $nation):
        if($data == $nation["flag"]){
            // VIGYÁZAT: A kódban itt hiba lehet. A $data string, nem tömb, így a $data["id"] nem értelmezhető. 
            // Valószínűleg $nation["id"]-t akart visszaadni a szerző.
            return $data["id"];
        }
    endforeach;
}

// Fő futási logika
// Ha van GET paraméter (tehát elküldték az űrlapot)...
if (count($_GET) > 0) {
    // ...akkor lefuttatja a check függvényt.
    if(check($errors,$_GET,$nations)){
        // Ha minden rendben (true), átirányít az index.php-re.
        header("Location: index.php");
    }
    // Ha hiba volt, az $errors tömb feltöltődött (referencia miatt), és az oldal újratöltődik a hibákkal.
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>5. feladat</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <h1>5. Média</h1>
    <div id="main">
        <form method="get">
            <label>
                Cég neve
                <input name="company">
            </label>
            <label>
                Ország
                <select name="nation">
                    <?php foreach ($nations as $nation): ?>
                        <!-- Országkódot fog továbbküldeni, pl. HUN -->
                        <option value="<?= $nation['id'] ?>">
                            <?= $nation['flag'] ?> <?= $nation['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </label>
            <label>
                Újságírók száma
                <input name="reporters">
            </label>
            <div>
                Szerződés
                <label><input type="radio" name="contract" value="subsidiary"> EBU Alvállalkozó</label>
                <label><input type="radio" name="contract" value="independent"> Független</label>
            </div>
            <input type="submit">
        </form>

        <div id="success">Sikeres regisztráció!</div>
        <div id="errors">
            Hiba!
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>



    <hr>

    <div>
        Ha GET kérést használtál egy checks.php oldalon keresztül, akkor ezekkel a linkekkel tudod tesztelni az űrlapon keresztül körülményesen előidézhető hibákat:
        <ul><a href="check.php?nation=XXX">Nem létező ország (check.php?nation=XXX)</a></ul>
        <ul><a href="check.php?nation=DEU&reporters=25">Big5 túl sok újságíró (check.php?nation=DEU&reporters=25)</a></ul>
        <ul><a href="check.php?contract=taxevasion">Nem létező szerződés típus (check.php?contract=taxevasion)</a></ul>
        <ul><a href="check.php?nation=DEU&contract=independent">Big5 rossz szerződés (check.php?nation=DEU&contract=independent)</a></ul>
    </div>
    <div>
        Ha GET kérést használtál helyben, akkor ezekkel a linkekkel tudod tesztelni az űrlapon keresztül körülményesen előidézhető hibákat:
        <ul><a href="index.php?nation=XXX">Nem létező ország (index.php?nation=XXX)</a></ul>
        <ul><a href="index.php?nation=DEU&reporters=25">Big5 túl sok újságíró (index.php?nation=DEU&reporters=25)</a></ul>
        <ul><a href="index.php?contract=taxevasion">Nem létező szerződés típus (index.php?contract=taxevasion)</a></ul>
        <ul><a href="index.php?nation=DEU&contract=independent">Big5 rossz szerződés (index.php?nation=DEU&contract=independent)</a></ul>
    </div>
</body>

</html>