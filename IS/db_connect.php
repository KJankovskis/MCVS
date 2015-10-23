
include('login.php');
$username = $_SESSION['login_user']; 
//echo "$username";
$mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
