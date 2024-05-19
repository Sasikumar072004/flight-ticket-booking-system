<?php include('includes/header.php'); 
 require_once('includes/showMessage.php');
?>
<div class="container">
    <h2>Change Password</h2>
    <div class="form-and-image-container">
        <div class="image-container">
            <img src="images/changePassword.jpg" alt="Change Password Image">
        </div>
        <form action="change-password.php" method="POST" class="password-form">
            <div class="form-group">
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" id="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit" name="change_password">Change Password</button>
        </form>
    </div>
</div>

<?php

if (!isset($_SESSION['logged_in'])) {
    // Redirect $User who are not logged in to the login page
    header('Location: index.php');
    exit();
}

if (isset($_POST['change_password'])) {
    include('connection.php');

    // Get form data
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];
    $User = $_SESSION['user_type'];
    // Retrieve the user's current password from the database
    $query = "SELECT pass FROM $User WHERE email = '$email'";
    $result = $con->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $current_password = $row['pass'];

        // Verify the old password
        if ($old_password === $current_password) {
            // Check if the new password and confirmation match
            if ($new_password === $confirm_password) {
                // Update the password in the database
                $update_query = "UPDATE $User SET pass = '$new_password' WHERE email = '$email'";
                if ($con->query($update_query) === TRUE) {
                    $messageText = "Password changed successfully.";
                    echo '<script>var jsMessageText = "' . $messageText . '";</script>';
                    // echo '<meta http-equiv="refresh" content="2;url=customer-dashboard.php">';
                    echo '<meta http-equiv="refresh" content="2;url=' . $User . '-dashboard.php">'; // Redirect to the appropriate dashboard
                } else {
                    $messageText = "Error updating password: " . $con->error;
                    echo '<script>var jsMessageText = "' . $messageText . '";</script>';
                }
            } else {
                $messageText = "New password and confirmation do not match.";
                echo '<script>var jsMessageText = "' . $messageText . '";</script>';
            }
        } else {
            $messageText = "Old password is incorrect.";
            echo '<script>var jsMessageText = "' . $messageText . '";</script>';
        }
    } else {
        $messageText = "Something went wrong";
        echo '<script>var jsMessageText = "' . $messageText . '";</script>';
    }

    // Close the connection
    $con->close();
}
?>
<?php include('includes/footer.php'); ?>
