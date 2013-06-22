<?php
require_once("database.php");
require_once('AcademicData.php');
require_once('ProfessionalData.php');
require_once('References.php');



class Services
{
	var $contractingDate;
	var $serviceType;
	var $price;
	var $estimatedVerifTime;
	
	public static function create($login,$contractingDate,$serviceType, $price, $estimatedVerifTime)
	{
		global $db;

		if(strcmp($login,'') !=0)
		{
			$query = "SELECT * FROM User WHERE UserId = '" . $login . "'";
			$row = $db->query_first($query);

			if ($db->affected_rows>0)
			{
				$query = "INSERT INTO CandidateBill SET candidateId='".$login
							."', contractingDate='".date('Y/m/d',strtotime($contractingDate))
							."', serviceType='".$serviceType
							."', price='".$price
							."', estimatedVerifTime='".$estimatedVerifTime
							."'";
				$row = $db->query($query);
				if (eregi($serviceType, 'standard'))
				{
		     		AcademicData::changeState($login);
			
				}
				else if (eregi($serviceType, 'silver'))
				{
				     AcademicData::changeState($login);
				     ProfessionalData::changeState($login);
				}
				else if (eregi($serviceType, 'gold'))
				{
		     		 AcademicData::changeState($login);
				     ProfessionalData::changeState($login);
				     References::changeState($login);
				}
			
			}
			else {
				echo "Error";
			}
		}
		else {
			echo "Field empty";
		}
	}
	
	public static function printS($userID)
	{
		global $db;
		
		$query = "SELECT * FROM CandidateBill WHERE candidateId = '" . $userID . "'";
		$row = $db->query_first($query);
		if($db->affected_rows > 0)
		{
			$result = $db->fetch_all_array($query);
			
			foreach($result as $ad)
			{
				list($year, $month, $day) = explode("-", $ad['contractingDate']);
				$contractingDate="$day-$month-$year";
				
				
?>
				<div id="item">
            		<b>Service Type:</b>
<?php
				if (eregi($ad['serviceType'], 'STANDAR')) {
?>
		<img src="services/standard.png">
<?php
				} else if (eregi($ad['serviceType'], 'SILVER')){ 
?>
		<img src="services/silver.png">
<?php
				} else if (eregi($ad['serviceType'], 'GOLD')) {
?>
		<img src="services/gold.png">
<?php
				}
?>
            		<div> 
	            		<b>Contracting Date:</b> <?php echo $contractingDate?> 
						<b>Price:</b> <?php echo $ad['price'] ?>
						<b>Estimated Verif Time:</b> <?php echo $ad['estimatedVerifTime'] ?>
						<div id="editordelete">
							<a class="delete_button" id="<?php echo $ad['candidateId'].'_'.$ad['contractingDate']?>"></a>
						</div>
       				</div>
       			</div>
<?php
			}
			 return "si";
		} else {
			return "no";
		}

	}
	
	public static function getThumbService($candId){
		global $db;

		if(strcmp($candId,'') !=0)
		{
			$q = "SELECT * FROM CandidateBill WHERE candidateId = '" . $candId . "'";
			$row = $db->query_first($q);
			if($db->affected_rows > 0)
			{
				$result = $db->fetch_all_array($q);
				foreach($result as $ad)
				{
					if (eregi($ad['serviceType'], 'STANDAR')) {
						return  "<img src=\"services/standard.png\" align=\"right\">";
					} else if (eregi($ad['serviceType'], 'SILVER')){ 
						return  "<img src=\"services/silver.png\" align=\"right\">";
					} else if (eregi($ad['serviceType'], 'GOLD')) {
						return  "<img src=\"services/gold.png\" align=\"right\">";
					}
				}
			} else {
			return "<img src=\"services/none.png\" align=\"right\">";
			}
		}
		else {
			return "<img src=\"services/none.png\" align=\"right\">";
		}
		
	}
}

?>