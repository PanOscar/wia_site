

<?php
session_start();

include 'connect.php';
?>
<!DOCTYPE html>
<html>
	<head>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="Stylesheet" type="text/css" href="css/reset.css" >
		<link rel="Stylesheet" type="text/css" href="css/admin.css" >
	</head>

	<body>
	
<?php	
		
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
			
			if($_SESSION['typ'] == 'admin'){ 
			
			//CAŁA STRONA TUTAJ
?>			
		<div class="logout">
		<form action="logout.php" method="GET">
		<?php
		echo "Welcome in admin panel ".$_SESSION['login'];
		?>
		<br>
		<input type="submit" name="logout" value="Logout" >
		</form>
		</div>
		<div class="sec-left">
			<a href="?"><div class="menu options"></div></a>
			<a href="?id=1"><div class="menu posts"></div></a>
		</div>
		<div class="sec-right">
			<?php
			$id = @$_GET['id'];
			$sql="SELECT * FROM options WHERE option_id = 1";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				if(isset($_GET['zapisz'])){
					if($_GET['users_can_register']!=$row['option_value']){
						if($row['option_value']==1){
							
								$sql1= "UPDATE options SET option_value = '0' WHERE option_id = 1";
								$conn->query($sql1);
								header("Refresh:0");
						}else{
								$sql1="UPDATE options SET option_value = '1' WHERE option_id = 1";
								$conn->query($sql1);
								header("Refresh:0");
						}	
					}
				}
				if (!isset($id)){
				
				?>
				
				<div style="font-size:40px">
					<div style="text-align:center;font-size:100px; background:black">Ustawienia forum</div>
					<form class="ustawienia" method="GET" action="">
						<input type="hidden" id="users_can_register2" name="users_can_register" value="0"><label><input type="checkbox" id="users_can_register" name="users_can_register" value="1"<?php echo ($row['option_value']==1 && $row['option_name']=='users_can_register' ? 'checked' : '');?>> Użytkownicy mogą się rejestrować</label>
						
						
						<br>
						<input type="submit" name="zapisz" value="Zapisz">
					</form>
				</div>
				<?php
				}else if($id == 1){
				?>
				<div style="text-align:center;font-size:100px; background:black">Ustawienia postów</div>
					<form>
						<br>
						<input type="submit" name="zapisz" value="Zapisz">
					</form>
				<?php	
				}else {
					
				}
			?>
			<script>
			
			</script>
		</div>
<?php
			//KONIEC STRONY
			}else{
				echo "n\You aren't admin";
				sleep(2);
		//Set Refresh header using PHP.
				header( "Location: index.php" );
			}
		} else {
			echo "Please log in first to see this page.";
				sleep(2);
		//Set Refresh header using PHP.
				header( "Location: login.php" );
		}
	

?>
		</div>
	</body>
</html>
