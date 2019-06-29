<?php
session_start();
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
$id=$_GET['id'];
// echo $id;
include "funcs.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_test_table WHERE id=".$id);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  
      $_SESSION["name"]  = $result["name"];
      $_SESSION["email"]= $result["email"];
      $_SESSION["year"] =$result["year"];
      $_SESSION["company"]=$result["company"];
      $_SESSION["birthday"]=$result["birthday"];
   
    $y =$result['y'];
    $m =$result["m"];
    $d =$result["d"];
    
    $sex =$result["sex"];
    $_SESSION["job"] =$result["job"];
    $_SESSION["experience"]=$result["experience"];
    $zip31 = $result["zip31"];
$zip32 = $result["zip32"];
$pref31 = $result["pref31"];
$addr31 = $result["addr31"];
$addr32 = $result["addr32"];
$build = $result["build"];
$adress = $result["adress"];
    }
}
if($_SESSION["kanri_flg"]=="1"){
  $readonly = "";

 }else{
  $readonly = "readonly";
 }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規アンケート登録</title>
  <link href="test.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="body">

<header>
<?php include("menu.php");?>
 
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div id ="haikei">
<form method="post" action="user_update.php" >
  <div class="jumbotron">
  <fieldset>
<legend><label for="">新規入場者登録画面</label></legend>
  
    <table border="1" width="800" bordercolor="#333333">
  <tr><td><label for="">名前</label></td><td><input type="text" name="name" id="name" value = "<?php echo $_SESSION["name"]; ?>"></td></tr>
  <tr><td><label for="">Email</label></td><td><input type="email" name="email" id="email" value="<?php echo $_SESSION["email"]; ?>"></td></tr>
  <tr><td><label for="">年齢</label></td><td><input type="text" style="width:50px" name="year" value="<?php echo $_SESSION["year"]; ?>"><label for="">　歳</label></td></tr>
  <tr><td><label for="">所属会社</label></td><td><input type="text" name="company" value="<?php echo  $_SESSION["company"]; ?>"></td></tr>
  <tr><td><label for="">生年月日</label></td><td><select id = "nengo1" style="width:100px" name = "birth">
                <option value="昭和"><label for="">昭和</label></option>
                <option value="平成"><label for="">平成</label></option>
                </select>
            　<input type="text" id = "birthday-year" style="width:50px" name="birthday-year" value="<?php echo $y; ?>"><label for="">年</label>
           　 <input type="text" id = "birthday-month"style="width:50px" name="birthday-month" value="<?php echo $m; ?>"><label for="">月</label>
           　 <input type="text" id = "birthday-day" style="width:50px" name="birthday-day" value="<?php echo $d; ?>"><label for="">日</label> </td></tr>
  <tr><td><label for="">性別</label></td><td><select id = "sex" style="width:100px" name="sex" >
  <option value="男"><label for="">男</label></option>
                <option value="女"><label for="">女</label></option>
                </select></td></tr>
  <tr><td><label for="">職種</label></td><td><input type="text" name="job" value="<?php echo  $_SESSION["job"]; ?>"></td></tr><br>
  <tr><td><label for="">経験年数</label></td><td><input type="text" style="width:50px" name="experience" value="<?php echo $_SESSION["experience"]; ?>"><label for="">　年</label></td></tr>
  <tr><td width="150"><label for="" id= "a">郵便番号：〒</label></td>
  <td><input type="text" name="zip31" size="4" maxlength="3" style="width:50px" value="<?php echo $zip31; ?>">
<label for=""> - </label>
<input type="text" name="zip32" size="5" maxlength="4" style="width:50px"  onKeyUp="AjaxZip3.zip2addr('zip31','zip32','pref31','addr31','addr32');" value="<?php echo $zip32; ?>">
<label for="" id= "f">※郵便番号を入力すると自動で入力されます</label></td></tr>
  <tr><td><label for="" id= "b">都道府県</label></td><td><input type="text" name="pref31" size="20" value="<?php echo $pref31; ?>"></td></tr>
  <tr><td><label for="" id= "c">市町区</label></td><td><input type="text" name="addr31" size="40" value="<?php echo $addr31; ?>"></td></tr>
  <tr><td><label for="" id= "d">それ以降の住所</label></td><td><input type="text" name="addr32" size="40" value="<?php echo $addr32; ?>"></td></tr>
  <tr><td><label for="" id= "e">建物名</label></td><td><input type="text" name="build" size="40" value="<?php echo $build; ?>"></td></tr>
  <tr><td><label for="" id= "e">画像</label></td><td> <input type="file" name = "upfile"></td></tr>

</table>
     <input type="hidden" name = "id" value="<?php echo $id; ?>">
     <input type="submit" value="送信"><br>
     </fieldset>
  
<!-- Main[End] -->


</body>
</html>

