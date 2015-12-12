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
        
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db') or die('Nevaru pievienoties datubāzei');
        $resultSet  =$mysqli->query("SELECT * FROM Persona WHERE parole='$password' AND lietotajvards='$username'");
        
        $parole = '';
        $lietotajvards = '';
        global $role;
        
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){
                $parole = $rows['parole'];
                $lietotajvards = $rows['lietotajvards'];
                $role = $rows['lietotajaLoma'];
            }
        }        
        if ($username == $lietotajvards && $password == $parole) {
                $_SESSION['login_user']=$username;
                $_SESSION['user_role']=$role;
                header("location: profile.php"); // Pārslēdzas uz citu lapu
        } 
        else {
            $error = "Nepareizi ievadīts lietotājvārds un / vai parole!";
        }
     mysqli_close($mysqli); 
    }
}
?>