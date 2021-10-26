<?php

    require_once "db.php";

    require_once "data_clean.php";

    if(isset($_POST['resNewCount']))
    {
        $newcount = $_POST['resNewCount'];

        //if filters have been applied
        if(isset($_POST['sw_item']))
        {
            $sql = "select * from restaurant where ((res_name like
            ?) OR (cuisine like ?) OR  (address like ?) OR (city like ?) OR (country like ?))";

            if(isset($_POST['filter_location']) && isset($_POST['filter_cuisine']))
            {
                $sw_item = clean_data($_POST['sw_item']);
                $location_filter = clean_data($_POST['filter_location']);
                $cuisine_filter = $_POST['filter_cuisine'];

                //if location and cuisine filled in
                if($location_filter !== "" && $cuisine_filter !== "")
                {
                    echo "<br>Searching for '". $cuisine_filter . "' restaurants in '" . $location_filter . "' related to '" . $sw_item . "' <br>";
                    
                    //search restaurants with name related to user search who's cuisine is the filtered cuisine and with the filtered location
                    
                    $sw_item = "%". $sw_item ."%";
                    $location_filter = "%". $location_filter ."%";
                    $cuisine_filter = "%". $cuisine_filter ."%";

                    $sql = "select * from restaurant where (res_name like ? AND (cuisine like ?) 
                    AND (address like ? OR city like ? OR country like ?))";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $sw_item, $cuisine_filter, $location_filter, $location_filter, $location_filter);

                }//if just location
                elseif($location_filter !== "" && $cuisine_filter === "")
                {

                    echo "<br>Searching for restaurants in '" . $location_filter . "' related to '" . $sw_item . "' <br>";

                    //search restaurants with name or cuisine related to user search with the location filtered

                    $sw_item = "%". $sw_item ."%";
                    $location_filter = "%". $location_filter ."%";

                    $sql = "select * from restaurant where ((res_name like ? OR cuisine like ?) AND
                    (address like ? OR city like ? OR country like ?))";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $sw_item, $sw_item, $location_filter, $location_filter, $location_filter);

                }//if just cuisine
                elseif($location_filter === "" && $cuisine_filter !== "")
                {

                    echo "<br>Searching for '". $cuisine_filter . "' restaurants related to '" . $sw_item . "' <br>";

                    //search restaurants with name or location related to user search who's cuisine is the filtered cuisine  
            
                    $sw_item = "%". $sw_item ."%";
                    $cuisine_filter = "%". $cuisine_filter ."%";

                    $sql = "select * from restaurant where ((res_name like ? 
                    OR  address like ? OR city like ? OR country like ?) 
                    AND (cuisine like ?))";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $sw_item, $sw_item, $sw_item, $sw_item, $cuisine_filter);

                }
                else
                {
                    $sw_item = "%". $sw_item ."%";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $sw_item, $sw_item, $sw_item, $sw_item, $sw_item);
                }

            }

            $stmt->execute();

            $query = $stmt->get_result();

            if($query)
            {
                $num = $query->num_rows;

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
                        $limit = $newcount;

                        if($limit > $num)
                        {
                            $limit = $num;
                        }

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

            $stmt->close();

        }
        else
        {
            echo "Uh oh! It seems like an error has occured";

        }

    }

    mysqli_close($conn);

?>