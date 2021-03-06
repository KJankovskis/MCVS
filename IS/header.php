<!DOCTYPE html>
<html>
<head>
<title>MCVS</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="styleForGroupPlanning.css" rel="stylesheet" type="text/css">
<link href="atteli/favIcon.png" rel="shortcut icon" type="image/x-icon" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script> 
    $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.php"); 
    });
</script>
    
<script>
    $(document).ready(function(){   
        $(".close-down").click(function(){
            $(".content-top").delay(100).show().animate({opacity: 0, top:"-130px"},1000);
        });
        
        $(".close-up").click(function(){
            $(".content-top").delay(100).show().animate({opacity: 0, top:"-130px"},1000);
        });
        
        $( ".show" ).click(function() {
            function slide(){
                $(".content-top").delay(100).show().animate({opacity: 1, top:"60px"},1000);
            }
            slide();
        });
    });
</script>
    
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    
<script type="text/javascript">
    function ShowHideDiv() {
        var person = document.getElementById("person");
        var showPerson = document.getElementById("showPerson");
        showPerson.style.display = person.checked ? "block" : "none";
        var course = document.getElementById("course");
        var showCourse = document.getElementById("showCourse");
        showCourse.style.display = course.checked ? "block" : "none";
        var room = document.getElementById("room");
        var showRoom = document.getElementById("showRoom");
        showRoom.style.display = room.checked ? "block" : "none";
        var group = document.getElementById("group");
        var showGroup = document.getElementById("showGroup");
        showGroup.style.display = group.checked ? "block" : "none";
    }
</script>

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
                <b id="logo"><a href="main.php"><img src="atteli/logo.png" alt="logo" height="50" width="250"></a></b>
				
                <b id="logout"><a href="logout.php"><img src="atteli/logout.png" alt="logout-icon" height="24" width="24"></a></b>     
                <b id="user-page"><a href="user-page.php"><img src="atteli/user.png" alt="user-icon" height="24" width="24"></a></b>
                <b id="home"><a href="main.php"><img src="atteli/home.png" alt="home-icon" height="24" width="24"></a></b>
				<p id="welcome"><b><?php echo "Sveiki, $name $surname "?></b></p>
            </div>