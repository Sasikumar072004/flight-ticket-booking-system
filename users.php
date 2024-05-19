<?php
session_start();
if (!isset($_SESSION['user_type'])) {
    header('location: login.php');
}
require_once('includes/showMessage.php');
require 'includes/functions.php';
displaySessionMessage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managing Users</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    
</head>

<body>
    <?php include('includes/admin-nav.php'); ?>

    <div class="container mt-5" style="max-width: 1024px;
    margin-left: 275px;">
        <h2>Admins</h2>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th >Name</th>
                    <th>Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connection.php");

                // user deletion code
                if (isset($_POST["confirm_delete_user"])) {
                    $deleteUserEmail = $_POST["delete_user_email"];

                    // Initialize the user type variable
                    $userType = '';

                    // Define the SQL queries to check which table the email exists in
                    $checkAdminSql = "SELECT * FROM admin WHERE email = '$deleteUserEmail'";
                    $checkCustomerSql = "SELECT * FROM customer WHERE email = '$deleteUserEmail'";
                    $checkAirlineSql = "SELECT * FROM airline WHERE email = '$deleteUserEmail'";

                    // Check if the email exists in the admin table
                    $resultAdmin = $con->query($checkAdminSql);
                    if ($resultAdmin->num_rows > 0) {
                        $userType = 'admin';
                        // Check the total number of admins in the database
                        $totalAdminSql = "SELECT COUNT(*) AS admin_count FROM admin";
                        $resultTotalAdmin = $con->query($totalAdminSql);

                        if ($resultTotalAdmin->fetch_assoc()['admin_count'] <= 1) {
                            setSessionMessage("At least one admin required");
                            header('location: users.php');
                            exit;
                        }

                    }

                    // Check if the email exists in the customer table
                    $resultCustomer = $con->query($checkCustomerSql);
                    if ($resultCustomer->num_rows > 0) {
                        $userType = 'customer';
                    }

                    // Check if the email exists in the airline table
                    $resultAirline = $con->query($checkAirlineSql);
                    if ($resultAirline->num_rows > 0) {
                        $userType = 'airline';
                    }

                    // If the user type is identified, proceed with deletion
                    if (!empty($userType)) {
                        // Define the SQL query based on the user type
                        $deleteSql = "DELETE FROM $userType WHERE email = '$deleteUserEmail'";

                        // Execute the SQL query
                        if ($con->query($deleteSql) === TRUE) {
                            setSessionMessage("User deleted successfully");
                        } else {
                            setSessionMessage("Error deleting user: " . $con->error, "error");
                        }
                    } else {
                        setSessionMessage("User not found", "error");
                    }

                    // Redirect to the current page to refresh the user list
                    header('location: users.php');
                }

                // Displaying users from admin table
                $sqlAdmins = "SELECT * FROM admin";
                $resultAdmins = $con->query($sqlAdmins);

                while ($rowAdmin = $resultAdmins->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-wrap'>" . $rowAdmin["admin_name"] . "</td>";
                    echo "<td class='text-wrap'>" . $rowAdmin["email"] . "</td>";
                    echo "<td class='text-center'  class='text-wrap'>";
                    echo "<button class='btn btn-danger btn-sm delete-user' data-email='" . $rowAdmin["email"] . "' data-toggle='modal' data-target='#deleteUserModal'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Delete User Form -->
        <form action="" method="POST">
            <input type="hidden" name="delete_user_email" id="delete_user_email" value="">
            <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
                aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteUserModalLabel">Confirm Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this admin?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="confirm_delete_user">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5"  style="  max-width: 1024px;
    margin-left: 275px;">
        <h2>Customers</h2>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Displaying users from customer table
                $sqlCustomers = "SELECT * FROM customer";
                $resultCustomers = $con->query($sqlCustomers);

                while ($rowCustomer = $resultCustomers->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-wrap'>" . $rowCustomer["customer_name"] . "</td>";
                    echo "<td  class='text-wrap'>" . $rowCustomer["email"] . "</td>";
                    echo "<td class='text-center'  class='text-wrap'>";
                    echo "<button class='btn btn-danger btn-sm delete-user' data-email='" . $rowCustomer["email"] . "' data-toggle='modal' data-target='#deleteUserModal'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5"  style="max-width:1024px;
    margin-left: 275px;";
        <h2>Airlines</h2>

        <table class="table table-striped">
            <thead  class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Displaying users from airline table
                $sqlAirlines = "SELECT * FROM airline";
                $resultAirlines = $con->query($sqlAirlines);

                while ($rowAirline = $resultAirlines->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td  class='text-wrap'>" . $rowAirline["airline_name"] . "</td>";
                    echo "<td  class='text-wrap'>" . $rowAirline["email"] . "</td>";
                    echo "<td class='text-center'  class='text-wrap'>";
                    echo "<button class='btn btn-danger btn-sm delete-user' data-email='" . $rowAirline["email"] . "' data-toggle='modal' data-target='#deleteUserModal'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to handle modals -->
    <script>
        // Click event handler for delete buttons
        $(document).on("click", ".delete-user", function () {
            var deleteUserEmail = $(this).data('email');
            $('#delete_user_email').val(deleteUserEmail);
        });
    </script>
</body>

</html>