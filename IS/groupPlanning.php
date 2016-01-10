<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');
?>


<div class="topic">
    <p>Jaunas mācību grupas plānošana</p>
</div>
<div class="gpContent">
    <br><br>
    <table id="groupPlanningTable" width="100%" style="border: 3px solid #DCE6F7;">
		<form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px" style="border: 3px solid #DCE6F7;">
			<td width="35%" style="border: 3px solid #DCE6F7;">
				<label id="groupNameLabel">Grupas nosaukums: </label>
			</td>
			<td width="35%" style="border: 3px solid #DCE6F7;">
                <input id="groupNameInput" type="text" name="groupName">
			</td>
		</tr>
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td width="35%" style="border: 3px solid #DCE6F7;">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="35%" style="border: 3px solid #DCE6F7;">
                <select id="gpCourseList" name="gbCourseListName">
                    <?php                    
                    //Ja tiek apstiprināts kurss, tikai tā vērtība tiek atlasīta sarakstā
                    if (isset($_POST['gpCourseAcceptButton'])) {
                        ?>
                        <option value="<?php echo $_POST['gbCourseListName']; ?>">
                            <?php echo $_POST['gbCourseListName']; ?>
                        </option>
                        <?php
                    }
                    //Ja kurss netiek apstiprināts un notiek kāda cita darbība, 
                    //tiek ielasīts pilns kursa saraksts
                    else {
                        ?>
                        <option value=""></option>
                        <?php
                        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
						mysqli_set_charset($mysqli, 'utf8');
                        $resultSet  =$mysqli->query("SELECT * FROM Kurss");
                        
                        if($resultSet -> num_rows != 0) {                
                            while($rows = $resultSet -> fetch_assoc()) {
                                ?>
                                <option value="<?php echo $rows['kKursaNosaukums']; ?>">
                                    <?php echo $rows['kKursaNosaukums']; ?>
                                </option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <span style="padding-left: 20px"></span><input type="submit" id="gpCourseAcceptButton" name="gpCourseAcceptButton" value="Apstiprināt"><span style="padding-left: 70px"></span><input type="submit" id="gpCourseRefreshButton" name="gpCourseRefreshButton" value="Atjaunot">
            </td>
        </tr>
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td style="border: 3px solid #DCE6F7;">
                <label id="gpTeacherLabel">Izvēlieties pasniedzēju:</label>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <select id="gpTeacherList" name="gpTeacherListName">
                    <?php
                        //Pēc kursa izvēles tiek ielasīti sarakstā attiecīgie pasniedzēji
                        if (isset($_POST['gpCourseAcceptButton'])) {
                            ?>
                            <option value=""></option>
                            <?php
                            
                            $selectedCourse = $_POST['gbCourseListName'];
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet1 = $mysqli->query("SELECT idKurss 
                            FROM Kurss 
                            WHERE kKursaNosaukums='$selectedCourse'");
        
                            if($resultSet1->num_rows !=0){
                                while($rows1 = $resultSet1->fetch_assoc()){
                                    $selectedCourseId = $rows1['idKurss'];
                                    
                                    $resultSet2 = $mysqli->query("SELECT Persona.vards, Persona.uzvards, Persona.personasKods
                                    FROM Persona
                                    LEFT JOIN Persona_has_Kurss 
                                    ON Persona.idPersona = Persona_has_Kurss.Persona_idPersona
                                    WHERE Persona.lietotajaLoma =  'P' 
                                    AND Persona_has_Kurss.Kurss_idKurss = '$selectedCourseId'");
                        
                                    if($resultSet2 -> num_rows != 0) {
                                        while($rows = $resultSet2 -> fetch_assoc()) {           
                                            ?>
                                            <option value="<?php echo $rows['vards'] . " " . $rows['uzvards'] . " " . $rows['personasKods']; ?>">
                                                <?php echo $rows['vards'] . " " . $rows['uzvards'] . " " . $rows['personasKods']; ?>
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
            <td style="border: 3px solid #DCE6F7;">
                <!-- <span style="padding-left: 20px"></span><input type="submit" id="gpTeacherAcceptButton" name="gpTeacherAcceptButton" value="Apstiprināt"> -->
            </td>
        </tr>
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td style="border: 3px solid #DCE6F7;">
                <label id="gpRoomLabel">Izvēlieties auditoriju:</label>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <select id="gpRoomList" name="gpRoomListName">
                    <?php
                        //Ja tiek izvēlēts kurss, 
                        //lietotājam tiek piedāvāts atbilstošs auditoriju saraksts
                        if (isset($_POST['gpCourseAcceptButton'])) {
                            ?>
                            <option value=""></option>
                            <?php
                            
                            $selectedCourse = $_POST['gbCourseListName'];
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
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
            <td style="border: 3px solid #DCE6F7;">
                <!-- <span style="padding-left: 20px"></span><input type="submit" id="gpRoomAcceptButton" name="gpRoomAcceptButton" value="Apstiprināt"> -->
            </td>
        </tr>
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td style="border: 3px solid #DCE6F7;">
                <label id="gpDateLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td>
                <input type="date" id="gpDateFrom" name="gpDateFrom"> - <input type="date" id="gpDateTo" name="gpDateTo">
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <!-- <span style="padding-left: 20px"></span><input type="submit" id="gpDatesAcceptButton" name="gpDatesAcceptButton" value="Apstiprināt"> -->
            </td>
        </tr>
              
    </table>

    <br><br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU" name="gpCreateButton"></center>
    <br><br>
    <?php 
    if (isset($_POST['gpCreateButton'])) {
        
        $groupName = $_POST['groupName'];
        $selectedCourse = $_POST['gbCourseListName'];
        $selectedRoom = $_POST['gpRoomListName'];
        $selectedRoomPieces = explode(",", $selectedRoom);
        $selectedRoomName = $selectedRoomPieces[2];
        $selectedRoomNameFinal = substr($selectedRoomName, 1);
        $dateFrom = $_POST['gpDateFrom'];
        $dateTo = $_POST['gpDateTo'];
               
        
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
		mysqli_set_charset($mysqli, 'utf8');
        
        
        $resultSet = $mysqli->query(
            "SELECT idKurss FROM Kurss WHERE kKursaNosaukums = '$selectedCourse'");
                        
        if($resultSet -> num_rows != 0) {                
            while($rows = $resultSet -> fetch_assoc()) {
                $selectedCourseId = $rows['idKurss'];
            }
        }
        
        $resultSet2 = $mysqli->query(
            "SELECT idAuditorija FROM Auditorija WHERE aNumursNosaukums = '$selectedRoomNameFinal'");
        
        if($resultSet2 -> num_rows != 0) {                
            while($rows = $resultSet2 -> fetch_assoc()) {
                $selectedRoomId = $rows['idAuditorija'];
            }
        }
        
        $myServer = 'localhost';
        $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
        $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
        $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
        $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
        mysqli_set_charset($d, 'utf8');
                            
        $sql_query="INSERT INTO MacibuGrupa(idMacibuGrupa, Kurss_idKurss, Auditorija_idAuditorija, mGrupasNosaukums, mgDatumsNo, mgDatumsLidz) VALUES('','$selectedCourseId','$selectedRoomId', '$groupName', '$dateFrom', '$dateTo');";
        
        if (mysqli_query($d, $sql_query)) {
            // echo "Ieraksts par lietotaju veiksmīgi pievienots";
        } else {
            echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
        }
        
        //----------------------------------------
        
        $selectedTeacher = $_POST['gpTeacherListName'];
        $selectedTeacherPieces = explode(" ", $selectedTeacher);
        $selectedTeacherPK = $selectedTeacherPieces[2];
        
        $mysqli2 = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
		mysqli_set_charset($mysqli2, 'utf8');
        
        $resultSet1 = $mysqli2->query(
            "SELECT idPersona FROM Persona WHERE personasKods = '$selectedTeacherPK';");
                        
        if($resultSet1 -> num_rows != 0) {                
            while($rows = $resultSet1 -> fetch_assoc()) {
                $selectedTeacherId = $rows['idPersona'];
            }
        }
        
        
        $resultSet3 = $mysqli2->query(
            "SELECT idMacibuGrupa FROM MacibuGrupa ORDER BY idMacibuGrupa DESC LIMIT 1;");
        
        if($resultSet3 -> num_rows != 0) {                
            while($rows = $resultSet3 -> fetch_assoc()) {
                $selectedGroupId = $rows['idMacibuGrupa'];
            }
        }
        
        $sql_query2="INSERT INTO Persona_has_Macibugrupa(Persona_idPersona, MacibuGrupa_idMacibuGrupa, vaiIrPasniedzejs) VALUES('$selectedTeacherId','$selectedGroupId','J');";
        
        if (mysqli_query($d, $sql_query2)) {
            // echo "Ieraksts par lietotaju veiksmīgi pievienots";
        } else {
            echo "Error: " . $sql_query2 . "<br>" . mysqli_error($d);
        }
        
        mysqli_close($d);   
    }
    ?>
    </form>
</div>
<?php
    include('footer.php'); 
}
?>
