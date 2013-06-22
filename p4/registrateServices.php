<?php
require_once('Services.php');
		session_start();
		
		$contractingDate = date('Y M D');
		
		$serviceType = $_POST['serviceType'];
		
		if (eregi($serviceType, 'standard'))
		{
		     $serviceType = 'STANDAR';
		     $price = 10;
			 $estimatedVerifTime = 5;
			
		}
		else if (eregi($serviceType, 'silver'))
		{
		     $serviceType = 'SILVER';
		     $price = 18;
			 $estimatedVerifTime = 10;
		}
		else if (eregi($serviceType, 'gold'))
		{
		     $serviceType = 'GOLD';
		     $price = 30;
			 $estimatedVerifTime = 15;
		}
		
		$r = Services::create($_SESSION["username"],$contractingDate, $serviceType, $price,$estimatedVerifTime);
		
		if (strcmp($r,'') != 0){
			echo $r;
		}
?>

<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_S.php';
	});
	
</script>

