<?php
require_once('Services.php');

///////////////////     Constants and importations      /////////////////////////
$system_name = "Candidate Validation System";
$current_version = "v0.2";
$cvs_email = "cvs.aw.urjc@gmail.com";
$gold_price = 40;
$silver_price = 30;
$standar_price = 20;

///////////////////     Functions       /////////////////////////

function print_head()
{
        global $system_name;
        echo "
                <html><head>
                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\" media=\"screen\">
                <title>". $system_name ."</title>
                </head>
                <br>
                <br>
               
               
                <body>";
       
}

function print_end(){
        echo"</body></html>";
}

function print_header($username, $type) {
        print_head();
        global $system_name;
        echo "
                <div id=\"page\">
                        <div id=\"header\"></div>
                       
                        <div id=\"mainarea\">
                        <div id=\"sidebar\">
                                <div id=\"headerleft\">
                                        <h1>". $system_name. "</h1>
                                </div>
                                <div id=\"menulinks\">";


        switch ($type)
        {
                case "candidate":
                        echo "<h2>Service</h2>". Services::getThumbService($username) ."
                                <br/><br/><br/><a href=\"Candidate_PD.php\">PERSONAL DATA</a>
                                <a href=\"Candidate_AD.php\">ACADEMIC DATA</a>
                                <a href=\"Candidate_PFD.php\">PROFFESIONAL DATA</a>
                                <a href=\"Candidate_REF.php\">REFERENCES</a>
                                <a href=\"Candidate_S.php\">SERVICES</a>
                                <a href=\"Candidate_E.php\">EMPLOYEERS</a>
                                ";
                        break;
                case "employeer":
                        echo "
                                <a href=\"personal_data_employeer.php\">PERSONAL DATA</a>
                                <a href=\"services_employeer.php\">SERVICES</a>
                                <a href=\"contracted_services_employeer.php\">CONTRACTED SERVICES</a>
                                <a href=\"employeer_bills.php\">BILLS</a>
                                ";
                        break;
                       
                case "verificator":
                        echo "
                                <a href=\"personal_data_verificator.php\">PERSONAL DATA</a>
                                <a href=\"verify_academic.php\">VERIFY ACADEMIC DATA</a>
                                <a href=\"verify_professional.php\">VERIFY PROFESSIONAL DATA</a>
                                <a href=\"verify_references.php\">VERIFY REFERENCES</a>
                                ";
                        break;
        }

       
        echo "<a href=\"logout.php\">LOGOUT</a>
                                </div>
                        </div>";
                       
        echo "<div id=\"contentarea\">";
}

function print_welcome($username, $usertype){
        global $cvs_email;
        echo "<h2> Hello, " . $username . "<br>" .
                        "You are logged in the system as a " . $usertype . "</h2><br>";
        echo "<h3> Choose between the options on your left. " .
                        "<br> For further contact information or help you can send " .
                        "us an e-mail to: <a href=\"mailto:" . $cvs_email ."\"/>" . $cvs_email ."</a>";
               
       
}
function print_footer(){
        global $current_version;
        echo "</div>";
        echo
        "<div id=\"footer\">
                Current version: ". $current_version ."
                </div>
        </div>
        ";
        print_end();
       
}


function print_login_form(){
        global $system_name;
        print_head();
        echo "<h1> ". $system_name ."</h1>";
        echo "<FORM METHOD=POST ACTION=\".\">
                                                <h2>Username:
                                                <INPUT TYPE=\"text\" NAME=\"username\">
                                                <BR>
                                                Password:
                                                <INPUT TYPE=\"password\" NAME=\"password\">
                                                <br>
                                                <INPUT TYPE=\"submit\"name=\"submit\" value=\"Send\"></h2>
                                                </FORM>";
        echo "Are you new?. <a href=\"registration.html\">Click here to register</a>";
        print_end();

}

