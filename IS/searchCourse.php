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
<?php
        # Veidojam savienojumu ar savu serveri un datu bāzi
		$myServer = 'localhost';
		$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
		$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
		$myPass = 'janisk';  # Norādiet savu lietotājvārdu
		# ja nevaram pievienoties - rakstam kļūdu paziņojumus
		$mysqli = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
		mysqli_set_charset($mysqli, 'utf8');
		
		$kKods=$_REQUEST['kKods'];
		
        $resultSet  =$mysqli->query("SELECT * FROM Kurss WHERE kursaKods='$kKods'");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $kursaKods = $rows['kursaKods'];
                $kKursaNosaukums = $rows['kKursaNosaukums'];
                $kursaApraksts = $rows['kursaApraksts'];
                $tips = $rows['nepieciesamaisAuditorijasTips'];
                $skaits = $rows['kMaksimalaisStudentuSkaits'];
                $ilgums = $rows['kursaIlgums']; 
            }
        }
    ?>
    <div class="name-surname">
        <p ><?php echo "$kKursaNosaukums"; ?> </p>
    </div>
    <div class="kurss">
        <div class="kursaApraksts">
            <p><?php echo "<b>Kursa apraksts</b>:<br> $kursaApraksts" ?></p>
        </div>
        <p><?php echo "<b>Kursa kods</b>:  $kursaKods" ?></p>
        <p><?php echo "<b>Nepieciešamā auditorija</b>: "; 
            if($tips == 'D'){
                echo "Datorauditorija";
            }
            else{
                echo "Auditorija";
            }
            ?></p>
        <p><?php echo "<b>Maksimālais studentu skaits</b>: $skaits" ?></p>
        <p><?php echo "<b>Kursa ilgums</b>: $ilgums dienas" ?></p>  
    </div>
<?php include('footer.php'); 
}
?>