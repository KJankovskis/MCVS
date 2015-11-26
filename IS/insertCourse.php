<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
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


	if($code == "" || $nosaukums == "" || $apraksts == "" || $skaits == "" || $ilgums == ""){
		?><div class="pievienotsDbTuksh"> <p>Kāds no aizpildāmajiem laukiem nav aizpildīts!</p></div><?php
	}
	else{
		$sql_query=" INSERT INTO Kurss(kursaKods, kKursaNosaukums, kursaApraksts, 
										nepieciesamaisAuditorijasTips, kMaksimalaisStudentuSkaits, kursaIlgums, kursaDiplomaDokuments) 
					VALUES('$code','$nosaukums','$apraksts', '$tips', '$skaits', '$ilgums', '$diploms');";
		if (mysqli_query($d, $sql_query)) {
			?><div class="pievienotsDbApstiprinoss"> <p>Kurss veiksmīgi pievienota datubāzei</p></div><?php
		} else {
			?><div class="pievienotsDbNeapstiprinoss"> <p>Kurss nav pievienota datubāzei</p></div><?php
		}
	}
mysqli_close($d);

?>
</body>
</html>