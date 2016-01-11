<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');?>
<?php
		        $IDgrupa = '';
				$IDkurss = '';
				$IDauditorija = '';
				$mgDatumsNo = '';
				$mgDatumsLidz = '';
				$IDpasniedzejs = '';
				$pasniedzejaVards = '';
				$pasniedzejaUzvards = '';
				$pasniedzejaPersonasKods = '';
				$kursaNosaukums = '';
				$auditorijasNosaukums = '';
				$aAdrese = '';
				$aPilseta = '';
				$IDstudenta = '';
        # Veidojam savienojumu ar savu serveri un datu bāzi
		$myServer = 'localhost';
		$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
		$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
		$myPass = 'janisk';  # Norādiet savu lietotājvārdu
		# ja nevaram pievienoties - rakstam kļūdu paziņojumus
		$mysqli = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
		mysqli_set_charset($mysqli, 'utf8');
		
        $nosaukums=$_REQUEST['gNosaukums'];

        $resultSetGroup  =$mysqli->query("SELECT * FROM MacibuGrupa WHERE mGrupasNosaukums='$nosaukums'");
        if($resultSetGroup->num_rows !=0){
            while($rows = $resultSetGroup->fetch_assoc()){ 
                $IDgrupa = $rows['idMacibuGrupa'];
				$IDkurss = $rows['Kurss_idKurss'];
				$IDauditorija = $rows['Auditorija_idAuditorija'];
				$mgDatumsNo = $rows['mgDatumsNo'];
				$mgDatumsLidz = $rows['mgDatumsLidz'];
            }
        }
		$resultSetTeacherID  =$mysqli->query("SELECT * FROM Persona_has_MacibuGrupa WHERE MacibuGrupa_idMacibuGrupa='$IDgrupa' AND vaiIrPasniedzejs = 'J'");
        if($resultSetTeacherID->num_rows !=0){
            while($rows = $resultSetTeacherID->fetch_assoc()){ 
				$IDpasniedzejs = $rows['Persona_idPersona'];
            }
        }
		$resultSetTeacher  =$mysqli->query("SELECT * FROM Persona WHERE idPersona='$IDpasniedzejs'");
        if($resultSetTeacher->num_rows !=0){
            while($rows = $resultSetTeacher->fetch_assoc()){ 
				$pasniedzejaVards = $rows['vards'];
				$pasniedzejaUzvards = $rows['uzvards'];
				$pasniedzejaPersonasKods = $rows['personasKods'];
            }
        }
		$resultSetCourse  =$mysqli->query("SELECT * FROM Kurss WHERE idKurss='$IDkurss'");
        if($resultSetCourse->num_rows !=0){
            while($rows = $resultSetCourse->fetch_assoc()){ 
				$kursaNosaukums = $rows['kKursaNosaukums'];
            }
        }
		$resultSetAuditorija  =$mysqli->query("SELECT * FROM Auditorija WHERE idAuditorija='$IDauditorija'");
        if($resultSetAuditorija->num_rows !=0){
            while($rows = $resultSetAuditorija->fetch_assoc()){ 
				$auditorijasNosaukums = $rows['aNumursNosaukums'];
				$aAdrese = $rows['aAdrese'];
				$aPilseta = $rows['aPilseta'];
            }
        }
		$resultSetStudentiID  =$mysqli->query("SELECT * FROM Persona_has_MacibuGrupa WHERE MacibuGrupa_idMacibuGrupa='$IDgrupa' AND vaiIrPasniedzejs = 'N'");
        if($resultSetStudentiID->num_rows !=0){
            while($rows = $resultSetStudentiID->fetch_assoc()){ 
				$IDstudenta = $rows['Persona_idPersona'];;
            }
        }
		$resultSetStudent = $mysqli->query("SELECT * FROM Persona WHERE idPersona='$IDstudenta'");

    ?>
    <div class="name-surname">
        <p ><?php echo "$nosaukums"; ?> </p>
    </div>
    <div class="person">
		<br>
		<br>
		<br>
        <p><?php echo "<b>Pasniedzejs</b> :  $pasniedzejaVards $pasniedzejaUzvards , $pasniedzejaPersonasKods" ?></p>
        <p><?php echo "<b>Apgūstamais kurss</b> : $kursaNosaukums" ?></p>
        <p><?php echo "<b>Auditorija</b> : $auditorijasNosaukums <b>atrodas :</b> $aAdrese, $aPilseta" ?></p>
        <p><?php echo "<b>Mācības ilgst no</b> $mgDatumsNo <b>līdz</b> $mgDatumsLidz" ?></p>     
    </div>
    
    <div class="about">
        <div class="noslogojums"><p>Noslogojums</p></div>
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Nr.</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Vārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uzvārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Personas kods</th>
          </tr>
          <tr>
        <?php
        $tmp = 0;
        $x = 0;
        if ($resultSetStudent->num_rows > 0) {
                while($row = $resultSetStudent->fetch_assoc()) {
                    $tmp = $tmp +1;
                    echo "<td><center>" . $tmp. "</center></td><td><center>" . 
                        $row["vards"]. "</center></td><td><center>" . 
                        $row["uzvards"]. "</center></td><td><center>" .
                        $row["personasKods"]. "</center></td></tr>". "<br>";
                }
            } else {
                $x = 404;
            }
        ?>     
        </table>
        <br><br><br><br><center>
        <?php
        if($x == 404){
            echo "Personai tuvākajā laikā nekas nav ieplānots!";
        }
        ?>
        </center>
    </div>
   

<?php include('footer.php'); 
}
?>