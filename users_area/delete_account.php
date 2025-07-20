<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <!-- Ensure Bootstrap CSS and JS are included -->
</head>
<body>
    <h3 class="mb-4">Delete Account</h3>
    <form id="deleteForm" action="" method="post">
        <input type="hidden" name="delete" value="0"> <!-- Hidden field to control deletion -->
        <div class="form-outline mb-4">
            <input type="button" class="btn btn-danger form-control w-50 m-auto" data-toggle="modal" data-target="#firstModal" value="Delete Account">
        </div>
        
        <!-- First Modal: Initial Confirmation -->
        <div class="modal fade" id="firstModal" tabindex="-1" role="dialog" aria-labelledby="firstModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="text-center">Are you sure you want to delete your account?</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#secondModal" data-dismiss="modal">Confirm</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Second Modal: Password Confirmation -->
        <div class="modal fade" id="secondModal" tabindex="-1" role="dialog" aria-labelledby="secondModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="text-center"><span class="text-warning">This Deletion cannot be undone! <br></span> Enter your password to confirm deletion:</h5>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Confirm Delete</button>
              </div>
            </div>
          </div>
        </div>
    </form>

    <script>
        document.getElementById('confirmDelete').addEventListener('click', function() {
            document.querySelector('#deleteForm input[name="delete"]').value = "1"; // Set the hidden input value to 1
            document.getElementById('deleteForm').submit(); // Submit the form
        });
    </script>
</body>
</html>
<?php
$username_session = $_SESSION['username'];

if (isset($_POST['delete']) && $_POST['delete'] == "1") {
    $user_password = $_POST['password'];

    // Retrieve the hashed password from the database
    $stmt = $con->prepare("SELECT user_password FROM user_table WHERE username = ?");
    $stmt->bind_param("s", $username_session);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($user_password, $hashed_password)) {
            $delete_query = $con->prepare("DELETE FROM user_table WHERE username = ?");
            $delete_query->bind_param("s", $username_session);
            $result = $delete_query->execute();
        
            if ($result) {
                session_destroy();
                echo "<script>alert('Account deleted successfully');</script>";
                echo "<script>window.location.href = '../index.php';</script>";
            } else {
                echo "<script>alert('Error deleting account');</script>";
            }
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href = 'profile.php?delete_account';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.location.href = 'profile.php';</script>";
    }
    $stmt->close();
}

if (isset($_POST['Cancel'])) {
    echo "<script>window.location.href = 'profile.php?delete_account.php';</script>";
}
?>
