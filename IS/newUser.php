<?php include('header.php');?>
    <div class="topic">
            <p>Jauna lietotāja pievienošana</p>
    </div>
    <?php
    # Veidojam savienojumu ar savu serveri un datu bāzi
    $myServer = 'localhost';
    $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
    $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
    $myPass = '';  # Norādiet savu lietotājvārdu
    # ja nevaram pievienoties - rakstam kļūdu paziņojumus
    $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
//    $sql_query="SELECT MAX(idDalibnieks) FROM dalibnieks";
//    $result=mysqli_query($d,$sql_query);
//    $sql_query="SELECT idSporta_veids,Veids_Nosaukums FROM sporta_veids";
//    $sporta_veids=mysqli_query($d,$sql_query);
//    if (mysqli_num_rows($result)<1) {
//    print "</br>datu nav</br>";
//    }
//
 //   print "<table>" ;
//    $rinda = mysqli_fetch_row($result);
//    $rinda[0]=$rinda[0]+1;
    ?>

    <div class="middleUser">
        <form action="newUser.php" method="post" enctype="multipart/form-data">
            <div class = "forTextFields">
                <label>Vārds: </label><input type="text" name="vards" /><br><br>
                <label>Uzvards: </label><input type="text" name="uzvards" /><br><br>
                <label>E-pasts: </label><input type="text" name="epasts" /><br><br>
                <label>Tālrunis: </label><input type="text" name="talrunis" /><br><br>
                <label>Perosnas kods: </label><input type="text" name="personasKods" /><br><br>
                <label>Dzīves vietas adrese: </label><input type="text" name="dzivesAdrese" /><br><br>
                <label>Dzīves vietas pilsēta: </label><input type="text" name="dzivesPilseta" /><br><br> 
                <label>Darba vietas adrese:: </label><input type="text" name="darbaAdrese" /><br><br>
                <label>Darba vietas pilsēta: </label><input type="text" name="darbaPilseta" /><br><br>
                <label>Personas foto: </label><input type="file" name="foto" id="foto"><br><br>
                <label>Lietotājvārds: </label><input type="text" name="lietotajvards" /><br><br>
                <label>Parole: </label><input type="text" name="parole" /><br><br>
                <label>Lietotāja loma: </label><br><select name="lietotajaLoma" id="lietotajaLoma">
                    <option value="L" name="L">Lietotājs</option>
                    <option value="P" name="P">Pasniedzējs</option>
                    <option value="A" name="A">Administrators</option>
                </select><br>
            </div>
            <?php         
                print "<input class=\"saveButton\" type=\"Submit\" name=\"Submit\" value=\"Pievienot\"> ";
            ?>
        </form>
    </div> 
<?php
    if(isset($_REQUEST['Submit']))
    {
        include('insertUser.php');
    }
?>

<?php include('footer.php'); ?>
        
        