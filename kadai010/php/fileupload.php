<?php
session_start();
//Fileが送信されてきているのか？チェック！
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    
    $file_name = $_FILES["upfile"]["name"];//ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"];//一時保存場所

    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = date("YmdHis").md5(session_id()) . "." . $extension;

    // FileUpload [--Start--]
    $_IMG="";
    $file_dir_path = "upload/".$file_name;
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
            chmod( $file_dir_path, 0644 );
            $_IMG = '<img src="'.$file_dir_path.'">';
        } else {
            // echo "Error:アップロードできませんでした。";
        }
    }

    
 }else{
    $_IMG = "画像が送信されていません";
 }
 echo isset($_IMG) ;

//  if ( $_IMG == false) {
//     echo isset($_IMG) ;
// } else {
//     header("Location: select_user.php");
//     exit;
// }
?>

</body>
</html>