<?php
//後からだと大変なので､各ファイルからrequireで読み込み
if( $_SERVER['HTTP_HOST'] == 'localhost'){
  $host   = 'localhost';
  $dbname = 'shop'; 
  $user   = 'root';
  $pswd   = 'kunren718';
  
} else {
  $host   = 'localhost';
  $dbname = 'sho';  // xserverで変わる情報
  $user   = 'sho'; 
  $pswd   = 'kunren718'; 
}

// 例外的なエラーをキャッチして自動分岐します
try{

  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $user, 
    $pswd 
  );
} catch (Exception $e) {
  echo 'どれかまちがってる';
}