function print_msg($msg){
        print_head();
        echo "<h1>" . $msg . "</h1>";
        print_end();
}

function print_content_msg($msg)
{
        echo "<h2>" . $msg . "</h2>";
}



####Verificator######
function print_verificator_personal_data($name,$lastName)
{
        echo "

                        <h2>PERSONAL DATA</h2>
                        These are your personal data.<br><br><br>
                        <b>NAME: </b> " . $name . " <br><br>
       
                        <b>LAST NAME: </b> " . $lastName . " <br><br>

                ";
}

function print_full_name($full_name)
{
        echo "<h2>" . $full_name . "</h2>";
}

function print_professional_item($company, $companyAddress, $iniDate, $endDate, $position, $verificatorId, $candidateId)
{
        echo "<div id=\"item\">" .
                "<b> Company: </b>" . $company . "<br>" .
                "<b> Company address: </b>" . $companyAddress . "<br>" .
                "<b> Start date: </b>" . $iniDate .
                "<b> End date: </b>" . $endDate . "<br>" .
                "<b> Position: </b>" . $position . "<br>";
       
        /*We will present two different options:
                If the verificator is null, give the possibility of "locking this service"
                If the verificator is myself, offer the possibility the possibility of saying is the data is correct or not
        */
       

        echo "<div id=\"editordelete\">";
        echo "<b> <br>Actions: <br><br></b>";
        if ($verificatorId=="")
        {
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=lock&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&iniDate=" . $iniDate . "&company=".$company . "\">" .
                                "<img alt=\"Verify myself\" title=\"Verify myself\" src=\"states/lock.png\"/></a> " ;
        }else{
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=verify&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&iniDate=" . $iniDate . "&company=".$company . "\">" .
                                "<img alt=\"Verify\" title=\"Verify\" src=\"states/validated.png\"/></a> " ;
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=noverify&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&iniDate=" . $iniDate . "&company=".$company . "\">" .
                                "<img alt=\"Do not verify\" title=\"Do not verify\" src=\"states/notvalidated.png\"/></a> " ;
        }
               
        echo "</div></div>";

}

function print_reference_item($referenceName, $referenceLastName, $telephone, $relationship, $email, $verificatorId, $candidateId, $recommendationLetter)
{
        echo "<div id=\"item\">" .
                "<b> Name: </b>" . $referenceName . "<br>" .
                "<b> Last name: </b>" . $referenceLastName . "<br>" .
                "<b> Telephone: </b>" . $telephone .
                "<b> Relationship: </b>" . $relationship . "<br>" .
                "<b> E-mail: </b>" . $email . "<br>";
       
        if ($recommendationLetter!=null)
                echo "<b> Comments from him/her: </b>" . $recommendationLetter . "<br>";
               
       
        /*We will present three different options:
                If the verificator is empty, give the possibility of "locking this service"
                If the verificator is myself and there is not recommendation letter - waiting for it
                If the verificator is myself, and there is already recommendation letter - show verify/not verify options
        */
        echo "<div id=\"editordelete\">";
        echo "<b> <br>Actions: <br><br></b>";
        if ($verificatorId=="")
        {
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=lock&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&referenceName=" . $referenceName . "&referenceLastName=".$referenceLastName . "\">" .
                                "<img alt=\"Verify myself\" title=\"Verify myself\" src=\"states/lock.png\"/></a> " ;
        }else if ($verificatorId == $_SESSION["username"] && $recommendationLetter==null){
                echo "<img alt=\"Waiting for an answer\" title=\"Waiting for an answer\" src=\"states/mail.jpg\"/>";
        }else if ($verificatorId == $_SESSION["username"] && $recommendationLetter!=null){
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=verify&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&referenceName=" . $referenceName . "&referenceLastName=".$referenceLastName . "\">" .
                                "<img alt=\"Verify\" title=\"Verify\" src=\"states/validated.png\"/></a> " ;
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=noverify&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&referenceName=" . $referenceName . "&referenceLastName=".$referenceLastName . "\">" .
                                "<img alt=\"Do not verify\" title=\"Do not verify\" src=\"states/notvalidated.png\"/></a> " ;
        }
               
        echo "</div></div>";


}



