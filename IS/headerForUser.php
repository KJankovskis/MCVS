<!DOCTYPE html>
<html>
<head>
<title>MCVS</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="styleForGroupPlanning.css" rel="stylesheet" type="text/css">
<link href="atteli/favIcon.png" rel="shortcut icon" type="image/x-icon" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>


</head>
<body>
	<?php
        include('login.php');
        $username = $_SESSION['login_user']; 
        //echo "$username";
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
		mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM Persona WHERE lietotajvards='$username' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $name = $rows['vards'];
                $surname = $rows['uzvards'];
            }
        }
    ?>
    <div class="wrap">
        	<div class="header">
                <b id="logo"><a href="#"><img src="atteli/logo.png" alt="logo" height="50" width="250"></a></b>
				
                <b id="logout"><a href="logout.php"><img src="atteli/logout.png" alt="logout-icon" height="24" width="24"></a></b>     
                
				<p id="welcome"><b><?php echo "Sveiki, $name $surname "?></b></p>
            </div>