<?php
require_once('ProfessionalData.php');
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
		<h2>PROFESSIONAL DATA</h2>
		Enter your professional data.<br><br>
		<?php

			ProfessionalData::printPD($_SESSION["username"]);
		?>

		<div id="item" class='add'>
			<form method=POST name="regist" action="registrateProfessionalData.php">
					<label for="company">Center</label>
					<input type="text" name="company"/>
					<br/> 
					<label for="inDate">In Date</label>
					Day
					<select name="inDay">	
					<?php
						for($i=1;$i<32;$i++){
					?>
					<option><?php echo $i?></option>
					<?php
						}
					?>
					</select>
					Month
					<select name="inMonth">		
					<?php
						for($i=1;$i<13;$i++){
					?>
					<option><?php echo $i?></option>
					<?php
						}
					?>
					</select>
					Year
					<select name="inYear">		
					<?php
						for($i=1970;$i<2010;$i++){
					?>
					<option><?php echo $i?></option>
					<?php
						}
					?>
					</select>
					<br/>
					<label for="endDate">End Date</label>
					Day
					<select name="endDay">	
					<?php
						for($i=1;$i<32;$i++){
					?>
					<option><?php echo$i?></option>
					<?php
						}
					?>
					</select>
					Month
					<select name="endMonth">		
					<?php
						for($i=1;$i<13;$i++){
					?>
					<option><?php echo $i?></option>
					<?php
						}
					?>
					</select>
					Year
					<select name="endYear">		
					<?php
						for($i=1970;$i<2010;$i++){
					?>
					<option><?php echo $i?></option>
					<?php
						}
					?>
					</select>
					<br/>
					<label for="position">Position</label>
					<input type="text" name="position"/>
					<br/> 
					<label for="companyAddress">Company Address</label>
					<input type="text" name="companyAddress"/>
					<br/> 
					<p> <input name="boton" TYPE="submit" VALUE="Send"> </p>
			</form>
        </div>
		<div id="linkorbutton"><a class="add_button"><input type="submit" value="Add"/></a></div>
	
	
<?php
	print_footer();
?>

<script language="JavaScript" type="text/javascript">
	var val;
	$(document).ready(function() {
		$('.add_button').click(function() {
			$('.add').show();
			$('.add_button').hide();
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