function print_reference_form($candidateId, $referenceName, $referenceLastName){
        global $system_name;
        print_head();
        echo "<h1> ". $system_name ."</h1>";
        echo "<FORM METHOD=POST ACTION=\"process_reference_answer.php\">
                                                <h2>Comment:
                                                <BR><TEXTAREA NAME=\"recommendationLetter\"COLS=40 ROWS=6></TEXTAREA>
                                                <input type=\"hidden\" name=\"candidateId\" value=\"" . $candidateId ."\">
                                                <input type=\"hidden\" name=\"referenceName\" value=\"" . $referenceName ."\">
                                                <input type=\"hidden\" name=\"referenceLastName\" value=\"" . $referenceLastName ."\">
                                                <BR><INPUT TYPE=\"submit\"name=\"submit\" value=\"Send\"></h2>
                                                </FORM>";

        print_end();

}


function print_academic_item($centerName, $degree, $iniDate, $endDate, $candidateId, $verificatorId, $email, $observations, $verified)
{
        echo "<div id=\"item\">" .
                "<b> Center name: </b>" . $centerName . "<br>" .
                "<b> Degree: </b>" . $degree . "<br>" .
                "<b> Start date: </b>" . $iniDate .
                "<b> End date: </b>" . $endDate . "<br>";
        if      ($email!=null)
        {
                echo "<b> Agreement: </b> Yes <br>";
                echo "<b> Contact e-mail for verifications: </b>" . $email . "<br>";
                if ($verified!=null)
                {
                        echo "<b> Validated: </b> "; if($verified>0){ echo "Yes";}else{ echo"No";}; echo " <br>";
                        echo "<b> Observations from center: </b>" ; if($observations!=null){ echo $observations;}else{ echo"No observations sent";}; echo " <br>";
                       
                }
        }else{
                echo "<b> Agreement: </b> No <br>";
        }

       
        /*We will present three different options:
                If the verificator is null, give the possibility of "locking this service"
                If the verificator is myself:
                        If there is not agreement, show  verify/not verify
                        If there is agreement:
                                If there is not answer: show waiting for an answer
                                else: show verify/not verify
        */
        echo "<div id=\"editordelete\">";
        echo "<b> <br>Actions: <br><br></b>";
        if ($verificatorId=="")
        {
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=lock&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&centerName=" . $centerName . "&degree=".$degree . "\">" .
                                "<img alt=\"Verify myself\" title=\"Verify myself\" src=\"states/lock.png\"/></a> " ;
        }else if ($verificatorId == $_SESSION["username"] && ($email==null || ($email!=null && $verified!=null) )){
                //no agreement or agreement and answer already received - observations removed because maybe there are not
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=verify&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&centerName=" . $centerName . "&degree=".$degree . "\">" .
                                "<img alt=\"Verify\" title=\"Verify\" src=\"states/validated.png\"/></a> " ;
                echo "<a href=\"" .$_SERVER["PHP_SELF"] . "?action=noverify&verificatorId=". $_SESSION["username"] . "&candidateId=". $candidateId . "&centerName=" . $centerName . "&degree=".$degree . "\">" .
                                "<img alt=\"Do not verify\" title=\"Do not verify\" src=\"states/notvalidated.png\"/></a> " ;
        }else if ($verificatorId == $_SESSION["username"] && $email!=null && $verified==null){
                //agreement, but not answer yet- observations removed because maybe there are not
                echo "<img alt=\"Waiting for an answer\" title=\"Waiting for an answer\" src=\"states/mail.jpg\"/>";
        }
               
        echo "</div></div>";

}


