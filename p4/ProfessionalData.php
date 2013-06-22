<?php
require_once("database.php");

class ProfessionalData
{
	var $company;
	var $inDate;
	var $endDate;
	var $position;
	var $companyAddress;
	var $state;
	var $verified;
	
	public static function create($login,$company,$inDate,$endDate, $position, $companyAddress)
	{
		global $db;

		if(strcmp($login,'') !=0)
		{
			$query = "SELECT * FROM User WHERE userId = '" . $login . "'";
			print $query;
			$row = $db->query_first($query);

			if ($db->affected_rows>0)
			{
				$query = "INSERT INTO ProfessionalData SET candidateId='".$login
							."', company='".$company
							."', iniDate='".date('Y/m/d',strtotime($inDate))
							."', endDate='".date('Y/m/d',strtotime($endDate))
							."', position='".$position
							."', companyAddress='".$companyAddress
							."'";
				
				$query2 = "SELECT * FROM CandidateBill WHERE candidateId = '" . $login . "'";
				$row2 = $db->query_first($query2);
				if($db->affected_rows > 0)
				{
					if (eregi($row2['serviceType'],'SILVER') || eregi($row2['serviceType'],'GOLD')){
						echo "AKI";
						$query .= ", state='procesing'";
					}
				}
				$row = $db->query($query);
				
			}
			else {
				echo "Error";
			}
		}
		else {
			echo "Field empty";
		}
	}
	
	public static function printPD($userID)
	{
		global $db;
		
		$query = "SELECT * FROM ProfessionalData WHERE candidateId = '" . $userID . "'";
		$row = $db->query_first($query);
		if($db->affected_rows > 0)
		{
			$result = $db->fetch_all_array($query);
			
			foreach($result as $ad)
			{
				list($year, $month, $day) = explode("-", $ad['iniDate']);
				$iniDate="$day-$month-$year";
				list($year, $month, $day) = explode("-", $ad['endDate']);
				$endDate="$day-$month-$year";
				
?>
		<div id="item">
            <b>Company:</b> <?php echo $ad['company'] ?>
            <div> <b>Start Date:</b> <?php echo $iniDate?> <b>End Date:</b> <?php echo $endDate?> </div>
			<b>Position:</b> <?php echo $ad['position'] ?>
			<b>Company Address:</b> <?php echo $ad['companyAddress'] ?>
			<div id="editordelete">
				<a class="delete_button" href="deleteProfessionalData.php?id=<?php echo $ad['candidateId'].'_'.$ad['company'].'_'.$iniDate?>">
					<input type="submit" value="Delete"/>
				</a>
			</div>
			<div> <b>State: </b>
<?php
				if(strcmp($ad['state'],'') == 0){
					
?>
			<img src="states/unknown.png" width="20" height="20"> 
<?php
				} else if(eregi($ad['state'],'procesing')){
?>
			<img src="states/inprocess.png" width="20" height="20">
<?php
				} else if(eregi($ad['state'],'verified')){
?>
			<img src="states/validated.png" width="20" height="20">
<?php
				} else if(eregi($ad['state'],'notVerified')){
?>
			<img src="states/notvalidated.png" width="20" height="20">
<?php
				}
?>
			 
			 </div>
        </div>
<?php
			}
		}

	}
	
		public static function delete($candidateId,$company, $inDate){
		global $db;
		echo $inDate;
		$query = "DELETE FROM ProfessionalData WHERE candidateId = '" . $candidateId . "' AND ".
					"company = '". $company . "' AND ".
					"iniDate=  '".date('Y/m/d',strtotime($inDate))."'";
		$row = $db->query($query);
	}
	
	public static function changeState($candidateId)
	{
		global $db;
		
		$data['state']='procesing';
		$where = "candidateId='".$candidateId."'";
		$db->query_update('ProfessionalData',$data,$where);
	}
	
}

?>