<?php
require( "./credentials.php" );

// アップロードファイルを取得
$name = $_FILES["file"]["name"]; // ファイル名
$mimetype = $_FILES["file"]["type"]; // Content-Type
$filesize = $_FILES["file"]["size"]; // ファイルサイズ
$tmpname = $_FILES["file"]["tmp_name"]; // 一時ファイル名（ここに実体がある）

if( $tmpname ){
  try{
    // アップロードファイル（画像）のデータを取得
    $fp = fopen( $tmpname, "rb" );
    $imgdata = fread( $fp, $filesize );
    fclose( $fp );

    $dbh = new PDO( $dsn, $username, $password );
    if( $dbh != null ){
      // imgs テーブルに画像を格納
      $created = date( "Y/m/d H:i:s" );
      $sql = "insert into imgs(type,filename,img,created) values(:type,:filename,:img,:created)";
      $stmt = $dbh->prepare( $sql );
      $stmt->bindParam( ':type', $mimetype, PDO::PARAM_STR );
      $stmt->bindParam( ':filename', $name, PDO::PARAM_STR );
      $stmt->bindParam( ':img', $imgdata, PDO::PARAM_STR );
      $stmt->bindParam( ':created', $created, PDO::PARAM_STR );

      $r = $stmt->execute(); //. 成功すると1
      
      $dbh = null;
      //print( 'r = ' . $r );
      header( 'location: /' );
    }
  }catch( PDOException $e ){
    print( 'Error: ' . $e->getMessage() );
    die();
  }
}else{
  print( 'No tmpname' );
}
?>