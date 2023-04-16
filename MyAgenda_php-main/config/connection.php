<?php

  $host = "localhost";
  $dbname = "agenda";
  $user = "root";
  $pass = "";

  try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    //Actived error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e){
    // error connection
    $error = $e->getMessage();
    echo "Erro: $error";
  }