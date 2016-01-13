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
        # Veidojam savienojumu ar savu serveri un datu bāzi
		$myServer = 'localhost';
		$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
		$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
		$myPass = 'janisk';  # Norādiet savu lietotājvārdu
		# ja nevaram pievienoties - rakstam kļūdu paziņojumus
		$mysqli = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
		mysqli_set_charset($mysqli, 'utf8');
		
		$aNosaukums=$_REQUEST['aNosaukums'];
		
        $resultSet  =$mysqli->query("SELECT * FROM Auditorija WHERE aNumursNosaukums='$aNosaukums' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $ID = $rows['idAuditorija'];
                $nosaukums = $rows['aNumursNosaukums'];
                $tips = $rows['aTips'];
                $pilseta = $rows['aPilseta'];
                $skaits = $rows['aMaksimalaisStudentuSkaits'];
                $tafele = $rows['tafele'];
                $projektors = $rows['projektors']; 
                $video = $rows['videoKonforence']; 
            }
        }
        $sql = "SELECT * FROM AuditorijaNoslogojums WHERE Auditorija_idAuditorija='$ID'";
        $result = $mysqli->query($sql);
    ?>
    <div class="name-surname">
        <p ><?php echo "$nosaukums"; ?> </p>
    </div>
    <div class="auditorija">
        <p><?php echo "<b>Nepieciešamā auditorija</b> : "; 
            if($tips == 'D'){
                echo "Datorauditorija";
            }
            else{
                echo "Auditorija";
            }
            ?></p>
        <p><?php echo "<b>Atrodas pilsētā</b> : $pilseta" ?></p> 
        <p><?php echo "<b>Maksimālais sēdvietu skaits</b> : $skaits" ?></p>
        <p><?php echo "<b>Tāfele</b> : "; 
            if($tafele == '1'){
                echo "Ir";
            }
            else{
                echo "Nav";
            }
            ?></p>
        <p><?php echo "<b>Projektors</b> : "; 
            if($projektors == '1'){
                echo "Ir";
            }
            else{
                echo "Nav";
            }
            ?></p>
        <p><?php echo "<b>Video konference</b> : "; 
            if($video == '1'){
                echo "Ir";
            }
            else{
                echo "Nav";
            }
            ?></p><br><br>
    </div>
    <div class="about">
        <div class="noslogojums"><p>Noslogojums</p></div>
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Nr.</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Aktivitāte</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Datums no</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Datums līdz</th>
          </tr>
          <tr>
        <?php
        $tmp = 0;
        $x = 0;
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tmp = $tmp +1;
                    echo "<td><center>" . $tmp. "</center></td><td><center>" . 
                        $row["aDatums"]. "</center></td><td><center>" . 
                        $row["aLaiksNo"]. "</center></td><td><center>" . 
                        $row["aLaiksLidz"]. "</center></td></tr>". "<br>";
                }
            } else {
                $x = 404;
            }
        ?>     
        </table>
        <br><br><br><br><center>
        <?php
        if($x == 404){
            echo "Auditorija tuvākajā laikā nav aizņemta!";
        }
        ?>
        </center>
    </div>
<?php include('footer.php'); 
}
?>