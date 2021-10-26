<?php

    session_start();

    if(!(isset($_SESSION['username'])))
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }

    if(isset($_GET['resid']))
    {
        $_SESSION['resid'] = $_GET['resid'];

    }
    else
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Write Review</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="restaurant.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/project.js"></script>
    <script src="js/pley.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
<ul class="navbar-nav mr-auto">
    <li class="nav-item title active">
        <a class="nav-link" href="home.php">PLEY</a>
    </li>
</ul>  
<ul class="navbar-nav mr-auto">
            <li class="nav-item tab">
                <a class="nav-color"><strong>WRITE A REVIEW</strong></a>
            </li>
        </ul> 
<ul class="navbar-nav">	
    <li class="nav-item tab">
        <a class="nav-color" href="my_profile.php" id="profile-register">Your Profile</a>
        <i class="fas fa-user-alt nav-color" id="profile-register-icon"></i>
    </li>
    <li class="nav-item tab">
        <a class="nav-color" href="logout.php" id="log">Logout</a>
        <i class="fas fa-sign-in-alt nav-color"></i>
    </li>
</ul>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <article><br>
            <form name="review_form" id="review_form" action="submit_review.php" action="POST">
                <input type="type" id="review_title" name="review_title" size="40" placeholder=" Title your review" maxlength="50" required></input>
                <br><br>
                <textarea rows="20" cols="50" id="review_desc" name="review_desc" placeholder=" Write your review here" maxlength="280" required></textarea>
                <br><br>
                <button type="submit" class="btn btn-primary" id="submit_review" name="submit_review">Submit Review</button>
            </form>
            </article>
        </div>

        <div class="col-sm-6">
        <article><br>
        <h2>Recent Reviews</h2>
            <?php

                require_once "db.php";

                require_once "data_clean.php";

                $id = clean_data($_GET['resid']);

                $id = mysqli_real_escape_string($conn, $id);

                $sql = "select username, name, title, description, rev_date FROM reviews
                join users USING(username) 
                where (reviews.restaurant_id = '$id') LIMIT 10";
                        
                $query = mysqli_query($conn, $sql);
                        
                $num = mysqli_num_rows($query);
                        
                if($num > 0)
                {
            
                    echo "<table id='review_table' class='table'>";
                            
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $review_date = date("d-m-Y", strtotime($row['rev_date']));

                        echo "<tr><td><br>" . $row['title'] . " " . $review_date . "<br>";
                        echo "<p> By: " . $row['name'] . "</p>";
                        echo  $row['description'] . "<br>";
                        echo "</td></tr>";

                    }

                    echo "<tr><td></td></tr>";
                    echo "</table>";
                            
                }
            
                mysqli_close($conn);
            
            ?>
        </article>
        </div>
    </div>
</div>
</body>
</html>