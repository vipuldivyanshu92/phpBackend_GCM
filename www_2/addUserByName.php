// addUserByName is used to add the user by just entering his name and searching.
// this will return true if the entered user name is corrent, then android will redirect to
// another page where the display will be the username(nickName) on top and then at the bottom , add message button
// this user name will be enterd in the inster sqllite db so that it is in the "recent history page" 
// and also in the freinds page.
// On top of the friends page is the add from contacts button and also the search bar , 
// whose search  button makes this request

<?php

require_once('loader.php');
$name=$_REQUEST['name']

if($name!="")
{
  $result=getUserByName($name)
  if (mysql_num_rows($result) > 0) 
    {
      echo 'EXISTS';
    }
  else
  {
  echo 'NULL'
  }
}

?>
