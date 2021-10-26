<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
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
    <ul class="navbar-nav">
		<li class="nav-item tab">
            <a class="nav-color" href="register_user.php" id="profile-register">Register</a>
			<i class="fas fa-user-plus nav-color" id="profile-register-icon"></i>
        </li>	
        <li class="nav-item tab">
			<a class="nav-color" href="logout.php" id="log">Login</a>
			<i class="fas fa-sign-in-alt nav-color"></i>
        </li>
    </ul>
</nav>	


<?php
        require "db.php";

        //if logged in
        if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];

            $sql = "select name from users where username = '$username'";

            $query = mysqli_query($conn, $sql);

            if($query == TRUE)
            {
                $row = mysqli_fetch_assoc($query);

                $name = $row['name'];

				echo "<script>loggedStatus(1);</script>";
				echo "<script>profileStatus(1);</script>";
				echo "<div class='mainDiv w-100 p-3 restaurantBackground'>";
					echo "<div class='welcome'>";
						echo "<strong><p class='text-light text-center welcome p-5 border-shadow'>Welcome $name</p></strong>";
					echo "</div>";
					echo "<br>";
					echo "<div>";
						echo "<div class='text-center p-5 dropdown-content' id='dropdown'>";
							echo "<form id='search-main' name='search-main' action='search_restaurant.php' method='GET'>";
							echo "<input type='text' class='searchBar' id='res_sw' name='res_sw' placeholder='Search for resturants or cuisines...'>";
							echo "<div id='suggest' class='suggestDiv suggested-results'></div><br>";
							echo '&nbsp&nbsp&nbsp<input type="submit" class="btn btn-primary searchButton" name="search_res" value="Search"><br><br><br>';
							echo "</form>";
						echo "</div>";
					echo "</div>";
					echo "<br>";
					echo "<div class='row fullHeight p-5'>";
						echo "<article class='left'>";
						echo "<strong><p class='text-light ad border-shadow'>CHECK NOW<br><br>FOR EXCLUSIVE DEALS</p></strong>";
						echo "</article>";
					echo "</div>";
				echo "</div>";
            }
		}
		// if not logged in
        else
        {
			echo "<script>loggedStatus(0);</script>";
			echo "<script>profileStatus(0);</script>";
			echo "<div class='mainDiv w-100 p-3 restaurantBackground'>";
					echo "<div class='welcome'>";
						echo "<strong><p class='text-light text-center welcome p-5 border-shadow'>Welcome</p></strong>";
					echo "</div>";
					echo "<br>";
					echo "<div>";
						echo "<div class='text-center p-5 dropdown-content' id='dropdown'>";
							echo "<form id='search-main' name='search-main' action='search_restaurant.php' method='GET'>";
							echo "<input type='text' class='searchBar' id='res_sw' name='res_sw' placeholder='Search for resturants or cuisines...'>";
							echo "<div id='suggest' class='suggestDiv suggested-results'></div><br>";
							echo '&nbsp&nbsp&nbsp<input type="submit" class="btn btn-primary searchButton" name="search_res" value="Search"><br><br><br>';
							echo "</form>";
						echo "</div>";
					echo "</div>";
					echo "<br>";
					echo "<div class='row fullHeight p-5'>";
						echo "<article class='left'>";
						echo "<strong><p class='text-light ad border-shadow'>SIGN UP NOW<br><br>FOR EXCLUSIVE DEALS</p></strong>"; 
							echo "<a href='register_user.php' class='btn btn-primary'><strong>REGISTER</strong></a>";
						echo "</article>";
					echo "</div>";
				echo "</div>";
        }

?>

<footer>
	<bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</body>
</html>