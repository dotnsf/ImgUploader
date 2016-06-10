<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html> 
<head> 
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta charset="utf-8"/>
<title>画像アップローダーサンプル</title> 

<link rel="shortcut icon" href="./favicon.png" type="image/png" />
<link rel="icon" href="./favicon.png" type="image/png" />

<script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css"/>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<link href="./colorbox.css" rel="stylesheet"/> 
<script type="text/javascript" src="./jquery.colorbox-min.js"></script>

<script type="text/javascript">
function delImg( id ){
  if( confirm( "本当に削除しますか？" ) ){
    location.href = "./delete.php?id=" + id;
  }
}

$(function(){
  $('.iframe').colorbox({
    iframe: true,
    width: "90%",
    height: "90%"
  });
});
</script>
<style>
html, body, {
  background-color: #ddddff;
  height: 100%;
  margin: 0px;
  padding: 0px
}
</style>
</head> 
<body> 
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="./">画像アップローダー</a>
        <button class="navbar-toggle" data-toggle="collapse" data-target=".target">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <form name="frm1" action="./up.php" method="post" enctype="multipart/form-data">
      <div class="collapse navbar-collapse target">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <input class="btn btn-primary" type="file" name="file"/>
            <input class="btn btn-info" type="submit" value="submit"/>
          </li>
        </ul>
      </div>
      </form>
    </div>
  </nav>

<?php
require( "./credentials.php" );
?>

  <div class="container" style="padding:60px 0">
    <table class='table table-bordered table-hover table-condensed'>
      <tr><th>#</th><th>URL</th><th>登録日</th><th>&nbsp;</th></tr>
<?php
try{
  $dbh = new PDO( $dsn, $username, $password );
  if( $dbh != null ){
    $sql = "select id, created from imgs order by created desc";
    $stmt = $dbh->query( $sql );
    while( $row = $stmt -> fetch( PDO::FETCH_ASSOC ) ){
      $id = $row['id'];
      $created = $row['created'];
        
      $tr = "<tr><td><a class='iframe cboxElement' rel='external' href='./loadimg.php?id=" . $id . "'><img src='http://" . $_SERVER['SERVER_NAME'] . "/loadimg.php?id=" . $id . "' width='32' height='32'/></a></td>"
          . "<td>http://" . $_SERVER['SERVER_NAME'] . "/loadimg.php?id=" . $id . "</td>"
          . "<td>" . $created . "</td>"
          . "<td><button type='button' class='btn btn-sm btn-warning' onClick='delImg(" . $id . ")'>削除</button></td>"
          . "</tr>\n";
      echo $tr;
    }
    
    $dbh = null;
  }
}catch( PDOException $e ){
  print( 'Error: ' . $e->getMessage() );
  die();
}
?>
    </table>
  </div>
</body>
</html>
