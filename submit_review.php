<?php

    session_start();

    require_once "db.php";

    require_once "data_clean.php";

    if(isset($_POST['submit_review']))
    {
        if(isset($_POST['review_title']) && isset($_POST['review_desc']) && isset($_SESSION['resid']))
        {
            $resid = $_SESSION['resid'];
            $username = $_SESSION['username'];
            $review_title = $_POST['review_title'];
            $review_desc = $_POST['review_desc'];

            $sql = "insert into reviews (username, restaurant_id, title, description, rev_date) values (?, ?, ?, ?, CURRENT_DATE)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $resid, $review_title, $review_desc);
            $stmt->execute();

            $query = $stmt->affected_rows;

            if($query !== 0)
            {
                
                
            }
            else
            {
                echo "failed";
            }

            $stmt->close();

        }

    }

    mysqli_close($conn);