function print_academic_form($candidateId, $centerName, $degree, $iniDate, $endDate){
        global $system_name;
        print_head();
        echo "<h1> ". $system_name ."</h1>";
        echo "Did he/she get the degree " . $degree ." during the period :" . $iniDate . " to " . $endDate ."?";
        echo "<FORM METHOD=POST ACTION=\"process_center_answer.php\">
                                                <h2>Observations:
                                                <BR><TEXTAREA NAME=\"observations\"COLS=40 ROWS=6></TEXTAREA>
                                               
                                                <br><select size=\"1\" name=\"verified\">
                                                <option value=\"0\" selected>No</option>
                                                <option value=\"1\">Yes</option>
                                                </select>

                                                <input type=\"hidden\" name=\"candidateId\" value=\"" . $candidateId ."\">
                                                <input type=\"hidden\" name=\"centerName\" value=\"" . $centerName ."\">
                                                <input type=\"hidden\" name=\"degree\" value=\"" . $degree ."\">
                                                <BR><INPUT TYPE=\"submit\"name=\"submit\" value=\"Send\"></h2>
                                                </FORM>";

        print_end();

}

####Employeer######
function print_items_employer_bill($array)
{
	global $gold_price,$silver_price,$standar_price;
        foreach($array as $key=>$val)
        {
                echo "<div id=\"item\">
                       
                    <b>Candidate:</b> ".$val['name']." ".$val['lastName']."
                                <b>Service Type:</b> ";
               
                                switch ($val['serviceType'])
                                {
                                        case ("GOLD"):
                                                echo "<img src=\"services/gold.png\">";
                                                $price= $gold_price;
                                                break;
                                        case ("SILVER"):
                                                echo "<img src=\"services/silver.png\">";
                                                $price= $silver_price;
                                                break;
                                        case ("STANDAR"):
                                                echo "<img src=\"services/standard.png\">";
                                                $price= $standar_price;
                                                break;
                                }
                    echo"<div> <b>Contracting Date:</b> ".$val['contractingDate']." <b>Expiration Date:</b> ".$val['expirationDate']." </div>";
                    echo"<div> <b>Price:</b> ".$price." </div>
                </div>";
     }
       
}


function print_academic_data($array)
{
        echo "<b>ACADEMIC DATA</b><br>";
        foreach($array as $key=>$val)
        {
                echo "<div id=\"item\">
                       
                    <b>Degree:</b> ".$val['degree']."
                                <b>Center:</b> ".$val['centerName']."
                    <div> <b>Start Date:</b> ".$val['iniDate']." <b>End Date:</b> ".$val['endDate']." </div>";
                   
                    switch($val['state'])
                    {
                        case ("procesing"):
                                echo"<div> <b>State: </b> <img src=\"states/inprocess.png\"> </div>
                                        </div>";
                                break;
                        case ("verified"):
                                echo"<div> <b>State: </b> <img src=\"states/validated.png\"> </div>
                                        </div>";
                                break;
                        case ("notVerified"):
                                echo"<div> <b>State: </b> <img src=\"states/notvalidated.png\"> </div>
                                        </div>";
                                break;
                        default:
                                echo"<div> <b>State: </b> <img src=\"states/unknown.png\"> </div>
                                        </div>";                
                    }
                                   
                               
     }
}

function print_proffesional_data($array)
{
        echo "<b>PROFFESIONAL DATA</b><br>";
        foreach($array as $key=>$val)
        {
                echo"<div id=\"item\">
            <b>Company name:</b>" .$val['company']." <br>
                        <b>Company address:</b>" .$val['companyAddress']."<br>
                        <b>Position:</b>" .$val['position']."<br>
            <div> <b>Start Date:</b>" .$val['iniDate']." <b>End Date:</b>" .$val['endDate']." </div>";
                       
                        switch($val['state'])
                    {
                        case ("procesing"):
                                echo"<div> <b>State: </b> <img src=\"states/inprocess.png\"> </div>
                                        </div>";
                                break;
                        case ("verified"):
                                echo"<div> <b>State: </b> <img src=\"states/validated.png\"> </div>
                                        </div>";
                                break;
                        case ("notVerified"):
                                echo"<div> <b>State: </b> <img src=\"states/notvalidated.png\"> </div>
                                        </div>";
                                break;
                        default:
                                echo"<div> <b>State: </b> <img src=\"states/unknown.png\"> </div>
                                        </div>";                
                    }
        }
       
}

