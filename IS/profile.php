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
                    <p>MACIBU<br><br> GRUPU<br><br> PLANOSANA</p>
                </div>
            </div>
        </div> 
        <div class="searchArray">
            <div class="search-left">
        
            </div>
            <div class="search-right">
                <form>
                    <input type="text" placeholder="Search..." required>
                    <input type="button" value="Search">
                </form>
            </div>
        </div>
        <div class="founded">
    
        </div>
        <?php include('footer.php'); ?>