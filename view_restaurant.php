<?php
    session_start();

    if(!(isset($_GET['resid'])))
    {
        header("Location: http://localhost/WebDev2/home.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    <?php
            require_once "db.php";

            require_once "data_clean.php";

            $id = clean_data($_GET['resid']);

            $id = mysqli_real_escape_string($conn, $id);

            $sql = "select * from restaurant where restaurant_id = '$id'";
        
            $query = mysqli_query($conn, $sql);
            
            if($query == TRUE)
            {
            $row = mysqli_fetch_assoc($query);
                    
            if($row > 0)
            {
                echo $row['res_name'];
            }
        }
    ?>
    </title>
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
            <a class="nav-color" href="my_profile.php" id="profile-register">Your Profile</a>
			<i class="fas fa-user-alt nav-color" id="profile-register-icon"></i>
        </li>
        <li class="nav-item tab">
			<a class="nav-color" href="logout.php" id="log">Logout</a>
			<i class="fas fa-sign-in-alt nav-color"></i>
        </li>
    </ul>
</nav>

<?php

require_once "db.php";

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

<div class="container-fluid">
    <div class="row" id="profile">
        <div class="col-sm-4">
            <article>
            <?php
                require_once "db.php";

                require_once "data_clean.php";

                $id = clean_data($_GET['resid']);

                $id = mysqli_real_escape_string($conn, $id);

                $sql = "select * from restaurant where restaurant_id = '$id'";
        
                $query = mysqli_query($conn, $sql);
            
                if($query == TRUE)
                {
                    $row = mysqli_fetch_assoc($query);
                    
                    if($row > 0)
                    {
                        echo "<br><h1>" . $row['res_name'] ."</h1>";
                        echo "<br>";
                        echo "<img src='./img/" . $row['res_image'] . "' class='profilePicture'>";
                        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
                        echo "<p><span style='font-weight: bold'>Cuisine: </span><a href='#'>" . $row['cuisine'] . "</p></a>";
                        echo "<p><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                        ", " . $row['city'] . ", " . $row['country'] . "</p>";
                        echo "<p><span style='font-weight: bold'>Phone: </span>" . $row['phone'] . "</p>";
                        echo "<p><span style='font-weight: bold'>Reservations: </span>" . $row['reservation'] . "</p>";

                        if($row['website'] != null)
                        {
                            echo "<p><span style='font-weight: bold'>Website: </span>" . $row['website'] . "</p>";
                        }
 
                        if (isset($_SESSION['username']))
                        {
                            $username = $_SESSION['username'];
                            
                            echo "<a type='button' class='btn btn-primary' href='http://localhost/WebDev2/write_review.php?resid=$id'>Write a review</a><br>";

                            $sql = "select * from favourites where (favourites.username = '$username' and favourites.restaurant_id = '$id')";

                            $query = mysqli_query($conn, $sql);

                            if($query == TRUE)
                            {
                                $num = mysqli_num_rows($query);

                                if($num == 0)
                                {
                                    echo "<br><input id='fav-button' class='btn btn-primary' type='button' value='Add to Favourites'></input>";
                                    
                                }
                                else
                                {
                                    echo "<br><input id='fav-button' class='btn btn-primary' type='button' value='Remove from Favourites'></input>";
                                 
                                }
                                echo 
                                "<script type='text/javascript'>
                                    $(document).ready(function()
                                    {
                                        //Remove from favourites
                                        $('#fav-button').click(function(e)
                                        {
                                            var fav_val = $('#fav-button').val();
                                            console.log(fav_val);
                                            if(fav_val === 'Add to Favourites')
                                            {
                                                $.ajax
                                                ({
                                                    type: 'POST',
                                                    url: 'add_to_fav.php',
                                                    data: { resid: '" . $id . "' },
                                                    success: function(ret)
                                                    {
                                                        if(ret === 'success')
                                                        {
                                                            alert('Restaurant added your favourites');
                                                            $('#fav-button').prop('value', 'Remove from Favourites');

                                                        }
                                                        else
                                                        {
                                                            alert('Error: Could not add to your favourites '+ret);

                                                        }
                                                    },
                                                    error: function(xhr, textStatus, errorThrown)
                                                    {
                                                        alert('An error as occured: '+textStatus+': '+errorThrown);
                                                    }
                                                        
                                                });
                                            }

                                            if(fav_val === 'Remove from Favourites')
                                            {
                                                $.ajax
                                                ({
                                                    type: 'POST',
                                                    url: 'remove_from_fav.php',
                                                    data: { resid: '" . $id . "' },
                                                    success: function(ret)
                                                    {
                                                        if(ret === 'success')
                                                        {
                                                            alert('Restaurant removed from your favourites');
                                                            $('#fav-button').prop('value', 'Add to Favourites');
                                                            
                                                        }
                                                        else
                                                        {
                                                            alert('Error: Could not remove to your favourites: '+ret);

                                                        }
                                                    },
                                                    error: function(xhr, textStatus, errorThrown)
                                                    {
                                                        alert('An error as occured: '+textStatus+': '+errorThrown);
                                                    }
                                                        
                                                });

                                            }

                                    
                                        });
                                    });
                                </script>";

                            }

                        }
                        else
                        {
                            $CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $send_url = 'http://' . $CurPageURL;
                            
                            echo "<br><a href='http://localhost/WebDev2/set_redirect.php?func=log_to_rev&surl=$send_url'>
                            <button type='button' class='btn btn-primary'>Login to review</button></a>";
                                           
                        }

                        echo "<br>";

                    }
                    else
                    {
                        header("Location: http://localhost/WebDev2/home.php");
                    }

                }
                
            ?>
            </article>
        </div>
        <div class="col-sm-5">
        <article><br>
                <h2>Reviews</h2><br>
                <?php
					
                    $sql = "select username, name, title, description, rev_date FROM reviews
                    join users USING(username) 
                    where (reviews.restaurant_id = '$id') LIMIT 10";
                    
                    $query = mysqli_query($conn, $sql);
                    
                    $num = mysqli_num_rows($query);
                    
                    if($num > 0)
                    {
        
                        echo "<table id='review_table' class='table'>";
                        
                        while($row = mysqli_fetch_assoc($query))
                        {
                            $review_date = date("d-m-Y", strtotime($row['rev_date']));
        
                            echo "<tr><td><br>" . $row['title'] . " " . $review_date . "<br>";
                            echo "<a href='http://localhost/WebDev2/view_uprofile.php?usrid=" . $row['username'] . "'>" . $row['name'] . "</a><br>";
                            echo  $row['description'] . "<br>";
                            echo "</td></tr>";

                        }

                        echo "<tr><td></td></tr>";
                        echo "</table>";
                        
                    }
        
                    mysqli_close($conn);
        
                ?>
            </article>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</body>
<footer>
    <br><br><br>
    <bold>© 2019 PLEY LLC. ALL RIGHTS RESERVED.</bold> 
</footer>
</html>