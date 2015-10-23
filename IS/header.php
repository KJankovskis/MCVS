<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="styleForMain.css" rel="stylesheet" type="text/css">
<link href="styleForProfile.css" rel="stylesheet" type="text/css">
<link href="styleForNews.css" rel="stylesheet" type="text/css">
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
    
</head>
<body>
    <div class="wrap">
        	<div class="header">
                <b id="logo"><a href="profile.php"><img src="atteli/logo.png" alt="logo" height="50" width="250"></a></b>
                <b id="logout"><a href="logout.php"><img src="atteli/logout.png" alt="logout-icon" height="24" width="24"></a></b>
                <b id="user-page"><a href="user-page.php"><img src="atteli/user.png" alt="user-icon" height="24" width="24"></a></b>
            </div>