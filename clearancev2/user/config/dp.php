<?php

    
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname="clearnce";
    $dsn = '';
    
    try {
        $dsn= 'mysql:host='.$host. ';dbname='.$dbname;
    
    
        $pdo = new PDO($dsn, $username, $password);
      // set the PDO error mode to exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   echo "Connected successfully";
    } catch(PDOException $e) {
        echo 'connection failed: '.$e->getMessage();
    }


    


?>