
<?php
session_start();

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

// index.phpから送られてきたデータを変数で受け取る
$_SESSION["name"]  = filter_input( INPUT_POST, "name" );
$_SESSION["email"]     = filter_input( INPUT_POST, "email" );
$_SESSION["lid"]      = filter_input( INPUT_POST, "lid" );
$_SESSION["lpw"]       = filter_input( INPUT_POST, "lpw" );
$_SESSION["kanri_flg"] = filter_input( INPUT_POST, "kanri_flg" );
$_SESSION["lpw"]      = password_hash($_SESSION["lpw"] , PASSWORD_DEFAULT);


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_test;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_test_table(name,email,lid,lpw,kanri_flg)VALUES(:name,:email,:lid,:lpw,:kanri_flg)");

$stmt->bindValue(':name', $_SESSION["name"] , PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $_SESSION["email"], PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $_SESSION["lid"] , PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $_SESSION["lpw"], PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $_SESSION["kanri_flg"], PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  // ５．index.phpへリダイレクト　この処理がないと画面が切り替わらない
header("Location: select_user.php");

}

?>
<?PHP 
// include("select_all.php");
?>


