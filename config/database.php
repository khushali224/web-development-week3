<?php
declare(strict_types=1);
$host="localhost"; $db="rasit_watch_db"; $user="root"; $pass=""; $charset="utf8mb4";
try {
 $pdo=new PDO("mysql:host=$host;dbname=$db;charset=$charset",$user,$pass,[
  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES=>false
 ]);
} catch(PDOException $e){ die("Database connection failed. Import database/rasit_watch_db.sql and check XAMPP MySQL."); }
