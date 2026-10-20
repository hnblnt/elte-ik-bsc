<?php
function novel(&$szam) {
    $szam++;
}

$a = 5;
novel($a);
echo $a;