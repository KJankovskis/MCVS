<?php
session_start(); // Sāk sesiju
$error=''; // Mainīgais erroram
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = "Nav ievadīts lietotājvārds un / vai parole!";
    }
    else{
    // definē mainīgos
        global $username;
            $username = $_POST['username'];
        $password=$_POST['password'];

        // Izveido savienojumu ar serveri
        $connection = mysql_connect("localhost", "root", "janisk");
        // Sis rindas ir lai aizsargatu informaciju datubaze
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        // izvelas datubazi
        $db = mysql_select_db("mcvs_db", $connection);
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("SELECT * FROM Persona WHERE parole='$password' AND lietotajvards='$username'", $connection);
        if($query->num_rows !=0){
			while($rows = $query->fetch_assoc()){ 
				$role = $rows['lietotajaLoma'];
			}
		}
		$rows = mysql_num_rows($query);
        if ($rows == 1) {
             
			if($role == 'L'){
				$_SESSION['login_user']=$username;
				header("location: user-page.php"); // Pārslēdzas uz citu lapu
			}
			else{
				$_SESSION['login_user']=$username;
				header("location: profile.php"); // Pārslēdzas uz citu lapu
			}
        } 
        else {
            $error = "Nepareizi ievadīts lietotājvārds un / vai parole!";
        }
     mysql_close($connection); 
    }
}
?>