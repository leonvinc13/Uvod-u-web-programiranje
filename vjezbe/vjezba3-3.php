<?php
$prosjek="";
$konOcjena="";
if (isset($_POST['ocjena1']) && isset($_POST['ocjena2'])) {
    $ocjena1=$_POST['ocjena1'];
    $ocjena2=$_POST['ocjena2'];
    $prosjek=($ocjena1+$ocjena2)/2;
    if ($prosjek<1.5 || $ocjena1==1 || $ocjena2==1){
        $konOcjena=1;
    }
    else if ($prosjek>=1.5 && $prosjek<2.5){
        $konOcjena=2;
    }
    else if ($prosjek>=2.5 && $prosjek<3.5){
        $konOcjena=3;
    }
    else if ($prosjek>=3.5 && $prosjek<4.5){
        $konOcjena=4;
    }
    else {
        $konOcjena=5;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vjezba 3-3</title>
</head>
<body>
    <form action="" method="post">
        Unesite ocjenu 1. kolokvija: 
        <input type="number" name="ocjena1" id="ocjena1" min="1" max="5"> <br>
        Unesite ocjenu 2. kolokvija: 
        <input type="number" name="ocjena2" id="ocjena2" min="1" max="5"> <br>
        <input type="submit" value="Prikaži">
        <p> Prosjek ocjena je: <?php echo $prosjek; ?> </p>
        <p> Konačna ocjena je: <?php echo $konOcjena; ?></p>
    </form>
</body>
</html>