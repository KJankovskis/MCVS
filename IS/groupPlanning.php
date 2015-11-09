<?php
    include('header.php');
?>

<div class="topic">
    <p>Jaunas mācību grupas plānošana</p>
</div>
<div class="gpContent">
    <table>
        <tr>
            <td width="40%">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="40%">
                <select id="gpCourseList" style="width: 300px; height: 30px">
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
            <td width="40%">
                <label id="gpTeacherLabel" style="height: 30px">Izvēlieties pasniedzēju:</label>
            </td>
            <td width="40%">
                <select id="gpTeacherList" style="width: 300px; height: 30px">
                    <option value="000"></option>
                    <option value="001">Jānis Zariņš></option>
                    <option value="002">Indulis Celms></option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpTeacherButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <label id="gpRoomInfo" style="height: 30px">Izvēlieties auditoriju:</label>
            </td>
            <td width="40%">
                <select id="gpRoomList" style="height: 30px">
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
            <td width="40%">
                <label id="gpRoomLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td width="40%">
                <input type="date" id="gpDateFrom" style="height: 30px; width: 125px; border: 1px solid black"> - <input type="date" id="gpDateTo" style="height: 30px; width: 125px; border: 1px solid black">
            </td>
            <td width="20%">
                
            </td>
        </tr>
        
        <tr>
            <td rowspan="3" width="40%" style="vertical-align: middle">
                <label id="gpStudentLabel">Pievienojiet studentus:</label>
            </td>
            <td width="40%">
                <input type="text" id="gpStudentName" placeholder="Studenta vārds" style="height: 20px; width: 300px">
            </td>
            <td rowspan="3" width="20%" style="vertical-align: middle">
                <input type="submit" id="gpStudentSearchButton" value="Meklēt">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <input type="text" id="gpStudentSurname" placeholder="Studenta uzvārds" style="height: 20px; width: 300px">
            </td>
        </tr>
        
        <tr>
            <td width="40%">
                <input type="text" id="gpStudentID" placeholder="Studenta personas kods" style="height: 20px; width: 300px">
            </td>
        </tr>
    </table>
    <br>
    <div class="gpContenResults">
        <label id="gpCourseResultLabel" style="height: 30px; width: 300px">Izvēlētais kurss:</label>
        <label id="gpCourseResultInfo" style="height: 30px; width: 300px">Projektu vadība</label>
        <br>
        <label id="gpTeacherResultLabel" style="height: 30px; width: 300px">Izvēlētais pasniedzējs:</label>
        <label id="gpTeacherResultInfo" style="height: 30px; width: 300px">Arnis Strautiņš</label>
    </div>
    <br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br>
</div> 

<?php include('footer.php'); ?> 