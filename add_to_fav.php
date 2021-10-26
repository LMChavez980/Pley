<?php
    session_start();

    require_once "db.php";

    require_once "data_clean.php";

    if(isset($_POST['resid']) && isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

        $resid = clean_data($_POST['resid']);

        $sql = "Insert into favourites values (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $resid, $username);
        $stmt->execute();

        $query = $stmt->affected_rows;
        
        //If Insert executed
        if($query !== 0)
        {
            $num = mysqli_affected_rows($conn);

            echo "success";
        }
        else
        {
            echo "fail";
        
        }

        $stmt->close();
    }

    mysqli_close($conn);

?>