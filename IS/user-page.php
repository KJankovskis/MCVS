<?php include('header.php');?>

    <?php
        include('login.php');
        $username = $_SESSION['login_user']; 
        //echo "$username";
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        $resultSet  =$mysqli->query("SELECT * FROM Persona WHERE lietotajvards='$username' ");
		mysqli_set_charset($mysqli, 'utf8');
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){
                $name = $rows['vards'];
                $surname = $rows['uzvards'];
                $mail = $rows['epasts'];
                $phone = $rows['talrunis'];
                $city = $rows['dzivesPilseta']; 
                $adress = $rows['dzivesAdrese'];
                $cityWork = $rows['darbaPilseta']; 
                $workplaceAdress = $rows['darbaAdrese'];
                $foto = $rows['foto'];
                $role = $rows['lietotajaLoma'];
            }
        }
		$sql = "SELECT * FROM PersonaNoslogojums WHERE Persona_idPersona='$ID'";
        $result = $mysqli->query($sql);
    ?>
    <div class="name-surname">
        <p ><?php echo "$name $surname"; ?> </p>
    </div>
    <div class="person">
        <div class="profilePicture">
            <?php
echo '<dd>'
     . '<img src="data:image/jpeg;base64,' . base64_encode($foto) . '" width="200" height="230">'
     . '</dd>';
?>
        </div>
        <p><?php echo "<b>e-pasts</b> :  $mail" ?></p>
        <p><?php echo "<b>tālrunis</b> : $phone" ?></p>
        <p><?php echo "<b>dzīvesvietas adrese</b> : $adress , $city" ?></p>
        <p><?php echo "<b>darbavieta</b> : $workplaceAdress, $cityWork" ?></p>
        <p><?php
            if($role == 'L'){             //lietotajs
                echo "<b>apgūtie kursi</b> : <br><br>";
                echo "<b>iegūtie diplomi</b> : <br><br>";
                echo "<b>iegūtie sertifikāti</b> : <br><br>";
            }
            else if($role == 'P'){        //pasniedzejs
                echo "<b>pasniedzamie kursi</b> :";
            }
            else if($role == 'A'){ 
            }
        ?></p>      
    </div>
    <div class="noslogojums"><p>Noslogojums</p></div>
    <div class="about">
       <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Nr.</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Datums</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Laiks no</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Laiks līdz</th>
          </tr>
          <tr>
        <?php
        $tmp = 0;
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tmp = $tmp +1;
                    echo "<td>" . $tmp. "</td><td>" . $row["pDatums"]. "</td><td>" . $row["pLaiksNo"]. "</td><td>" . $row["pLaiksLidz"]. "</td></tr>". "<br>";
                }
            } else {
                
            }
        ?>     
        </table> 
    </div>
   
<?php include('footer.php'); ?>