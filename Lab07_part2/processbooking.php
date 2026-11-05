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
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
        $err_msg .= "<p>Error: Firstname must contain only letters and spaces.</p>";
    }

    if (strlen($lastname) == 0) {
        $err_msg .= "<p>Error: Please enter your lastname.</p>";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
        $err_msg .= "<p>Error: Lastname must contain only letters and spaces.</p>";
    }

    
    if (!preg_match("/^[0-9]{1,3}$/", $age)) {
        $err_msg .= "<p>Error: Age must contain 1 to 3 digits.</p>";
    }

    
    if (!preg_match("/^[0-9]{1,2}$/", $partysize)) {
        $err_msg .= "<p>Error: Number of travellers must contain 1 to 2 digits.</p>";
    } elseif ((int)$partysize < 1) {
        $err_msg .= "<p>Error: Number of travellers must be at least 1.</p>";
    }

    
    if (!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $bookday)) {
        $err_msg .= "<p>Error: Date must use the format dd/mm/yyyy.</p>";
    } else {
        $dateParts = explode("/", $bookday);
        $day = (int)$dateParts[0];
        $month = (int)$dateParts[1];
        $year = (int)$dateParts[2];

        if (!checkdate($month, $day, $year)) {
            $err_msg .= "<p>Error: Please enter a valid date.</p>";
        }
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