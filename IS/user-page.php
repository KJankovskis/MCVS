<?php
        include('login.php');      
        $username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
		include('header.php');
        //echo "$username";
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
		mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM Persona JOIN PersonaNoslogojums ON idPersona = Persona_idPersona WHERE lietotajvards='$username' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $ID = $rows['idPersona'];
                $name = $rows['vards'];
                $surname = $rows['uzvards'];
                $mail = $rows['epasts'];
                $phone = $rows['talrunis'];
                $city = $rows['dzivesPilseta']; 
                $adress = $rows['dzivesAdrese'];
                $cityWork = $rows['darbaPilseta']; 
                $workplaceAdress = $rows['darbaAdrese'];
                $foto = $rows['foto'];
                if (empty($foto)) $foto = "atteli/defaultPerson.png";
                $role = $rows['lietotajaLoma'];
				//startDate = $rows['pDatums'];
				//startTime = $rows['pLaiksNo'];
				//endTime = $rows['pLaiksLidz'];
            }
        }
    ?>
    <div class="name-surname">
        <p ><?php echo "$name $surname"; ?> </p>
    </div>
    <div class="person">
        <div class="profilePicture">
            <?php
echo //'<dd>'
     //. '<object data="atteli/defaultPerson.png" type="image/png">' .
           '<img src="data:image/jpeg;base64,' . base64_encode($foto) . '" width="200" height="230">';
     //. '</object>'
     //. '</dd>';
?>
            
        </div>
        <p><?php echo "<b>e-pasts</b>: $mail" ?></p>
        <p><?php echo "<b>tālrunis</b>: $phone" ?></p>
        <p><?php echo "<b>dzīvesvietas adrese</b>: $adress, $city" ?></p>
        <p><?php echo "<b>darbavieta</b>: $workplaceAdress, $cityWork" ?></p>
        <?php
            if($role == 'L'){
                ?><p><?php //lietotajs
                echo "<b>apgūtie kursi</b>: <br><br>";
                echo "<b>iegūtie diplomi</b>: <br><br>";
                echo "<b>iegūtie sertifikāti</b>: <br>";
                ?></p><?php
            }
            else if($role == 'P'){
                ?><p><?php//pasniedzejs
                echo "<b>pasniedzamie kursi: </b>";
                ?></p><?php
            }
            else if($role == 'A'){ 
            }
        ?>
        <p><?php echo "<b>lietotāja loma: </b>"; 
			if($role == 'L'){             //lietotajs
                echo "Lietotājs";
            }
            else if($role == 'P'){        //pasniedzejs
                echo "Pasniedzējs";
            }
            else if($role == 'A'){ 
				echo "Administrators";
			}
        ?></p>
    </div>
    
    <div class="about">
        <div class="noslogojums"><p>Noslogojums</p></div>
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;position: absolute; top:30px;">
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
		
		$resultNoslogojums=$mysqli->query("SELECT * FROM Persona_has_MacibuGrupa WHERE Persona_idPersona='$ID' ");
		if($resultNoslogojums->num_rows !=0){
            while($rows = $resultNoslogojums->fetch_assoc()){ 
                $IDmGrupa = $rows['MacibuGrupa_idMacibuGrupa'];
				$resultMacibuGrupa=$mysqli->query("SELECT * FROM MacibuGrupa WHERE 	idMacibuGrupa='$IDmGrupa'");
					if ($resultMacibuGrupa->num_rows > 0) {
						while($row = $resultMacibuGrupa->fetch_assoc()) {
							$tmp = $tmp +1;
							echo "<td><center>" . $tmp. "</center></td><td><center>" . $row["mGrupasNosaukums"]. "</center></td><td><center>" . $row["mgDatumsNo"]. "</center></td><td><center>" . $row["mgDatumsLidz"]."</center></td></tr>". "<br>";
						}
					} else {
						$x = 404;
					}
            }
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