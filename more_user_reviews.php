<?php

    require_once "db.php";

    if(isset($_POST['userReviewCount']) && isset($_POST['usid']))
    {

        $newcount = $_POST['userReviewCount'];

        $username = $_POST['usid'];

        $sql = "SELECT restaurant_id, restaurant.address, res_name, title, description, rev_date FROM restaurant
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
                echo "<a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . "'>" . $row['res_name'] . "</a>";
                echo "<br>" . $row['address'] . "<br>";
                echo "<br>" . $row['title'] . " " . $review_date . "<br>";
                echo  $row['description'] . "<br>";
                echo "</tr>";
            }
            
            echo "</table>";
            
        }
    }

    mysqli_close($conn);

?>