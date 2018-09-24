<?php
session_start();

include 'connect.php';
 // Right at the top of your script

?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
	
	<?php
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			echo "Welcome to the member's area, " . $_SESSION['login'] . "!<br>";
			echo "You dont need to register :) <br><b><h2>Automaticaly rediecting to home site after 5sec</h2></b>";
			//Set Refresh header using PHP.
			header( "refresh:2;url=index.php" );
		} else {
			$sql = " SELECT * FROM options ";

			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
				if($row['option_name'] == 'users_can_register' && $row['option_value'] == '1'){
					?>
					<form action="register.php" method="GET">
						<h1> Zarejestruj się</h1>
						<label>Login: </label><input type="text" name="login" required>
						<br>
						<label>Hasło: </label><input type="text" name="haslo" required>
						<br>
						<label>Pytanie: </label><input type="text" name="quest">

						<input type="submit" name="rejestr" value="Zarejestruj">
					</form> 
					<?php
				}else {
					echo "Register is acctually off. You will be rediected to home site";
					header( "refresh:2;url=index.php" );
				}
					
				
			} else {
				echo "0 results";
			}

		}
	
	if (isset($_GET['rejestr'])) {

		sleep(5);
		//Set Refresh header using PHP.
		header( "Location: login.php" );
		 
		//Print out some content for example purposes.
		echo 'This is the content.';
	}

	?>
	</body>
</html>