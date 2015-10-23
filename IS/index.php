<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MCVS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="main">
    <h1>MĀCĪBU CENTRA VADĪBAS SISTĒMA</h1>
        <div id="login">
            <form action="" method="post">
            <label>UserName :</label>
            <input id="name" name="username" placeholder="username" type="text"><br>
            <label>Password :</label><br>
            <input id="password" name="password" placeholder="**********" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $error; ?></span>
        </form>
        </div>
    </div>
</body>
</html>