<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('test.db');
      }
   }


   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      // echo "Opened database successfully\n";
   }

   $create_qry ="CREATE TABLE IF NOT EXISTS blogpost(id INTEGER PRIMARY KEY AUTOINCREMENT,
                                                      name TEXT NOT NULL DEFAULT '0',
                                                      message TEXT NOT NULL DEFAULT '0',
                                                      timestamp DATETIME DEFAULT CURRENT_TIMESTAMP)";


  $ret = $db->exec($create_qry);
  if(!$ret){
    echo $db->lastErrorMsg();
  } else {
    // echo "Table created successfully";
  }

?>
