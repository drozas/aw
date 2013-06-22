<?php
require_once('Candidate.php');
	
	session_start();
	
	if( is_Numeric($_POST['telephone']) ){
		$tel = $_POST['telephone'];
	} else {
		$tel = 0;
	}
	
	$r = Candidate::update($_SESSION["username"],$_POST['name'],$_POST['lastname'],$tel,$_POST['address'],$_POST['email']);
	
	if(strcmp($r,'')){
		echo $r;
	}
?>
<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_PD.php';
	});
	
</script>