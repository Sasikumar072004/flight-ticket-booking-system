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


if (isset($_POST['source_date'])) {
    unset($_SESSION['source_date']);
}
if (isset($_POST['source_time'])) {
    unset($_SESSION['source_time']);
}
if (isset($_POST['dest_date'])) {
    unset($_SESSION['dest_date']);
}
if (isset($_POST['dest_time'])) {
    unset($_SESSION['dest_time']);
}
if (isset($_POST['dep_airport'])) {
    unset($_SESSION['dep_airport']);
}
if (isset($_POST['arr_airport'])) {
    unset($_SESSION['arr_airport']);
}
if (isset($_POST['flight_class'])) {
    unset($_SESSION['flight_class']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/booking-form.css" />
    <link rel="stylesheet" type="text/css" href="css/general.css">
</head>
<body>
    <header>
    </header>
    <nav>
        <a class="logo" href="index.php"> <img src="images\ftbs.jpeg" alt="site-logo"> </a>
        <?php include('navOptions/nav.php') ?>
    </nav>
    <div class="container mt-5" style="margin-top: 150px;">
        <div class="left-column">
            <img class="booking-img" src="images/flight-booking.jpg" alt="booking image" width="150" height="150">
        </div>
        <div class="right-column">
            <h3>Flight Booking</h3>
            <form method="POST" action="available-flights.php">
                <div class="form-group">
                    <label for="source">Departure</label>
                    <input type="date" name="source_date" class="form-control" required>
                    <input type="time" name="source_time" class="form-control mt-2" required>
                </div>

                <div class="form-group">
                    <label for="dest">Arrival</label>
                    <input type="date" name="dest_date" class="form-control" required>
                    <input type="time" name="dest_time" class="form-control mt-2" required>
                </div>

                <div class="form-group">
                    <label for="dep_airport">From</label>
                    <select name="dep_airport" class="form-control" required>
                        <option value="" disabled selected>Select Departure Airport</option>

                        <?php
                        include('connection.php');

                        // Construct the SQL query to select all airport names
                        $sql = 'SELECT airport_name FROM airport';

                        // Execute the SQL query
                        $result = mysqli_query($con, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Loop through the results and create an option for each airport
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['airport_name'] . '">' . $row['airport_name'] . '</option>';
                            }
                        } else {
                            // Handle the case where the query fails
                            echo '<option value="" disabled selected>Unable to fetch airport data</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="arr_airport">To</label>
                    <select name="arr_airport" class="form-control" required>
                        <option value="" disabled selected>Select Arrival Airport</option>

                        <?php
                        include('connection.php');

                        // Construct the SQL query to select all airport names
                        $sql = 'SELECT airport_name FROM airport';

                        // Execute the SQL query
                        $result = mysqli_query($con, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Loop through the results and create an option for each airport
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['airport_name'] . '">' . $row['airport_name'] . '</option>';
                            }
                        } else {
                            // Handle the case where the query fails
                            echo '<option value="" disabled selected>Unable to fetch airport data</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="flight_class">Flight Class</label>
                    <select name="flight_class" class="form-control" required>
                        <option value="" disabled selected>Select Flight Class</option>
                        <option value="Economy">Economy</option>
                        <option value="Business">Business</option>
                        <option value="First Class">First Class</option>
                    </select>
                </div>

                <!-- Add the airline_name Name field here -->
                <div class="form-group">
                    <label for="airline">Airline Name</label>
                    <select name="airline_name" class="form-control">
                        <option value="" selected>Select Airline Name (Optional)</option>
                        <?php
                        include('connection.php');

                        // Construct the SQL query to select all airline names
                        $sql = 'SELECT airline_name FROM airline';

                        // Execute the SQL query
                        $result = mysqli_query($con, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Loop through the results and create an option for each airline
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['airline_name'] . '">' . $row['airline_name'] . '</option>';
                            }
                        } else {
                            // Handle the case where the query fails
                            echo '<option value="" disabled selected>Unable to fetch airline data</option>';
                        }
                        ?>
                    </select>
                </div>
                <!-- End of Airline Name field -->

                <!-- Add a Flight Search button -->
                <button name="search_flight" type="submit" class="btn btn-primary">Search Flights</button>
            </form>

            <?php
            if (!isset($_SESSION['user_type'])) {
                echo '<br><h6><p>Please <a href = "login.php"> login</a> first to book a ticket</p></h6>';
            }
            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'admin' or $_SESSION['user_type'] == 'airline')) {
                echo '<br><h6><p>Login as a customer to book a ticket</p></h6>';
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
            <p>&copy 2024 Flight ticket booking system, all right reserved</p>
        <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    </footer>
</body>
</html>

