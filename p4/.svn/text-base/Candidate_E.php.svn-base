<?php
require_once('Employeer.php');
require_once("content.php");
session_start();	

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="candidate"))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<script type='text/javascript' src='j/jquery-1.3.js'> </script>
<?php
	print_header($_SESSION["username"], $_SESSION["type"]);
?>
		<h2>EMPLOYEERS</h2>
		
		Here you can choose which companies will see your data validated.
		<br><br>
		<div>
<?php

Employeer::printAll($_SESSION["username"]);
?>

		</div>
<?php
	print_footer();

}else{
	print_msg("You are not logged into the system");
}
?>