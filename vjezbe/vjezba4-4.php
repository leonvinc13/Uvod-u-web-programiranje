<?php
function prosti($broj){
    if ($broj < 2) return false;
    $brojDjelitelja = 0;

    for ($i = 1; $i <= $broj; $i++){
        if ($broj % $i == 0) {
            $brojDjelitelja++;
        }
    }

    if ($brojDjelitelja == 2) return true;
    else return false;
}

if (isset($_POST['broj'])){
    $broj = $_POST['broj'];

    if (prosti($broj)) {
        echo "Broj $broj je prosti <br>";
    } else {
        echo "Broj $broj nije prosti <br>";
    }

    for ($i = 0; $i < 100; $i++){
        if (prosti($i)) echo $i . " ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vježba 4-4</title>
</head>
<body>
    <form action="" method="post">
        <br>Upiši broj:
        <input type="number" name="broj">
        <br><br>
        <input type="submit" value="Provjeri je li prost">
    </form>
</body>
</html>