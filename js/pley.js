//
// JAVASCRIPT CODE
//

var usernameField;
var passwordField;
var firstnameField;
var lastnameField;
var emailField;
var securityField;
var cityField;
var countryField;
var arrowPicture = 0;
var arrowPassword = 0;
var arrowPersonal = 0;

// Check if the fields are empty or not
function fieldCheck(field, border)
{
    // Fields are empty; highlight in red
    if(field == 0)
    {
        document.getElementById(border).style.borderColor = "red";
    }
    // Fields are not empty
    else
    {
        document.getElementById(border).style.borderColor = null;
    }
}


// Message to fill the missing required field
function popupMissingFields(field)
{
    if(field == 0)
    {
        
        document.getElementById("missingFields").innerHTML = "Please enter all the fields highlighted in red correctly";
        document.getElementById("missingFields").style.color = "red";
    }
    else 
    {
        document.getElementById("missingFields").innerHTML = null;
    }
}

// Validate the login form
function validateLogin()
{
    var usernameValue = document.forms["user_login"]["username"].value;
    var passwordValue = document.forms["user_login"]["password"].value;

    // If username field is empty
    if(usernameValue == "")
    {
        usernameField = 0;
        fieldCheck(usernameField, "username");
        popupMissingFields(usernameField);
    }
    // If the username is filled
    else
    {
        usernameField = 1;
        fieldCheck(usernameField, "username");
        popupMissingFields(usernameField);
        
    }


    // If password field is empty
    if(passwordValue == "")
    {
        passwordField = 0;
        fieldCheck(passwordField, "password");
        popupMissingFields(passwordField);
    }
    // If the password is filled
    else
    {
        passwordField = 1;
        fieldCheck(passwordField, "password");
        popupMissingFields(passwordField);
        
    }

    // Submit the form if all the fields are filled correctly
    if(usernameField == 1 && passwordField == 1)
    {
        return true;
    }
}

    
// Validate the register form
function validateRegister()
{
    var registerFormFilled = 0;
    var username = document.forms["user_reg"]["reg_username"].value;
    var password = document.forms["user_reg"]["reg_password"].value;
    var securityAnswer = document.forms["user_reg"]["reg_sec_ans"].value;
    var firstname = document.forms["user_reg"]["reg_firstname"].value;
    var lastname = document.forms["user_reg"]["reg_lastname"].value;
    var email = document.forms["user_reg"]["reg_email"].value;
    var city = document.forms["user_reg"]["reg_city"].value;
    var country = document.forms["user_reg"]["reg_country"].value;


    // If username field is empty
    if(username == "")
    {
        usernameField = 0;
        fieldCheck(usernameField, "reg_username");
        popupMissingFields(usernameField);
    }
    // If the username is not alphanumeric, and must be length 6 to 15
    else if(!username.match(/^[a-zA-z0-9]{6,15}$/))
    {
        alert("This is not the right username format\n"
             +"- Username must be 6 to 15 in length\n"
             +"- Username must not have any whitespaces\n"
             +"- Username must contain no special letters");
        usernameField = 0;
        fieldCheck(usernameField, "reg_username");
        popupMissingFields(usernameField);
    }
    // If the username is filled
    else
    {
        usernameField = 1;
        fieldCheck(usernameField, "reg_username");
        popupMissingFields(usernameField); 
    }

    
    // If password field is empty
    if(password == "")
    {
        passwordField = 0;
        fieldCheck(passwordField, "reg_password");
        popupMissingFields(passwordField);
    }
    // If the password is not alphanumeric, and must be length 6 to 15
    else if(!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/))
    {
        alert("This is not the right password format\n"
             +"- Password must be 8 letters minimum\n"
             +"- Password must contain at least one uppercase\n"
             +"- Password must contain at least one lowercase\n"
             +"- Password must not have any whitespaces \n"
             +"- Password must contain at least one number");
        passwordField = 0;
        fieldCheck(passwordField, "reg_password");
        popupMissingFields(passwordField);            
    }
    // If the password is filled
    else
    {
        passwordField = 1;
        fieldCheck(passwordField, "reg_password");
        popupMissingFields(passwordField);
    }

    // If security answer is empty
    if(securityAnswer == "")
    {
        securityField = 0;
        fieldCheck(securityField, "reg_sec_ans");
        popupMissingFields(securityField);
    }
    // If security answer is filled
    else
    {
        securityField = 1;
        fieldCheck(securityField, "reg_sec_ans");
        popupMissingFields(securityField);
    }


    // If first name is empty
    if(firstname == "")
    {
        firstnameField = 0;
        fieldCheck(firstnameField, "reg_firstname");
        popupMissingFields(firstnameField);
    }
    // If first name is filled
    else
    {
        firstnameField = 1;
        fieldCheck(firstnameField, "reg_firstname");
        popupMissingFields(firstnameField);
    }

    
    // If last name is empty
    if(lastname == "")
    {
        lastnameField = 0;
        fieldCheck(lastnameField, "reg_lastname");
        popupMissingFields(lastnameField);
    }
    // If last name is filled
    else
    {
        lastnameField = 1;
        fieldCheck(lastnameField, "reg_lastname");
        popupMissingFields(lastnameField);
    }


    // If the email field is empty
    if(email == "")
    {
        emailField = 0;
        fieldCheck(emailField, "reg_email");
        popupMissingFields(emailField);
    }
    // If the email is filled
    else
    {
        emailField = 1;
        fieldCheck(emailField, "reg_email");
        p
        opupMissingFields(emailField);
    }

    // If the city field is empty
    if(city == "")
    {
        cityField = 0;
        fieldCheck(cityField, "reg_city");
        popupMissingFields(cityField);
    }
    // If the city is filled
    else
    {
        cityField = 1;
        fieldCheck(cityField, "reg_city");
        popupMissingFields(cityField);
    }


    // If the country field is empty
    if(country == "")
    {
        countryField = 0;
        fieldCheck(countryField, "reg_country");
        popupMissingFields(countryField);
    }
    else
    {
        countryField = 1;
        fieldCheck(countryField, "reg_country");
        popupMissingFields(countryField);
    }

    registerFormFilled = usernameField + passwordField + firstnameField + lastnameField + emailField + cityField + countryField + securityField;
    
    if(registerFormFilled == 8)
    {   
        return true;    
    }
    else
    {
        return false;
    }
}

