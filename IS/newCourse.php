<?php include('header.php');?>
    <div class="topic">
        <p>Jana kursa pievienošana</p>
    </div>
    <div class="middleCourse">
        <form action="newCourse.php" method="post" enctype="multipart/form-data">
            <div class="itemsCourse">
                <label>Kursa kods: </label><input type="text" name="code" /><br><br>
                <label>Kursa nosaukums: </label><input type="text" name="title" /><br><br>
                <label>Kursa apraksts: </label><input type="text" name="sumary" /><br><br>
                <label>Nepieciešamās auditorijas tips: </label><select name="auditorijasTips" id="auditorijasTips">
                      <option value="D" name="D">Datorauditorija</option>
                      <option value="A" name="A">Auditorija</option>
                </select><br><br>
                <label>Maksimālo studentu skaits: </label><input type="text" name="capacity" /><br><br>
                <label>Kursa ilgums(dienas): </label><input type="text" name="duration"/><br><br>
                <label>Kursa diploma dokuments:</label><input type="file" name="diploms" id="diploms"><br><br>
                <label>Kursa programma:</label><input type="file" name="programma" id="programma"><br><br>
                <label>Kursa macibu materialis:</label><input type="file" name="materiali" id="materiali"><br><br>
            </div>
            <?php         
                print "<input class=\"saveButton\" type=\"Submit\" name=\"Submit\" value=\"Pievienot\"> ";
            ?>
        </form>   
    </div>
<?php
    if(isset($_REQUEST['Submit']))
    {
        include('insertCourse.php');
    }
?>
<?php include('footer.php'); ?>