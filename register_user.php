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
    <title>Register</title>
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
			<a class="nav-color" href="login.php" id="log">Login</a>
			<i class="fas fa-sign-in-alt nav-color"></i>
        </li>
    </ul>
</nav>	
<br>
<div class="container rounded-corner">
	<form id="user_reg" name="user_reg" action="login.php" class="loginForm" method="POST">
		<fieldset class="register">
			<h1>REGISTER</h1>
			<p id="missingFields" name="missingFields">&nbsp&nbsp</p>

			<div class="form-group">
				<label for="username">Username: </label><br>
				<input type="text" id="reg_username" name="reg_username" placeholder="Max 13 chars." maxlength="13" size="13" class="form-control" required/>
				<br>
			</div>
			<div class="form-group">
				<label for="password">Password: </label><br>
				<input type="password" id="reg_password" name="reg_password" placeholder="Max 13 chars." maxlength="13" size="13" class="form-control" required/><br>
				<input type="checkbox" id="showPass"/>Show Password
				<br>
			</div>
			<div class="form-group">
				<label for="reg_sec_q">Security Question: </label><br>
				<select name="reg_sec_q" id="reg_sec_q">
					<option value="What was the name of your first pet?">What was the name of your first pet?</option>
					<option value="What is the maiden name of your mother?">What is the maiden name of your mother?</option>
					<option value="What is your favourite colour?">What is your favourite colour?</option>
					<option value="What is your favourite movie?">What is your favourite movie?</option>
					<option value="What is the name of your best friend?">What is the name of your best friend?</option>
				</select>
				<br>
			</div>
			<div class="form-group">
				<label for="reg_sec_ans">Security Question Answer: </label><br>
				<input type="text" id="reg_sec_ans" name="reg_sec_ans" placeholder="Answer" maxlength="30" size="30" class="form-control" required/>
				<br>
			</div>
			<div class="form-group">
				<label for="profile_img">(Optional) Choose A Profile Picture:</label><br>
				<input id="profile_img" name="profile_img" type="file"accept="image/png, image/jpeg"/>
				<br>
			</div>
			<div class="form-group">
				<label for="firstname">First Name: </label><br>
				<input type="text" id="reg_firstname" name="reg_firstname" placeholder="Firstname" maxlength="12" size="12" class="form-control" required/>
				<br>
			</div>
			<div class="form-group">
				<label for="lastname">Last Name: </label><br>
				<input type="text" id="reg_lastname" name="reg_lastname" placeholder="Lastname" maxlength="12" size="12" class="form-control" required/>
				<br>
			</div>
			<div class="form-group">
				<label for="email">Email: </label><br>
				<input type="email" id="reg_email" name="reg_email" placeholder="Email" maxlength="30" size="30" class="form-control" required/>
				<br>
			</div>
			<div class="form-group">
				<label for="city">City: </label><br>
				<input type="text" id="reg_city" name="reg_city" placeholder="City" maxlength="30" size="30" class="form-control" required/>
				<br>
			</div>
			<div class="form-group">
				<label for="country">Country: </label><br>
				<input type="text" id="reg_country" name="reg_country" placeholder="Country" maxlength="30" size="30" class="form-control" required/>
				<br>
			</div>
			<button type="submit" class="btn btn-primary" name="regis_submit" id="regis_submit">Register</button>
			<br><br><br><br>
            <p><a href="login.php" class="loginLink">Already have an account? Sign in here</a></p>
		</fieldset>
	</form>
</div>
<br>
</body>
<br><br><br>
<footer class="footer-white">
<bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</html>