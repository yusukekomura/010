<?php
//1.POSTでParamを取得
// $name = $_POST["name"];
// $email = $_POST["email"];
// $naiyou = $_POST["naiyou"];
$id = $_GET["id"];
// $age = $_POST["age"];

//2.DB接続など
include "funcs.php";
$pdo = db_con();


// 基本的にinsert.phpの処理の流れです。
$sql ="DELETE FROM  gs_test_table  WHERE id=:id";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)



//SQL実行
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．select.phpへリダイレクト
    header("Location: select_all.php");
    exit;
}



?>
