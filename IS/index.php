<?php
include('indexNew.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    $role = $_SESSION['user_role'];
    if($role == "L"){
        header("location: user-pageForUser.php");
    }else if($role == "A"){
        header("location: profile.php");
    }
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
            <label style="height: 20px">Lietotājvārds:</label>
            <input id="name" name="username" type="text"><br>
            <label style="height: 20px">Parole:</label>
            <input id="password" name="password" type="password">
            <input id="ienaktSistema" name="submit" type="submit" value="Ienākt sistēmā">
            <span><?php echo $error; ?></span>
            </form>
        </div>
    </div>
</body>
</html>