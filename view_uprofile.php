<?php
    session_start();

    //if no username specified
    if(!(isset($_GET['usrid'])))
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }

    if(isset($_SESSION['username']))
    {
        //if the usernames are the same then go to user own profile
        if($_GET['usrid'] == $_SESSION['username'])
        {
            header("Location: http://localhost/WebDev2/my_profile.php");
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
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
        <li class="nav-item tab">
            <a class="nav-link nav-tab-color" href="cat_restaurants.php">Restaurants
			<i class="fas fa-utensils nav-color"></i>
			</a>
        </li>
        <li class="nav-item tab">
            <a class="nav-link nav-tab-color" href="contacts.php">Contacts
			<i class="fas fa-address-book nav-color"></i>	
			</a>
        </li>
    </ul>  
    <ul class="navbar-nav mr-auto">
                <li class="nav-item tab">
                    <form id='search-main' name='search-main' action='search_restaurant.php' method='GET'>
                    <input type='text' class='navSearch' id='res_sw' name='res_sw' placeholder='Search for resturants...'>
                    <input type="submit" class="btn btn-primary searchButton" name="search_res" value="Search">
                    </form>
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

<?php

require_once "db.php";

//if logged in
if(isset($_SESSION['username']))
{
    $username = $_SESSION['username'];

    $sql = "select name from users where username = '$username'";

    $query = mysqli_query($conn, $sql);

    if($query == TRUE)
    {
        echo "<script>loggedStatus(1);</script>";
        echo "<script>profileStatus(1);</script>";
    }
}
// if not logged in
else
{
    echo "<script>loggedStatus(0);</script>";
    echo "<script>profileStatus(0);</script>";
}
?>

<div class="container-fluid">
    <div class="row" id="profile">
        <div class="col-sm-3">
            <article>
                <?php
                    require_once "db.php";

                    require_once "data_clean.php";

                    //if logged in
                    $username = clean_data($_GET['usrid']);
            
                    $username = mysqli_real_escape_string($conn, $username);

                    $sql = "select * from users where username = '$username'";
            
                    $query = mysqli_query($conn, $sql);
            
                    if($query == TRUE)
                    {
                        $row = mysqli_fetch_assoc($query);

                        $newdate = date("d-m-Y", strtotime($row['date_joined']));
                        
                        echo "<br><h1>" . $row['name'] ."</h1>";
                        echo "<br>";
                        echo "<p><span style='font-weight: bold'>Image here</span></p>";
                        echo "<br>";
                        echo "<p><span style='font-weight: bold'>Date joined: </span>" . $newdate . "</p>";
                        echo "<br>";
                            
                    }
                ?>
            </article>  
        </div>
        <div class="col-sm-6">
            <article><br>
            <h2>Reviews</h2>
            <?php
                require "db.php";
                        
                $sql = "SELECT restaurant_id, restaurant.address, res_name, title, description, rev_date FROM restaurant
                join reviews USING(restaurant_id) 
                join users USING(username) 
                where (reviews.username = '$username')";
                
                $query = mysqli_query($conn, $sql);
                
                $num = mysqli_num_rows($query);
                
                if($num > 0)
                {

                    echo "<table class='table'>";
                    
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $review_date = date("d-m-Y", strtotime($row['rev_date']));

                        echo "<tr><td>";
                        echo "<a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . "'>" . $row['res_name'] . "</a>";
                        echo "<br>" . $row['address'] . "<br>";
                        echo "<br>" . $row['title'] . " " . $review_date . "<br>";
                        echo  $row['description'] . "<br>";
                        echo "</td></tr>";
                    }

                    echo "<tr><td></td></tr>";
                    echo "</table>";
                    
                }

                ?>
            </article>
        </div>
        <div class="col-sm-3">
        <article>
                <br><h2>Recent Favourites</h2>
                <?php
                            
                    $sql = "SELECT restaurant_id, res_name, restaurant.address, cuisine FROM restaurant
                    join favourites USING(restaurant_id) 
                    join users USING(username) 
                    where restaurant.restaurant_id = favourites.restaurant_id AND favourites.username = '$username'";
                    
                    $query = mysqli_query($conn, $sql);
                    
                    $num = mysqli_num_rows($query);
                    
                    if($num > 0)
                    {
                        echo "<table class='table'>";
                        
                        while($row = mysqli_fetch_assoc($query))
                        {
                            echo "<tr><td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . "'>";
                            echo  $row['res_name'] . "</a><br>";
                            echo  $row['address'] . "<br>";
                            echo  "Cuisine: " .$row['cuisine'] . "<br>";
                            echo "</td></tr>";
                        }
                        
                        echo "<tr><td></td></tr>";
                        echo "</table>";
                        
                    }

                ?>
        </article>
        </div>
    </div>
</div>
</body>
<footer>
<br><br><br>
<bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</html>