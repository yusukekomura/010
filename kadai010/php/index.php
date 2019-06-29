
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規アンケート登録</title>
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
<form method="post" action="insert.php">
  <div class="jumbotron">
  <fieldset>
<legend><label for="">新規入場者登録画面</label></legend>
  
    <table border="1" width="800" bordercolor="#333333">
  <tr><td width="150"><label for="">名前</label></td><td><input type="text" name="name" id="name"></td></tr>
  <tr><td width="150"><label for="">Email</label></td><td><input type="email" name="email" id="email"></td></tr>
  <tr><td width="150"><label for="">年齢</label></td><td><input type="text" style="width:50px" name="year"><label for="">　歳</label></td></tr>
  <tr><td width="150"><label for="">所属会社</label></td><td><input type="text" name="company"></td></tr>
  <tr><td width="150"><label for="">生年月日</label></td><td><select id = "nengo1" style="width:100px" name = "birth">
                <option value="昭和"><label for="">昭和</label></option>
                <option value="平成"><label for="">平成</label></option>
                </select>
                 
            　<input type="text" id = "birthday-year" style="width:50px" name="birthday-year"><label for=""> 年</label>
           　 <input type="text" id = "birthday-month"style="width:50px" name="birthday-month"><label for=""> 月</label>
           　 <input type="text" id = "birthday-day" style="width:50px" name="birthday-day"><label for=""> 日</label> </td></tr>
  <tr><td width="150"><label for="">性別</label></td><td><select id = "sex" style="width:100px" name="sex">
                <option value="男"><label for="">男</label></option>
                <option value="女"><label for="">女</label></option>
                </select></td></tr>
  <tr><td width="150"><label for="">職種</label></td><td><input type="text" name="job"></td></tr><br>
  <tr><td width="150"><label for="">経験年数</label></td><td><input type="text" style="width:50px" name="experience"><label for="">　年</label></td></tr>
 
  <tr><td width="150"><label for="" id= "a">郵便番号：〒</label></td>
  <td><input type="text" name="zip31" size="4" maxlength="3" style="width:50px" >
<label for=""> - </label>
<input type="text" name="zip32" size="5" maxlength="4" style="width:50px"  onKeyUp="AjaxZip3.zip2addr('zip31','zip32','pref31','addr31','addr32');">
<label for="" id= "f">※郵便番号を入力すると自動で入力されます</label></td></tr>
  <tr><td><label for="" id= "b">都道府県</label></td><td><input type="text" name="pref31" size="20"></td></tr>
  <tr><td><label for="" id= "c">市町区</label></td><td><input type="text" name="addr31" size="40"></td></tr>
  <tr><td><label for="" id= "d">それ以降の住所</label></td><td><input type="text" name="addr32" size="40"></td></tr>
  <tr><td><label for="" id= "e">建物名</label></td><td><input type="text" name="build" size="40"></td></tr>
     </table>
     <input type="submit" value="送信"><br>
     </fieldset>
  </div>
</form>
<form action="select_all.php" method="post" >
<fieldset>
<legend><label for="">会社名で検索</label></legend>
<label><label for="">会社名：</label><input type="text" name="company_name"></label>
<legend><label for="">職種で検索</label></legend>
<label><label for="">職種：</label><input type="text" name="jobstyle"></label>
<!-- <legend><label for="">日付で検索</label></legend>
<label><label for="">日付：</label><input type="date" name="date"></label> -->
 <input type="submit" value="検索" width=100>
 </fieldset>
    </form>
    </div>
<!-- Main[End] -->


</body>
</html>