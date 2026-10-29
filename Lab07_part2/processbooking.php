<?php
function sanitise_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["firstname"])) {
    $firstname = sanitise_input($_POST["firstname"]);
    $lastname = sanitise_input($_POST["lastname"]);
    $age = sanitise_input($_POST["age"]);
    $speciesCode = sanitise_input($_POST["species"]);
    $food = sanitise_input($_POST["food"]);
    $bookday = sanitise_input($_POST["bookday"]);
    $partysize = sanitise_input($_POST["partysize"]);

    $bookingText = "";

    if (isset($_POST["accom"])) {
        $bookingText .= "Accommodation";
    }

    if (isset($_POST["4day"])) {
        if ($bookingText != "") {
            $bookingText .= " and ";
        }
        $bookingText .= "4 Day Tour";
    }

    if (isset($_POST["10day"])) {
        if ($bookingText != "") {
            $bookingText .= " and ";
        }
        $bookingText .= "10 Day Tour";
    }

    if ($bookingText == "") {
        $bookingText = "no tours";
    }

    switch ($speciesCode) {
        case "M":
            $species = "Human";
            break;
        case "D":
            $species = "Dwarf";
            break;
        case "E":
            $species = "Elf";
            break;
        case "H":
            $species = "Hobbit";
            break;
        default:
            $species = "Unknown";
    }

    $err_msg = "";

    if (strlen($firstname) == 0) {
        $err_msg .= "<p>Error: Please enter your firstname.</p>";
    }

    if (strlen($lastname) == 0) {
        $err_msg .= "<p>Error: Please enter your lastname.</p>";
    }

    if ($err_msg == "") {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Booking Confirmation</title>
        </head>
        <body>
            <h1>Rohirrim Tour Booking Confirmation</h1>
            <p>
                Welcome <?php echo $firstname; ?> <?php echo $lastname; ?>!<br>
                You are now booked on <?php echo $bookingText; ?>.<br>
                Species: <?php echo $species; ?><br>
                Age: <?php echo $age; ?><br>
                Meal Preference: <?php echo $food; ?><br>
                Date: <?php echo $bookday; ?><br>
                Number of travellers: <?php echo $partysize; ?>
            </p>
        </body>
        </html>
        <?php
    } else {
        echo $err_msg;
        echo '<p><a href="register.html">Return to the booking form</a></p>';
    }
} else {
    echo '<p>Error: Please submit the booking form first.</p>';
    echo '<p><a href="register.html">Go to the booking form</a></p>';
}
?>