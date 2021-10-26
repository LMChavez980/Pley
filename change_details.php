<?php
    session_start();

    require_once "db.php";

    if(!(isset($_SESSION['username'])))
    {
        header("Location: http://localhost/WebDev2/home.php");
    }
    else
    {
        $username = $_SESSION['username'];
        //if changing profile picture
        if(isset($_POST['new_profile_picture']) && isset($_POST['change_picture']))
        {
            $stmt = $conn->prepare("UPDATE users SET user_pic = ? WHERE username = ?");
            $stmt->bind_param("ss", $_POST['new_profile_picture'], $_SESSION['username']);
            $stmt->execute();

            if($stmt->affected_rows === 0)
            {
                echo "fail";
            }
            else
            {
                echo "success";
            }

            $stmt->close();

        }//if changing password
        elseif(isset($_POST['new_pass']) && isset($_POST['change_password']))
        {
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $_POST['new_pass'], $_SESSION['username']);
            $stmt->execute();

            if($stmt->affected_rows === 0)
            {
                echo "fail";
            }
            else
            {
                echo "success";
            }

            $stmt->close();
        }//if changing personal info
        elseif(isset($_POST['change_info']))
        {
            $new_name = $_POST['new_name'];
            
            $new_email = $_POST['new_email'];
            $new_city = $_POST['new_city'];
            $new_country = $_POST['new_country'];

            $sql = "SELECT name, email, city, country from users WHERE username = '$username'";

            $query = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($query);

            //Check if email is blank then fill in with current value
            if($new_email == "")
            {
                $new_email = $row['email'];
            }
            elseif(!(filter_var($new_email, FILTER_VALIDATE_EMAIL)))
            {
                echo "Invalid Email Entered";
                mysqli_close($conn);
                exit();
            }

            //Check if name is blank then fill in with current value
            if($new_name == "")
            {
                $new_name = $row['name'];
            }

            //Check if city is blank then fill in with current value
            if($new_city == "")
            {
                $new_city = $row['city'];
            }

            //Check if country is blank then fill in with current value
            if($new_country == "")
            {
                $new_country = $row['country'];
            }

            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, city = ?, country = ? WHERE username = ?");
            $stmt->bind_param("sssss", $new_name, $new_email, $new_city, $new_country, $username);
            $stmt->execute();

            if($stmt->affected_rows === 0)
            {
                echo "Received invalid input \n- Please fill in at least one of the fields";
            }
            else
            {
                echo "success";
            }

            $stmt->close();


        }

    }

    mysqli_close($conn);

?>