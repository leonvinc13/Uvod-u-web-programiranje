<?php
$conn = mysqli_connect("localhost", "root", "", "users");
if (!$conn) {
    die("Greška pri spajanju na bazu: " . mysqli_connect_error());
}
if (isset($_POST['firstname']) && 
    isset($_POST['lastname']) && 
    isset($_POST['email']) && 
    isset($_POST['username']) && 
    isset($_POST['password']) && 
    isset($_POST['country'])) {
        
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $country = $_POST['country'];

    $query = "INSERT INTO users (firstname, lastname, email, username, password, country) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $username, $password, $country);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Execute failed: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            width: 400px;
            border: 1px solid black;
            padding: 20px;
            background-color: lightgray;
        }
        input, select {
            margin-bottom: 5px;
            height: 30px;
        }
        #submit {
            background-color: green;
            color: white;
        }
        #submit:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1> Registration Form </h1>
        <label for="firstname">First Name:</label> <br>
        <input type="text" name="firstname" id=""> <br>
        <label for="lastname">Last Name:</label> <br>
        <input type="text" name="lastname" id=""> <br>
        <label for="email">Email:</label> <br>
        <input type="email" name="email" id=""> <br>
        <label for="username">Username:</label> <br>
        <input type="text" name="username" placeholder="Username" minlength="5" maxlength="10"> <br>
        <label for="password">Password:</label> <br>
        <input type="password" name="password" placeholder="Password" minlength="4"> <br>
        <label for="country">Country:</label> <br>
        <select name="country" id="">
            <option value="Croatia">Croatia</option>
            <option value="Serbia">Serbia</option>
            <option value="Bosnia">Bosnia</option>
        </select> <br>
        <input type="submit" value="Submit" id="submit">
    </form>
</body>
</html>