<?php
// Check if the form is submitted
if(isset($_POST['submit'])){
    // Database connection details
    $db_host = "localhost"; // Assuming your database is hosted locally
    $db_user = "root"; // The default MySQL root user
    $db_pass = ""; // No password is set for the root user
    $db_name = "booking"; // Replace with your database name

    // Create a database connection
    $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check if the connection was successful
    if ($con->connect_error) {
        die("connection failed: " . $con->connect_error);
    }

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the email or username already exist in the database
    $check_query = "SELECT * FROM customer WHERE email = ? OR userName = ?";
    $check_stmt = $con->prepare($check_query);
    $check_stmt->bind_param("ss", $email, $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email or username already exists. Please choose a different email or username.";
    } else {
        // SQL query to insert data into the customer table
        $insert_query = "INSERT INTO customer (firstName, lastName, userName, email, phone, gender, pass, confirmPass) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind the insert statement
        $stmt = $con->prepare($insert_query);
        $stmt->bind_param("ssssisss", $first_name, $last_name, $username, $email, $phone, $gender, $password, $confirm_password);

        // Execute the insert statement
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $con->error;
        }

        // Close the insert statement
        $stmt->close();
    }

    // Close the check statement and connection
    $check_stmt->close();
    $con->close();
}
?>