<?php
     /*
     this page:
     -----------------------------------------------------------------------
     - check for strong_id cookie genereate from index.php when user comes to page
     -----------------------------------------------------------------------
     */  
     if(!empty($_COOKIE['strong_id'])) { // came from my page
          if ($_SERVER['REQUEST_METHOD'] === 'GET') {
               $data = array(file_get_contents('data.json'));
               echo json_encode($data);
          } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               // save data to file as in savePaper
               // savePaper();
               $dir = __DIR__ . '/uploads';
               if (!file_exists($dir) ) {
                    $oldmask = umask(0);  // helpful when used in linux server
                    mkdir ($dir, 0744);
               }
               $json = json_encode($_POST['paper']);
               $filepath = $dir . '/paper-' . uniqid() . '.json';
               file_put_contents($filepath, $json);
               echo json_encode(['message'=>'Saved your papar to local file system.']);
               die();
          }
     } else {
          echo json_encode(['message'=>'Not authorized.']);
          die();
     }

     function savePaper() {
          try {
               $dir = __DIR__ . '/uploads';
               if (!file_exists($dir) ) {
                    $oldmask = umask(0);  // helpful when used in linux server
                    mkdir ($dir, 0744);
               }
               $json = json_encode($_POST);
               $filepath = $dir . '/paper-' . uniqid() . '.json';
               file_put_contents($filepath, $json);
               die();
          } catch(Exception $e) {
               echo json_encode(['message'=>'Caught exception: ' .  $e->getMessage() . "\n"]);
               die();          
          }
     }

?>