<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

$vieta = $_REQUEST["vieta"];
$tips = $_REQUEST["auditorijasTips"];
$maxSkaits = $_REQUEST["skaits"];
$tafele = $_REQUEST["tafele"];
$projektors = $_REQUEST["projektors"];
$video = $_REQUEST["video"];


    $sql_query=" INSERT INTO auditorija(atrasanasVieta, auditorijasTips, aMaksimalaisStudentuSkaits, tafele, projektors, videoKonference) 
                VALUES('$vieta','$tips','$maxSkaits', '$tafele', '$projektors', '$video');";
    if (mysqli_query($d, $sql_query)) {
//        echo "Ieraksts par lietotaju veiksmīgi pievienots";
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
    }

mysqli_close($d);

?>
</body>
</html>