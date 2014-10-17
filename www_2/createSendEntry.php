//This is for creating a new send row in the table giffie_transfer
//This will allow take in the name of the reciver , sender's IEMI , date stamp
//And control parameters from phone as destroy flag. It will create a status of '0'
// and put it in with the row to tell that app that the row has been created.
//Once this has been done it will respond to the phone the unique key,timestamp,IEMI
//The phone will use this to when it is uploading the image to the server.

<?php

require_once('loader.php');
$name=$_REQUEST['name'];
$iemi=$_REQUEST['iemi'];
$stimestamp=$_REQUEST['stimestamp'];
$destroy=$_REQUEST['destroy'];

if($name!="" && $iemi!="" && $stimestamp!="" and $destroy!="")
{
  $result=createTranferRow($name,$iemi,$stimestamp,$destroy)
  if (mysql_num_rows($result) > 0) 
    {
      return $result;
    }
  else
  {
  echo 'Error';
  }
}

?>