// Changes the login/logout tab based on the users login status
function loggedStatus(status)
{
    // if user is logged in
    if(status == 1)
    {
        document.getElementById("log").innerHTML = "Logout";
        document.getElementById("log").setAttribute("href", "logout.php");
    }
    // if user is logged out
    else if(status == 0)
    {
        document.getElementById("log").innerHTML = "Login";
        document.getElementById("log").setAttribute("href", "login.php");
    }
}


// Changes the profile/register tab based on the users profile status
function profileStatus(status)
{
    // if user has a profile
    if(status == 1)
    {
        document.getElementById("profile-register").innerHTML = "Your Profile";
        document.getElementById("profile-register").setAttribute("href", "my_profile.php");
        document.getElementById("profile-register-icon").className = "fas fa-user-alt nav-color";
    }
    // if user does not have a profile
    else if(status == 0)
    {
        document.getElementById("profile-register").innerHTML = "Register";
        document.getElementById("profile-register").setAttribute("href", "register_user.php");
        document.getElementById("profile-register-icon").className = "fas fa-user-plus nav-color";
    }
}

// Submit button
function searchSubmit()
{
    document.getElementById('res_sw').submit();
}

// enable login button
function enableLogin()
{
    $("#login_submit").attr("disabled", false);
    $("#login_submit").text("Login");
}

// enable register button
function enableRegister()
{
    $("#regis_submit").attr("disabled", false);
    $("#regis_submit").text("Register");
}

// drop down icon
function dropdownPicture()
{
    if(arrowPicture == 0)
    {
        document.getElementById("arrow_picture").className = "fas fa-arrow-down";
        arrowPicture = 1;
    }
    else
    {
        document.getElementById("arrow_picture").className = "fas fa-arrow-up";
        arrowPicture = 0;
    }
} 

// drop down icon
function dropdownPassword()
{
    if(arrowPassword == 0)
    {
        document.getElementById("arrow_password").className = "fas fa-arrow-down";
        arrowPassword = 1;
    }
    else
    {
        document.getElementById("arrow_password").className = "fas fa-arrow-up";
        arrowPassword = 0;
    }
}

// drop downw icon
function dropdownPersonal()
{
    if(arrowPersonal == 0)
    {
        document.getElementById("arrow_personal").className = "fas fa-arrow-down";
        arrowPersonal = 1;
    }
    else
    {
        document.getElementById("arrow_personal").className = "fas fa-arrow-up";
        arrowPersonal = 0;
    }
}



$(document).ready(function() {
    // logging in animation
    $('#login_submit').click(function(){
    
        // if form is filled 
        if(validateLogin() == true)
        {
            // disable the button
            $("#login_submit").attr("disabled", true);
            $("#login_submit").text("Logging in ...");
            setTimeout(enableLogin, 1000);
            $("#login_submit").submit();
        }
    });
    

    // registering animation
    $('#regis_submit').click(function(){

        // if form is filled
        if(validateRegister() == true)
        {
            // disable the button
            $("#regis_submit").attr("disabled", true);
            $("#regis_submit").text("Registering ...");
            setTimeout(enableRegister, 1000);
            $("#regis_submit").submit();
        }
    });

  });