<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <?php 
        if($_SESSION["kanri_flg"]=="1"){ 
         echo 'ようこそ'.$_SESSION["name"].'さん'; };
        ?>
        <a class="navbar-brand" href="user.php">登録画面に戻る</a>
        <a class="navbar-brand" href="select_user.php">マイページに戻る</a>
        
            <?php  
            if($_SESSION["kanri_flg"]=="1"){ ?>
               <a class="navbar-brand" href="select_all.php">登録者一覧</a>
            <?php }?>
            
            <a class="navbar-brand" href="logout.php">ログアウト</a>
        </div>
    </div>
</nav>