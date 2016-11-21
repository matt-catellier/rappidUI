<?php  
   require_once('security_guard.php');
   //save data to file as in savePaper
   $dir = __DIR__ . '/uploads';
   if (!file_exists($dir) ) {
        $oldmask = umask(0);  // helpful when used in linux server
        mkdir ($dir, 0744);
   }
   $json = json_encode($_POST['paper']);
   $filepath = $dir . '/paper-' . uniqid() . '.json';
   file_put_contents($filepath, $json);
   echo($json)
 ?>