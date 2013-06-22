<?php
require_once('Candidate.php');
	session_start();
	
	if(strcmp($_GET['type'],"allow") == 0){
		$r = Candidate::allowEmployeer($_SESSION["username"],$_GET['id']);
	} else {
		$r = Candidate::denyEmployeer($_SESSION["username"],$_GET['id']);
	}
	
	if(strcmp($r,'') != 0){
		echo $r;
	}
?>
<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_E.php';
	});
	
</script>