<?php
    session_start();

    require_once "db.php";

    require_once "data_clean.php";

    if(isset($_SESSION['apply_filter']) && isset($_SESSION['filter_location']) && isset($_SESSION['filter_cuisine']))
    {
        unset($_SESSION['apply_filter']);
        unset($_SESSION['filter_location']);
        unset($_SESSION['filter_cuisine']);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Results</title>
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
			<a class="nav-color" href="login.php" id="log">Logout</a>
			<i class="fas fa-sign-in-alt nav-color"></i>
        </li>
    </ul>
</nav>

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

<br>
<div class="container rounded-corner">
    <table>
    <div>
        <br>
        <form name="filter_by" id="filter_by" action="search_restaurant.php" method="GET">
            <input type="text" name="filter_location" value=""></input>
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
    <div class="all_res container">
    <?php

        //if pressed search
        if(isset($_GET['search_res']))
        {
            //Ensure properly searched
            if(isset($_GET['res_sw']) && $_GET['res_sw'] != "")
            {
                //clean data received/sent
                $sw_item = clean_data($_GET['res_sw']);
                $sw_item = mysqli_real_escape_string($conn, $sw_item);
                $_SESSION['res_sw'] = $sw_item;
                $sql = "select * from restaurant where res_name like
                '%$sw_item%' OR cuisine like '%$sw_item%' OR  address like '%$sw_item%' OR city like '%$sw_item%' OR country like '%$sw_item%' LIMIT 5";
                
            } //end if not empty search
            else
            {
                header("Location: http://localhost/WebDev2/home.php");
            }

        }//Check if filtering
        elseif(isset($_GET['apply_filter']))
        {
            //ensure both are set
            if(isset($_GET['filter_location']) && isset($_GET['filter_cuisine']))
            {
                $sw_item = $_SESSION['res_sw'];

                //clean data
                $location_filter = clean_data($_GET['filter_location']);
                $cuisine_filter = clean_data($_GET['filter_cuisine']);
    
                $location_filter = mysqli_real_escape_string($conn, $location_filter);
                $cuisine_filter = mysqli_real_escape_string($conn, $cuisine_filter);
    
                $_SESSION['apply_filter'] = $_GET['apply_filter'];
                $_SESSION['filter_location'] = $location_filter;
                $_SESSION['filter_cuisine'] = $cuisine_filter;

                //if both filters are filled in
                //if only the location filter filled in
                //if only the cuisine filter filled in
                if($location_filter != "" && $cuisine_filter != "")
                {
                    echo "<br>Searching for '". $cuisine_filter . "' restaurants in '" . $location_filter . "' related to '" . $sw_item . "' <br>";
                    //search restaurants with name related to user search who's cuisine is the filtered cuisine and with the filtered location
                    $sql = "select * from restaurant where (res_name like '%$sw_item%' AND (cuisine like '$cuisine_filter') 
                    AND (address like '%$location_filter%' OR city like '%$location_filter%' OR country like '%$location_filter%'))
                    LIMIT 5";
                }
                elseif($location_filter != "" && $cuisine_filter == "")
                {
                    echo "<br>Searching for restaurants in '" . $location_filter . "' related to '" . $sw_item . "' <br>";

                    //search restaurants with name or cuisine related to user search with the location filtered

                    $sql = "select * from restaurant where ((res_name like '%$sw_item%' OR cuisine like '%$sw_item%') AND
                    (address like '%$location_filter%' OR city like '%$location_filter%' OR country like '%$location_filter%'))
                    LIMIT 5";
            
                }
                elseif($location_filter == "" && $cuisine_filter != "")
                {
                    echo "<br>Searching for '". $cuisine_filter . "' restaurants related to '" . $sw_item . "' <br>";

                    //search restaurants with name or location related to user search who's cuisine is the filtered cuisine  
            
                    $sql = "select * from restaurant where ((res_name like '%$sw_item%' 
                    OR  address like '%$sw_item%' OR city like '%$sw_item%' OR country like '%$sw_item%') 
                    AND (cuisine like '$cuisine_filter')) LIMIT 5";
            
                }
        
            }
        }
        
        //echo $sql;

        $query = mysqli_query($conn, $sql);

        if($query == TRUE)
        {
            $r_count = mysqli_num_rows($query);

            echo "<br>Found " . $r_count . " results<br>";

            if($r_count > 0)
            {
                echo "<div>";
                echo "<br><table>";

                while($row = mysqli_fetch_assoc($query))
                {
                    echo "<tr>";
                    echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                    <img src='./img/" . $row['res_image'] . "' class='thumbnail'></a></td>";
                    echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                    <span style='font-weight: bold'>" . $row['res_name'] . "</span></a>";
                    echo "<br><span style='font-weight: bold'>Cuisine: </span>" . $row['cuisine'];
                    echo "<br><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                    ", " . $row['city'] . ", " . $row['country'];
                    echo "<br><span style='font-weight: bold'>Phone: </span>" . $row['phone'] . "<br></td></a>";
                    echo "</tr>";
                    
                } //end while

                echo "</table>";

            } //end if count

        } //end successful query

    ?>
    <br><br><br>
    <footer>
    <bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold>
    </footer>
    </div>
    <?php
        if($query == TRUE)
        {
            if($r_count >= 5)
            {
                echo "<input type='button' class='more_res' value='Show More'></input>";
            }
        }

        mysqli_close($conn);
    ?>
</div>
</body>
</html>