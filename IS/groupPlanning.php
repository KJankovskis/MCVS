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
        <tr>
            <td width="40%">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="40%">
                <select id="gpCourseList" name="gbCourseListName">
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
            <td width="20%">
                <input type="submit" id="gpCourseButton" name="gpCourseButton" value="Apstiprināt" onclick="return mgAddCourse();">
            </td>
        </tr>
        </form>
        <tr>
            <td width="40%">
                <label id="gpTeacherLabel">Izvēlieties pasniedzēju:</label>
            </td>
            <td width="40%">
                <select id="gpTeacherList" name="gbTeacherListName">
                    <option value=""></option>
                    <?php
                        if (isset($_POST['gpCourseButton'])) {
                            
                        $selectedCourse = $_POST['gbCourseListName'];
                        
                        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        
                        $resultSet1 = $mysqli->query("SELECT idKurss FROM Kurss 
                        WHERE kKursaNosaukums='$selectedCourse'");
        
                        if($resultSet1->num_rows !=0){
                            while($rows = $resultSet1->fetch_assoc()){
                                $selectedCourseId = $rows['idKurss'];
                            }
                        }
                            
                            echo "Izvēlētā kursa ID: " . $selectedCourseId;
        /*    
        $resultSet2 = $mysqli->query("SELECT Persona.vards, Persona.uzvards FROM Persona
LEFT JOIN Persona_has_Kurss ON Persona.idPersona = Persona_has_Kurss.Persona_idPersona
WHERE Persona.lietotajaLoma =  'P' AND Persona_has_Kurss.Kurss_idKurss = '$selectedCourseId'");
                        
        if($resultSet2 -> num_rows != 0) {
            while($rows = $resultSet2 -> fetch_assoc()) {
                $selectedTeacherName = $rows['Persona.vards'];
                $$selectedTeacherSurame = $rows['Persona.uzvards'];
            }
        }
        
         
    }
    */
             ?>       
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpTeacherButton" value="Apstiprināt">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <label id="gpRoomLabel">Izvēlieties auditoriju:</label>
            </td>
            <td width="40%">
                <select id="gpRoomList">
                    <option value="000"></option>
                    <option value="001">Liepāja, Dzintaru iela 1, 34. auditorija</option>
                    <option value="002">Rīga, Bērzu iela 2, PARĪZE</option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpRoomButton" value="Apstiprināt">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <label id="gpDateLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td width="40%">
                <input type="date" id="gpDateFrom"> - <input type="date" id="gpDateTo">
            </td>
            <td width="20%">
                
            </td>
        </tr>
        
        <tr>
            <td rowspan="3" width="40%" style="vertical-align: middle">
                <label id="gpStudentLabel">Meklējiet un pievienojiet studentus:</label>
            </td>
            <td width="40%">
                <input type="text" id="gpStudentName" placeholder="Studenta vārds">
            </td>
            <td rowspan="3" width="20%" style="vertical-align: middle">
                <input type="submit" id="gpStudentSearchButton" value="Meklēt">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <input type="text" id="gpStudentSurname" placeholder="Studenta uzvārds">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <input type="text" id="gpStudentID" placeholder="Studenta personas kods">
            </td>
        </tr>
    </table>
    <br><br><br>
    <label id="gpCourseResultLabel">Izvēlētais kurss:</label>
    <label id="gpCourseResultInfo"><b></b></label>
    <br>
    <label id="gpTeacherResultLabel" >Izvēlētais pasniedzējs:</label>
    <label id="gpTeacherResultInfo"><b></b></label>
    <br>
    <label id="gpRoomResultLabel" >Izvēlētā auditorija:</label>
    <label id="gpTeacherResultInfo"><b></b></label>
    <br>
    <label id="gpStudentResultLabel" >Izvēlētie studenti:</label>
    <select id="gpStudentResultInfo" name="gpStudentResultInfo">
        <option></option>
    </select>
    <br><br><br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br><br>
</div>

<?php
    include('footer.php'); 
?>
