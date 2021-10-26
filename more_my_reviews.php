<?php

    session_start();

    require_once "db.php";

    if(isset($_POST['myreviewCount']) && isset($_SESSION['username']))
    {
        $newcount = $_POST['myreviewCount'];

        $username = $_SESSION['username'];

        $sql = "SELECT restaurant_id, restaurant.address, res_name, title, description, review_id, rev_date, restaurant.city, restaurant.country FROM restaurant
        join reviews USING(restaurant_id) 
        join users USING(username) 
        where (reviews.username = '$username')
        ORDER BY rev_date DESC LIMIT $newcount";
            
        $query = mysqli_query($conn, $sql);
            
        $num = mysqli_num_rows($query);
            
        if($num > 0)
        {

            echo "<table>";
                
            while($row = mysqli_fetch_assoc($query))
            {
                $review_date = date("d-m-Y", strtotime($row['rev_date']));

                echo "<tr>";
                echo "<a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . "'><br><br>" . $row['res_name'] . "</a>";
                echo "<br>" . $row['address'] . ", " . $row['city'] . ", " . $row['country'] . "<br>";
                echo "<br>" . $row['title'] . " " . $review_date . "<br>";
                echo  "<br>" . $row['description'] . "<br>";
                echo "</tr>";
            }
                
            echo "</table>";
                
        }

        mysqli_close($conn);

    }

?>