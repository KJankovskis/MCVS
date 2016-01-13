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
        <p>Jauna kursa pievienošana</p>
    </div>
    <div class="middleCourse">
        <form action="newCourse.php" method="post" enctype="multipart/form-data">
            <div class="itemsCourse">
				<div class="forTextFieldsL_Course">
					<label id="newUserVards" style="height: 35px">Kursa kods: </label><br>
					<label style="height: 35px">Kursa nosaukums: </label><br>
					<label style="height: 35px">Kursa apraksts: </label><br>
					<label style="height: 35px">Nepieciešamās auditorijas tips: </label><br>
					<label style="height: 35px">Maksimālo studentu skaits: </label><br>
					<label style="height: 35px">Kursa ilgums (dienas): </label><br>
					<label style="height: 35px">Kursa diploma dokuments:</label><br>
					<label style="height: 35px">Kursa programma:</label><br>
					<label style="height: 35px">Kursa macibu materialis:</label><br>
				</div>
				
				<div class="forTextFieldsR_Course">
					<input id="newCourseCode" type="text" name="code" /><br>
					<input id="newCourseTitle" type="text" name="title" /><br>
					<input id="newCourseSumary" type="text" name="sumary" /><br>
					<select name="auditorijasTips" id="newCourseAuditorijasTips">
						  <option value="D" name="D">Datorauditorija</option>
						  <option value="A" name="A">Auditorija</option>
					</select><br>
					<input id="newCourseCapacity" type="text" name="capacity" /><br>
					<input id="newCourseDuration" type="text" name="duration"/><br>
					<input id="newCourseDiploms" type="file" name="diploms" id="diploms"><br>
					<input id="newCourseProgramma" type="file" name="programma" id="programma"><br>
					<input id="newCourseMateriali" type="file" name="materiali" id="materiali"><br>
				</div>
            </div>
			<center><input id="newCourseButton" class="newCourseSaveButton" type="Submit" name="Submit" value="Izveidot kursu"></center>
        </form>
    </div> 
<?php
    if(isset($_REQUEST['Submit']))
    {
        include('insertCourse.php');
    }
?>
<?php include('footer.php'); 
}
?>