<?php
   require_once('security_guard.php');
   $data = array(file_get_contents('data.json'));
   echo json_encode($data);
?>