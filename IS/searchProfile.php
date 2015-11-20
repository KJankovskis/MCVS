<?php include('header.php');?>
<?php

        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        $resultSet  =$mysqli->query("SELECT * FROM Persona WHERE vards='Arnis' ");
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
    
    <div class="about">
        <div class="noslogojums"><p>Noslogojums</p></div>
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
        $x = 0;
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tmp = $tmp +1;
                    echo "<td><center>" . $tmp. "</center></td><td><center>" . 
                        $row["pDatums"]. "</center></td><td><center>" . 
                        $row["pLaiksNo"]. "</center></td><td><center>" .
                        $row["pLaiksLidz"]. "</center></td></tr>". "<br>";
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
   

<?php include('footer.php'); ?>