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
        
        