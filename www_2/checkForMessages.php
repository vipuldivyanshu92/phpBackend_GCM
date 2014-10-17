<?php


$iemi=$_REQUEST['iemi'];
$result = mysql_query("SELECT name,systimestamp,destroy FROM giffie_transfer 
                      WHERE id = '$iemi' AND status='1'");





?>
