<?php
    session_start();

    require_once "db.php";

    require_once "data_clean.php";

    if(isset($_POST['resid']) && isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

        $resid = clean_data($_POST['resid']);

        $sql = "Delete from favourites 
        where (favourites.restaurant_id = ? AND favourites.username = ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $resid, $username);
        $stmt->execute();

        $query = $stmt->affected_rows;
        
        //If delete executed
        if($query !== 0)
        {
            echo "success";
        }
        else
        {
            echo "fail";
        }

        $stmt->close();
    }
    elseif(isset($_POST['multi_resid']) && isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

        $errors = 0;

        $sql = "Delete from favourites 
        where (favourites.restaurant_id = ? AND favourites.username = ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $resid, $username);

        foreach($_POST['multi_resid'] as $resid)
        {
            $stmt->execute();

            $query = $stmt->affected_rows;

            //if delete executed
            if($query === 0)
            {
                $errors = $errors + 1;
            }

        }

        if($errors > 0)
        {
            echo "fail";
        }
        else
        {
            echo "success";
        }
        
    }

    mysqli_close($conn);

?>