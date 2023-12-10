<?php
session_start();
include "connect.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
$message = '';
// Fetch user details from the database
// PHP Code above here ...

// Fetch user details from the database
$userData = array();
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id']; // Assuming you store user ID in session after login
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        $message = "Error fetching user data: " . mysqli_error($conn);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // Additional fields
    $matrix_number = mysqli_real_escape_string($conn, $_POST['matrix_number']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $race = mysqli_real_escape_string($conn, $_POST['race']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $profile_pic = mysqli_real_escape_string($conn, $_POST['profile_pic']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Update query
    $query = "UPDATE users SET name='$name', email='$email', matrix_number='$matrix_number', faculty='$faculty', program='$program', gender='$gender', religion='$religion', address='$address', postcode='$postcode', district='$district', state='$state', race='$race', phone_number='$phone_number', profile_pic='$profile_pic', password='$password' WHERE id='" . $_SESSION['id'] . "'";

    // Execute query
    if (mysqli_query($conn, $query)) {
        header("Location: profile.php");
    } else {
        // Error handling
        // You can add an error message if you want
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Profile Update</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/icon1.png">
</head>

<body>

    <!-- Ensure your PHP block above is correctly fetching data before this HTML block -->
    <div class="container mt-4">
        <div class="col">
            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
            <h1 class="text-center">Profile Update for <?php echo htmlspecialchars($userData['username'] ?? ''); ?></h1>
        </div>
        <?php if (!empty($userData['profile_pic'])) : ?>
            <div class="text-center">
                <img src="<?php echo htmlspecialchars($userData['profile_pic']); ?>" alt="Profile Picture" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>
        <?php if ($message) : ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="matrix_number">Matrix Number:</label>
                <input type="text" class="form-control" id="matrix_number" name="matrix_number" value="<?php echo htmlspecialchars($userData['matrix_number'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="faculty">Faculty:</label>
                <input type="text" class="form-control" id="faculty" name="faculty" value="<?php echo htmlspecialchars($userData['faculty'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="program">Program:</label>
                <input type="text" class="form-control" id="program" name="program" value="<?php echo htmlspecialchars($userData['program'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" <?php echo (isset($userData['gender']) && $userData['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo (isset($userData['gender']) && $userData['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?php echo (isset($userData['gender']) && $userData['gender'] === 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="religion">Religion:</label>
                <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($userData['religion'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($userData['address'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo htmlspecialchars($userData['postcode'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" class="form-control" id="district" name="district" value="<?php echo htmlspecialchars($userData['district'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($userData['state'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="race">Race:</label>
                <input type="text" class="form-control" id="race" name="race" value="<?php echo htmlspecialchars($userData['race'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($userData['phone_number'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_pic">Profile Picture URL:</label>
                <input type="text" class="form-control" id="profile_pic" name="profile_pic" value="<?php echo htmlspecialchars($userData['profile_pic'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($userData['password'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

</body>

</html>