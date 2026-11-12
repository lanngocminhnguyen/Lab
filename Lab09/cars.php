<?php
require_once "settings.php";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("<p>Unable to connect to the database.</p>");
}

mysqli_set_charset($conn, "utf8mb4");

$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car List</title>
</head>
<body>
    <h1>Car List</h1>

    <?php
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1' cellpadding='8'>";
            echo "<tr>";
            echo "<th>Car ID</th>";
            echo "<th>Make</th>";
            echo "<th>Model</th>";
            echo "<th>Price</th>";
            echo "<th>Year of Manufacture</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["car_id"] . "</td>";
                echo "<td>" . $row["make"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["yom"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>There are no cars to display.</p>";
        }

    } else {
        echo "<p>Something went wrong with the query.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>