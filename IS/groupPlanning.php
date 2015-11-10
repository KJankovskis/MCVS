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
                    <option value="null"></option>
                    <?php
                        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
                        $resultSet  =$mysqli->query("SELECT * FROM Kurss");
                        
                        if($resultSet -> num_rows != 0) {
                            $i = 0;
                            $kursiArray = array ();
                
                            while($rows = $resultSet -> fetch_assoc()) {
                                ?>
                                <option value="<?php $i; ?>"><?php echo $rows['kKursaNosaukums']; ?></option>
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
                <label id="gpStudentLabel">Pievienojiet studentus:</label>
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
    <div class="gpContentResults">
        <label id="gpCourseResultLabel">Izvēlētais kurss:</label>
        <label id="gpCourseResultInfo">Projektu vadība</label>
        <br>
        <label id="gpTeacherResultLabel" >Izvēlētais pasniedzējs:</label>
        <label id="gpTeacherResultInfo">Arnis Strautiņš</label>
    </div>
    <br>
        <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br>
</div>

<?php
    if (isset($_POST['gpCourseButton'])) {
        $tests = $_POST['gbCourseListName'];

        echo "Izvēlēts: " . $tests;
    }
?>

<?php include('footer.php'); ?> 