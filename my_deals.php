<?php
    session_start();

    if(!(isset($_SESSION['username'])))
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<title>My Deals</title>
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
            <a class="nav-color" href="my_profile.php">Your Profile</a>
			<i class="fas fa-user-alt nav-color"></i>
        </li>
        <li class="nav-item tab">
			<a class="nav-color" href="logout.php" id="log">Logout</a>
			<i class="fas fa-sign-in-alt nav-color"></i>
        </li>
    </ul>
</nav>

<div class="container rounded-corner">
    <div class="row">
        <div class="col-sm-6">
            <article>
                    <?php
                        require_once "db.php";

                        //if logged in
                        $username = $_SESSION['username'];
                
                        $sql = "select * from users where username = '$username'";
                
                        $query = mysqli_query($conn, $sql);
                
                        if($query == TRUE)
                        {
                            $row = mysqli_fetch_assoc($query);

                            $newdate = date("d-m-Y", strtotime($row['date_joined']));
                
                            echo "<h1>" . $row['name'] ."</h1>";
                            echo "<br>";
                            echo "<p><span style='font-weight: bold'>Image here</span></p>";
                            echo "<br>";
                            echo "<p><span style='font-weight: bold'>Date joined: </span>" . $newdate . "</p>";
                            echo "<br><a href='edit_myprofile.php'><input type='button' class='btn btn-primary' value='Edit Profile'></input></a>";
                            echo "<br>";
                                
                        }
                    ?>
                </article>
        </div>
        <div class="col-sm-6">
                <article>
                    <h2>Deals</h2>
                    <div id="my_deals">
                    <?php
                        $sql = "select restaurant_id, res_name, start_date, end_date, description from users
                        JOIN favourites USING (username)
                        JOIN restaurant USING(restaurant_id)
                        JOIN deals USING (restaurant_id)
                        WHERE restaurant.restaurant_id = favourites.restaurant_id AND favourites.username = '$username'
                        ORDER BY start_date ASC LIMIT 2";

                        $query = mysqli_query($conn, $sql);

                        $num = mysqli_num_rows($query);
                            
                        if($num > 0)
                        {
                            echo "<table class='table'>";
                                
                            while($row = mysqli_fetch_assoc($query))
                            {
                                $deal_start =  date("d-m-Y", strtotime($row['start_date']));
                                $deal_end =  date("d-m-Y", strtotime($row['end_date']));

                                echo "<tr><td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . "'>";
                                echo  $row['res_name'] . "</a><br>";
                                echo  "Start: " . $deal_start . " Ends: " . $deal_end . "<br>";
                                echo  $row['description']. "<br>";
                                echo "</tr>";
                            }

                            echo "<tr><td></td></tr>";
                            echo "</table>";
                                
                        }
                        else
                        {
                            echo "No deals!<br>
                            Add restaurants to your favourites for access to exclusive deals!";
                        }

                    ?>
                    </div>
                    <?php
                        if($num > 1)
                        {
                            echo "<br><br><input type='button' id='more_deals' class='btn btn-primary' value='Load more deals'></input>";
                        }
                    ?>
                </article>
        </div>
    </div>
</div>
</body>
</html>