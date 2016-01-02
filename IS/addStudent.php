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
    <table id="groupPlanningTable" width="100%" style="border: 3px solid #DCE6F7;">
        <form action="http://84.237.231.90/MCVS/IS/addStudent.php" method="post">
        <tr height="40px" style="border: 3px solid #DCE6F7;">
            <td width="35%" style="border: 3px solid #DCE6F7;">
                <label id="gpCourseLabel">Izvēlieties mācību grupu:</label>
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
                    
                    ?>
                </select>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <span style="padding-left: 20px"></span><input type="submit" id="gpCourseAcceptButton" name="gpCourseAcceptButton" value="Apstiprināt"><span style="padding-left: 70px"></span><input type="submit" id="gpCourseRefreshButton" name="gpCourseRefreshButton" value="Atjaunot">
            </td>
        </tr>
        </form>
        
        <form action="http://84.237.231.90/MCVS/IS/addStudent.php" method="post">
        <tr style="border: 3px solid #DCE6F7;">
            <td rowspan="3" style="vertical-align: middle">
                <label id="gpStudentLabel">Meklējiet un pievienojiet studentus:</label>
            </td>
            <td style="border: 3px solid #DCE6F7;">
                <input type="text" id="gpStudentName" placeholder="Studenta vārds" name="name">
            </td>
            <td rowspan="3" style="vertical-align: middle">
                <span style="padding-left: 20px"></span><input type="submit" id="gpStudentSearchButton" value="Meklēt" name="gpStudentSearchButton">
            </td>
        </tr>
        
        <tr>
            <td style="border: 3px solid #DCE6F7;">
                <input type="text" id="gpStudentSurname" placeholder="Studenta uzvārds" name="surname">
            </td>
        </tr>
        
        <tr>
            <td style="border: 3px solid #DCE6F7;">
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
            $sql = "SELECT * FROM Persona WHERE uzvards='$surname'";
            $result = $d->query($sql); 
        } else if($name == "" && $surname ==""){                    //ja nav ievadits vards un uzvards
            $sql = "SELECT * FROM Persona WHERE personaskods='$peronID'";
            $result = $d->query($sql); 
        } else if($peronID == ""){                                  //ja nav ievadits personas kods
            $sql = "SELECT * FROM Persona WHERE vards='$name' AND uzvards='$surname'";
            $result = $d->query($sql); 
        } else if($name == ""){                                     //ja nav ievadits vards
            $sql = "SELECT * FROM Persona WHERE uzvards='$surname' AND personaskods='$peronID'";
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
        <form action="http://84.237.231.90/MCVS/IS/addStudent.php" method="post">
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
					"<a href=\"addStudent.php?aNosaukums=".$row["personasKods"]."\">Pievienot</a>" . "</center></td></tr>";
            }
        } else {
                $x = 404;
            }
        ?>     
        </table>
        <br><br><br><br><center>
        <?php
        if($x == 404){
            echo "Pēc šādiem meklēšanas kritērijiem datubāzē nav atrasts neviens ieraksts!";
        }
        ?>
        </center>
        </form>
    </div>
    <br><br>
<?php
         
mysqli_close($d);           
    }
    ?>

</div>
<?php
    include('footer.php'); 
 }
?>
