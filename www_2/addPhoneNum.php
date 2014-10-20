<?php
//this is to be used by the users to add theie phone numbers
//the verified flag is 0 when phone number not entered.
//it becomes one when the phone number was automatically taken from phone
//it becomes 2 when it is verified.
//when verifiedis either 1 or 2 the person can be searched

include_once("function.php");

$imei=$_REQUEST["imei"];
$ph_num=$_REQUEST["ph_num"];
$country_code=$_REQUEST["ch_code"];

if($ph_num!="" && strlen($ph_num)>=10)
{
$result = mysql_query("UPDATE giffie_users SET  
                                        verified='1'
                                     WHERE imei='$imei'") or die(mysql_error());
            // check for successful store
            if ($result) {
               // 
               return json_endode(array({"message":"Number Updated.\nNow you frinds can find you.",
               "status":"1"));
            } else {
                return json_endode(array({"message":"Error, user nor found",
               "status":"0"));
            }

}
return json_endode(array({"message":"Enter a valid phone number",
               "status":"0"));
// write code to send verification number...


?>
