<?php
    session_start();

    if(isset($_SESSION['username']))
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot Password</title>
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
    <h1>Forgot My Password</h1>
    <span style="font-size: 30px">Verify</span><img id="verify-ucheck1" src="./img/green-check.png" height="40" width="40" style="display: none"/>
    <div class="form-group row">    
        <div id="verify_user" class="col-xs-6">
            <form id="check_user" name="check_user" action="recover_password.php" method="POST">
                <label for="check_uname">Enter your username</label>
                <input type="text" name="check_uname" id="check_uname" class="form-control" placeholder="Username" maxlength="13" required/>
                <br><br>
                <label for="check_uemail">Enter your email</label>
                <input type="email" name="check_uemail" id="check_uemail" class="form-control" placeholder="Email" maxlength="30" required/>
                <br><br>
                <input type="submit" name="verify_user" id="verify_user" class="btn btn-primary" value="Verify User"/>
            </form>
        </div>
    </div>
    <br><br>
    <div id="verify_question" style="display: none">
        <span style="font-size: 30px">Security Question</span><img id="verify-ucheck2" src="./img/green-check.png" height="40" width="40" style="display: none"/>
        <br>
        <div class="form-group row">    
            <div id="verify_user" class="col-xs-6">
            <form id= "security_q" name="security_q" action="recover_password.php" method="POST">
                <p id="usec_q"></p>
                <label for="sec_answer">Answer: </label>
                <input type="text" name="sec_answer" id="sec_answer" class="form-control" placeholder="Answer Here" maxlength="140" required/>
                <br><br>
                <input type="submit" name="sec_submit" id="sec_submit" class="btn btn-primary" value="Submit"/>
            </form>
            </div>
        </div>
    </div>
    <br>
    <div id="change_pass" style="display: none">
    <span style="font-size: 30px">Change Password</span><img id="verify-ucheck3" src="./img/green-check.png" height="40" width="40" style="display: none"/>
    <br><br>
        <div class="form-group row">    
            <div id="verify_user" class="col-xs-6">
                <form name="recover_pass" id="recover_pass" action="recover_password.php" method="POST">
                    <label for="new_pass">New Password: </label>
                    <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Enter New Password" maxlength="13" required/>
                    <br><br>
                    <label for="confirm_new_pass">Confirm New Password: </label>
                    <input type="password" id="confirm_new_pass" name="confirm_new_pass" class="form-control" placeholder="Confirm New Password" maxlength="13" required/>
                    <br><br>
                    <input type="submit" id="change_password" class="btn btn-primary" value="Change Password"/>
                </form>
            </div>
        </div>
    </div>
    <br>
    <p id="redirect_alert" style="display: none">Password changed successfully. Redirecting to your profile<p>
</div>
</body>
<footer class="footer-white">
<br><br>
<bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</html>