<?php
if (isset($_POST['recenica'])){
    $niz = $_POST['recenica'];
    echo str_word_count($niz, 0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vjezba 4-3</title>
    <style>
        #in{
            width: 100%;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2> Zadatak </h2> 
        <p>U zadataku se traži da se ispiše koliko je rijeći u rečenici. Koristite naredbu str_word_count </p> 
        <h3> Ulazni niz: </h3> 
        <input type="text" name="recenica" id="in"> <br>
        <input type="submit" value="Ispiši broj riječi">
    </form>
</body>
</html>

