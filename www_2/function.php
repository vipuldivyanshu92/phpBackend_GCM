<?php
include_once("loader.php");
define("GOOGLE_API_KEY", "AIzaSyDSFu-uada7tIkEj4_pKfY-hKsvOgpWKTs"); // Place your Google API Key


//echo $db_conx;
          function updateTransferRow($id,$systimestamp){
               $result = mysqli_query($GLOBALS['db_conx'],"UPDATE giffie_transfers SET  
                                        status='1'
                                     WHERE id='$id' AND 
                                     systimestamp='$systimestamp'"); 
                    
          }
          /**
          * Creating a new transfer row in giffie_transfers
          *
          */
          function createTranferRow($name,$iemi,$stimestamp,$destroy) {
            // insert user into database
            //$gifpath="/images/".$name.$iemi.".gif"
            $result = mysqli_query($GLOBALS['db_conx'],"INSERT INTO giffie_transfers(
                                       name, imei, stimestamp, 
                                       destroy,systimestamp,status) 
                                     VALUES(
                                       '$name', 
                                       '$iemi', 
                                       '$stimestamp',
                                       '$destroy',
                                       NOW(),'0')"
                                      );
            // check for successful store
            if ($result) {
                // get user details
                $id = mysqli_insert_id($GLOBALS['db_conx']); // last inserted id
                $result = mysqli_query($GLOBALS['db_conx'],"SELECT id,systimestamp FROM giffie_transfers WHERE id = '$id'") or die(mysql_error());
                // return user details
                if (mysqli_num_rows($result) > 0) {
                    return mysqli_fetch_array($result);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
       /**
         * Storing new user
         * returns user details
         */
       function storeUser($name, $email,$password,$imei,$ph_num) {
            // insert user into database
            $result = mysqli_query($GLOBALS['db_conx'],"INSERT INTO giffie_users(
                                       name, email,password,
                                       imei ,ph_num,created_at) 
                                     VALUES(
                                       '$name', 
                                       '$email',
									   '$password',
                                       '$imei',
                                       '$ph_num',
                                       NOW())"
                                      );
            // check for successful store
            if ($result) {
                // get user details
                $id = mysqli_insert_id($GLOBALS['db_conx']); // last inserted id
                $result = mysqli_query($GLOBALS['db_conx'],"SELECT * FROM giffie_users WHERE id = $id") or die(mysql_error());
                // return user details
                if (mysqli_num_rows($result) > 0) {
                    return mysqli_fetch_array($result);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
     
     
        /**
         * Get user by email
         */
       function getUserByEmail($email) {
            $result = mysqli_query($GLOBALS['db_conx'],"SELECT name FROM giffie_users WHERE email = '$email' LIMIT 1");
            return $result;
        }
     
        /**
         * Getting all registered users
         */
       function getAllUsers() {
            $result = mysqli_query($GLOBALS['db_conx'],"select * FROM giffie_users");
            return $result;
        }
     
         /**
         * Getting users detail by IMEI
         */
       function getIMEIUser($imei) {
            $result = mysqli_query($GLOBALS['db_conx'],"SELECT * FROM giffie_users WHERE imei='$imei'");
            return $result;
        }
         
        /**
         * Getting users detail by REGID
         */
       function getRegIDUser($regID) {
            $result = mysqli_query($GLOBALS['db_conx'],"select * 
                                   FROM giffie_users 
                                   where gcm_regid='$regID'");
            return $result;
        }

     /**
         * Getting users detail by name
         */
       function getUserByName($name) {
            $result = mysqli_query($GLOBALS['db_conx'],"select name 
                                   FROM giffie_users 
                                   where name='$name'");
            return $result;
        }
        
     
        /**
         * Getting users detail by ph_num
         */
       function getUserByPhNum($ph_num) {
            $result = mysqli_query($GLOBALS['db_conx'],"select name 
                                   FROM giffie_users 
                                   where ph_num='$ph_num'");
            return $result;
        }
         
        /**
         * Getting users
         */
       function getIMEIUserName($imei) {
            $UserName = "";
            $result = mysqli_query($GLOBALS['db_conx'],"select name 
                                   FROM giffie_users 
                                   where imei='$imei'");
            if(mysqli_num_rows($result))
            {
               while($row = mysqli_fetch_assoc($result))
               {
                   $UserName  = $row['name'];
               }
            }
            return $UserName;
        }
     
        /**
         * Validate user
         */
      function isUserExisted($email,$name) {
       
            $result    = mysqli_query($GLOBALS['db_conx'],"SELECT email 
                                      from giffie_users 
                                      WHERE email = '$email'");
            $result2    = mysqli_query($GLOBALS['db_conx'],"SELECT email 
                                      from giffie_users 
                                      WHERE name='$name'");
            $NumOfRows = mysqli_num_rows($result);
            $NumOfRows2 = mysqli_num_rows($result2);
            if ($NumOfRows > 0) {
                // user existed
                return true;
            }
            if ($NumOfRows2 > 0) {
                // user existed
                return true;
            } 
             
               return false;
            
        }
         
        /**
         * Sending Push Notification
         */
       function send_push_notification($registatoin_ids, $message) {
             
     
            // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';
     
            $fields = array(
                'registration_ids' => $registatoin_ids,
                'data' => $message,
            );
     
            $headers = array(
                'Authorization: key=' . GOOGLE_API_KEY,
                'Content-Type: application/json'
            );
            //print_r($headers);
            // Open connection
            $ch = curl_init();
     
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
     
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
     
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
     
            // Close connection
            curl_close($ch);
            echo $result;
        }
         
         
        function stripUnwantedTags($str)
        {
            $tempStr = $str;
             
            $tempStr  = str_replace('script','scriptd',$tempStr);
            $tempStr  = str_replace('iframe','iframed',$tempStr);
            $tempStr  = str_replace('base64','',$tempStr);
            $tempStr  = str_replace('eval(','',$tempStr);
            $tempStr  = str_replace('data:','',$tempStr);
            //$tempStr  = htmlentities($tempStr, ENT_QUOTES, "UTF-8");
             
            return $tempStr;
        }
         
        function escapeStr($str)
            {
                    $tempStr  = htmlentities($str, ENT_QUOTES, "UTF-8");
                    return str_replace("'","",$tempStr);
            }
        function escapeStrMysql($str){
             
           return  mysqli_real_escape_string($GLOBALS['db_conx'],$str);
		   //return $str;
         }  
          
        
      function stripHtmlTags($str){
                                           
             return  strip_tags($str);
         }
          
      function stripUnwantedHtmlEscape($str)
      {
          return escapeStrMysql(escapeStr(stripUnwantedTags(stripHtmlTags($str))));  
      }
    ?>
