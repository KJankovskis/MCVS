<?php include('header.php');?>
    <div class="topic">
        <p>Jaunas auditorijas pievienošana</p>
    </div>
    <div class = "middleRoom">
        <form action="newRoom.php" method="post">
        <div class="itemsRoom">
            
            <label>Atrašanāš vieta: </label><input type="text" name="vieta" /><br><br>
            <label>Auditorijas tips: </label><select name="auditorijasTips" id="auditorijasTips">
                    <option value="D" name="D">Datorauditorija</option>
                    <option value="A" name="A">Auditorija</option>
            </select><br><br>
            <label>Studentu skaits: </label><input type="text" name="skaits" /><br><br>
            <label>Tāfele: </label><br>
            <input type="radio" name="tafele" value="1">Ir
            <input type="radio" name="tafele" value="2">Nav
            <br><br><label>Projektors: </label><br>   
            <input type="radio" name="projektors" value="1">Ir
            <input type="radio" name="projektors" value="2">Nav
            <br><br><label>Video konference: </label><br>   
            <input type="radio" name="video" value="1">Ir
            <input type="radio" name="video" value="2">Nav
            </div>
            <?php         
                print "<input class=\"saveButton\" type=\"Submit\" name=\"SubmitRoom\" value=\"Pievienot\"> ";
            ?>
        </form>   
    </div>
<?php
    if(isset($_REQUEST['SubmitRoom']))
    {
        include('insertRoom.php');
    }
?>
<?php include('footer.php'); ?>
