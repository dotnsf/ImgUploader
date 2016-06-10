<?php
require( "./credentials.php" );

try{
  $dbh = new PDO( $dsn, $username, $password );
  $r = "";
  if( $dbh != null ){
    // imgs テーブル作成
    try{
      $sql = "create table if not exists imgs(id int auto_increment primary key,type varchar(30), filename varchar(255), img mediumblob, created datetime);";
      $stmt = $dbh->prepare( $sql );
      $r = $stmt->execute();
    }catch( Exception $e ){
      $r = $e->getMessage();
    }
    echo( "create table imgs ->" . $r . "\n" );
  }
}catch( PDOException $e ){
  print( 'Error: ' . $e->getMessage() );
  die();
}
?>