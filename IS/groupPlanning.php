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
                            $i = 0;
                            $kursiArray = array ();
                
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
                <input type="submit" id="gpCourseButton" name="gpCourseButton" value="Apstiprināt">
            </td>
        </tr>
        </form>
        <tr>
            <td width="40%">
                <label id="gpTeacherLabel">Izvēlieties pasniedzēju:</label>
            </td>
            <td width="40%">
                <select id="gpTeacherList">
                    <option value="000"></option>
                    <option value="001">Jānis Zariņš</option>
                    <option value="002">Indulis Celms</option>
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
    <label id="gpCourseResultInfo"><b><?php echo $selectedCourse ?></b></label>
    <br>
    <label id="gpTeacherResultLabel" >Izvēlētais pasniedzējs:</label>
    <label id="gpTeacherResultInfo"><b><?php echo $selectedTeacher ?></b></label>
    <br>
    <label id="gpRoomResultLabel" >Izvēlētā auditorija:</label>
    <label id="gpTeacherResultInfo"><b><?php echo $selectedRoom ?></b></label>
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
    if (isset($_POST['gpCourseButton'])) {
        //include('selectTeachersAndRooms.php'); 
                            
        $selectedCourse = $_POST['gbCourseListName'];
    }

    include('footer.php'); 
?>
