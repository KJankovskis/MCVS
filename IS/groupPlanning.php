<?php
    include('header.php');

    $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
    $resultSet  =$mysqli->query("SELECT * FROM Kurss");
        if($resultSet -> num_rows != 0) {
            $i = 0;
            
            while($rows = $resultSet -> fetch_assoc()) {
                $kurss = $rows['kKursaNosaukums'];
                
                $kursiArray = array (
                    $kursiArray[i] = $kurss;
                );
            /*
            try {
                foreach ($kursiArray as $value) {
                    $kursi = $kursi + $value + ",";
                }
            } catch (Exception $e) {
                echo 'Otrais izņēmums: ',  $e -> getMessage(), "\n";
            }*/
        }
?>

<div class="topic">
    <p>Jaunas mācību grupas plānošana</p>
</div>
<div class="gpContent">
    <br>
    <label>Izvade no DB: </label>
    <br>
    <table>
        <tr>
            <td width="45%">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="35%">
                <select id="gpCourseList">
                    <option value="000"></option>
                    <option value="001">Projektu vadība</option>
                    <option value="002">Ievads darbam ar sistēmu</option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpCourseButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="45%">
                <label id="gpTeacherLabel">Izvēlieties pasniedzēju:</label>
            </td>
            <td width="35%">
                <select id="gpTeacherList">
                    <option value="000"></option>
                    <option value="001">Jānis Zariņš</option>
                    <option value="002">Indulis Celms</option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpTeacherButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="45%">
                <label id="gpRoomLabel">Izvēlieties auditoriju:</label>
            </td>
            <td width="35%">
                <select id="gpRoomList">
                    <option value="000"></option>
                    <option value="001">Liepāja, Dzintaru iela 1, 34. auditorija</option>
                    <option value="002">Rīga, Bērzu iela 2, PARĪZE</option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpRoomButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="45%">
                <label id="gpDateLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td width="35%">
                <input type="date" id="gpDateFrom"> - <input type="date" id="gpDateTo">
            </td>
            <td width="20%">
                
            </td>
        </tr>
        
        <tr>
            <td rowspan="3" width="45%" style="vertical-align: middle">
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
            <td width="35%">
                <input type="text" id="gpStudentSurname" placeholder="Studenta uzvārds">
            </td>
        </tr>
        
        <tr>
            <td width="35%">
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
    <br><br><br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br>
</div> 

<?php include('footer.php'); ?> 