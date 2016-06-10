<?php
require( "./credentials.php" );
if( isset( $_GET['id'] ) && $_GET['id'] ){
  try{
    $id = $_GET['id'];

    $dbh = new PDO( $dsn, $username, $password );
    if( $dbh != null ){
      // imgs テーブルから削除
      $sql = "delete from imgs where id = :id";
      $stmt = $dbh->prepare( $sql );
      $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
      $r = $stmt->execute(); //. 成功すると1
      
      $dbh = null;
    }
  }catch( PDOException $e ){
    print( 'Error: ' . $e->getMessage() );
    die();
  }
}else{
  print( 'No tmpname' );
}

header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '/' );
?>