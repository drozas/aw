<?php
require_once('AcademicData.php');
		session_start();
		
		$indate = ''.$_POST['inYear'].'-'.$_POST['inMonth'].'-'.$_POST['inDay'].'';
		$enddate = ''.$_POST['endYear'].'-'.$_POST['endMonth'].'-'.$_POST['endDay'].'';
		
		$r = AcademicData::create($_SESSION["username"],$_POST['centerName'],$_POST['degree'],$indate,$enddate);
		
		if (strcmp($r,'') != 0){
			echo $r;
		}

?>


<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_AD.php';
	});
	
</script>


