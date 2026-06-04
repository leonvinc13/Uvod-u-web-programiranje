<?php
$conn = mysqli_connect("localhost", "root", "", "users");
if (!$conn) {
    die("Greška pri spajanju na bazu: " . mysqli_connect_error());
}

$query = "SELECT users.firstname, users.lastname, countries.country_name FROM users inner join countries on users.country_code = countries.country_code";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vjezba 17</title>
</head>
<body>
    <h1>Korisnici</h1>
    <table>
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Država</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['country_name'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>