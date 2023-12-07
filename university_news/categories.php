<?php
session_start();
include('connect.php');
$query = "SELECT * from category ORDER BY id";
$categories = mysqli_query($conn, $query);
$n = 0;
if (isset($_POST["ansubmit"])) {
    function valid($data)
    {
        $data = trim(stripslashes(htmlspecialchars($data)));
        return $data;
    }
    $answer = valid($_POST["answer"]);
    if ($answer == NULL) {
        echo "<script>window.alert('Please Enter something.');</script>";
    } else {
        $que = "";
        if ($_POST["nul"] == 0) {
            // There is an existing answer, so append the new answer and user
            $que = "UPDATE quans SET answer=CONCAT(answer, '<br>', '" . $answer . "', '<br><small>Replied By: @" . $_SESSION["user"] . "</small>'), answeredby=CONCAT(answeredby, ', @" . $_SESSION["user"] . "') WHERE question LIKE '%" . $_POST["question"] . "%'";
        } else {
            // No existing answer, just set the new answer and user
            $que = "UPDATE quans SET answer='" . $answer . " <br><small>Replied By: @" . $_SESSION["user"] . "</small>', answeredby = '@" . $_SESSION["user"] . "' WHERE question LIKE '%" . $_POST["question"] . "%'";
        }

        if (mysqli_query($conn, $que))
            echo "<style>#box0,.open{display: none;} #tb{display: block;}</style>";
        else
            header("Location: index.php");
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title> USIM News Forum by Irfan </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/material.css">
    <link type="text/css" rel="stylesheet" href="fonts/font.css">
    <link rel="icon" href="">
    <!-- Sripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> -->
    <script type="text/javascript" src="js/script.js"></script>

    <style>
        .or-separator {
            font-weight: normal;
            color: #777;
            /* other styles */
        }

        textarea {
            width: 300px;
            height: 50px;
            color: black;
            padding: 10px;
            margin: 5px 0 -14px;
        }

        .ans_sub {
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

        /* Center the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            /* You can adjust this value to control the width of the modal */
            max-width: 600px;
            /* Maximum width of the modal */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
        }

        /* Close button (X) */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: bold;
            color: black;
            cursor: pointer;
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

    <!-- content -->
    <div id="content">
        <h4>
            <a id="title-head" href="categories.php">News</a>
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") {
            ?>
                <button onclick="window.location.href='add_news.php'" class="btn btn-success">Add News</button>
            <?php
            }
            ?>
        </h4>
        <div id="box0" class="row text-center">
            <?php
            // Fetch the categories and their images from the database
            $query = "SELECT id, name, description, image_url FROM category ORDER BY id";
            $categories = mysqli_query($conn, $query);

            // Display each category with its image
            while ($category = mysqli_fetch_assoc($categories)) {
                $category_id = htmlspecialchars($category['id']);
                $category_name = htmlspecialchars($category['name']);
                $category_description = htmlspecialchars($category['description']);
                $category_image = htmlspecialchars($category['image_url']);
            ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100" style="background-image: url('<?php echo $category_image; ?>'); background-repeat: no-repeat; background-size: cover; position: relative;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; background-color: rgba(0, 0, 0, 0.5); padding: 5px;">
                                <?php echo $category_name; ?>
                            </h5>
                            <p class="card-text" style="color: white; background-color: rgba(0, 0, 0, 0.5); padding: 5px;"><?php echo $category_description; ?></p>
                        </div>
                        <a href="#" class="btn btn-primary view-more" data-category-id="<?php echo $category_id; ?>">View More</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="pop" id="tb">
            <center>
                <h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">😄</b>Thank You For Your Feedback.</h1>
            </center>
        </div>
        <center>
            <?php
            // Reset the data pointer in the result set
            mysqli_data_seek($categories, 0);
            // Now loop through categories again to display questions and answers
            while ($category = mysqli_fetch_assoc($categories)) {
                $category_id = htmlspecialchars($category['id']);
                $box_id = "box" . $category_id;

                // Fetch the questions and answers for this category
                $questions_query = "SELECT q.question, q.answer, q.askedby, q.answeredby FROM quans AS q INNER JOIN quacat AS r ON q.id = r.id WHERE r.id = '$category_id' LIMIT 8";
                $questions_result = mysqli_query($conn, $questions_query);
            ?>
                <div id="<?php echo $box_id; ?>" class="open">
                    <a href="">
                        <div id="close">X</div>
                    </a>
                    <div id="topic">
                        <?php
                        echo "<h2 id='topic-head'>";
                        $q = 'select name, description from category where id=' . $category_id;
                        $r = mysqli_query($conn, $q);

                        $d = mysqli_fetch_assoc($r);
                        echo $d['name'] . '</h2><p id="topic-desc">' . $d['description'] . "<br>Explore home page for more news.</p>";
                        ?>
                    </div>

                    <center>
                        <?php
                        $qu = "select q.question, q.answer, q.askedby, q.answeredby from quans as q, quacat as r, category as c where q.id=r.id and r.category=c.name and c.id='$category_id' Limit 8";
                        $re = mysqli_query($conn, $qu);
                        while ($da = mysqli_fetch_assoc($re)) {
                        ?>
                            <div id="qa-block">
                                <div class="question">
                                    <div id="Q"><?php echo $da['askedby'] ?>: </div>
                                    <?php echo $da['question'] . "<small id='sml'> </small>"; ?>
                                </div>
                                <div class="answer">
                                    <?php
                                    if ($da["answer"]) {
                                        $nul = 0;
                                        echo $da["answer"] . "</small>";
                                    } else {
                                        $nul = 1;
                                        echo "<em>*** Not Answered Yet ***</em>";
                                    }
                                    ?>
                                    <form id="f<?php echo $n; ?>" style="margin-bottom: -5px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                        <!-- <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..."></textarea> -->
                                        <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your comment..."></textarea>
                                        <input style="display: none;" name="question" value="<?php echo $da['question'] ?>">
                                        <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                        <input style="display: none;" name="preby" value="<?php echo $da['answeredby'] ?>">
                                        <input type="submit" name="ansubmit" value="Submit" class="btn btn-light" id="ar<?php echo $n; ?>">
                                    </form>
                                </div>
                            </div>
                        <?php $n++;
                        } ?>
                    </center>
                </div>
            <?php
            }
            ?>
        </center>
    </div>
    <!-- content -->

    <!-- Hidden modal container -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- Content to be displayed goes here -->
            <span class="close">&times;</span>
        </div>
    </div>


    <!-- Footer -->
    <div id="footer">
        &copy; 2023 &bull; News Forum by Irfan
    </div>

    <script>
        function show_submit(n) {
            console.log('clicked', n);
            $('#area' + n).show();
            $('#ar' + n).show();
            $('#f' + n).show();
        }

        $(document).ready(function() {
            $(document).on('click', 'a[id^="ans_b"]', function() {
                var n = $(this).attr('id').replace('ans_b', '');
                show_submit(n);
            });

            // Function to toggle visibility of question and answer content
            function toggleContent(categoryId) {
                var box = $('#box' + categoryId);
                var modal = $('#myModal');
                var modalContent = modal.find('.modal-content');

                if (box.hasClass('open')) {
                    // Show the modal
                    modalContent.html(box.html());
                    modal.css('display', 'block');
                } else {
                    // Hide the modal
                    modal.css('display', 'none');
                }
            }

            // Add click event handlers for "View More" buttons
            $('.view-more').click(function() {
                var categoryId = $(this).data('category-id');
                toggleContent(categoryId);
            });

            // Close the modal-like content when clicking the close button
            $('.close').click(function() {
                $('#myModal').css('display', 'none');
            });
        });
    </script>


</body>

</html>