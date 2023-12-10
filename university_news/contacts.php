<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title> USIM News Forum </title>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/material.css">
    <link type="text/css" rel="stylesheet" href="fonts/font.css">
    <link rel="icon" href="images/icon1.png">
</head>

<body id="_4">
    <!-- navigation bar -->
    <a href="index.php">
        <div id="log">
            <div id="i">G</div>
            <div id="cir">G</div>
            <div id="ntro">USIM News Forum</div>
        </div>
    </a>
    <ul id="nav-bar">
        <!-- <a href="index.php">
            <li>Home</li>
        </a> -->

        <a href="contacts.php">
            <li id="home">Contact</li>
        </a>

        <?php
        if (!isset($_SESSION['user'])) {
        ?>
            <a href="login.php">
                <li>Log In</li>
            </a>
        <?php
        } else {
        ?>
            <a href="ask.php">
                <li>Ask Question</li>
            </a>
            <a href="index.php">
                <li>News</li>
            </a>
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
    <!-- content -->
    <div id="content" class="clearfix">

        <div id="box-1">
            <div class="heading">
                <center>
                    <h1 class="logo">
                        <div id="ntro">USIM News Forum</div>
                    </h1>
                    <p id="tag-line">Where the USIM community discusses the latest news and trends</p>
                </center>
            </div>
        </div>
        <div id="box-2">
            <div id="text">
                <h1>Irfan</h1>
                <p>
                    Contact 1<br>
                    Contact 2<br>
                    Social: <a href="USIM.com">contact3</a>
                </p>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div id="footer">
        &copy; 2023 &bull; Discussion Forum By Irfan
    </div>

</body>

</html>