<?php
// 以下の MySQL の接続情報を自身の環境に併せて編集する
$hostname = 'hostname';
$port = 3306;
$dbname = 'dbname';
$username = 'username';
$password = 'password';

// Bluemix 環境であれば上記の設定は不要
if( getenv( 'VCAP_SERVICES' ) ){
  $vcap = json_decode( getenv( 'VCAP_SERVICES' ), true );
  
  $credentials = NULL;
  try{
    if( isset( $vcap['cleardb'] ) ){
      $credentials = $vcap['cleardb'][0]['credentials'];
    }
  }catch( Exception $e ){
  }
  if( $credentials == NULL ){
    try{
      if( isset( $vcap['mysql-5.5'] ) ){
        $credentials = $vcap['mysql-5.5'][0]['credentials'];
      }
    }catch( Exception $e ){
    }
  }

  if( $credentials != NULL ){
    $hostname = $credentials['hostname'];
    $dbname = $credentials['name'];
    $port = $credentials['port'];
    $username = $credentials['username'];
    $password = $credentials['password'];
  }
}


// ここは編集不要
$dsn = 'mysql:dbname='.$dbname.';host='.$hostname.';port='.$port;
?>
