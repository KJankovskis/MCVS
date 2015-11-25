<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

$nosaukums = $_REQUEST["nosaukums"];
$tips = $_REQUEST["auditorijasTips"];
$adrese = $_REQUEST["adrese"];
$pilseta = $_REQUEST["pilseta"];
$maxSkaits = $_REQUEST["skaits"];
$tafele = $_REQUEST["tafele"];
$projektors = $_REQUEST["projektors"];
$video = $_REQUEST["video"];


    $sql_query=" INSERT INTO Auditorija(aNumursNosaukums, auditorijasTips, aAdrese, aPilseta, aMaksimalaisStudentuSkaits, tafele, projektors, videoKonference) 
                VALUES('$nosaukums','$tips','$adrese','$pilseta','$maxSkaits', '$tafele', '$projektors', '$video');";
    if (mysqli_query($d, $sql_query)) {
//        echo "Ieraksts par lietotaju veiksmīgi pievienots";
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
    }

mysqli_close($d);

?>
</body>
</html>