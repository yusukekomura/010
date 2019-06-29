<?php
//1.POSTでParamを取得
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
$id = $_POST["id"];
//2.DB接続など
include "funcs.php";
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
// 基本的にinsert.phpの処理の流れです。
$sql ="UPDATE  gs_test_table SET name=:name,email=:email,year=:year,company=:company,birthday=:birthday,y=:y,m=:m,d=:d,sex=:sex,job=:job,experience=:experience WHERE id=:id";

$stmt = $pdo->prepare($sql);
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
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)

//SQL実行
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: select_all.php");
    exit;
}



?>
