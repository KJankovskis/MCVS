<?php
    include('header.php');
?>

<div class="topic">
    <p>Jaunas mācību grupas plānošana</p>
</div>
<div class="gpContent">
    <table>
        <tr>
            <td width="35%">
                <label id="gpCourseLabel">Izvēlieties mācību kursu:</label>
            </td>
            <td width="45%">
                <select id="gpCourseList">
                    <option name="000" value=""></option>
                    <option name="001" value="Projektu vadība"></option>
                    <option name="002" value="Ievads darbam ar sistēmu"></option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpCourseButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="35%">
                <label id="gpTeacherLabel" style="height: 30px">Izvēlieties pasniedzēju:</label>
            </td>
            <td width="45%">
                <select id="gpTeacherList" style="height: 30px">
                    <option name="000" value=""></option>
                    <option name="001" value="Jānis Zariņš"></option>
                    <option name="002" value="Indulis Celms"></option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpTeacherButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="35%">
                <label id="gpRoomInfo" style="height: 30px">Izvēlieties auditoriju:</label>
            </td>
            <td width="45%">
                <select id="gpRoomList" style="height: 30px">
                    <option name="000" value=""></option>
                    <option name="001" value="Liepāja, Dzintaru iela 1, 34. auditorija"></option>
                    <option name="002" value="Rīga, Bērzu iela 2, PARĪZE"></option>
                </select>
            </td>
            <td width="20%">
                <input type="submit" id="gpRoomButton" value="Pievienot">
            </td>
        </tr>
        
        <tr>
            <td width="35%">
                <label id="gpRoomLabel">Ievadiet sākuma un beigu datumus:</label>
            </td>
            <td width="45%">
                <input type="date" id="gpDateFrom"> - <input type="date" id="gpDateTo">
            </td>
            <td width="20%">
                
            </td>
        </tr>
        
        <tr>
            <td rowspan="3" width="35%">
                <label id="gpStudentLabel">Pievienojiet studentus:</label>
            </td>
            <td width="45%">
                <input type="text" id="gpStudentName" placeholder="Studenta vārds">
            </td>
            <td rowspan="3" width="20%">
                <input type="submit" id="gpStudentSearchButton" value="Meklēt">
            </td>
        </tr>
        
        <tr>
            <td width="45%">
                <input type="text" id="gpStudentSurname" placeholder="Studenta uzvārds">
            </td>
        </tr>
        
        <tr>
            <td width="45%">
                <input type="text" id="gpStudentID" placeholder="Studenta personas kods">
            </td>
        </tr>
    </table>
    <br>
    <div class="gpContentLeft">
        <label id="gpCourseResultLabel" style="height: 30px">Izvēlētais kurss:</label>
    </div>
    <div class="gpContentRight">
        <label id="gpCourseResultInfo" style="height: 30px">Projektu vadība</label>
    </div>
    <br>
    <center><input type="submit" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU"></center>
    <br>
</div> 

<?php include('footer.php'); ?>    