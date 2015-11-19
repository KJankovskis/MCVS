<?php

$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
                            
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
mysqli_set_charset($d, 'utf8');

$sql_query2="DELETE FROM GrupasPlanosanaStudenti WHERE gpsID > '0';";

if (mysqli_query($d, $sql_query2)) {
    // echo "Ieraksts par lietotaju veiksmīgi pievienots";
} else {
    echo "Error: " . $sql_query2 . "<br>" . mysqli_error($d);
}
                            
$sql_query="DELETE FROM GrupasPlanosana WHERE gpID > '0';";

if (mysqli_query($d, $sql_query)) {
    // echo "Ieraksts par lietotaju veiksmīgi pievienots";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
}

mysqli_close($d);   
  
?>