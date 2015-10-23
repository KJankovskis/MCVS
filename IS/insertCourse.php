<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

    
$code = $_REQUEST["code"];
$nosaukums = $_REQUEST["title"];
$apraksts = $_REQUEST["sumary"];
$tips = $_REQUEST["auditorijasTips"];
$skaits =  $_REQUEST["capacity"];
$ilgums = $_REQUEST["duration"];
$diploms=addslashes (file_get_contents($_FILES['diploms']['tmp_name']));
$programma=addslashes (file_get_contents($_FILES['programma']['tmp_name']));
$materiali=addslashes (file_get_contents($_FILES['materiali']['tmp_name']));

    $sql_query=" INSERT INTO kurss(kursaKods, kKursaNosaukums, kursaApraksts, 
                                    nepieciesamaisAuditorijasTips, kMaksimalaisStudentuSkaits, kursaIlgums, kursaDiplomaDokuments) 
                VALUES('$code','$nosaukums','$apraksts', '$tips', '$skaits', '$ilgums', '$diploms');";
    if (mysqli_query($d, $sql_query)) {
//        echo "Ieraksts par lietotaju veiksmīgi pievienots";
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
    }

mysqli_close($d);

?>
</body>
</html>