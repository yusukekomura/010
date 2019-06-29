
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
 <link rel="stylesheet" href="test.css">
  <style>div{padding: 10px;font-size:16px;}</style>
 
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

</head>
<body id="body">

<header>
<?php 
session_start();
include("menu.php");
?>

  <nav class="navbar navbar-default">
   
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div id ="haikei">
<form method="post" action="first_insert.php">
  <div class="jumbotron">
  <fieldset>
<legend><label for="">ユーザー登録</label></legend>
  
    <table border="1" width="800" bordercolor="#333333">
  <tr><td width="150"><label for="">名前</label></td><td><input type="text" name="name" id="name"></td></tr>
  <tr><td width="150"><label for="">Email</label></td><td><input type="email" name="email" id="email"></td></tr>
  <tr><td width="150"><label for="">ID</label></td><td><input type="text" name="lid" id="lid"></td></tr>
  <tr><td width="150"><label for="">PASSWORD</label></td><td><input type="text" name="lpw" id="lpw"></td></tr>
 <tr><td width="150"><label>管理FLG選択</label></td>
 <td><label for="">一般ユーザー</label><input type="radio" name="kanri_flg" value="0"><label for="">　　管理者</label><input type="radio" name="kanri_flg" value="1"></td></tr>
 
     </table>
     <input type="submit" value="送信"><br>
     </fieldset>

<!-- Main[End] -->


</body>
</html>
