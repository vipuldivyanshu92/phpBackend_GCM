//This is to upload the ig in ths server
//It takes giffie_transer row's id and systimestamp

<?php

require_once('loader.php');
$id=$_REQUEST['id'];
$systimestamp=$_REQUEST['systimestamp'];

$target_dir = "uploads/";
$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
$uploadOk=1;

if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
    echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
    updateTransferRow($id,$systimestamp);
} else {
    echo "Sorry, there was an error uploading your file.";
}





?>
