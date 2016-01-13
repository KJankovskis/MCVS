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
    <p>Pievienot studentus mācību grupai</p>
</div>
<div class="gpContent">
    <br>
    <table id="groupPlanningTable" width="100%" style="border: 3px solid #DCE6F7;">
        <form action="http://84.237.231.90/MCVS/IS/addStudent.php" method="post">
			<tr height="40px" style="border: 3px solid #DCE6F7;">
				<td width="35%" style="border: 3px solid #DCE6F7;">
					<label id="gpCourseLabel">Izvēlieties mācību grupu:</label>
				</td>
				<td width="35%" style="border: 3px solid #DCE6F7;">
					<select id="gpGroupNameList" name="gpGroupNameListName">
							
							<?php
							if (isset($_POST['gpCourseAcceptButton']) || 
								isset($_POST['gpStudentSearchButton'])
							) {
							?>
							<option value="<?php echo $_POST['gpGroupNameListName']; ?>">
								<?php echo $_POST['gpGroupNameListName']; ?>
							</option>
							<?php
							$group_Name = $_POST['gpGroupNameListName'];
							$_SESSION['groupName'] = $group_Name;
							}else{
							?>
							<option selected="selected" value="0"></option>
							<?php
							$mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
							$resultSet  =$mysqli->query("SELECT * FROM MacibuGrupa");
							
							if($resultSet -> num_rows != 0) {                
								while($rows = $resultSet -> fetch_assoc()) {
									?>
									<option value="<?php echo $rows['mGrupasNosaukums']; ?>">
										<?php echo $rows['mGrupasNosaukums'];?>									
									</option>
									<?php
								}
							}
							mysqli_close($mysqli);  
	}						
						
						?>
					</select>
				</td>
				<td style="border: 3px solid #DCE6F7;">
					<span style="padding-left: 20px"></span><input type="submit" id="gpCourseAcceptButton" name="gpCourseAcceptButton" value="Apstiprināt"><span style="padding-left: 70px"></span><input type="submit" id="gpCourseRefreshButton" name="gpCourseRefreshButton" value="Atjaunot">
				</td>
			</tr>

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
				$sql = "SELECT * FROM Persona WHERE vards='$name' AND personaskods='$peronID'";
				$result = $d->query($sql); 
			} else{                                                     //ja visi lauki ir aizpilditi
				$sql = "SELECT * FROM Persona WHERE vards='$name' AND uzvards='$surname' AND personaskods='$peronID'";
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
						"<a href=\"addStudentScript.php?PK=".$row["personasKods"]."\">Pievienot</a>" . "</center></td></tr>";
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
	<br>
	<p style="text-align: center;
		padding-top: 15px;
		padding-left: 20px;
		font-size: 15px;
		font-weight: bold;
		color: red;">STUDENTS NAV PIEVIENOTS MĀCĪBU GRUPAI</p>
	<br>

</div>
<?php
    include('footer.php'); 
}
?>

