<?php
session_start();

include 'connect.php';

?>
<!DOCTYPE html>

<html lang="pl-PL">
	<head>
		<title>Oskar Bergmann</title>
		
		<!-- znaczniki META -->
		<meta charset="utf-8">
		<meta name="description" content="Strona przeznaczona na lekcje WIA">
		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
		<meta name="author" content="Oskar Bergmann">
		<meta http-equiv="name" content="Oskar">
		<meta http-equiv="l_name" content="Bergmann">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	<!-- Preload-->
		<link rel="preload" href="images/vol_zero.png" as="image" >
		<link rel="preload" href="images/vol_low.png" as="image" >
		<link rel="preload" href="images/vol_medium.png" as="image" >
		<link rel="preload" href="images/vol_high.png" as="image" >
	 <!-- CSS-->
		<link rel="Stylesheet" type="text/css" href="css/reset.css" >
		<link rel="Stylesheet" type="text/css" href="css/audio.css" >
		<link rel="Stylesheet" type="text/css" href="css/first.css" >
	
		
	 <!--Skrypty-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		
	<!--Strona do generowania ikony  http://realfavicongenerator.net/  
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		-->

	</head>
	
	<body>
		<?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			
			if($_SESSION['typ'] == 'admin'){
			$id = @$_GET['id'];
			$sql="SELECT * FROM options WHERE option_id = 1";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				?>
				<div id='mask'></div>
				<div id='control_panel'>
					<div style='text-align:center;font-size:40px; background:black'>Ustawienia forum</div>
					<form class='ustawienia' method='GET' action=''>
						<input type="hidden" id="users_can_register2" name="users_can_register" value="0"><label><input type="checkbox" id="users_can_register" name="users_can_register" value="1"<?php echo ($row['option_value']==1 && $row['option_name']=='users_can_register' ? 'checked' : '');?>> Użytkownicy mogą się rejestrować</label>
						<br>
					</form>
					
				</div>
				<?php
			}
		}
		?>
		<header>
		</header>
		<main>
			<!--<div class="control_menu">
				<div class="button" >
					<a href="http://www.facebook.com">Click</a>
				</div>
			</div>-->
					<?php	
		

		
					
						$sql = "SELECT * FROM categories WHERE idC ORDER BY sortC ASC";
						$result = $conn->query($sql);
						

						if($result->num_rows > 0){
						
									//<?php echo row['styl']; 
									while($row = $result->fetch_assoc()){
									$sql2 = "SELECT * FROM posts LEFT JOIN categories ON id_of_cat = idC WHERE id ORDER BY sort ASC ";
									$result2 = $conn->query($sql2);
									
										?>
									<div class="<?php echo $row["name_of_cat"]; ?>">
										<?php
											if($row['name_of_cat'] == 'audio' ){
												?>
													<h1>Pliki audio</h1>
													<br>
												<?php
												}
										while($row2 = $result2->fetch_assoc()){
											$i = $row2['id_of_cat'];
											
											if($row2['id_of_cat'] == $i && $row['idC'] == $row2['id_of_cat']){	
												echo "<!DOCTYPE HTML>\n";
												
												include $row["name_of_cat"].'.php';
												$i++;
											
											}
										}
										
										
										?>
									
									</div>
									<?php
									if($row['sortC'] < $result->num_rows){
									?>
									<hr>
									<?php
									}
									}
								
							
							
								
								
							
						} else {
							echo "0 results";
						} 
				
			?>
				
				<!--<div class="mp1">
					<div class="audioPlayer">
						<div class="comment">
							Testowy odtwarzacz audio. Jeszcze nie działa przeciąganie paska odtwarzacza.
						</div>
						<div class="play"></div> 
						<div class="pause"></div>
							<div class="tracker">
								<div class="duration"></div>
								<div class="progressBar">
									<span class="progress"></span>
									<div id="audio-progress-handle"></div>
								</div>
							</div>
							<div class="vol vol_medium"></div>
							<div class="volumeDiv">
								<div class="volumeBar"></div>
								<input class="volume" type="range" min="0" max="1000" value="500" />
							</div>
						<audio><source src="media/zadanie 1-a.mp3" type="audio/mpeg"></audio>
					</div>
					<p> -  bez drugiej zwrotki i drugiego refrenu</p>
				</div>
				<h1>
					Zadanie 4<br> "Zaimportuj dowolne trzy utwory i utwórz z nich składankę muzyczną. Zastosuj w tym celu następujące efekty:"
					
						<p class="list">
						 0-10 sek. - zastosuj efekt (echo)<br>
						 25 sek. - zmień piosenkę<br>
						 35 sek.-50 sek.. - zastosuj efekt (bass boots)<br>
						 1 min. 10sek. - zmień piosenkę<br>
						 1 min. -1 min 35sek. - zastosuj efekt (fazer)<br>
						 2 min. 05 sek. - zmień piosenkę<br>
						 2 min. 10 sek.- 2 min. 35 sek. - zastosuj efekt (normalizuj)<br>
						 2 min. 45 sek. - zmień piosenkę<br>
						 3 min. -3 min. 30 sek. - zastosuj efekt (wyciszenie)<br>
						 3 min. 30 sek. - zmień piosenkę<br>
						 4 min. – 4 min. 05sek. - zastosuj efekt (odwróć w pionie)<br>
						 4 min. 15 sek. - zmień piosenkę<br>
						 5 min – 5 min 20 sek. - zastosuj efekt (narastanie poziomu)<br>
						 5 min 35 sek. - zmień piosenkę<br>
						</p>
					
				</h1> -->
				
		</main>

		<footer>
				
				<p id="cos">Oskar Bergmann <br>Prawa autorskie zastrzeżone &copy;</p>
					
<?php	
		
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			echo "Welcome to the member's area, " . $_SESSION['login'] . "!";
			if($_SESSION['typ'] == 'admin'){
?>
		
		<p class="login" id="admin">Admin</p>
<?php	
			}
?>
		
		<p class="login"><a href="logout.php">Logout</a></p>
<?php
		} else {
			echo "Please log in first to see this page.";
?>
		<p class="login"><a href="login.php">Login</a></p>
<?php
		}
	

?>
				
		</footer>
		<script>
		$(document).ready(function(){  
				
			$(document).on('click', '#admin', function(e){
				  e.preventDefault();
				  $('#control_panel').hide();
				$('#control_panel').fadeIn(500);
				$('#control_panel').animate({height:'80%',width:'40%'},500);
				
				$('#mask').fadeIn(500);
                  
				 
				 
			 });
			
			 $(document).on('click', '#mask', function(){
				$('#control_panel').animate({height:'0',width:'0'},500);
				$('#control_panel').fadeOut('slow');
				$('#control_panel').hide(400);
				$('#mask').fadeOut(500);
				let users_can_register = 0;
				if($('#users_can_register').is(':checked')){
					users_can_register = 1;
				}else {
					users_can_register = 0;
				}
						$.ajax({
							type: "GET",
							url: "ajax.php",
							data:{zapisz:"true",users_can_register:users_can_register},
							success:function(){
								
							}
						});
				 
				 
			 });
		});
		</script>
		<script src="js/main.js"></script>
		
	</body>
</html>