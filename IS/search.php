<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

$chkPassPort = $_POST["chkPassPort"];

if($chkPassPort == "1"){
    $name = $_REQUEST["name"];
    $surname = $_REQUEST["surname"];
    $peronID = $_REQUEST["peronID"];
}
else if($chkPassPort == "2"){
    $courseID = $_REQUEST["courseID"];
    $courseName = $_REQUEST["courseName"];
}
else if($chkPassPort == "3"){
    $number = $_REQUEST["number"];
    $roomName = $_REQUEST["roomName"];
}
mysqli_close($d);
?>