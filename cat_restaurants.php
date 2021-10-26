<?php
    session_start();

    require_once "db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="restaurant.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/project.js"></script>
    <script src="js/pley.js"></script>
    </head>
<body class="restaurantBackground">
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item title active">
                    <a class="nav-link" href="home.php">PLEY</a>
                </li>
                <li class="nav-item tab">
                    <a class="nav-link nav-tab-color" href="#">Restaurants
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
                    <a class="nav-color" href="register_user.php" id="profile-register">Register</a>
                    <i class="fas fa-user-alt nav-color" id="profile-register-icon"></i>
                </li>
                <li class="nav-item tab">
                    <a class="nav-color" href="login.php" id="log">Login</a>
                    <i class="fas fa-sign-in-alt nav-color"></i>
                </li>
            </ul>
</nav><br>

<?php
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

<div class="container rounded-corner">
    <div
        ><br>
        <form name="filter_by" id="filter_by" action="cat_restaurants.php" method="GET">
            <label for="filter_location">Location: </label>
            <input type="text" name="filter_location" value=""></input>
            <label for="filter_cuisine">Cuisine: </label>
            <select name="filter_cuisine">
                <option value=""></option>
                <option value="American">American</option>
                <option value="Chinese">Chinese</option>
                <option value="Italian">Italian</option>
                <option value="Japanese">Japanese</option>
                <option value="Korean">Korean</option>
                <option value="Filipino">Filipino</option>
                <option value="Mexican">Mexican</option>
                <option value="Fusion">Fusion</option>
            </select>
            <input type="submit" name="apply_filter" class="btn btn-primary" value="Apply Filter"/>
        </form>
    </div>
    <div class="all_res">
    <?php

        $sql = "select * from restaurant";

        $query = mysqli_query($conn, $sql);

        if($query == TRUE)
        {
            $num = mysqli_num_rows($query);

            if($num > 0)
            {

                echo "<br><table>";

                if($num <= 5)
                {

                    for($i = 0; $i < $num; $i++)
                    {
                        $row = mysqli_fetch_assoc($query);
                        echo "<tr>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <img src='./img/" . $row['res_image'] . "' class='thumbnail'></a></td>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <span style='font-weight: bold'>" . $row['res_name'] . "</span></a>";
                        echo "<br><span style='font-weight: bold'>Cuisine: </span>" . $row['cuisine'];
                        echo "<br><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                        ", " . $row['city'] . ", " . $row['country'];
                        echo "<span style='font-weight: bold'>Phone: </span>" . $row['phone'] . "<br></td></a>";
                        echo "</tr>";
                    }

                }
                else
                {
                    $limit = 5;

                    echo "Showing " . $limit . " out of " . $num . " results";

                    for($i = 0; $i < $limit; $i++)
                    {
                        $row = mysqli_fetch_assoc($query);
                        echo "<tr>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <img src='./img/" . $row['res_image'] . "' height='100' width='100'></a></td>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <span style='font-weight: bold'><br>" . $row['res_name'] . "</span></a>";
                        echo "<br><span style='font-weight: bold'>Cuisine: </span>" . $row['cuisine'];
                        echo "<br><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                        ", " . $row['city'] . ", " . $row['country'];
                        echo "<br><span style='font-weight: bold'>Phone: </span>" . $row['phone'] . "</td></a>";
                        echo "</tr>";
                    }

                }

                echo "</table><br>";
            }
            else
            {
                echo "No restaurants found";
            }
        }
        else
        {
            echo "Uh oh! It seems like an error has occured";
        }

        mysqli_close($conn);

    ?>
    </div>
    <input type='button' class='more_res btn btn-primary' value='Show More'></input>
</div>
</body>
<footer class="footer-white">
    <br><br><br>
    <bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</html>