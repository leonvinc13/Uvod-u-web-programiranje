<?php
if (isset($_POST['operacija']))
    $prvi=$_POST['broj1'];
    $drugi=$_POST['broj2'];
    $operacija=$_POST['operacija'];
    switch ($operacija){
        case '+':
            $rezultat=$prvi+$drugi;
            break;
        case '-':
            $rezultat=$prvi-$drugi;
            break;
        case '*':
            $rezultat=$prvi*$drugi;
            break;
        case '/':
            $rezultat=$prvi/$drugi;
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vjezba 3-2</title>
</head>
<body>
    <form action="" method="post">
        <p> Kalkulator (Switch) naredba </p> <br>
        Upiši prvi broj 
        <input type="number" name="broj1" id="broj1"> <br>
        Upiši drugi broj
        <input type="number" name="broj2" id="broj2"> <br>
        <p> Rezultat: <?php echo $rezultat; ?> </p>
        <input type="submit" name="operacija" value="+">
        <input type="submit" name="operacija" value="-">
        <input type="submit" name="operacija" value="*">
        <input type="submit" name="operacija" value="/">
    </form>
</body>
</html>
