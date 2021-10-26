<?php

    session_start();

    require_once "db.php";

    if(isset($_POST['dealsNewCount']))
    {
        $newcount = $_POST['dealsNewCount'];

        $username = $_SESSION['username'];

        $sql = "select restaurant_id, res_name, start_date, end_date, description from users
        JOIN favourites USING (username)
        JOIN restaurant USING(restaurant_id)
        JOIN deals USING (restaurant_id)
        WHERE restaurant.restaurant_id = favourites.restaurant_id AND favourites.username = '$username'
        ORDER BY start_date ASC LIMIT $newcount";

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

    }

?>