function print_references_data($array)
{
        echo "<b>REFERENCES</b><br>";
        foreach($array as $key=>$val)
        {
                echo"<div id=\"item\">
            <b>NAME: </b> ".$val['referenceName']." <br>
                <b>LASTNAME: </b>  ".$val['referenceLastName']." <br>
               
                <b>RELATIONSHIP: </b> ".$val['relationship']." <br>";
               
                        switch($val['state'])
                    {
                        case ("procesing"):
                                echo"<div> <b>State: </b> <img src=\"states/inprocess.png\"> </div>
                                        </div>";
                                break;
                        case ("verified"):
                                echo"<div> <b>State: </b> <img src=\"states/validated.png\"> </div>
                                        </div>";
                                break;
                        case ("notVerified"):
                                echo"<div> <b>State: </b> <img src=\"states/notvalidated.png\"> </div>
                                        </div>";
                                break;
                        default:
                                echo"<div> <b>State: </b> <img src=\"states/unknown.png\"> </div>
                                        </div>";                
                    }
        }
       
}




function print_employeer_personal_data($companyName, $address,$telephone, $email)
{
        echo "
                <div id=\"contentarea\">
                        <h2>PERSONAL DATA</h2>
                        These are your personal data.<br><br><br>
                        <b>COMPANY NAME: </b> " . $companyName . " <br><br>
       
                        <b>ADDRESS: </b> " . $address . " <br><br>
                        <b>TELEPHONE: </b> " . $telephone . " <br><br>" .
                        "<b>EMAIL: </b> " . $email . " <br><br>
               
               
                </div>
                ";
}

function print_available_candidates($array,$candidateId)
{

	echo"<form method='get' action=''>".
		"<TABLE>
			<TR>
			   <TD><h2>CANDIDATES: " .
				"<select name='candidate'>";
				foreach($array as $key=>$val){
					echo "<option value='". $val['candidateId']."'";
					if ($val['candidateId']==$candidateId){
						echo "selected";
						}
					echo ">".$val['name']." ".$val['lastName']."</option>"; 
				}
   				 echo "</select></h2> </TD>
			   <TD><input type='submit' name='Submit' value='Submit'></TD>
			</TR>
		</TABLE>".
    		"</form>";
	
	
}


