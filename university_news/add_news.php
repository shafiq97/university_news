<?php
session_start();
include('connect.php');

// This PHP block would handle the form submission.
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Assign variables from posted data
  $news_title = mysqli_real_escape_string($conn, $_POST['news_title']);
  $news_description = mysqli_real_escape_string($conn, $_POST['news_description']);
  $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);

  // SQL query to insert the new news into the database
  $query = "INSERT INTO category (name, description, image_url) VALUES ('$news_title', '$news_description', '$image_url')";

  // Execute the query
  if (mysqli_query($conn, $query)) {
    // Redirect to news dashboard or display a success message
    header("Location: news.php");
    exit();
  } else {
    // Error handling
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <title> USIM News Forum by Irfan </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/material.css">
  <link type="text/css" rel="stylesheet" href="fonts/font.css">
  <link rel="icon" href="">
  <!-- Sripts -->
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <style>
    textarea {
      display: none;
      width: 300px;
      height: 50px;
      background: #333;
      color: #ddd;
      padding: 10px;
      margin: 5px 0 -14px;
    }

    .ans_sub {
      display: none;
      padding: 0 10px;
      height: 30px;
      line-height: 30px;
    }

    .pop {
      display: none;
      text-align: center;
      margin: 195.5px auto;
      font-size: 12px;
    }
  </style>
</head>

<body id="_3">
  <ul id="nav-bar">
    <a href="index.php">
      <li>Home</li>
    </a>
    <a href="categories.php">
      <li id="home">News</li>
      <a href="contacts.php">
        <li>Contact</li>
      </a>
      <a href="ask.php">
        <li>Ask Question</li>
      </a>
      <?php
      if (!isset($_SESSION['user'])) {
      ?>
        <a href="login.php">
          <li>Log In</li>
        </a>
        <a href="signup.php">
          <li>Sign Up</li>
        </a>
      <?php
      } else {
      ?>
        <a href="profile.php">
          <li>Hi, <?php echo $_SESSION["user"]; ?></li>
        </a>
        <a href="logout.php">
          <li>Log Out</li>
        </a>
      <?php
      }
      ?>
  </ul>
  <div id="content" class="container mt-5">
    <h2>Add News</h2>
    <form action="add_news.php" method="post">
      <div class="form-group">
        <label for="news_title">Title:</label>
        <input type="text" class="form-control" name="news_title" id="news_title" required>
      </div>
      <div class="form-group">
        <label for="news_description">Description:</label>
        <textarea class="form-control" name="news_description" id="news_description" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="image_url">Image URL:</label>
        <input type="text" class="form-control" name="image_url" id="image_url">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Add News</button>
    </form>
  </div>
</body>

</html>