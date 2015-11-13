<?php
    include('header.php');
?>


<div class="topic">
    <p>Jaunas mācību grupas plānošana</p>
</div>
<div class="gpContent">
    <br>
    <table width="100%">
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px">
            <td width="35%">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="35%">
                <select id="gpCourseList" name="gbCourseListName" onchange="changeResults();">
                    <option value=""></option>
                    <?php
                        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
                        $resultSet  =$mysqli->query("SELECT * FROM Kurss");
                        
                        if($resultSet -> num_rows != 0) {                
                            while($rows = $resultSet -> fetch_assoc()) {
                                ?>
                                <option value="<?php echo $rows['kKursaNosaukums']; ?>"><?php echo $rows['kKursaNosaukums']; ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </td>
            <td>
                <span style="padding-left: 20px"></span><input type="submit" id="gpCourseAcceptButton" name="gpCourseAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>
        <tr height="40px">
            <td>
                <label id="gpTeacherLabel">Izvēlieties pasniedzēju:</label>
            </td>
            <td>
                <select id="gpTeacherList" name="gbTeacherListName" onchange="changeResults();">
                    <option value=""></option>
                    <?php
                        if (isset($_POST['gpCourseAcceptButton'])) {
                            
                            $selectedCourse = $_POST['gbCourseListName'];
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
                            $resultSet1 = $mysqli->query("SELECT idKurss 
                            FROM Kurss 
                            WHERE kKursaNosaukums='$selectedCourse'");
        
                            if($resultSet1->num_rows !=0){
                                while($rows1 = $resultSet1->fetch_assoc()){
                                    $selectedCourseId = $rows1['idKurss'];
                                    
                                    $resultSet2 = $mysqli->query("SELECT Persona.vards, Persona.uzvards 
                                    FROM Persona
                                    LEFT JOIN Persona_has_Kurss 
                                    ON Persona.idPersona = Persona_has_Kurss.Persona_idPersona
                                    WHERE Persona.lietotajaLoma =  'P' 
                                    AND Persona_has_Kurss.Kurss_idKurss = '$selectedCourseId'");
                        
                                    if($resultSet2 -> num_rows != 0) {
                                        while($rows = $resultSet2 -> fetch_assoc()) {           
                                            ?>
                                            <option value="<?php echo $rows['vards'] . " " . $rows['uzvards']; ?>">
                                                <?php echo $rows['vards'] . " " . $rows['uzvards']; ?>
                                            </option>
                                            <?php
                                        }
                                    }   
                                }
                            }
                        }
                    ?>
                    </select>
            </td>
            <td>
                
            </td>
        </tr>
        
        <tr height="40px">
            <td>
                <label id="gpRoomLabel">Izvēlieties auditoriju:</label>
            </td>
            <td>
                <select id="gpRoomList" onchange="changeResults();">
                    <option value=""></option>
                
                    <?php
                        if (isset($_POST['gpCourseAcceptButton'])) {
                            
                            $selectedCourse = $_POST['gbCourseListName'];
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
                            $resultSet1 = $mysqli->query("SELECT nepieciesamaisAuditorijasTips 
                            FROM Kurss 
                            WHERE kKursaNosaukums='$selectedCourse'");
        
                            if($resultSet1->num_rows !=0){
                                while($rows1 = $resultSet1->fetch_assoc()){
                                    $selectedCourseType = $rows1['nepieciesamaisAuditorijasTips'];
                                    
                                    $resultSet2 = $mysqli->query("
                                    SELECT aNumursNosaukums, aAdrese, aPilseta 
                                    FROM Auditorija
                                    WHERE aTips =  '$selectedCourseType'");
                        
                                    if($resultSet2 -> num_rows != 0) {
                                        while($rows = $resultSet2 -> fetch_assoc()) {           
                                            ?>
                                            <option value="<?php echo $rows['aAdrese'] . ", " . $rows['aPilseta'] . ", " . $rows['aNumursNosaukums']; ?>">
                                                <?php echo $rows['aAdrese'] . ", " . $rows['aPilseta'] . ", " . $rows['aNumursNosaukums']; ?>
                                            </option>
                                            <?php
                                        }
                                    }   
                                }
                            }      
                        }
                    ?>
                </select>
            </td>
            <td>
                
            </td>
        </tr>
        
        <tr height="40px">
            <td>
                <label id="gpDateLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td>
                <input type="date" id="gpDateFrom" onchange="changeResults()"> - <input type="date" id="gpDateTo" onchange="changeResults()">
            </td>
            <td>
                
            </td>
        </tr>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr>
            <td rowspan="3" style="vertical-align: middle">
                <label id="gpStudentLabel">Meklējiet un pievienojiet studentus:</label>
            </td>
            <td>
                <input type="text" id="gpStudentName" placeholder="Studenta vārds" name="name">
            </td>
            <td rowspan="3" style="vertical-align: middle">
                <span style="padding-left: 20px"></span><input type="submit" id="gpStudentSearchButton" value="Meklēt" name="gpStudentSearchButton">
            </td>
        </tr>
        
        <tr>
            <td>
                <input type="text" id="gpStudentSurname" placeholder="Studenta uzvārds" name="surname">
            </td>
        </tr>
        
        <tr>
            <td>
                <input type="text" id="gpStudentID" placeholder="Studenta personas kods" name="peronID">
            </td>
        </tr>
        </form>
    </table>
    <br><br><br>
    
    <?php
    if(isset($_REQUEST['gpStudentSearchButton'])) {
        # Veidojam savienojumu ar savu serveri un datu bāzi
        $myServer = 'localhost';
        $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
        $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
        $myPass = 'janisk';  # Norādiet savu lietotājvārdu
        # ja nevaram pievienoties - rakstam kļūdu paziņojumus
        $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
         mysqli_set_charset($d, 'utf8');


        $name = $_REQUEST["name"];                      //Mainigie no
        $surname = $_REQUEST["surname"];                //ievades
        $peronID = $_REQUEST["peronID"];                //laukiem
    
        if($surname == "" && $peronID ==""){            //ja nav ievadits uzvards un personas kods
            $sql = "SELECT * FROM Persona WHERE vards='$name'";
            $result = $d->query($sql);    
        } else if($name == "" && $peronID ==""){    //ja nav ievadits vards un personas kods
            $sql = "SELECT * FROM persona WHERE uzvards='$surname'";
            $result = $d->query($sql); 
        } else if($name == "" && $surname ==""){                    //ja nav ievadits vards un uzvards
            $sql = "SELECT * FROM persona WHERE personaskods='$peronID'";
            $result = $d->query($sql); 
        } else if($peronID == ""){                                  //ja nav ievadits personas kods
            $sql = "SELECT * FROM persona WHERE vards='$name' AND uzvards='$surname'";
            $result = $d->query($sql); 
        } else if($name == ""){                                     //ja nav ievadits vards
            $sql = "SELECT * FROM persona WHERE uzvards='$surname' AND personaskods='$peronID'";
            $result = $d->query($sql); 
        } else if($surname == ""){                                  //ja nav ievadits uzvards
            $sql = "SELECT * FROM persona WHERE vards='$name' AND personaskods='$peronID'";
            $result = $d->query($sql); 
        } else{                                                     //ja visi lauki ir aizpilditi
            $sql = "SELECT * FROM persona WHERE vards='$name' AND uzvards='$surname' AND personaskods='$peronID'";
            $result = $d->query($sql);
        }

        ?>

        <div class="founded">
            <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
            <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;"><center>Vārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uzvārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Personas kods</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Darba vietas adrese</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Pievienot studentu</th>
            </tr>
                
            <form action="groupPlanning.php" method="post">
                
            <tr>
                <?php
                $x = 0;
            $rowCounter = 0;

                if ($result->num_rows > 0) {
                    $x = 1;
                    while($row = $result->fetch_assoc()) {
                    $temp = $row["personasKods"];
                    $rowCounter++;
                    
                    echo "<td><center>" . $row["vards"] . "</center></td><td><center>" . 
                    $row["uzvards"]. "</center></td><td><center>" . 
                    $row["personasKods"]. "</center></td><td><center>" . 
                    $row["darbaAdrese"]. ", " . $row["darbaPilseta"]. "</center></td><td><center>" . 
                    "<input type='checkbox' name='studentCheckbox' value='$temp'><input style='width: 10px' name='counter' type='hidden' value='$rowCounter'>" . "</center></td></tr>";
                    }
                } else {
                    $x = 2;  
                }
                ?>     
            </table>
        
            <?php
            if ($x == 1) {
                ?>
                <br><br><br><br>
                <center><input type="submit" id="gpAddSelectedStudentsButton" value="Pievienot izvēlētos studentus" name="gpAddSelectedStudentsButton"></center>
              
                <?php
            }
            if ($x == 2) {
                ?>
                <br><br><br><br><center>
                <?php
                echo "Pēc šādiem meklēšanas kritērijiem datubāzē nav atrasts neviens ieraksts!";
                ?>
                </center>
                <?php
            }
            ?>
            </form>
        </div>
    
        <?php
        mysqli_close($d);          
    }
    ?>
    
    <br><br><br>
    <label id="gpCourseResultLabel">Izvēlētais kurss:</label>
    <input type="text" readonly="readonly" disabled="disabled" id="gpCourseResultInfo">
    <br>
    <label id="gpTeacherResultLabel" >Izvēlētais pasniedzējs:</label>
    <input type="text" readonly="readonly" disabled="disabled" id="gpTeacherResultInfo">
    <br>
    <label id="gpRoomResultLabel" >Izvēlētā auditorija:</label>
    <input type="text" readonly="readonly" disabled="disabled" id="gpRoomResultInfo">
    <br>
    <label id="gpDatesResultLabel" >Izvēlētie datumi:</label>
    <input type="text" readonly="readonly" disabled="disabled" id="gpDatesResultInfo">
    <br>
    <label id="gpStudentResultLabel" >Izvēlētie studenti:</label>
    <select id="gpStudentResultInfo" name="gpStudentResultInfo">
        <option value=""></option>
        <?php
        if(isset($_POST['gpAddSelectedStudentsButton'])) {
            for ($i = 1; $i < $_POST['counter']; $i++) {
                if (isset($_POST['studentCheckbox'])) {
                    ?>
                    <option>Vārds Uzvārds PK: <?php echo $i; ?></option>
                    <?php
                }
            }
        }
        ?>
    </select>
    <br><br><br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br><br>
</div>

<?php
    include('footer.php'); 
?>
