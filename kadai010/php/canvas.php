<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規入場者書類</title>
</head>
<header>
<?php 
session_start();
include("menu.php");
try {
    $pdo = new PDO('mysql:dbname=gs_test;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }
    
    // ２．データ表示SQL作成
    
    $sql = "SELECT * FROM gs_test_table ";
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
        
    }
}
?>
</header>
<body>
 <script type="text/javascript">
   var name = <?php echo $_SESSION["name"]  ; ?>;
   console.log(name); 
    // $_SESSION["email"] ;
    // $_SESSION["year"] ;
    // $_SESSION["company"];
    // $_SESSION["birthday"];
    // $_SESSION["sex"];
    //  $_SESSION["job"] ;
    //  $_SESSION["experience"];
    //  $_SESSION["adress"] ;
     </script>
    


</body>
</html>