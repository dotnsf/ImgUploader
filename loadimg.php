<?php
require( "./credentials.php" );

// 見つからなかった時用の出力内容
$contenttype = 'text/plain';
$filename = '';
$r = $_SERVER['SERVER_NAME']; //'No img.';

$id = $_GET['id'];
if( $id ){
  try{
    // id が指定された画像を取り出す
    $dbh = new PDO( $dsn, $username, $password );
    if( $dbh != null ){
      $sql = 'select type,filename,img from imgs where id = ' . $id;
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      if( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ){
        // 見つかったらそのバイナリを取り出し、出力用の Content-Type を変更
        $contenttype = $result['type']; //'image/png';
        if( !$contenttype ){
          $contenttype = 'image/png';
        }
        $filename = $result['filename'];
        $r = $result['img'];
      }
    }
  }catch( PDOException $e ){
    print( 'Error: ' . $e->getMessage() );
    die();
  }
}

header( 'Content-Type: ' . $contenttype );
if( $filename ){
  header( 'Content-Disposition: filename=' . $filename );
}
echo( $r );

@ob_flush();
@flush();

exit();
?>
