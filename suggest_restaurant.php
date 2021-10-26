<?php

    require_once "db.php";

    require_once "data_clean.php";

    if(isset($_POST['suggestion']))
    {
        $sw_item = clean_data($_POST['suggestion']);

        $sw_item = mysqli_real_escape_string($conn, $sw_item);

        $sql = "select * from restaurant where res_name like
        '%$sw_item%' OR cuisine like '%$sw_item%' OR  address like '%$sw_item%' LIMIT 5";

        $query = mysqli_query($conn, $sql);

        if($query == TRUE)
        {
            $r_count = mysqli_num_rows($query);

            if($r_count > 0)
            {

                while($row = mysqli_fetch_assoc($query))
                {
                    echo "<a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '><ul class='searchResults'>
                    <li class='searchResults'><span style='font-weight: bold'>" . $row['res_name'] . "</span>";
                    echo "<br><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                    ", " . $row['city'] . ", " . $row['country'];
                    echo "</li></ul></a>";
                } //end while
                
            } //end if count

        } //end successful query

    }

    mysqli_close($conn);

?>