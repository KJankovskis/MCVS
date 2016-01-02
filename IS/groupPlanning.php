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
    <br>
    <?php
    if(isset($_POST['newGroupGroup'])) {
        include("truncateGroupPlanning.php");
    }
    else {
        if (isset($_POST['gpCourseAcceptButton'])) {
                            $selectedCourse = $_POST['gbCourseListName'];
                            
                            $myServer = 'localhost';
                            $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
                            $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
                            $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
                            $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
                            mysqli_set_charset($d, 'utf8');
                            

                            $sql_query="INSERT INTO GrupasPlanosana(gpKurss, gpPasniedzejsVards, gpPasniedzejsUzvards, gpPasniedzejsPK, gpAuditorijaAdrese, gpAuditorijaPilseta, gpAuditorijaNumursNosaukums, gpSakumaDatums, gpBeiguDatums) VALUES('$selectedCourse','','', '', '', '', '','','');";
                            if (mysqli_query($d, $sql_query)) {
                                // echo "Ieraksts par lietotaju veiksmīgi pievienots";
                            } else {
                                echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
                            }

                            mysqli_close($d);   
                            
                            ?>
                            
                        <?php
        }
         
        /* PARAUGS, LAI SAGLABĀTU VĒRTĪBAS LAUKOS
        
        if (isset($_POST['gpCourseAcceptButton']) || isset($_POST['gpTeacherAcceptButton']) ||
        isset($_POST['gpRoomAcceptButton']) || isset($_POST['gpDatesAcceptButton']) ||
        isset($_POST['gpStudentSearchButton'])) {
            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
            $resultSet = $mysqli->query("SELECT gpKurss, gpPasniedzejsVards, gpPasniedzejsUzvards, gpPasniedzejsPK, gpAuditorijaAdrese, gpAuditorijaPilseta, gpAuditorijaNumursNosaukums, gpSakumaDatums, gpBeiguDatums FROM grupasplanosana ORDER BY gpID DESC LIMIT 1;");
            
            if($resultSet->num_rows !=0){
                while($rows = $resultSet->fetch_assoc()){
                    $gpKurss = $rows['gpKurss'];
                    $gpPasniedzejsVards = $rows['gpPasniedzejsVards'];
                    $gpPasniedzejsUzvards = $rows['gpPasniedzejsUzvards'];
                    $gpPasniedzejsPK = $rows['gpPasniedzejsPK'];
                    $gpAuditorijaAdrese = $rows['gpAuditorijaAdrese'];
                    $gpAuditorijaPilseta = $rows['gpAuditorijaPilseta'];
                    $gpAuditorijaNumursNosaukums = $rows['gpAuditorijaNumursNosaukums'];
                    $gpSakumaDatums = $rows['gpSakumaDatums'];
                    $gpBeiguDatums = $rows['gpBeiguDatums'];
                }
            }
        }
        
        PARAUGS, LAI SAGLABĀTU VĒRTĪBAS LAUKOS */
    }
    ?>
    <br>
    <table id="groupPlanningTable" width="100%" style="border: 3px solid #DCE6F7;">
		<tr height="40px" style="border: 3px solid #DCE6F7;">
			<td width="35%" style="border: 3px solid #DCE6F7;">
				<label id="groupNameLabel">Grupas nosaukums: </label>
			</td>
			<td width="35%" style="border: 3px solid #DCE6F7;">
				<input id="groupNameInput" type="text" name="groupName" />
			</td>
		</tr>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td width="35%" style="border: 3px solid #DCE6F7;">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="35%" style="border: 3px solid #DCE6F7;">
                <select id="gpCourseList" name="gbCourseListName">
                    <?php
                    //Ja lapa tiek atjaunota, lietotājam tiek piedāvāts pilns kursu saraksts
                    if(isset($_POST['newGroupGroup']) || isset($_POST['gpCourseRefreshButton'])) {
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
                    
                    //Ja tiek nospiesta kāda no tālākām pogām, 
                    //izvēlētā kursa informācija tiek ielasīta sarakstā
                    if (isset($_POST['gpCourseAcceptButton']) ||     
                        isset($_POST['gpTeacherAcceptButton']) ||
                        isset($_POST['gpRoomAcceptButton']) || 
                        isset($_POST['gpDatesAcceptButton']) ||
                        isset($_POST['gpStudentSearchButton']) ||
                        isset($_POST['gpAddSelectedStudentsButton'])) {
                        
                        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
						mysqli_set_charset($mysqli, 'utf8');
                        $resultSet = $mysqli->query(
                            "SELECT gpKurss FROM GrupasPlanosana ORDER BY gpID DESC LIMIT 1;");
            
                        if($resultSet->num_rows !=0){
                            while($rows = $resultSet->fetch_assoc()){
                                $gpKurss = $rows['gpKurss'];
                            }
                        }
                        ?>
                        <option value="<?php echo $gpKurss; ?>">
                            <?php echo $gpKurss; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <span style="padding-left: 20px"></span><input type="submit" id="gpCourseAcceptButton" name="gpCourseAcceptButton" value="Apstiprināt"><span style="padding-left: 70px"></span><input type="submit" id="gpCourseRefreshButton" name="gpCourseRefreshButton" value="Atjaunot">
            </td>
        </tr>
        </form>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
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
                                    
                                    $resultSet2 = $mysqli->query("SELECT persona.vards, persona.uzvards, persona.personasKods
                                    FROM Persona
                                    LEFT JOIN persona_has_Kurss 
                                    ON persona.idPersona = persona_has_kurss.persona_idPersona
                                    WHERE persona.lietotajaLoma =  'P' 
                                    AND persona_has_kurss.Kurss_idKurss = '$selectedCourseId'");
                        
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

                        //Pēc pasniedzēja izvēles pogas nospiešanas informācija tiek ierakstīta DB
                        if (isset($_POST['gpTeacherAcceptButton'])) {                         
                            $myServer = 'localhost';
                            $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
                            $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
                            $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
                            $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
                            mysqli_set_charset($d, 'utf8');
                            
                            $resultSet = $mysqli->query("SELECT MAX(gpID) FROM GrupasPlanosana");
                            
                            if($resultSet->num_rows !=0){
                                while($rows = $resultSet->fetch_assoc()){
                                    $maxId = $rows['MAX(gpID)'];
                                }
                            }
                            
                            $selectedTeacher = $_POST['gpTeacherListName'];
                            $selectedTeacherParts = explode(" ", $selectedTeacher);
                            
                            $selectedTeacherName = $selectedTeacherParts[0];
                            $selectedTeacherSurname = $selectedTeacherParts[1];
                            $selectedTeacherID = $selectedTeacherParts[2];
                            
                            $sql_query2 = "UPDATE GrupasPlanosana SET gpPasniedzejsVards = '$selectedTeacherName', gpPasniedzejsUzvards = '$selectedTeacherSurname', gpPasniedzejsPK = '$selectedTeacherID' WHERE gpID = $maxId";
                                          
                            if (mysqli_query($d, $sql_query2)) {
                                // echo "Ieraksts par lietotaju veiksmīgi pievienots";
                            } else {
                                echo "Error: " . $sql_query2 . "<br>" . mysqli_error($d);
                            }

                            mysqli_close($d);   
                            
                            ?>
                            <option value="<?php echo $selectedTeacher; ?>"><?php echo $selectedTeacher; ?></option>
                        <?php
                        }

                        //Ja tiek nospiesta kāda no tālākām pogām, 
                        //izvēlētā pasniedzēja informācija tiek ielasīta sarakstā
                        if (isset($_POST['gpTeacherAcceptButton']) ||
                            isset($_POST['gpRoomAcceptButton']) ||                      
                            isset($_POST['gpDatesAcceptButton']) ||
                            isset($_POST['gpStudentSearchButton']) ||
                            isset($_POST['gpAddSelectedStudentsButton'])) {
            
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet = $mysqli->query("SELECT gpPasniedzejsVards, gpPasniedzejsUzvards, gpPasniedzejsPK FROM GrupasPlanosana ORDER BY gpID DESC LIMIT 1;");
            
            if($resultSet->num_rows !=0){
                while($rows = $resultSet->fetch_assoc()){
                    $gpPasniedzejsVards = $rows['gpPasniedzejsVards'];
                    $gpPasniedzejsUzvards = $rows['gpPasniedzejsUzvards'];
                    $gpPasniedzejsPK = $rows['gpPasniedzejsPK'];
                }
            }
                            ?>
                    <option value="<?php echo $gpPasniedzejsVards . ' ' . $gpPasniedzejsUzvards . ' ' . $gpPasniedzejsPK; ?>">
                            <?php echo $gpPasniedzejsVards . ' ' . $gpPasniedzejsUzvards . ' ' . $gpPasniedzejsPK; ?>
                        </option>
                    <?php
                        }         
                    ?>
                    </select>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <span style="padding-left: 20px"></span><input type="submit" id="gpTeacherAcceptButton" name="gpTeacherAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
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
                    
                        //Ja tiek izvēlēts pasniedzējs, 
                        //lietotājam tiek piedāvāts atbilstošs auditoriju saraksts, atkarībā no kursa
                        if (isset($_POST['gpTeacherAcceptButton'])) {
                            ?>
                            <option value=""></option>
                            <?php
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet = $mysqli->query("SELECT gpKurss FROM GrupasPlanosana ORDER BY gpID desc LIMIT 1;");
                            
                            if($resultSet->num_rows !=0){
                                while($rows = $resultSet->fetch_assoc()){
                                    $selectedKurss = $rows['gpKurss'];
                                }
                            }
                            
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet1 = $mysqli->query("SELECT nepieciesamaisAuditorijasTips 
                            FROM Kurss 
                            WHERE kKursaNosaukums='$selectedKurss'");
        
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

                        //Ja tiek izvēlēta auditorija, tās informācija tiek ievadīta DB
                        if (isset($_POST['gpRoomAcceptButton'])) {                         
                            $myServer = 'localhost';
                            $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
                            $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
                            $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
                            $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
                            mysqli_set_charset($d, 'utf8');
                            
                            $resultSet = $mysqli->query("SELECT MAX(gpID) FROM GrupasPlanosana");
                            
                            if($resultSet->num_rows !=0){
                                while($rows = $resultSet->fetch_assoc()){
                                    $maxId = $rows['MAX(gpID)'];
                                }
                            }
                            
                            $selectedRoom = $_POST['gpRoomListName'];
                            $selectedRoomParts = explode(",", $selectedRoom);
                            
                            $selectedRoomAddress = $selectedRoomParts[0];
                            $selectedRoomCity = $selectedRoomParts[1];
                            $selectedRoomCity = substr($selectedRoomCity, 1);
                            $selectedRoomName = $selectedRoomParts[2];
                            $selectedRoomName = substr($selectedRoomName, 1);
                            
                            $sql_query2 = "UPDATE GrupasPlanosana SET gpAuditorijaAdrese = '$selectedRoomAddress', gpAuditorijaPilseta = '$selectedRoomCity', gpAuditorijaNumursNosaukums = '$selectedRoomName' WHERE gpID = $maxId";
                                          
                            if (mysqli_query($d, $sql_query2)) {
                                // echo "Ieraksts par lietotaju veiksmīgi pievienots";
                            } else {
                                echo "Error: " . $sql_query2 . "<br>" . mysqli_error($d);
                            }

                            mysqli_close($d);   
                            
                            ?>
                            <option value="<?php echo $selectedRoom; ?>">
                                <?php echo $selectedRoom; ?>
                            </option>
                        <?php
                        }

                        //Ja tiek nospiesta kāda no tālākām pogām,
                        //auditorijas informācijas tiek ielasīta saraksta laukā atkārtoti
                        if (isset($_POST['gpDatesAcceptButton']) ||
                            isset($_POST['gpStudentSearchButton']) ||
                            isset($_POST['gpAddSelectedStudentsButton'])) {
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet = $mysqli->query("SELECT gpAuditorijaAdrese, gpAuditorijaPilseta, gpAuditorijaNumursNosaukums FROM GrupasPlanosana ORDER BY gpID DESC LIMIT 1;");
            
                            if($resultSet->num_rows !=0){
                                while($rows = $resultSet->fetch_assoc()){
                                    $gpAuditorijaAdrese = $rows['gpAuditorijaAdrese'];
                                    $gpAuditorijaPilseta = $rows['gpAuditorijaPilseta'];
                                    $gpAuditorijaNumursNosaukums = $rows['gpAuditorijaNumursNosaukums'];
                                }
                            }
                            ?>
                            <option value="<?php echo $gpAuditorijaAdrese . ", " . $gpAuditorijaPilseta . ", " . $gpAuditorijaNumursNosaukums; ?>">
                                <?php echo $gpAuditorijaAdrese . ", " . $gpAuditorijaPilseta . ", " . $gpAuditorijaNumursNosaukums; ?>
                            </option>
                            <?php
                        }
                    ?>
                </select>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <span style="padding-left: 20px"></span><input type="submit" id="gpRoomAcceptButton" name="gpRoomAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td style="border: 3px solid #DCE6F7;">
                <label id="gpDateLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td>
                <?php
                //Ja tiek apstiprināti datumi, to informācija tiek ievadīta DB
                if (isset($_POST['gpDatesAcceptButton'])) {                         
            $myServer = 'localhost';
            $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
            $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
            $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
            $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
            mysqli_set_charset($d, 'utf8');
                            
            $resultSet = $mysqli->query("SELECT MAX(gpID) FROM GrupasPlanosana");
                            
            if($resultSet->num_rows !=0){
                while($rows = $resultSet->fetch_assoc()){
                    $maxId = $rows['MAX(gpID)'];
                }
            }
                            
            $selectedDateFrom = $_POST['gpDateFrom'];
            $selectedDateTo = $_POST['gpDateTo'];
                            
            $sql_query2 = "UPDATE GrupasPlanosana SET gpSakumaDatums = '$selectedDateFrom', gpBeiguDatums = '$selectedDateTo' WHERE gpID = $maxId";
                                          
            if (mysqli_query($d, $sql_query2)) {
                // echo "Ieraksts par lietotaju veiksmīgi pievienots";
            } else {
                echo "Error: " . $sql_query2 . "<br>" . mysqli_error($d);
            }

            mysqli_close($d);   
                            
        }

                //Ja netiek nospiesta kāda no pogām, kurai jāielasa datumi no DB,
                //tad datumu lauki tiek izvadīti tukši
                if (!isset($_POST['gpDatesAcceptButton']) && 
                    !isset($_POST['gpStudentSearchButton']) &&
                    !isset($_POST['gpAddSelectedStudentsButton'])) {
                    ?>
                <input type="date" id="gpDateFrom" name="gpDateFrom"> - <input type="date" id="gpDateTo" name="gpDateTo">
                    <?php
                }
                //citādi datumu lauki tiek izvadīti kopā ar DB esošo informāciju
                else {
                    $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
                    $resultSet = $mysqli->query("SELECT gpSakumaDatums, gpBeiguDatums FROM GrupasPlanosana ORDER BY gpID DESC LIMIT 1;");
            
                    if($resultSet->num_rows !=0){
                        while($rows = $resultSet->fetch_assoc()){
                            $gpSakumaDatums = $rows['gpSakumaDatums'];
                            $gpBeiguDatums = $rows['gpBeiguDatums'];
                        }
                    }
                    ?>
                    <input type="date" id="gpDateFrom" name="gpDateFrom" value="<?php echo $gpSakumaDatums; ?>"> - <input type="date" id="gpDateTo" name="gpDateTo" value="<?php echo $gpBeiguDatums; ?>">
                    <?php
                }
                ?>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <span style="padding-left: 20px"></span><input type="submit" id="gpDatesAcceptButton" name="gpDatesAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>      
    </table>

    <br><br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br><br>
</div>
<?php
    include('footer.php'); 
}
?>
