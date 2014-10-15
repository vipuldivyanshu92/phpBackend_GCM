<?php

require_once('loader.php');

$name=$_REQUEST['name']
$email=$_REQUEST['email']
$ph_num=$_REQUEST['ph_num']

if($ph_num!="")
{
$result=getUserByPhNum($ph_num)
if (mysql_num_rows($result) > 0) 
    {
      return mysql_fetch_array($result);
    }
}
if($email!="")
{
$result=getUserByEmail($email)
if (mysql_num_rows($result) > 0) 
    {
      return mysql_fetch_array($result);
    }
}
// add addition code to work with android response
?>
