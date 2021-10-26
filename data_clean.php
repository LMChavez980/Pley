<?php

function clean_data($entered)
{
    $entered = trim($entered);
    $entered = stripslashes($entered);
    $entered = htmlspecialchars($entered);

    return $entered;
}

?>