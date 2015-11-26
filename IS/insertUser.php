<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($d, 'utf8');

    
$vards = $_REQUEST["vards"];
$uzvards = $_REQUEST["uzvards"];
$epasts = $_REQUEST["epasts"];
$talrunis = $_REQUEST["talrunis"];
$persKods =  $_REQUEST["personasKods"];
$dzivesAdrese = $_REQUEST["dzivesAdrese"];
$dzivesPilseta = $_REQUEST["dzivesPilseta"];
$darbaAdrese =  $_REQUEST["darbaAdrese"];
$darbaPilseta =  $_REQUEST["darbaPilseta"];
$foto=addslashes (file_get_contents($_FILES['foto']['tmp_name']));
$lietotajvards = $_REQUEST["lietotajvards"];
$loma = $_REQUEST["lietotajaLoma"];
$parole = $_REQUEST["parole"];


	if($vards == "" || $uzvards == "" || $epasts == "" || 
		$talrunis == "" || $persKods == "" || $dzivesAdrese == "" || 
		$dzivesPilseta == "" || $darbaAdrese == "" || $darbaPilseta == "" || 
		$lietotajvards == "" || $parole == ""){
		?><div class="pievienotsDbTuksh"> <p>Kāds no aizpildāmajiem laukiem nav aizpildīts!</p></div><?php
	}
	else{
		$sql_query=" INSERT INTO Persona(vards, uzvards, epasts, talrunis, personasKods, dzivesAdrese, 
										dzivesPilseta, darbaAdrese, darbaPilseta, foto, lietotajaLoma, lietotajvards, parole) 
					VALUES('$vards','$uzvards','$epasts', '$talrunis', '$persKods', '$dzivesAdrese', '$dzivesPilseta'
							, '$darbaAdrese', '$darbaPilseta','$foto' ,'$loma', '$lietotajvards', '$parole');";
		if (mysqli_query($d, $sql_query)) {
			?><div class="pievienotsDbApstiprinoss"> <p>Persona veiksmīgi pievienota datubāzei!</p></div><?php
		} else {
			?><div class="pievienotsDbNeapstiprinoss"> <p>Persona nav pievienota datubāzei!</p></div><?php
		}
	}
mysqli_close($d);

?>
</body>
</html>