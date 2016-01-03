<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	 include('header.php'); ?>
        <div class="content">
<!--            <div class="content-top"></div>-->
            <div class="content-left">
                <input class="newUser" name="newUser" type="button" value="PIEVIENOT JAUNU LIETOTĀJU" onclick="window.open('newUser.php', '_self')"/>
                <input class="newCourse" name="newCourse" type="button" value="PIEVIENOT JAUNU KURSU" onclick="window.open('newCourse.php', '_self')"/>
                <input class="newRoom" name="newRoom" type="button" value="PIEVIENOT JAUNU AUDITORIJU" onclick="window.open('newRoom.php', '_self')"/>
                
            </div>
            <div class="content-right">
				<input class="addStudent" name="newGroupGroup" type="button" value="IZVEIDOT JAUNU MĀCĪBU GRUPU" onclick="window.open('groupPlanning.php', '_self')"/>
				<input class="newGroupGroup" name="addStudent" type="button" value="PIEVIENOT STUDENTUS MĀCĪBU GRUPAI" onclick="window.open('addStudent.php', '_self')"/>
				
				<!--<form method="post" action="addStudent.php">
					<input class="addStudent" id="addStudent" name="addStudent" type="submit" value="PIEVIENOT STUDENTUS GRUPAI">
                </form>
                <form method="post" action="groupPlanning.php">
					<input class="newGroupGroup" id="newGroupGroup" name="newGroupGroup" type="submit" value="MĀCĪBU GRUPU PLĀNOŠANA">
                </form>  -->
            </div>
        </div> 
        <div class="topic">
            <p style="font-size:25px;">Informācijas meklēšana</p>
        </div>
        <div class="searchArray">
			<table id="searchInfo" width="80%">
			<form action="" method="post">
				<tr height="20px" style="font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="allBorder">
						<label style="font-size:20px;">Lietotājs: </label>
					</td>
					<td width="20%" class="allBorder">
						<input id="name" type="text" name="name"/>
					</td>
					<td width="20%" class="allBorder">
						<input id="surname" type="text" name="surname" />
					</td>
					<td width="20%" class="allBorder">
						<input id="peronID" type="text" name="peronID" />
					</td>
					<td width="5%" class="allBorder">				
						<input type="hidden" name="chkPassPort" value="1">
						<input type="Submit" id="searchInformation" name="Submit" value="Meklēt">
					</td>
				</tr>
				</form>
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="LRborder"></td>
					<td width="20%" class="LRborder">
						<label class="searchPerson">Vārds</label>
					</td>
					<td width="20%" class="LRborder">
						<label class="searchPerson">Uzvārds</label>
					</td>
					<td width="20%" class="LRborder">
						<label class="searchPerson">Personas kods</label>
					</td>
				</tr>
				<form action="" method="post">
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="LRBborder">
						<label style="font-size:20px;">Kurss: </label>
					</td>
					<td width="20%" class="LRborder">
						<input id="courseID" type="text" name="courseID"/>
					</td>
					<td width="20%" class="LRborder">
						<input id="courseName" type="text" name="courseName" />
					</td>
					<td width="20%" class="LRborder"></td>
					<td width="5%" class="LRborder">
						<input type="hidden" name="chkPassPort" value="2">
						<input type="Submit" id="searchInformation" name="Submit" value="Meklēt">
					</td>
				</tr>
				</form>
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="LRborder"></td>
					<td width="20%" class="LRTborder">
						<label id="searchCourse">Kods</label>
					</td>
					<td width="20%"class="LRTborder">
						<label id="searchCourse">Nosaukums</label>
					</td>
					<td class="LRTborder"></td>
					<td class="LRTborder"></td>
				</tr>
				<form action="" method="post">
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="LRBborder">
						<label style="font-size:20px;">Auditorija: </label>
					</td>
					<td width="20%" class="LRborder">
						<input id="roomName" type="text" name="roomName"/>
					</td>
					<td width="20%" class="LRborder"></td>
					<td width="20%" class="LRborder"></td>
					<td width="5%" class="LRborder">
						<input type="hidden" name="chkPassPort" value="3">
						<input type="Submit" id="searchInformation" name="Submit" value="Meklēt">
					</td>
				</tr>
				</form>
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="LRborder"></td>
					<td width="20%" class="LRTborder">
						<label id="searchRoom">Numurs/Nosaukums</label>
					</td>
					<td width="20%" class="LRTborder"></td>
					<td width="20%" class="LRTborder"></td>
					<td width="5%" class="LRTborder"></td>
				</tr>
				<form action="" method="post">
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="LRBborder">
						<label style="font-size:20px;">Mācību grupa: </label>
					</td>
					<td width="20%" class="LRBborder">
						<input id="groupName" type="text" name="groupName"/>
					</td>
					<td width="20%" class="LRBborder"></td>
					<td width="20%" class="LRBborder"></td>
					<td width="5%" class="LRBborder">
						<input type="hidden" name="chkPassPort" value="4">
						<input type="Submit" id="searchInformation" name="Submit" value="Meklēt">
					</td>
				</tr>
				</form>
				<tr height="20px" style=" font-size:10px; text-align: center; line-height: 0.3;">
					<td width="20%" class="allBorder"></td>
					<td width="20%" class="allBorder">
						<label id="searchGroup">Nosaukums</label>
					</td>
				</tr>
			</table>
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
<?php include('footer.php'); 
}		
?>