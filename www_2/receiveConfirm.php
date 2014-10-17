/*
*This is the code to send ack for the recieve confirmation from the reciever
*when the reciever send ack, then if the destroy flag for that row is set, we take the 
*data sent and use it to unset (delete the uploaded file)
*  system file name = uploads/uploadedfile/name.iemi.systimestamp.gif
*$target_dir = "uploads/";
*$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
*/
<?php

require_once('loader.php');

$iemi=$_REQUEST['iemi'];
$id=$_REQUEST['id'];
$systimestamp=$_REQUEST['systimestamp']
$result = mysql_query("SELECT id,systimestamp FROM giffie_transfer WHERE id = '$id'") or die(mysql_error());

$file="uploads/uploadedfile/".$name.$iemi.$systimestamp.".gif"
// some condition if true
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }

?>
