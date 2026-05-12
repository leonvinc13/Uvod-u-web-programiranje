<?php
$buttonClass = "sub";
$buttonText = "Provjeri";

if (isset($_POST['broj'])){
    $korBroj=$_POST['broj'];
    $randBroj=rand(1,9);
    if ($korBroj==$randBroj){
        $buttonClass = 'success';
        $buttonText = 'Pogodak, pokušaj ponovo!';
    }
    else {
        $buttonClass = 'fail';
        $buttonText = 'Krivo, pokušaj ponovo!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vjezba 3-1 </title>
    <style>
        .success{
            background-color: green;
        }
        .fail{
            background-color: red;
        }
    </style>
</head>
<body>
        <form action="" method="POST">
            Igra (pogodi broj) <br>
            <p> Upiši broj od 1 do 10:
            <input type="number" name="broj" id="broj"> <br>
            <input type="submit" value="<?php echo $buttonText; ?>" class="<?php echo $buttonClass; ?>"> <br>
            Zamišljen broj je <?php echo $randBroj; ?>
        </form>
</body>
</html>