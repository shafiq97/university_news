<?php
session_start();
include('connect.php');
// ... any PHP code needed for your logic ...

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
  <!-- Navigation bar from provided header -->
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

  <!-- Content -->
  <div id="content">
    <h2>News Dashboard</h2>
    <button onclick="window.location.href='add_news.php'" class="btn btn-primary" id="addNewsBtn">Add New News</button>

    <table id="newsTable" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Image URL</th> <!-- Added Image URL Column -->
        </tr>
      </thead>
      <tbody>
        <?php
        // Replace 'category' with the actual name of your table that contains the news
        $query = "SELECT * FROM category"; // Make sure to select the image_url column as well.
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Fetch each row and output table data
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            // Make sure your database has an 'image_url' column or adjust as necessary
            echo "<td><img src='" . htmlspecialchars($row['image_url']) . "' alt='News Image' height='50'></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No news found.</td></tr>";
        }
        ?>
      </tbody>
    </table>

  </div><!-- content -->

  <!-- Footer from provided footer -->
  <div id="footer">
    &copy; 2023 &bull; News Forum by Irfan
  </div>

  <!-- Bootstrap JS and other necessary scripts-->
  <!-- jQuery library -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- DataTables JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <!-- Initialize DataTables -->
  <script>
    $(document).ready(function() {
      $('#newsTable').DataTable();
    });
  </script>
  <!-- ... -->
</body>

</html>