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
include("menu.php");
?>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
   
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->
</form>
<form action="select_all.php" method="post" >
<fieldset>
<legend><label for="">条件付きで検索</label></legend>
<label for="">会社名：</label><input type="text" name="company_name">
<label for="">職種：</label><input type="text" name="jobstyle">
 <input type="submit" value="検索" width=100>
 </fieldset>
    </form>
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

$sql = "SELECT * FROM gs_test_table";


// }
// ２．データ表示SQL作成

$company_name = filter_input( INPUT_POST, "company_name" );
$jobstyle = filter_input( INPUT_POST, "jobstyle" );




if(isset($_POST["company_name"])){
$sql .=  " WHERE company = '$company_name' ";

}else if(isset($_POST["jobstyle"] )){
$sql .=  " WHERE job = '$jobstyle' ";

}else{
  $sql = "SELECT * FROM gs_test_table";
}



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
   $detail = '<form action="detail.php" method="get">'.'<input type="hidden" name="id" value='.$result["id"].'>'.'
   <input type="submit" value="更新" width="500">'.'</form>';
    $name = $result["name"];
    $email = $result["email"];
    $year=$result["year"];
    $company=$result["company"];
    $birthday=$result["birthday"];
    $sex=$result["sex"];
    $job=$result["job"];
    $experience=$result["experience"];
    $adress = $result["adress"];
    $delete = '<form action="delete.php" method="get">'.'<input type="hidden" name="id" value='.$result["id"].'>'.'
    <input type="submit" value="削除" width="500">'.'</form>';
    // $delete = '<a href="delete.php?id='.$result["id"].'">[削除]</a>';
echo '<tr>';
     if($_SESSION["kanri_flg"]=="1"){
      echo '<td>',$detail,'</td>';   
      }
echo '<td>',$name,'</td>';
echo '<td>',$email,'</td>';
echo '<td>',$year,'</td>';
echo '<td>',$company,'</td>';
echo '<td>',$birthday,'</td>';
echo '<td>',$sex,'</td>';
echo '<td>',$job,'</td>';
echo '<td>',$experience,'</td>';
echo '<td>',$adress,'</td>';
if($_SESSION["kanri_flg"]=="1"){ 
  echo '<td>',$delete,'</td>';
 }
echo '</tr>';
echo "\r\n";
    }
}

?>
</table>

<!-- Main[End] -->

</body>
</html>