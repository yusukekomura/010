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
  <title>新規アンケート用紙作成</title>
  <link href="css/test.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="body">

<header>
<?php include("menu.php");?>
 
</header>
<!-- //キャンバス -->
<canvas id="drowarea" width="1080" height="300"  style="border:1px solid blue;"></canvas>
        <input type="button" id="save" value="画像に変換" onclick="chgImg()">
<div id = "image">
        <canvas id="cv1" width="1250" height="1800"  style="border:1px solid blue;">   
        </canvas>
        <div><img id="newImg"></div>
        </div>

<?php
$name = $_SESSION["name"];
?>
<!-- Head[End] -->
<!-- Main[Start] -->
<script src="js/jquery-2.1.3.min.js">
        const kyan =$("#cv1")[0];
        const ttt =kyan.getContext("2d");
        const tt =kyan.getContext("2d");
        $("#save").on("click",function(e){
          var name = <?php echo json_encode($name);?>;
          ttt.fillText(name), 500, 323); 

</script>

<!-- Main[End] -->


</body>
</html>

