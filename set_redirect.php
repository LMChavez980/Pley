<?php
    session_start();

    if(isset($_GET['func']) && isset($_GET['surl']))
    {
        //if logging in to review
        if($_GET['func'] == 'log_to_rev')
        {
            $_SESSION['redirect_back'] = $_GET['surl'];
            echo $_SESSION['redirect_back'];
            header("Location: http://localhost/WebDev2/login.php");
        }
    }

?>