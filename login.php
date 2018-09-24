

<?php
session_start();

include 'connect.php';
// Right at the top of your script
$options = [
'cost' => 11
];

$zle = '';
if (isset($_GET['polacz'])) {
$login = $_GET['login'];
$pass = $_GET['pass'];

//SQL INJECTION PROTECTION
	$stmt = $conn->prepare('SELECT * FROM members WHERE login = ?');
	$stmt->bind_param('s', $login);

	$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	
	$password_db = password_hash($pass, PASSWORD_BCRYPT, $options);
		if (!password_verify($pass, $row['pass'])) {
			$zle = 'Invalid password or username.';
			
		} else{
			header( "refresh:0;url=index.php" );
			$_SESSION['loggedin'] = true;
			$_SESSION['login'] = $login;
			$_SESSION['typ'] = $row['typ'];

		}
	
} else {
	$zle = 'Invalid password or username.';
}

} else if(isset($_GET['logout'])){
header( "refresh:0;url=logout.php" );
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="Stylesheet" type="text/css" href="css/reset.css" >
<link rel="Stylesheet" type="text/css" href="css/login.css" >
</head>

<body>

<?php	

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	echo "Welcome to the member's area, " . $_SESSION['login'] . "!";
?>
<script>
	
	$('.login_form').hide();
</script>
<form action="logout.php" method="GET">
<input type="submit" name="logout" value="Logout" style="position: absolute; top:5px; right:20%;">
</form>
<?php
} else {
	
?>
<div class="login_form">
<form action="login.php" method="GET" id="Logowanie">
	<p>Admin Panel</p>
	<h1> Zaloguj się</h1>
	<label>Użytkownik: </label><input type="text" name="login" required><br>
	<label>Hasło: </label><input type="password" name="pass" required>
	<br>
	<a href="register.php">Rejestracja</a>
	<input type="submit" name="polacz" value="Połącz">
	
</form> 
<?php
	
	echo $zle;
}


?>
</div>
</body>
</html>
