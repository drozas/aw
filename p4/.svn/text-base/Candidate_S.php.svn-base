<?php
require_once('Services.php');
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
		<h2>SERVICES</h2>
			
		These are services you can contract.<br><br>

			<?php

				$r = Services::printS($_SESSION["username"]);
				if (strcmp($r, 'no') == 0)
				{
			?>
		<div id="item">
            <img src="services/standard.png"> <b>STANDARD SERVICE </b> Price: 10$ <br/>
			With this service you can validate your academic data.<br/>
			<img src="services/silver.png"> <b>SILVER SERVICE </b> Price: 18$<br/>
			With this service you can validate your academic data and your proffesional data.<br/>
			<img src="services/gold.png"> <b>GOLD SERVICE </b> Price: 30$<br/>
			With this service you can validate your academic data, your proffesional data and your references.<br/><br/>
				
			<form method=POST name="regist" action="registrateServices.php">
				<b>CHOOSE SERVICE</b><br/> 
				STANDARD<INPUT type="radio" name="serviceType" value="standard"/>
				SILVER<INPUT type="radio" name="serviceType" value="silver"/>
				GOLD<INPUT type="radio" name="serviceType" value="gold""/> <br/><br/>
				<b>CREDIT CARD NUMBER:</b> <br/>
				<input type="text" name="creditcard">
				<input type="submit" name="buystandar" value="Buy Now!"> 
			</form><br>
		</div>
			<?php
				}
			?>

     
 <?php
	print_footer();
}else{
	print_msg("You are not logged into the system");
}
?>