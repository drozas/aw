<?php
require_once('Candidate.php');
require_once("content.php");
session_start();

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="candidate"))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<script type='text/javascript' src='j/jquery-1.3.js'> </script>
<?php
	print_header($_SESSION["username"], $_SESSION["type"]);

	$cand = new Candidate($_SESSION["username"]);
?>
		<h2>PERSONAL DATA</h2>
		These are your personal data.<br><br><br>
		<div>
			<form method=POST name="regist" action="registratePersonalData.php">
				<label><b>NAME: </b></label> 
				<span class="no_edit"><?php echo $cand->getName();?></span>
				<span class="zedit"><input type="text" name="name" value="<?php echo $cand->getName();?>"/></span>
				<br><br>
				<label><b>LAST: </b></label>
				<span class="no_edit"><?php echo $cand->getLastName();?></span>
				<span class="zedit"><input type="text" name="lastname" value="<?php echo $cand->getLastName();?>"/></span>
				<br><br>
				<label><b>TELEPHONE: </b></label>
				<span class="no_edit"><?php echo $cand->getTelephone();?></span>
				<span class="zedit"><input type="text" name="telephone" value="<?php echo $cand->getTelephone();?>"/></span>
				<br><br>
				<label><b>ADDRESS: </b></label>
				<span class="no_edit"><?php echo $cand->getAddress();?></span>
				<span class="zedit"><input type="text" name="address" value="<?php echo$cand->getAddress();?>"/></span>
				<br><br>
				<label><b>E-MAIL: </b></label><label>
				<span class="no_edit"><?php echo $cand->getEmail();?></span>
				<span class="zedit"><input type="text" name="email" value="<?php echo $cand->getEmail();?>"/></span>
			</form>
		</div>
		<br/><br/><br/><br/>
		<div id="linkorbutton" class="no_edit"><a class="edit_button"><input type="submit" value="Edit"/></a></div>
		<div id="linkorbutton" class="zedit"><a class="submit_button"><input type="submit" value="Submit"/></a></div>

<?php
	print_footer();
?>

<script language="JavaScript" type="text/javascript">
	var val;
	$(document).ready(function() {
		$('.edit_button').click(function() {
			$('.zedit').show();
			$('.no_edit').hide();
		});
		$('.submit_button').click(function() {
			document.regist.submit();
		});
	});
	
</script>

<?php
}else{
	print_msg("You are not logged into the system");
}
?>