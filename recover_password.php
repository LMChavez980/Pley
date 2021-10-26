<?php

    require_once "db.php";

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['verify_user']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];

        //If email is correct format
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND email = ?");

            $stmt->bind_param("ss", $username, $email);

            $stmt->execute();

            $query = $stmt->get_result();

            if($query)
            {
                $num = $query->num_rows;
                
                if($num > 0)
                {
                    $row = $query->fetch_assoc();

                    $question = $row['security_q'];

                    $ret[] = array('result'=> 'valid', 'content'=> $question);
                }
                else
                {
                    $ret[] = array('result'=> 'invalid', 'content'=> 'Could not find username and/or email');
                }

            }
            else
            {
                $ret[] = array('result'=> 'invalid', 'content'=> 'A database error has occurred');
            }

            $stmt->close();

            $jsonformat = json_encode($ret);

            echo $jsonformat;

        }

    }//if succeeded to changing password
    elseif((isset($_POST['username']) && isset($_POST['email']) && isset($_POST['sec_answer']) && isset($_POST['sec_submit'])) || (isset($_POST['new_pass']) && isset($_POST['change_password'])))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND email = ?");

        $stmt->bind_param("ss", $username, $email);

        $stmt->execute();

        $query = $stmt->get_result();

        if($query)
        {
            $num = $query->num_rows;
                
            if($num > 0)
            {
                $row = $query->fetch_assoc();

                if(isset($_POST['sec_submit']))
                {
                    $sec_answer = $_POST['sec_answer'];
                    $user_answer = $row['security_ans'];

                    if($user_answer === $sec_answer)
                    {
                        echo "Success";
                    }
                    else
                    {
                        echo "Failed";
                    }

                }
                elseif(isset($_POST['change_password']))
                {
                    $new_password = $_POST['new_pass'];

                    $stmt2 = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                    $stmt2->bind_param("ss", $new_password, $username);
                    $stmt2->execute();

                    if($stmt2->affected_rows === 0)
                    {
                        echo "fail";
                    }
                    else
                    {
                        echo "success";
                        session_start();
                        $_SESSION['username'] = $username;
                    }

                    $stmt2->close();
                }
            }
            else
            {
                echo "None";
            }

        }
        else
        {
            echo "Error: Database Error";
        }

        $stmt->close();
        
    }

    mysqli_close($conn);

?>