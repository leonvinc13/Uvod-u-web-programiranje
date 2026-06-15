<?php

function ducan($stanje="otvoren"){
    echo "Ducan je " . $stanje;
}

function danUTjednu() {
    return date("l");
}

function sat() {
    return (int)date("H");
}

function datum() {
    return date("d.m");
}

$praznici = [
    "01.01", 
    "25.12", 
    "26.12"  
];

$dan = danUTjednu();
$h = sat();
$danas = datum();

echo "Danas je " . $dan . ", " . date("H:i:s");
echo "<br>";

if (in_array($danas, $praznici)) {
    ducan("zatvoren (praznik)");
}
else if ($dan == "Sunday") {
    ducan("zatvoren");
}
else if ($dan == "Saturday") {
    if ($h < 9 || $h > 14) ducan("zatvoren");
    else ducan();
}
else {
    if ($h < 8 || $h > 20) ducan("zatvoren");
    else ducan();
}

?>