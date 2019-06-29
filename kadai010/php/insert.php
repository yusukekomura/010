
<?php

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

// index.phpから送られてきたデータを変数で受け取る
$name = $_POST["name"];
$email = $_POST["email"];
$year = $_POST["year"];
$sex = $_POST["sex"];
$birth = $_POST["birth"];
$y =$_POST["birthday-year"];
$m =$_POST["birthday-month"];
$d =$_POST["birthday-day"];
$birthday = $birth.$y."年".$m."月".$d."日";
$company = $_POST["company"];
$job = $_POST["job"];
$experience = $_POST["experience"];
$zip31 = $_POST["zip31"];
$zip32 = $_POST["zip32"];
$pref31 = $_POST["pref31"];
$addr31 = $_POST["addr31"];
$addr32 = $_POST["addr32"];
$build = $_POST["build"];
$adress = $pref31.$addr31.$addr32.$build;


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_test;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_test_table(id, name, email, year, company, birthday, y, m, d, sex, job ,experience, zip31, zip32, pref31, addr31, addr32, build, adress,
indate )VALUES(NULL, :name, :email, :year, :company, :birthday, :y, :m, :d, :sex, :job, :experience, :zip31, :zip32, :pref31, :addr31, :addr32, :build, :adress, sysdate())");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':year', $year, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':company', $company, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':y', $y, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':m', $m, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':d', $d, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':job', $job, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':experience', $experience, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':zip31', $zip31, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':zip32', $zip32, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':pref31', $pref31, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':addr31', $addr31, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':addr32', $addr32, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':build', $build, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  // ５．index.phpへリダイレクト　この処理がないと画面が切り替わらない
header("Location: select_all.php");

}

?>
<?PHP 
// include("select_all.php");
?>


