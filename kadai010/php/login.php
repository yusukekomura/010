<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">


<title>ログイン画面 </title>
<link href="login.css" rel="stylesheet">
</head>
<body id="body">

<header>

</header>
<div id = "div">
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
<fieldset>

  <label for="" id="a">ID:</label>
<input type="text" name="lid" id="username" placeholder="Username"  required />
      <label for="username" data-icon="&#128100;"></label>  <br>
      <!-- Entypo &#128274; = Locked -->
      <br>
      <br>

      <label for="" id="a">PASSWORD:</label>
      <input type="password" name="lpw" id="password" placeholder="Password"  required />
      <label for="password" data-icon="&#128274;"></label><br>
      <br>
<input type="submit" value="LOGIN" data-icon="&#58542;" />
</fieldset>
</form>

</div>

</body>
</html>