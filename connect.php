<?php
 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = '';
 $db =  'members';

 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
 $conn->set_charset("utf8");
 
if ($conn->connect_error) {
    echo "Error: Niemożliwe połączenie z MSQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

 function CloseCon($conn){
 $conn -> close();
 }
 

 ?>