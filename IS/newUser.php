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
                    Vārds:<br>
                    Uzvārds:<br>
                    E-pasts:
                </div>
                <div clas="forTextFieldsR">
                    <input id="newUserName" type="text" name="vards"><br>
                    <input id="newUserSurame"  type="text" name="uzvards"><br>
                    <input id="newUserEmail" type="text" name="epasts"><br>
                </div>
                Vārds: <input id="newUserName" type="text" name="vards"><br>
                Uzvards: <input id="newUserSurame"  type="text" name="uzvards"><br>
                E-pasts: <input id="newUserEmail" type="text" name="epasts"><br>
                Tālrunis: <input id="newUserPhone" type="text" name="talrunis"><br>
                Personas kods: <input id="newUserPK" type="text" name="personasKods"><br>
                Dzīves vietas adrese: <input id="newUserHomeAddress" type="text" name="dzivesAdrese"><br>
                Dzīves vietas pilsēta: <input id="newUserHomeCity" type="text" name="dzivesPilseta"><br> 
                Darba vietas adrese:: <input id="newUserWorkAddress" type="text" name="darbaAdrese"><br>
                Darba vietas pilsēta: <input id="newUserWorkCity" type="text" name="darbaPilseta"><br>
                Personas foto: <input id="newUserPicture" type="file" name="foto" id="foto"><br>
                Lietotājvārds: <input id="newUserUsername" type="text" name="lietotajvards"><br>
                Parole: <input id="newUserPassword" type="text" name="parole"><br><br>
                Lietotāja loma: <select name="lietotajaLoma" id="lietotajaLoma">
                    <option value="L" name="L">Lietotājs</option>
                    <option value="P" name="P">Pasniedzējs</option>
                    <option value="A" name="A">Administrators</option>
                </select><br>
            </div>
            <?php         
                print "<input class=\"saveButton\" type=\"Submit\" name=\"Submit\" value=\"Izveidot lietotāju"\"> ";
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
        
        