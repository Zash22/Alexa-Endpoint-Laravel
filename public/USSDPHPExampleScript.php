<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

$higateuser = "C10TestUSSD";
$higatepass = "Indigo321";

$xml = "<Message>
<Version Version=\"1.0\" />
<Response Type=\"OnUSSEvent\">
<SystemID>Higate</SystemID>
<UserID>USERNAME</UserID>
<Service>SERVICE</Service>
<Network ID=\"1\" MCC=\"649\" MNC=\"001\" />
<OnUSSEvent Type=\"Request\">
<USSContext SessionID=\"12345678\" NetworkSID=\"2576443669\"
MSISDN=\"264812504299\" Script=\"\"
ConnStr=\"*120*99*123#\" />
<USSText Type=\"TEXT\">REQ</USSText>
</OnUSSEvent>
</Response>
</Message>";


//This example uses the SimpleXMLParser to generate objects from the xml input.
//This section loads the xml from a string into the $xml object
$Body = file_get_contents('php://input');
$xml=simplexml_load_string($xml) or die("Error: Cannot create object");


//First Check if the transaction is for USSD
if ((string)$xml->Response[0]['Type'] == "OnUSSEvent"){
	//Handle The Request Type Seperately
	if ((string)$xml->Response->OnUSSEvent[0]['Type'] == "Request"){
		if ((string)$xml->Response->OnUSSEvent->USSText == "REQ") {
			$resp = new SimpleXmlElement('<Message></Message>');
 			$ver = $resp->addChild("Version","");
			$ver->addAttribute("Version","1.0");
			$req = $resp->addChild("Request","");
			$req->addAttribute("Type","USSReply");
			$req->addAttribute("SessionID",$xml->Response->OnUSSEvent->USSContext[0]['SessionID']);
			$req->addAttribute("Flags","0");
			$user = $req->addChild("UserID",$higateuser);
			$user->addAttribute("Orientation","TR");
			$req->addChild("Password",$higatepass);
			$uss = $req->addChild("USSText","Welcome to the Test Service\n1. See your msisdn\n2. Exit");
			$uss->addAttribute("Type","Text");
			$xmlr = explode("\n", $resp->asXML(), 2);
			echo $xmlr[1];
		}else if ((string)$xml->Response->OnUSSEvent->USSText == "1") {
                        $resp = new SimpleXmlElement('<Message></Message>');
                        $ver = $resp->addChild("Version","");
                        $ver->addAttribute("Version","1.0");
                        $req = $resp->addChild("Request","");
                        $req->addAttribute("Type","USSReply");
                        $req->addAttribute("SessionID",$xml->Response->OnUSSEvent->USSContext[0]['SessionID']);
                        $req->addAttribute("Flags","0");
                        $user = $req->addChild("UserID",$higateuser);
                        $user->addAttribute("Orientation","TR");
                        $req->addChild("Password",$higatepass);
                        $uss = $req->addChild("USSText","Your MSISDN is:\n".$xml->Response->OnUSSEvent->USSContext[0]['MSISDN']."\nTo Exit send 2");
                        $uss->addAttribute("Type","Text");
			$xmlr = explode("\n", $resp->asXML(), 2);
                        echo $xmlr[1];
                }else if ((string)$xml->Response->OnUSSEvent->USSText == "2") {
			//Since this is the exit message notice that we set the flags to 1 instead of 0.
                        $resp = new SimpleXmlElement('<Message></Message>');
                        $ver = $resp->addChild("Version","");
                        $ver->addAttribute("Version","1.0");
                        $req = $resp->addChild("Request","");
                        $req->addAttribute("Type","USSReply");
                        $req->addAttribute("SessionID",$xml->Response->OnUSSEvent->USSContext[0]['SessionID']);
                        $req->addAttribute("Flags","1");
                        $user = $req->addChild("UserID",$higateuser);
                        $user->addAttribute("Orientation","TR");
                        $req->addChild("Password",$higatepass);
                        $uss = $req->addChild("USSText","Thank you for using our service.");
                        $uss->addAttribute("Type","Text");
			$xmlr = explode("\n", $resp->asXML(), 2);
                        echo $xmlr[1];
                }else{ 
                        $resp = new SimpleXmlElement('<Message></Message>');
                        $ver = $resp->addChild("Version","");
                        $ver->addAttribute("Version","1.0");
                        $req = $resp->addChild("Request","");
                        $req->addAttribute("Type","USSReply");
                        $req->addAttribute("SessionID",$xml->Response->OnUSSEvent->USSContext[0]['SessionID']);
                        $req->addAttribute("Flags","0");
                        $user = $req->addChild("UserID",$higateuser);
                        $user->addAttribute("Orientation","TR");
                        $req->addChild("Password",$higatepass);
                        $uss = $req->addChild("USSText","Command not understood.\n1. See your msisdn\n2. Exit");
                        $uss->addAttribute("Type","Text");
			$xmlr = explode("\n", $resp->asXML(), 2);
                        echo $xmlr[1];
                }
	}else{
		//I have handled open and close events just by accepting them. 
		//You could check for them individually the same way as you check for the request if you want to do setup and teardown
		echo "<Response status='0'/>";
	}
}else{
	echo "<Response status='0'/>";
}


 #<Message>
#<Version Version="1.0" />
# <Request Type="USSReply" SessionID="12345678" Flags="0">
# <UserID Orientation="TR">USERNAME</UserID>
# <Password>PASSWORD</Password>
# <USSText Type="TEXT">Welcome the this USSD session</USSText>
#  </Request>
# </Message>

?>
