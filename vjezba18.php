<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Vježba 18</title>
</head>
<body>

<div class="container mt-4">
    <h1>Users</h1>

<?php

$MySQL = mysqli_connect("localhost", "root", "", "users");

if (!$MySQL) {
    die("Greška pri spajanju: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['edit'])) {

    $firstname = mysqli_real_escape_string($MySQL, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($MySQL, $_POST['lastname']);
    $country_code = mysqli_real_escape_string($MySQL, $_POST['country_code']);

    $query = "
        UPDATE users
        SET firstname='$firstname',
            lastname='$lastname',
            country_code='$country_code'
        WHERE id=" . (int)$_GET['edit'];

    mysqli_query($MySQL, $query);

    echo '<div class="alert alert-success">
            Podaci su uspješno izmijenjeni!
          </div>';
}

if (isset($_GET['edit'])) {

    $query = "
        SELECT *
        FROM users
        WHERE id=" . (int)$_GET['edit'];

    $result = mysqli_query($MySQL, $query);
    $user = mysqli_fetch_assoc($result);

    ?>

    <a href="vjezba18.php" class="btn btn-secondary mb-3">BACK</a>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Ime</label>
            <input type="text"
                   name="firstname"
                   class="form-control"
                   value="<?= $user['firstname'] ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prezime</label>
            <input type="text"
                   name="lastname"
                   class="form-control"
                   value="<?= $user['lastname'] ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Država</label>

            <select name="country_code" class="form-control" required>

                <?php

                $countriesQuery = "SELECT * FROM countries ORDER BY country_name";
                $countriesResult = mysqli_query($MySQL, $countriesQuery);

                while ($country = mysqli_fetch_assoc($countriesResult)) {

                    $selected = ($country['country_code'] == $user['country_code'])
                        ? "selected"
                        : "";

                    echo "<option value='{$country['country_code']}' $selected>
                            {$country['country_name']}
                          </option>";
                }

                ?>

            </select>
        </div>

        <input type="submit"
               value="Spremi promjene"
               class="btn btn-primary">

    </form>

    <?php
}


else {

    $query = "
        SELECT users.id,
               users.firstname,
               users.lastname,
               countries.country_name
        FROM users
        INNER JOIN countries
        ON users.country_code = countries.country_code
        ORDER BY users.id";

    $result = mysqli_query($MySQL, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <p>
            <a href='vjezba18.php?edit={$row['id']}'>
                <i class='bi bi-pencil'></i>
            </a>

            {$row['firstname']}
            <span style='color:green'>{$row['lastname']}</span>
            <span style='color:blue'>{$row['country_name']}</span>
        </p>";
    }
}

mysqli_close($MySQL);

?>

</div>

</body>
</html>