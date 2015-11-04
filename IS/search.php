<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

$chkPassPort = $_POST["chkPassPort"];

if($chkPassPort == "1"){
    $name = $_REQUEST["name"];
    $surname = $_REQUEST["surname"];
    $peronID = $_REQUEST["peronID"];
    ?>
    <div class="founded">
        <?php echo "$name"; ?>
        test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
        test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
        test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
        test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    test<br />
    </div>
<?php
}
else if($chkPassPort == "2"){
    $tname = $_REQUEST["tName"];
    $tsurname = $_REQUEST["tSurname"];
    $tperonID = $_REQUEST["tPeronID"];
}
else if($chkPassPort == "3"){
    $courseID = $_REQUEST["courseID"];
    $courseName = $_REQUEST["courseName"];
}
else if($chkPassPort == "4"){
    $number = $_REQUEST["number"];
    $roomName = $_REQUEST["roomName"];
}
mysqli_close($d);
?>