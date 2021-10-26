<?php

    session_start();

    require_once "db.php";

    if(isset($_POST['favsNewCount']))
    {
        $newcount = $_POST['favsNewCount'];

        $username = $_SESSION['username'];

        $sql = "SELECT restaurant_id, res_name, restaurant.address, cuisine FROM restaurant
        join favourites USING(restaurant_id) 
        join users USING(username) 
        where restaurant.restaurant_id = favourites.restaurant_id AND favourites.username = '$username'
        ORDER BY favourites.restaurant_id ASC LIMIT $newcount";

        $query = mysqli_query($conn, $sql);
                
        $num = mysqli_num_rows($query);
                    
        if($num > 0)
        {
            echo "<table>";
            
            while($row = mysqli_fetch_assoc($query))
            {
                echo "<a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . "'><tr>";
                echo  $row['res_name'] . "<br>";
                echo  $row['address'] . "<br>";
                echo  "<a href='#'>Cuisine: " .$row['cuisine'] . "</a><br>";
                echo "</tr></a>";
            }
            
            echo "</table>";
        
        }

    }

?>