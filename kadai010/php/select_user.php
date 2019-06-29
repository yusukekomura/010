<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>表示画面</title>

<!-- <link rel="stylesheet" href="css/range.css"> -->
<link href="hyoji.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
<?php 
session_start();
// echo 'ようこそ'.$_SESSION["name"].'さん';
include("menu.php");
?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<table>
<tr>
<?php if($_SESSION["kanri_flg"]=="1"){ ?>
<th>更新ボタン</th>
<?php }?>
<th>名前</th>
<th>Email</th>
<th>年齢</th>
<th>所属会社</th>
<th>生年月日</th>
<th>性別</th>
<th>職種</th>
<th>経験年数</th>
<th>住所</th>
<th>プロフィール画像の登録</th>
<th>用紙作成</th>
<?php if($_SESSION["kanri_flg"]=="1"){ ?>
<th>削除ボタン</th></tr>      
<?php }?>
<?php
//1.  DB接続します
// $company_name = $_POST["company_name"];
// $jobstyle = $_POST["jobstyle"];
// $date = $_POST["date"];


// $_SESSION["kaisya"]=$_POST["keyword"];
// isset()

try {
$pdo = new PDO('mysql:dbname=gs_test;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

// ２．データ表示SQL作成
$username =$_SESSION["name"];
$sql = "SELECT * FROM gs_test_table WHERE name = '$username' ";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
    
    // $detail = '<a href="detail.php?id='.$result["id"].'">[更新]</a>';
   $detail = '<form action="user_detail.php" method="get">'.'<input type="hidden" name="id" value='.$result["id"].'>'.'
   <input type="submit" value="更新" width="500">'.'</form>';
   $_SESSION["name"]  = $result["name"];
   $_SESSION["email"] = $result["email"];
   $_SESSION["year"] =$result["year"];
   $_SESSION["company"]=$result["company"];
   $_SESSION["birthday"]=$result["birthday"];
   $_SESSION["sex"]=$result["sex"];
    $_SESSION["job"] =$result["job"];
    $_SESSION["experience"]=$result["experience"];
    $_SESSION["adress"] = $result["adress"];
    $profile = '<img src = upload/<?php echo $result["img"];?>';
    $create = '<form action="user_canvas.php" method="get">'.'
    <input type="hidden" name="id" value='.$result["id"].'>'.'
    <input type="submit" value="用紙作成" width="500">'.'</form>';
    $delete = '<form action="delete.php" method="get">'.'<input type="hidden" name="id" value='.$result["id"].'>'.'
    <input type="submit" value="削除" width="500">'.'</form>';
    // $delete = '<a href="delete.php?id='.$result["id"].'">[削除]</a>';
echo '<tr>';
     if($_SESSION["kanri_flg"]=="1"){
      echo '<td>',$detail,'</td>';   
      }
echo '<td>',$_SESSION["name"] ,'</td>';
echo '<td>', $_SESSION["email"],'</td>';
echo '<td>',$_SESSION["year"],'</td>';
echo '<td>',$_SESSION["company"],'</td>';
echo '<td>',$_SESSION["birthday"],'</td>';
echo '<td>', $_SESSION["sex"],'</td>';
echo '<td>',$_SESSION["job"],'</td>';
echo '<td>', $_SESSION["experience"],'</td>';
echo '<td>', $_SESSION["adress"],'</td>';
echo '<td>',$profile,'</td>';
echo '<td>',$create,'</td>';
if($_SESSION["kanri_flg"]=="1"){ 
  echo '<td>',$delete,'</td>';
 }
echo '</tr>';

    }
}



?>
</table>
<?php echo isset($_IMG); ?>
<!-- Main[End] -->

</body>
</html>