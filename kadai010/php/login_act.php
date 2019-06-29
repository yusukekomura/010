<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();
include("funcs.php");
$lid = filter_input( INPUT_POST, "lid" );
$lpw = filter_input( INPUT_POST, "lpw" );
//1.  DB接続します

$pdo = db_con();

//2. データ登録SQL作成

$sql = "SELECT * FROM gs_test_table WHERE lid=:lid ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sqlError($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
// $count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["lpw"]) ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  header("Location: select_user.php");
}else{
  //logout処理を経由して全画面へ
  header("Location: select_user.php");
}
exit();

?>

