<?php
session_start();
require_once('includes/showMessage.php');
require 'includes/functions.php';
displaySessionMessage();

if (isset($_SESSION['user_type'])) {
    include("navOptions/customer-dashboard-nav-options.php");
} else {
    include("navOptions/index-nav-options.php");
}

include('connection.php');

if (isset($_POST['search_flight']) || (isset($_SESSION['source_date']) && isset($_SESSION['source_time']) && isset($_SESSION['dest_date']) && isset($_SESSION['dest_time']) && isset($_SESSION['dep_airport']) && isset($_SESSION['arr_airport']) && isset($_SESSION['flight_class']))) {

    if (isset($_POST['search_flight'])) {
        $_SESSION['source_date'] = $_POST['source_date'];
        $_SESSION['source_time'] = $_POST['source_time'];
        $_SESSION['dest_date'] = $_POST['dest_date'];
        $_SESSION['dest_time'] = $_POST['dest_time'];
        $_SESSION['dep_airport'] = $_POST['dep_airport'];
        $_SESSION['arr_airport'] = $_POST['arr_airport'];
        $_SESSION['flight_class'] = $_POST['flight_class'];
    }

    $source_date = $_SESSION['source_date'];
    $source_time = $_SESSION['source_time'];
    $dest_date = $_SESSION['dest_date'];
    $dest_time = $_SESSION['dest_time'];
    $dep_airport = $_SESSION['dep_airport'];
    $arr_airport = $_SESSION['arr_airport'];
    $flight_class = $_SESSION['flight_class'];

    // Combine date and time into a single datetime field for comparison
    $source_timestamp = strtotime("$source_date $source_time");
    $dest_timestamp = strtotime("$dest_date $dest_time");

    $sql = "SELECT f.*, 
                   (f.seats - IFNULL(b.booked_seats, 0)) AS available_seats
            FROM flight f
            LEFT JOIN (
                SELECT flight_id, COUNT(*) AS booked_seats
                FROM booked
                GROUP BY flight_id
            ) b ON f.id = b.flight_id
            WHERE f.dep_airport = '$dep_airport'
            AND f.arr_airport = '$arr_airport'
            AND f.flight_class = '$flight_class'
            AND CONCAT(f.source_date, ' ', f.source_time) >= '$source_timestamp'
            AND CONCAT(f.dest_date, ' ', f.dest_time) >= '$dest_timestamp'";

    if (!empty($_POST['airline_name'])) {
        $airline_name = $_POST['airline_name'];
        $sql .= " AND f.airline_name = '$airline_name'";
    }
    $sql .= " ORDER BY f.source_date, f.source_time ASC";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
    } else {
        $search_results = $result;
    }
}

if (isset($_POST["book_button"])) {
    if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'customer')) {
        $flightId = $_POST['flight_id']; // Retrieve the flight ID from the form
        $customer_email = $_SESSION['email'];

        // Check available seats by counting booked seats
        $availabilityQuery = "SELECT (seats - IFNULL(booked_seats, 0)) AS available_seats 
                              FROM flight 
                              LEFT JOIN (
                                  SELECT flight_id, COUNT(*) AS booked_seats
                                  FROM booked
                                  WHERE flight_id = $flightId
                              ) b ON flight.id = b.flight_id
                              WHERE flight.id = $flightId";
        $availabilityResult = mysqli_query($con, $availabilityQuery);

        if ($availabilityResult && ($availabilityRow = mysqli_fetch_assoc($availabilityResult))) {
            $availableSeats = $availabilityRow['available_seats'];

            if ($availableSeats > 0) {
                $query = "INSERT INTO booked (flight_id, customer_email) VALUES ('$flightId', '$customer_email')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    // Booking was successful
                    $message = "Payment successful!"; // Customize this message as needed
                    setSessionMessage($message);
					
                } else {
                    // Booking failed
                    $errorMessage = "Booking failed. Please try again later.";
                    setSessionMessage($errorMessage, 'error'); // Customize this message as needed
                }
            } else {
                // Insufficient seats
                $errorMessage = "Insufficient seats. Please select another flight.";
                setSessionMessage($errorMessage, 'error');
            }
        } else {
            // Error fetching availability
            echo "Error fetching seat availability: " . mysqli_error($con);
        }

        header('Location: available-flights.php');
        exit();
    } else {
        if (!isset($_SESSION['user_type'])) {
            $errorMessage = 'Please login first to book a ticket';
        }
        if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'admin' or $_SESSION['user_type'] == 'airline')) {
            $errorMessage = 'Please login as a customer to book a ticket';
        }

        setSessionMessage($errorMessage, 'Warning');
        header('Location: available-flights.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <title>Book Flights</title>
</head>
<body>
    <header>
        <!-- Header content goes here -->
    </header>
    <nav>
        <a class="logo" href="index.php"> <img src="images\ftbs.jpeg" alt="site-logo"> </a>
        <?php include('navOptions/nav.php'); ?>
</nav>

<div class="container mt-5" style="margin-top: 150px;">
    <div class="right-column">
        <?php
        if (isset($search_results) && mysqli_num_rows($search_results) > 0) {
            echo "<h3>Available Flights:</h3>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Departure Airport</th><th>Arrival Airport</th><th>Airline Name</th><th>Seats</th><th>Price</th><th>Book</th></tr></thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($search_results)) {
                echo "<form method='post' action='available-flights.php'>";
                echo "<tr>";
                echo "<td>{$row['dep_airport']}</td>";
                echo "<td>{$row['arr_airport']}</td>";
                echo "<td>{$row['airline_name']}</td>";
                echo "<td>{$row['available_seats']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<input type='hidden' name='flight_id' value='{$row['id']}'>"; // Add a hidden input for flight ID
                echo "<td><button type='submit' class='btn btn-primary' name='book_button'>Book</button></td>";
                echo "</tr>";
                echo "</form>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</form>";
            // Free the result set
            mysqli_free_result($search_results);
        } else {
            echo "<h3>No flight available</h3>";
        }
        ?>
    </div>
</div>

<footer>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="aboutUs.php#targeting-contact">Contact</a></li>
        <li><a href="booking-form.php">Services</a></li>
    </ul>
    <p>&copy; 2024 Flight ticket booking system, all rights reserved</p>
</footer>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const bookButtons = document.querySelectorAll("[name='book_button']");

        bookButtons.forEach(button => {
            button.addEventListener("click", function (event) {
                const flightId = event.target.getAttribute("data-flight-id");
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "flight_id";
                hiddenInput.value = flightId;
                event.target.closest("form").appendChild(hiddenInput);
            });
        });
    });
</script>




<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>


</body>

</html>