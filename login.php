<?php

    session_start();

    if(isset($_SESSION['username']))
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }

    require "db.php";

    require "data_clean.php";
                    
    if(isset($_POST['login_submit']))
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $username = clean_data($_POST['username']);
            $password = clean_data($_POST['password']);
                
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
        
            $sql = "select * from users where username = '$username' and password = '$password'";
                    
            $query = mysqli_query($conn, $sql);
                            
            if($row = mysqli_fetch_assoc($query))
            {
                $_SESSION['username'] = $username;
                    
                echo "success";
                    
            }
            else
            {
                echo "Incorrect password/username combination";
            }

            mysqli_close($conn);

            exit();
        }
    
    }

    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
    <ul class="navbar-nav">
        <li class="nav-item tab">
            <a class="nav-color" href="register_user.php">Register</a>
			<i class="fas fa-user-plus nav-color"></i>
        </li>
    </ul>
</nav>	
<br>
    <div class="container rounded-corner">
        <form id="user_login" name="user_login" action="login.php" class="loginForm" method="POST">
        <fieldset class="login">
		    <h1>LOGIN </h1>
            <p id="missingFields" name="missingFields">&nbsp&nbsp</p>
            <p id="logoutSuccess"></p>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" maxlength="15" size="20" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" maxlength="15" size="20" required/>
                </div>
                <button type="submit" class="btn btn-primary" name="login_submit" id="login_submit">Login</button>
                <br><br><br>
                <p><a href="register_user.php" class="registerLink">No account? Sign up now</a></p>
                <p><a href="forgot_password.php" class="loginLink">Forgot your password? Click here</a></p>
        </fieldset>
        </form>
    </div>
</body>
<br><br><br>
<footer class="footer-white">
<bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</html>
