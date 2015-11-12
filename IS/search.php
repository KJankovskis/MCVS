<?php

# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($d, 'utf8');

$chkPassPort = $_POST["chkPassPort"];

if($chkPassPort == "1"){
    $name = $_REQUEST["name"];          //Mainigie no
    $surname = $_REQUEST["surname"];    //ievades
    $peronID = $_REQUEST["peronID"];    //laukiem
    
    if($surname == "" && $peronID ==""){                        //ja nav ievadits uzvards un personas kods
    $sql = "SELECT * FROM Persona WHERE vards='$name'";
    $result = $d->query($sql);    
    } else if($name == "" && $peronID ==""){                    //ja nav ievadits vards un personas kods
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
    <div class="founded">
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Vārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uzvārds</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Personas kods</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Darba vietas adrese</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uz profila lapu</th>
          </tr>
          <tr>
        <?php
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<td>" . $row["vards"]. "</td><td>" . $row["uzvards"]. "</td><td>" . $row["personasKods"]. "</td><td>" .                               $row["darbaAdrese"]. ", " . $row["darbaPilseta"]. "</td> </tr>". "<br>";
                }
            } else {
                echo "Datubāzē, nav neviena persona ar šadu vārdu:";
            }
        ?>     
        </table>
    </div>
<?php
}  
else if($chkPassPort == "2"){
    $courseID = $_REQUEST["courseID"];
    $courseName = $_REQUEST["courseName"];
     
    if($courseID == ""){                                    //ja nav kursa kods
        $sql = "SELECT * FROM Kurss WHERE kKursaNosaukums='$courseName'";
        $result = $d->query($sql); 
    } else if($courseName == ""){                           //ja nav kursa nosaukums
        $sql = "SELECT * FROM kurss WHERE kursaKods='$courseID'";
        $result = $d->query($sql);  
    } else{                                                 //ja visi lauki ir aizpilditi
        $sql = "SELECT * FROM kurss WHERE vards='$name' AND kursaKods='$courseID' AND kKursaNosaukums='$courseName'";
        $result = $d->query($sql);
    }
?>
  <div class="founded">
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Kods</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Nosaukums</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Auditorijas tips</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Ietilpība</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Kursa ilgums</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uz kursa lapu</th>
          </tr>
          <tr>
        <?php
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<td>" . $row["kursaKods"]. "</td><td>" . $row["kKursaNosaukums"]. "</td><td>" . $row["nepieciesamaisAuditorijasTips"]. "</td><td>" . $row["kMaksimalaisStudentuSkaits"]. "</td><td>" . $row["kursaIlgums"]. "</td> </tr>". "<br>";
                }
            } else {
                echo "Datubāzē, nav neviena persona ar šadu vārdu:";
            }
        ?>     
        </table>
    </div>
<?php
}
else if($chkPassPort == "3"){
    $roomName = $_REQUEST["roomName"];
    $sql = "SELECT * FROM Auditorija WHERE aNumursNosaukums='$roomName'";
    $result = $d->query($sql); 
?>
  <div class="founded">
        <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
          <tr>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Nosaukums/Numurs</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Pilsēta</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Adrese</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Ietilpība</th>
                <th style="padding: 5px; border: 1px solid black; border-collapse: collapse;">Uz auditorijas lapu</th>
          </tr>
          <tr>
        <?php
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<td>" . $row["aNumursNosaukums"]. "</td><td>" . $row["aAdrese"]. "</td><td>" . $row["aPilseta"]. "</td><td>" . $row["aMaksimalaisStudentuSkaits"]. "</td> </tr>". "<br>";
                }
            } else {
                echo "Datubāzē, nav neviena persona ar šadu vārdu:";
            }
        ?>     
        </table>
    </div>
}
mysqli_close($d);
?>