<?php

/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;


function suma_fechas($fecha,$ndias)
            

{
            
      if (preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$fecha))
            
				
              list($ano,$mes,$dia)=split("/", $fecha);
            

    	 if (preg_match("/([0-9][0-9]){1,2}-[0-9]{1,2}-[0-9]{1,2}/",$fecha))
            

              list($ano,$mes,$dia)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$ano) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-n-j",$nueva);
            

      return ($nuevafecha);  
            

}

//Start the session or recover it if exists
session_start();


//If the user has already been authenticated and it is a verificator
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="employeer"))
{
	print_header($_SESSION["username"], $_SESSION["type"]);
	
	
	$query = "SELECT c.name,c.lastName,c.candidateId " .
			"FROM `AllowedEmployeer` ae,`Candidate` c " .
			"WHERE ae.employeerId = '" . $_SESSION["username"] . "'" .
			"AND c.candidateId=ae.candidateId AND (c.candidateId NOT IN" .
			" (SELECT candidateId FROM `EmployeerBill` eb WHERE eb.employeerId = '" . $_SESSION["username"] . "'".
			" AND eb.expirationDate> NOW()))";
				
	$array = $db->fetch_all_array($query);
	
	if (isset($_GET['candidateId'])){
		$candidateId=$_GET['candidateId'];

		if (isset($_GET['creditcard'])){

			$creditCard= $_GET['creditcard'];
			if(isset($_GET['buygold'])){

				$choosedService= "GOLD";	
			}
			else if(isset($_GET['buysilver'])){
				$choosedService= "SILVER";	
			}
			else if(isset($_GET['buystandar'])){
				$choosedService= "STANDAR";	
			}
			if (is_Numeric($creditCard) and (strlen($creditCard)==16)){
				$query = "SELECT c.name,c.lastName,c.candidateId FROM Candidate c WHERE " .
				"c.candidateId='".$candidateId."'";
				$row = $db->query_first($query);
				$array = $db->fetch_all_array($query);
				$data["candidateId"]= $candidateId;
				$data["employeerId"]= $_SESSION["username"];
				$data["serviceType"]= $choosedService;
				$actualDate = date("Y-n-j",time());
				$data["contractingDate"]= $actualDate;
				//$data["expirationDate"]= date($actualDate,strtotime("+30 days"));
				$data["expirationDate"]= suma_fechas($actualDate,30);
				$db->query_insert("EmployeerBill",$data);
				$data["name"]= $row["name"];
				$data["lastName"]= $row["lastName"];
				print_content_msg("The service has been contracted succesfully");
				print_employeer_bill($data);
				
			}
			else{
				$candidateService= $_GET['candidateService'];

				print_available_candidates($array,$candidateId);
				print_content_msg("These are the Available Services for this Candidate");
				print_available_services($candidateService,$candidateId,true,$choosedService);
				
				
			}
			
			
			
		}
	}
	else if (isset($_GET['candidate'])){
		$candidateId=$_GET['candidate'];
		print_available_candidates($array,$candidateId);

		$query = "SELECT serviceType FROM CandidateBill cb WHERE cb.candidateId = '" . $candidateId . "'";
		$row = $db->query_first($query);
		if ($db->affected_rows>0){
			print_content_msg("These are the Available Services for this Candidate");
			print_available_services($row['serviceType'],$candidateId,false,"Sin servicio");
		}
		else{
			print_content_msg("This Candidate hasn't any Contracted Service");
		}
	}
	else{	
		$candidateId=null;
		if ($db->affected_rows>0){
			print_available_candidates($array,$candidateId);
			
		}
		else{
			print_content_msg("There isn't available Candidates");
		}
		#TODO: Errors management
		#else
	}	
	
	print_footer();
}
?>
