<?php

    require_once "db.php";

    require_once "data_clean.php";

    //if filters have been applied
    if(isset($_POST['apply_filter']))
    {
        $sql = "select * from restaurant";

        if(isset($_POST['filter_location']) && isset($_POST['filter_cuisine']))
        {
            $location_filter = clean_data($_POST['filter_location']);
            $cuisine_filter = clean_data($_POST['filter_cuisine']);

            $location_filter = mysqli_real_escape_string($conn, $location_filter);
            $cuisine_filter = mysqli_real_escape_string($conn, $cuisine_filter);

            //echo $location_filter;
            //echo $cuisine_filter;

            //if location and cuisine filled in
            if($location_filter != "" && $cuisine_filter != "")
            {
                echo "<br>Searching for '". $cuisine_filter . "' restaurants in '" . $location_filter . "'<br>";
                $sql = "select * from restaurant where cuisine = '$cuisine_filter' 
                AND (address like '%$location_filter%' OR city like '%$location_filter%' OR country like '%$location_filter%')";
            }//if just location
            elseif($location_filter != "" && $cuisine_filter == "")
            {
                echo "<br>Searching for restaurants in '" . $location_filter . "'<br>";
                $sql = "select * from restaurant where 
                (address like '%$location_filter%' OR city like '%$location_filter%' OR country like '%$location_filter%')";

            }//if just cuisine
            elseif($location_filter == "" && $cuisine_filter != "")
            {
                echo "<br>Searching for '". $cuisine_filter . "' restaurants <br>";

                $sql = "select * from restaurant where cuisine = '$cuisine_filter'";

            }
        }

        //echo $sql;

        $query = mysqli_query($conn, $sql);

        if($query == TRUE)
        {
            $num = mysqli_num_rows($query);

            if($num > 0)
            {
                if(!($_POST['filter_location'] == "" && $_POST['filter_cuisine'] == ""))
                {    
                    echo "<br>Found " . $num . " restaurant(s)";

                }

                echo "<br><table>";

                if($num <= 5)
                {
                    if(!($_POST['filter_location'] === "" && $_POST['filter_cuisine'] === ""))
                    {
                        echo "Showing " . $num . " out of " . $num . " restaurant(s)<br>";
                    }

                    for($i = 0; $i < $num; $i++)
                    {
                        $row = mysqli_fetch_assoc($query);
                        echo "<tr>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <img src='./img/" . $row['res_image'] . "' height='100' width='100'></a></td>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <span style='font-weight: bold'>" . $row['res_name'] . "</span></a>";
                        echo "<br><span style='font-weight: bold'>Cuisine: </span>" . $row['cuisine'];
                        echo "<br><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                        ", " . $row['city'] . ", " . $row['country'];
                        echo "<br><span style='font-weight: bold'>Phone: </span>" . $row['phone'] . "</td></a>";
                        echo "</tr>";
                    }

                }
                else
                {
                    $limit = 5;

                    echo "Showing " . $limit . " out of " . $num . " results";

                    for($i = 0; $i < $limit; $i++)
                    {
                        $row = mysqli_fetch_assoc($query);
                        echo "<tr>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <img src='./img/" . $row['res_image'] . "' height='100' width='100'></a></td>";
                        echo "<td><a href='http://localhost/WebDev2/view_restaurant.php?resid=" . $row['restaurant_id'] . " '>
                        <span style='font-weight: bold'>" . $row['res_name'] . "</span></a>";
                        echo "<br><span style='font-weight: bold'>Cuisine: </span>" . $row['cuisine'];
                        echo "<br><span style='font-weight: bold'>Address: </span>" . $row['address'] . 
                        ", " . $row['city'] . ", " . $row['country'];
                        echo "<br><span style='font-weight: bold'>Phone: </span>" . $row['phone'] . "</td></a>";
                        echo "</tr>";

                    }

                }

                echo "</table><br>";

            }
            else
            {
                echo "No restaurants found";
            }
        }
        else
        {
            echo "Uh oh! It seems like an error has occured";

        }
    }
    else
    {
        echo "Uh oh! It seems like an error has occured";

    }

    mysqli_close($conn);;

?>