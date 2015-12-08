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
            $mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
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
    <table id="groupPlanningTable" width="100%">
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px">
            <td width="35%">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="35%">
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
        <tr height="40px">
            <td>
                <label id="gpTeacherLabel">Izvēlieties pasniedzēju:</label>
            </td>
            <td>
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
            <td>
                <span style="padding-left: 20px"></span><input type="submit" id="gpTeacherAcceptButton" name="gpTeacherAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px">
            <td>
                <label id="gpRoomLabel">Izvēlieties auditoriju:</label>
            </td>
            <td>
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
            <td>
                <span style="padding-left: 20px"></span><input type="submit" id="gpRoomAcceptButton" name="gpRoomAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
        <tr height="40px">
            <td>
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
            <td>
                <span style="padding-left: 20px"></span><input type="submit" id="gpDatesAcceptButton" name="gpDatesAcceptButton" value="Apstiprināt">
            </td>
        </tr>
        </form>      
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
    <?php

    //Ja tiek nospiesta meklēšanas poga, tiek veikta meklēšana, izvadīti rezultāti
    if(isset($_REQUEST['gpStudentSearchButton'])) {
        $myServer = 'localhost';
        $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
        $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
        $myPass = 'janisk';  # Norādiet savu lietotājvārdu
        
        $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

        $name = $_REQUEST["name"];
        $surname = $_REQUEST["surname"];
        $peronID = $_REQUEST["peronID"];
    
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
        <br><br>
        <div class="founded">
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;"><center>Vārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uzvārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Personas kods</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Darba vietas adrese</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Pievienot studentu</th>
          </tr>
        <form action="http://84.237.231.90/MCVS/IS/groupPlanning.php" method="post">
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
            <br><br><br><br>
            <center>
            <?php
            echo "Pēc šādiem meklēšanas kritērijiem datubāzē nav atrasts neviens ieraksts!";
            ?>
            </center>
            <?php
        }
        ?>
        </form>
    </div>
    <br><br>
<?php
         
mysqli_close($d);           
    }
    
    //Ja tiek nospiesta studentu pievienošanas poga,
    //studentu informācija tiek ievadīta DB
    if(isset($_POST['gpAddSelectedStudentsButton'])) {            
            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db'); 
			mysqli_set_charset($mysqli, 'utf8');			
            $resultSet = $mysqli->query("SELECT MAX(gpID) FROM GrupasPlanosana;");
                            
            if($resultSet->num_rows !=0){
                while($rows = $resultSet->fetch_assoc()){
                    $maxId = $rows['MAX(gpID)'];
                }
            }
            
            $myServer = 'localhost';
                            $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
                            $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
                            $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
                            $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
                            mysqli_set_charset($d, 'utf8');
            
            $sql_query2= "INSERT INTO GrupasPlanosanaStudenti (grupasplanosana_gpID, gpsVards, gpsUzvards, gpsPK) VALUES('$maxId', 'Andris', 'Tests', '111190-22334');";
                          
            $counter = $_POST['counter'];
        
            for ($i = 1; $i <= $counter; $i++) {
                if (mysqli_query($d, $sql_query2)) {
                    // echo "Ieraksts par lietotaju veiksmīgi pievienots";
                } else {
                    echo "Error: " . $sql_query2 . "<br>" . mysqli_error($d);
                }
            }

            mysqli_close($d);   
    }
    ?>
    <select id="gpStudentResultInfo" name="gpStudentResultInfo">
        <?php

        //Ja tiek nospiesta meklēšanas vai pievienošanas poga,
        //studentu informācija tiek ielasīta no DB
        if(isset($_POST['gpStudentSearchButton']) || 
           isset($_POST['gpAddSelectedStudentsButton'])) {
            //for ($i = 1; $i < $_POST['counter']; $i++) {
            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db'); 
			mysqli_set_charset($mysqli, 'utf8');			
            $resultSet = $mysqli->query("SELECT MAX(grupasplanosana_gpID) FROM GrupasPlanosanaStudenti;");
                            
            if($resultSet->num_rows !=0){
                while($rows = $resultSet->fetch_assoc()){
                    $maxId = $rows['MAX(grupasplanosana_gpID)'];
                }
            }
            
            
            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
            $resultSet = $mysqli->query("SELECT gpsVards, gpsUzvards, gpsPK FROM GrupasPlanosanaStudenti WHERE grupasplanosana_gpID = '$maxId';");
            
            if($resultSet->num_rows !=0){
                while($rows = $resultSet->fetch_assoc()){
                    $gpsVards = $rows['gpsVards'];
                    $gpsUzvards = $rows['gpsUzvards'];
                    $gpsPK = $rows['gpsPK'];
                    
                    ?>
                    <option value="<?php echo $gpsPK; ?>">
                        <?php echo $gpsVards . " " . $gpsUzvards . " " . $gpsPK; ?>
                    </option>
                    <?php
                }
            }
        }
        //}
        ?>
    </select>
    <br><br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br><br>
</div>
<?php
    include('footer.php'); 
}
?>