function print_available_services($candidateService,$candidateId,$error,$choosedService){
	
	global $gold_price,$silver_price,$standar_price;
	
	switch ($candidateService){
		
		case ("GOLD"):
		
			echo"<div id='item'>

            	<img src='services/gold.png'>  <br/><br/>" .
            	"<b>GOLD SERVICE </b> Price: ".$gold_price. 
				"<form method='get' action=''>" .
				"<TABLE>
					<TR>
					   <TD><b>CREDIT CARD NUMBER:</b> </TD>
					   <TD><input type='text' name='creditcard'></TD>
					</TR>
					<TR>
					   <TD><b>EXPIRED DATE:</b></TD>
					   <TD><input type='text' name='expiredDate'></TD>
					</TR>" .
					"<TR>
					   <TD><b>HOLDER:</b></TD>
					   <TD><input type='text' name='holder'></TD>
					</TR>
				</TABLE> 
					</br>
				 	<input type='submit' name='buygold' value='Buy Now!'> ";
				 	if ($error and $choosedService=="GOLD"){
				 		echo "<font color='#ff0000'>INCORRECT CREDIT CARD NUMBER</font>";
				 		
				 	}
				 	echo "<input type=\"hidden\" name=\"candidateId\" value=\"" . $candidateId ."\">
				 	<input type=\"hidden\" name=\"candidateService\" value=\"" . $candidateService ."\">
				</form>
				With this service you can check his academic data.		
        		</div>";
        	
        case ("SILVER"):
		
			echo"<div id='item'>

            	<img src='services/silver.png'>  <br/><br/>" .
            	"<b>SILVER SERVICE </b> Price: ".$silver_price. 
				"<form method='get' action=''>" .
				"<TABLE>
					<TR>
					   <TD><b>CREDIT CARD NUMBER:</b> </TD>
					   <TD><input type='text' name='creditcard'></TD>
					</TR>
					<TR>
					   <TD><b>EXPIRED DATE:</b></TD>
					   <TD><input type='text' name='expiredDate'></TD>
					</TR>" .
					"<TR>
					   <TD><b>HOLDER:</b></TD>
					   <TD><input type='text' name='holder'></TD>
					</TR>
					</TABLE> 
					</br>
				 	<input type='submit' name='buysilver' value='Buy Now!'> ";
				 	if ($error and $choosedService=="SILVER"){
				 		echo "<font color='#ff0000'>INCORRECT CREDIT CARD NUMBER</font>";
				 		
				 	}
				 	echo "<input type=\"hidden\" name=\"candidateId\" value=\"" . $candidateId ."\">
				 	<input type=\"hidden\" name=\"candidateService\" value=\"" . $candidateService ."\">
				</form>
				With this service you can check his academic data.		
        		</div>";
        	
		case ("STANDAR"):
		
			echo"<div id='item'>

            	<img src='services/standard.png'>  <br/><br/>" .
            	"<b>STANDARD SERVICE </b> Price: ".$standar_price.
				"<form method='get' action=''>" .
				"<TABLE>
					<TR>
					   <TD><b>CREDIT CARD NUMBER:</b> </TD>
					   <TD><input type='text' name='creditcard'></TD>
					</TR>
					<TR>
					   <TD><b>EXPIRED DATE:</b></TD>
					   <TD><input type='text' name='expiredDate'></TD>
					</TR>" .
					"<TR>
					   <TD><b>HOLDER:</b></TD>
					   <TD><input type='text' name='holder'></TD>
					</TR>
					</TABLE> 
					</br>
				 	<input type='submit' name='buystandar' value='Buy Now!'> ";
				 	if ($error and $choosedService=="STANDAR"){
				 		echo "<font color='#ff0000'>INCORRECT CREDIT CARD NUMBER</font>";
				 		
				 	}
				 	echo "<input type=\"hidden\" name=\"candidateId\" value=\"" . $candidateId ."\">
				 	<input type=\"hidden\" name=\"candidateService\" value=\"" . $candidateService ."\">
				</form>
				With this service you can check his academic data.		
        		</div>";
        	
	}
		
	}
	
	/*function print_employeer_bill($data)
	{
		echo "<div id=\"item\">               
        	<b>Candidate:</b> ".$data["name"]." ".$data["lastName"]."
                <b>Service Type:</b> ";
   
                    switch ($data["serviceType"])
                {
                        case ("GOLD"):
                                echo "<img src=\"services/gold.png\">";
                                break;
                        case ("SILVER"):
                                echo "<img src=\"services/silver.png\">";
                                break;
                        case ("STANDAR"):
                                echo "<img src=\"services/standard.png\">";
                                break;
                }
                   echo"<div> <b>Contracting Date:</b> ".$data["contractingDate"]." <b>Expiration Date:</b> ".$data["expirationDate"]." </div>";
                   echo"<div> <b>Price:</b> "."Coger precio fichero constantes "." </div>
                </div>";
		
		
		
	}*/

      

?>