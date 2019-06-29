<?php

// 絞込条件のパラメータ
$idea = $_POST["idea"];
$jobtype = $_POST["jobtype"];
$perpose = $_POST["perpose"];
// $activetime = $_POST["activetime"];
// $area = $_POST["area"];

//1.  DB接続します
try {
$pdo = new PDO('mysql:dbname=endes;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

// GETで現在のページ数を取得する（未入力の場合は1を挿入）
if (isset($_GET['page'])) {
	$page = (int)$_GET['page'];
} else {
	$page = 1;
}

// スタートのポジションを計算する
if ($page > 1) {
	// 例：２ページ目の場合は、『(2 × 10) - 10 = 10』
	$start = ($page * 10) - 10;
} else {
	$start = 0;
}

// .データ表示(条件検索)
$sql = "SELECT * FROM profile";

if ($idea != "" && $jobtype != "" && $perpose != ""){

  $sql .= " WHERE idea ='" .$idea. "'";
  $sql .= " AND jobtype ='" .$jobtype. "'";
  $sql .= " AND perpose ='" .$perpose. "'";

}else if ($idea != "" && $jobtype != ""){
 
  $sql .= " WHERE idea ='" .$idea. "'";
  $sql .= " AND jobtype ='" .$jobtype. "'";
  echo $sql;

}else if ($idea != "" && $perpose != ""){
 
  $sql .= " WHERE idea ='" .$idea. "'";
  $sql .= " AND perpose ='" .$perpose. "'";

}else if ($jobtype != "" && $perpose != ""){
 
  $sql .= " WHERE jobtype ='" .$jobtype. "'";
  $sql .= " AND perpose ='" .$perpose. "'";

}else if ($idea != ""){
 
  $sql .= " WHERE idea ='" .$idea. "'";

}else if ($jobtype != ""){

  $sql .= " WHERE jobtype ='" .$jobtype. "'";

}else if ($perpose != ""){

  $sql .= " WHERE perpose ='" .$perpose. "'";

} 

//２．データ表示SQL作成(10件ずつ表示)
$stmt = $pdo->prepare( $sql  ."LIMIT {$start}, 10");
$status = $stmt->execute();

//３．データ表示(全件)
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
    // $view .= '<div class="person"><div class="person-icon"><img src="https://prog-8.com/images/html/advanced/html.png"></div>';
    $view .= '<div class="person">';    
    $view .= '<p>';
    $view .= '<img class="person-icon" src="img/profile.jpg">';
    $view .= '</p>';
    $view .= '<p>';
    $view .= "名前：".$result["profilename"];
    $view .= '</p>';
    $view .= '<p>';
    $view .= "目的：".$result["perpose"];
    $view .= '</p>';
    $view .= '<p>';
    $view .= "職種：".$result["jobtype"];
    $view .= '</p>';
    $view .= '<p>';
    $view .= "作りたいアイデア有無：".$result["idea"];
    $view .= '</p>';
    $view .= '<p>';
    $view .= "活動場所：".$result["area"];
    $view .= '</p>';
    $view .= '<p>';
    $view .= "活動目安時間(1週間)：".$result["activetime"];
    $view .= '</p>';
    $view .= '<p>';
    $view .= '<button type="button" name="name" value="value">詳細</button>';
    $view .= '</p>';    
    $view .= '</div>';
  }
}

// postsテーブルのデータ件数を取得する
$page_num = $pdo->prepare(" SELECT COUNT(*) id FROM profile ");
$page_num->execute();
$page_num = $page_num->fetchColumn();

// ページネーションの数を取得する
$pagination = ceil($page_num / 10);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index3.php">エンジニア・デザイナー一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<div>
<form action = "select4.php" method="post">

<!-- idea -->
<select name="idea">
<option value="">作りたいサービス有無</option>
<option value="有">有</option>
<option value="無">無</option>
</select>

<!-- jobtype -->
<select name="jobtype">
<option value="">職種</option>
<option value="エンジニア">エンジニア</option>
<option value="デザイナー">デザイナー</option>
</select>

<!-- perpose -->
<select name="perpose">
<option value="">目的</option>
<option value="スキルアップしたい">スキルアップしたい</option>
<option value="一発当てたい">一発当てたい</option>
<option value="仲間を増やしたい">仲間を増やしたい</option>
</select>

<!--   -->
<!-- activetime -->
<!-- <select name="activetime">
<option value="">活動時間</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select> -->

<!-- area -->
<!-- <select name="area">
<option value="">活動エリア</option>
<option value="ここは変更する所！！！">ここは変更する所！！！</option>
<option value="ここは変更する所！！！">ここは変更する所！！！</option>
<option value="ここは変更する所！！！">ここは変更する所！！！</option>
</select> -->

<input type="submit" value="絞込">
</form>
</div>

<!-- Main[Start] -->
<!-- <div>
    <div class="container jumbotron"></div>
</div> -->
<div>
<div class="people-wrapper">             
  <div class="people">          
    <?=$view?>  
  </div>      
</div>
<!-- Main[End] -->

<div class="pager">
    <?php for ($x=1; $x <= $pagination ; $x++) { ?>
	  <a href="?page=<?php echo $x ?>"><?php echo $x; ?></a>
    <?php } // End of for ?>
</div>
</div>

</body>
</html>