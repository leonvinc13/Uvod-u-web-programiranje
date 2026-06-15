<?php
    $naslov = "PHP dokument - vježba 2-4";
    $autor = "Leon Vincelj";
    if (isset($_POST['submit'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];

        $c = (3 * $a - $b) / 2;

        echo "<h3>Rezultat: c = $c</h3>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vjezba 2-4 </title>
</head>
<body>
    <h1><?php echo htmlspecialchars($naslov); ?></h1>
    <p>Ovu stranicu izradio/la je <strong><?php echo htmlspecialchars($autor); ?></strong>.</p>
    <form method="post">
        Vrijednost a: <input type="number" name="a"><br>
        Vrijednost b: <input type="number" name="b"><br>
        <input type="submit" name="submit" value="Zbroji">
    </form>

</body>
</html>