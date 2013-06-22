<?php
require_once('ProfessionalData.php');
		session_start();
		
		$indate = ''.$_POST['inYear'].'-'.$_POST['inMonth'].'-'.$_POST['inDay'].'';
		$enddate = ''.$_POST['endYear'].'-'.$_POST['endMonth'].'-'.$_POST['endDay'].'';
		
		$r = ProfessionalData::create($_SESSION["username"],$_POST['company'],$indate,$enddate, $_POST['position'], $_POST['companyAddress']);
		
		if (strcmp($r,'') != 0){
			echo $r;
		}
?>

<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_PFD.php';
	});
	
</script>


