<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');?>
    <div class="topic">
        <p>Jaunas auditorijas pievienošana</p>
    </div>
    <div class="middleRoom">
        <form action="newRoom.php" method="post">
        <div class="itemsRoom">
            <div class="forTextFieldsL_Room">
				<label id="newRoomVards" style="height: 35px">Auditorijas nosaukums/numurs: </label><br>
				<label style="height: 35px">Auditorijas tips: </label><br>
				<label style="height: 35px">Auditorijas adrese: </label><br>
				<label style="height: 35px">Auditorijas pilseta: </label><br>
				<label style="height: 35px">Studentu skaits: </label><br>
				<label style="height: 35px">Tāfele: </label><br>
				<label style="height: 35px">Projektors: </label><br>
				<label style="height: 35px">Video konference: </label><br>
			</div>
			<div class="forTextFieldsR_Room">
				<input id="newRoomName" type="text" name="nosaukums" /><br>
				<select name="auditorijasTips" id="newRoomAuditorijasTips">
						<option value="D" name="D">Datorauditorija</option>
						<option value="A" name="A">Auditorija</option>
				</select><br>
				<input id="newRoomAdress" type="text" name="adrese" /><br>
				<input id="newRoomCity" type="text" name="pilseta" /><br>
				<input id="newRoomCapacity" type="text" name="skaits" /><br><br>
				
				<input type="radio" name="tafele" value="1">Ir
				<input type="radio" name="tafele" value="2">Nav
				<br><br><br> 
				<input type="radio" name="projektors" value="1">Ir
				<input type="radio" name="projektors" value="2">Nav
				<br><br><br>
				<input type="radio" name="video" value="1">Ir
				<input type="radio" name="video" value="2">Nav
				<br>
			</div>
            
            </div>
				<center><input id="newRoomButton" class="newRoomSaveButton" type="Submit" name="Submit" value="Izveidot auditoriju"></center>
        </form>   
    </div>
<?php
    if(isset($_REQUEST['Submit']))
    {
        include('insertRoom.php');
    }
?>
<?php include('footer.php'); 
}
?>
