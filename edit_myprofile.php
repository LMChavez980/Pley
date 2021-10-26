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
<head>
<title>Edit Profile</title>
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
            <a class="nav-color" href="my_profile.php">Your Profile</a>
			<i class="fas fa-user-alt nav-color"></i>
        </li>
        <li class="nav-item tab">
			<a class="nav-color" href="logout.php" id="log">Logout</a>
			<i class="fas fa-sign-in-alt nav-color"></i>
        </li>
    </ul>
</nav>
<br><br>
<div class="container rounded-corner">
    <p class="headerText"><strong>EDIT PROFILE</strong></p>

    <br>
    <h>Change Profile Picture</h>&nbsp;&nbsp;&nbsp;&nbsp;<button type="input" class="btn btn-primary" id="picture_arrow" onclick="dropdownPicture()">
    <i class="fas fa-arrow-up" id="arrow_picture"></i></button>
    <br><br><br>
    <div id="change_upic" style="display: none">
        <form name="change_profile_pic" id="change_profile_pic" action="change_details.php" method="POST">
            <label for="new_profile_picture">Choose A Profile Picture: </label>
            <input id="new_profile_picture" name="new_profile_picture" type="file"accept="image/png, image/jpeg"/>
            <br><br>
            <input type="submit" id="change_picture" class="btn btn-primary" value="Apply Changes"/>
        </form>
    </div>
    <br><br>
    <h>Change Password</h>&nbsp;&nbsp;&nbsp;&nbsp;<button type="input" class="btn btn-primary" id="password_arrow" value="Arrow Down" onclick="dropdownPassword()">
    <i class="fas fa-arrow-up" id="arrow_password"></i></button>
    <br><br><br>
    <div id="change_upass" style="display: none" class="form-group row">
        <div class="col-xs-3">
        <form name="change_profile_pass" id="change_profile_pass" action="change_details.php" method="POST">
            <label for="new_pass">New Password: </label>
            <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Enter New Password" maxlength="13" required/>
            <br><br>
            <label for="confirm_new_pass">Confirm New Password: </label>
            <input type="password" id="confirm_new_pass" name="confirm_new_pass" class="form-control" placeholder="Confirm New Password" maxlength="13" required/>
            <br><br>
            <input type="submit" id="change_password" class="btn btn-primary" value="Apply Changes"/>
        </form>
        </div>
    </div>
    <br><br>
    <h>Change Personal Information</h>&nbsp;&nbsp;&nbsp;&nbsp;<button type="input" class="btn btn-primary" id="personal_arrow" value="Arrow Down" onclick="dropdownPersonal()">
    <i class="fas fa-arrow-up" id="arrow_personal"></i></button>    
    <br><br><br>
    <div id="change_personal" style="display: none" class="form-group row">
        <?php
            require_once "db.php";

            $username = $_SESSION['username'];

            $sql = "select * from users where username = '$username'";

            $query = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($query);

        ?>  
            <div class="col-xs-4">
            <form name="change_profile_info" id="change_profile_info" action="change_details.php" method="POST">
                <label id="name_label" for="new_name">Name: <?php echo $row['name'] ?> </label>
                <input type="text" name="new_name" id="new_name" class="form-control" placeholder="Enter New Name" maxlength="25"/>
                <br><br>
                <label id="email_label" for="new_email">Email: <?php echo $row['email'] ?></label>
                <input type="email" name="new_email" id="new_email" class="form-control" placeholder="Enter New Email" maxlength="30"/>
                <br><br>
                <label id="location_label" for="new_city">Location: <?php echo $row['city'] . ", " . $row['country'] ?></label>
                <input type="text" name="new_city" id="new_city" class="form-control" placeholder="Enter New City" maxlength="30"/>
                <br>
                <input type="text" name="new_country" id="new_country" class="form-control" placeholder="Enter New Country" maxlength="30"/>
                <br><br>
                <input type="submit" name="change_info" id="change_info" class="btn btn-primary" value="Apply Changes"/>
            </form>
            </div>
    </div>
    <footer>
    <br><br><br><br>
    <bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold>
    </footer>
</div>
</body>
</html>