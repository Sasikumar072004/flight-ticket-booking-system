<?php require_once 'includes/header.php'; ?>
<?php require ('includes/showMessage.php'); ?>
<?php 
    // if user try to access the signup page by typing the signup page url manyally while s/he is logged in,
    // then we can prevent it. S/he will be logged out if s/he try this. 
    //Since we didn't add an nav option to access the signup page then why s/he should access this? So we're restrciting him/ her. 
   if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header('location:logout.php');                                      
   }
?>
<div class="wrapper" style="background-image: url('images/signupback.jpg');">
    <div class="inner">
        <div class="image-holder">
            <img src="images/signupfront.jpg" alt="">
        </div>
        <form action="" method="POST">
            <h3>Customer Signup</h3>
            <div class="form-group">
                <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
                <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
                <span id="username_message"></span>
            </div>
            <div class="form-wrapper">
                <input type="text" name="username" placeholder="Username" class="form-control" id="username" required>
            </div>
            <div class="form-wrapper">
                <input type="email" name="email" placeholder="Email Address" class="form-control" required>
            </div>
            <div class="form-wrapper">
                <input type="number" name="phone" placeholder="Phone" class="form-control" required>
            </div>
            <div class="form-wrapper">
                <select name="gender" class="form-control" required>
                    <option value="" disabled selected>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
            </div>
            <div class="form-wrapper">
                <input type="password" name="password" placeholder="Password" class="form-control" id="password"
                    required>
                <span toggle="#password" class="password-toggle"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👀</span>
            </div>
            <div class="form-wrapper">
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control"
                    id="confirm-password" required>
                <span toggle="#confirm-password" class="password-toggle"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👀</span>
            </div>
            <div class="password-match-container" style="position: relative;">
                <div id="password-match-message" <div id="password-match-message"
                    style="color: red; font-size: smaller; position: absolute; margin-top: -5%;"></div>

            </div>
            <script src="js/tooglePass.js"></script>
            <script src="js/passwordMatching.js"></script>
            <button type="submit" name="submit">Register <i class="zmdi zmdi-arrow-right"></i></button>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    include('connection.php');

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password != $confirm_password) {
        $messageText = "Password don't match";
        echo '<script>var jsMessageText = "' . $messageText . '";</script>';
       
        exit();
    }
    // Check if the email or username already exist in the database
    $check_query = "SELECT * FROM customer WHERE email = '$email' OR customer_name = '$username'";
    $result = $con->query($check_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['email'] == $email) {
            $messageText = "Email already registered in the system, please login.";
        } else {
            $messageText = "Username is taken, Please choose a different username.";
        }

        echo '<script>var jsMessageText = "' . $messageText . '";</script>';
       
    } else {
        // SQL query to insert data into the customer table
        $insert_query = "INSERT INTO customer VALUES ('$first_name', '$last_name', '$username', '$email', $phone, '$gender', '$password')";

        // Execute the insert statement
        if (mysqli_query($con, $insert_query)) {
            $messageText = "Congrats! Successfully registered";
            echo '<script>var jsMessageText = "' . $messageText . '";</script>';
           
            echo '<meta http-equiv="refresh" content="3;url=login.php">'; // waiting for 3 seconds to showing the success message then redirecting.
            // Redirect after successful registration
            // header('location: index.php');
            // exit(); // Make sure to exit after the header() call
        } else {
            // Output an error message to the browser or log it
            echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
        }
    }

    // Close the connection
    $con->close();
}
?>
<?php include('includes/footer.php'); ?>