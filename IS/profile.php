        <?php include('header.php'); ?>
        <div class="content">
<!--            <div class="content-top"></div>-->
            <div class="content-left">
                <input class="newUser" name="newUser" type="button" value="PIEVIENOT JAUNU LIETOTAJU" onclick="window.open('newUser.php', '_self')"/>
                <input class="newCourse" name="newCourse" type="button" value="PIEVIENOT JAUNU KURSU" onclick="window.open('newCourse.php', '_self')"/>
                <input class="newRoom" name="newRoom" type="button" value="PIEVIENOT JAUNU AUDITORIJU" onclick="window.open('newRoom.php', '_self')"/>
                
            </div>
            <div class="content-right">
                <div class="groups">
                    <input class="newGroup" name="newGroup" type="button" value="MĀCĪBU GRUPAS PLĀNOŠANA" onclick="window.open('groupPlanning.php', '_self')"/>
                </div>
            </div>
        </div> 
        <div class="topic">
            <p style="font-size:25px;">Informācijas meklēšana</p>
        </div>
        <div class="searchArray">
            <form action="" method="post">
            <div class="search-left">
                
                <label for="peroson">
                    <input type="radio" id="peroson" name="chkPassPort" value="1" onclick="ShowHideDiv()" />
                    <b>persona</b>
                </label>
                <label for="course">
                    <input type="radio" id="course" name="chkPassPort" value="2" onclick="ShowHideDiv()" />
                    <b>Kurss</b>
                </label>
                
                <label for="room">
                    <input type="radio" id="room" name="chkPassPort" value="3" onclick="ShowHideDiv()" />
                    <b>Auditorija</b>
                </label>
<!--____________________________________________________________________-->
                <div id="showPerson" style="display: none">
                    Vards: <input type="text" id="name" name="name"/><br>
                    Uzvards:<input type="text" id="surname" name="surname"/><br>
                    Personas kods: <input type="text" id="peronID" name="peronID"/>
                </div>
 <!--____________________________________________________________________-->               
                <div id="showCourse" style="display: none">
                    Kursa kods: <input type="text" id="courseID" name="courseID"/><br>
                    Kursa nosaukums:<input type="text" id="courseName" name="courseName"/><br>
                </div>
 <!--____________________________________________________________________-->               
                <div id="showRoom" style="display: none">
                    Numurs: <input type="text" id="number" name="number"/><br>
                    Nosaukums:<input type="text" id="roomName" name="roomName"/><br>
                </div>
<!--____________________________________________________________________-->
            </div>
            <div class="search-right">
            <?php         
                print "<input class=\"searchButton\" type=\"Submit\" name=\"Submit\" value=\"Meklet\"> ";
            ?>
            </div>
                </form>
        </div>
<?php
    if(isset($_REQUEST['Submit']))
    {
        include('search.php');
    }
?>
<!--
        <div class="founded">
    
        </div>
-->
        <?php include('footer.php'); ?>