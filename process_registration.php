<?php

require "db.php";

if(isset($_POST['regis_submit']))
{
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['city'])
	&& isset($_POST['country']) && isset($_POST['sec_q']) && isset($_POST['sec_ans']) && isset($_POST['profile_img']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$sec_q = $_POST['sec_q'];
        $sec_ans = $_POST['sec_ans'];
        $profile_img = $_POST['profile_img'];

		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$check_valid_email = $conn->prepare("SELECT * from users WHERE email = ?");
			$check_valid_email->bind_param("s", $email);
			$check_valid_email->execute();
			
			$email_query = $check_valid_email->get_result();

			$check_valid_email->close();

			if($email_query)
			{
				$check_valid_username = $conn->prepare("select * from users where username = ?");

				$check_valid_username->bind_param("s", $username);

				$check_valid_username->execute();

				$username_query = $check_valid_username->get_result();

				if($username_query)
				{
					$check_valid_username->close();

					$num_email = $email_query->num_rows;

					$num_username = $username_query->num_rows;

					if($num_email === 0)
					{
						//echo "Right";

						if($num_username === 0)
						{
							//echo "Yee";
							$sql = "insert into users values (? , ?, ?, CURRENT_DATE(), ?, ?, ?, ?, ?, ?)";
					
							$stmt = $conn->prepare($sql);

							$stmt->bind_param("sssssssss", $username, $password, $name, $city, $country, $email, $sec_q, $sec_ans, $profile_img);
					
							$stmt->execute();

							if($stmt->affected_rows !== 0)
							{
								session_start();
								$_SESSION['username'] = $username;
								echo "success";
								$stmt->close();

							}
							else
							{
								echo "Error: Could not register";
							} // end insert

						}
						else
						{
							echo "Username already in use";
		
						} //end username check

					}
					else
					{
						echo "Email already in use";

					} //end email check

				}
				else
				{
					echo "A database error has occured";
				}

			}
			else
			{
				echo "A database error has occured";
			}
					
		}	
		else
		{
			echo "Invalid email entered";
		}

		mysqli_close($conn);

		exit();
    }

}
?>