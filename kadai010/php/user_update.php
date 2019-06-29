<?php
session_start();
//1.POSTでParamを取得
$_SESSION["name"]  = $_POST["name"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["year"] = $_POST["year"];
$_SESSION["sex"] = $_POST["sex"];
$birth = $_POST["birth"];
$y =$_POST["birthday-year"];
$m =$_POST["birthday-month"];
$d =$_POST["birthday-day"];
$_SESSION["birthday"] = $birth.$y."年".$m."月".$d."日";
$_SESSION["company"] = $_POST["company"];
$_SESSION["job"] = $_POST["job"];
$_SESSION["experience"] = $_POST["experience"];
$id = $_POST["id"];

if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    
    $file_name = $_FILES["upfile"]["name"];//ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"];//一時保存場所

    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = date("YmdHis").md5(session_id()) . "." . $extension;

    // FileUpload [--Start--]
    $img="";
    $file_dir_path = "upload/".$file_name;
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
            chmod( $file_dir_path, 0644 );
            $img = '<img src="'.$file_dir_path.'">';
        } else {
            // echo "Error:アップロードできませんでした。";
        }
    }

    
 }else{
     $img = "画像が送信されていません";
 }
//2.DB接続など
include "funcs.php";
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
// 基本的にinsert.phpの処理の流れです。
$sql ="UPDATE  gs_test_table SET name=:name,email=:email,year=:year,company=:company,birthday=:birthday,y=:y,m=:m,d=:d,sex=:sex,job=:job,experience=:experience, img=:img WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $_SESSION["name"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $_SESSION["email"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':year', $_SESSION["year"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':company', $_SESSION["company"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthday', $_SESSION["birthday"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':y', $y, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':m', $m, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':d', $d, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sex', $_SESSION["sex"] , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':job', $_SESSION["job"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':experience', $_SESSION["experience"] , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', $file_name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
//SQL実行
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: select_user.php");
    exit;
}



?>
