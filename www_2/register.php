<?php
           require_once('loader.php');
            
           // return json response 
           $json = array();
            
           $nameUser  = stripUnwantedHtmlEscape($_POST["name"]);
           $emailUser = stripUnwantedHtmlEscape($_POST["email"]);
           $gcmRegID  = stripUnwantedHtmlEscape($_POST["regId"]); // GCM Registration ID got from device
           $imei      = stripUnwantedHtmlEscape($_POST["imei"]);
           $ph_num    = stripUnwantedHtmlEscape($_POST["ph_num"]);
           
           // Send this message to device
           $message = $nameUser." Registeration success.../n Happy Giffieing";
            
           /**
            * Registering a user device in database
            * Store reg id in users table
            */
           if ( isset($nameUser) && 
                isset($emailUser) && 
                isset($gcmRegID) && 
                $nameUser!="" && 
                $imei!="" && 
                $gcmRegID!="" && 
                $emailUser!="" &&
                $ph_num!=""
               ) {
               
              if(!isUserExisted($emailUser,$gcmRegID))
              {
               // Store user details in db
               $res = storeUser($nameUser, $emailUser, $gcmRegID,$imei,$ph_num);
            
               $registration_ids = array($gcmRegID);
               $messageSend = array("message" => $message);
            
               $result = send_push_notification($registration_ids, $messageSend);
            
              }//echo $result;
              
               
           } else {
               // user details not found
               echo "Wrong values";
           }
   ?>
