<?php include('header.php');?>
    <div class="topic">
            <p>Jauna lietotāja pievienošana</p>
    </div>
    <?php
    # Veidojam savienojumu ar savu serveri un datu bāzi
    $myServer = 'localhost';
    $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
    $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
    $myPass = 'janisk';  # Norādiet savu lietotājvārdu
    # ja nevaram pievienoties - rakstam kļūdu paziņojumus
    $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
    ?>

    <div class="middleUser">
        <form action="newUser.php" method="post" enctype="multipart/form-data">
            <div class = "forTextFields">
                <div class="forTextFieldsL">
                    <label id="newUserVards" style="height: 35px">Vārds:</label><br>
                    <label style="height: 35px">Uzvārds:</label><br>
                    <label style="height: 35px">E-pasts:</label><br>
                    <label style="height: 35px">Tālrunis:</label><br>
                    <label style="height: 35px">Personas kods:</label><br>
                    <label style="height: 35px">Dzīves vietas adrese:</label><br>
                    <label style="height: 35px">Dzīves vietas pilsēta:</label><br>
                    <label style="height: 35px">Darba vietas adrese:</label><br>
                    <label style="height: 35px">Dzīves vietas pilsēta:</label><br>
                    <label style="height: 35px">Personas foto:</label><br>
                    <label style="height: 35px">Lietotājvārds:</label><br>
                    <label style="height: 35px">Parole:</label><br>
                    <label style="height: 35px">Lietotāja loma:</label><br>
                </div>
                <div class="forTextFieldsR">
                    <input id="newUserName" type="text" name="vards"><br>
                    <input id="newUserSurname"  type="text" name="uzvards"><br>
                    <input id="newUserEmail" type="text" name="epasts"><br>
                    <input id="newUserPhone" type="text" name="talrunis"><br>
                <input id="newUserPK" type="text" name="personasKods"><br>
                <input id="newUserHomeAddress" type="text" name="dzivesAdrese"><br>
                <input id="newUserHomeCity" type="text" name="dzivesPilseta"><br> 
                <input id="newUserWorkAddress" type="text" name="darbaAdrese"><br>
                <input id="newUserWorkCity" type="text" name="darbaPilseta"><br>
                <input id="newUserPicture" type="file" name="foto" id="foto"><br>
                <input id="newUserUsername" type="text" name="lietotajvards"><br>
                <input id="newUserPassword" type="text" name="parole"><br>
                <select name="lietotajaLoma" id="lietotajaLoma">
                    <option value="L" name="L">Lietotājs</option>
                    <option value="P" name="P">Pasniedzējs</option>
                    <option value="A" name="A">Administrators</option>
                </select>
                </div>
            </div>
            <center><input id="newUserButton" class="newUserSaveButton" type="Submit" name="Submit" value="Izveidot lietotāju"></center>
        </form>
    </div> 
<?php
    if(isset($_REQUEST['Submit']))
    {
        include('insertUser.php');
    }
?>

<?php include('footer.php'); ?>
        
        