<?php

$auti = array("Audi", "BMW", "Renault", "Citroen");

$voz = array();

if (isset($_POST['vozilo'])) {

    $voz = $_POST['vozilo'];
}

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 4-1</title>
</head>
<body>

    <form action="" method="post">

        Označi vozilo: <br>

        <input type="checkbox" name="vozilo[]" value="Audi"> Audi
        <input type="checkbox" name="vozilo[]" value="BMW"> BMW
        <input type="checkbox" name="vozilo[]" value="Renault"> Renault
        <input type="checkbox" name="vozilo[]" value="Citroen"> Citroen

        <br><br>

        <input type="submit" value="POŠALJI">

        <p>Odabrana vozila su:</p>

        <?php

        foreach ($voz as $v) {

            echo $v . "<br>";
        }

        ?>

    </form>

</body>
</html>