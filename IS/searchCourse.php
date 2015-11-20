<?php include('header.php');?>
<?php
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        $resultSet  =$mysqli->query("SELECT * FROM Kurss WHERE kursaKods='SM' ");
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
            <p><?php echo "<b>Kursa apraksts</b> :<br> $kursaApraksts" ?></p>
        </div>
        <p><?php echo "<b>Kursa kods:</b> :  $kursaKods" ?></p>
        <p><?php echo "<b>Nepieciešamā auditorija</b> : "; 
            if($tips == 'D'){
                echo "Datorauditorija";
            }
            else{
                echo "Auditorija";
            }
            ?></p>
        <p><?php echo "<b>Maksimālais sēdvietu skaits: </b> : $skaits" ?></p>
        <p><?php echo "<b>Kursa ilgums</b> : $ilgums" ?></p>  
        <p><?php echo "<b>Kursa apraksts</b> : $ilgums" ?></p>
    </div>
<?php include('footer.php'); ?>