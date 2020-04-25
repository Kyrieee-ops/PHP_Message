<?php
session_start();
//セッションの有効期限 60分に設定
session_cache_expire(60);

//htmlspecialchars関数
//エスケープ処理
function h($str) {
    return htmlspecialchars($str,ENT_QUOTES);
  }
//C:\xampp\htdocs\php_validation\class_name
$path = dirname(__DIR__).'/php_message/class_name/class_name_validation.php';
//氏名バリデーションクラスを読み込む
//
include($path);

// 企業名\フォルダ\クラスフォルダ as 別名
use vendor\php_message\class_name as n_validate;
//useを使用したクラスの呼び方は、別名\クラスフォルダ\クラス名かっこはなしでnewする。
//namespace nameのvalidationメソッドに接続 
$name_vaidate = new n_validate\validation\name_validation;
 
 /*---------------------------------------------
 送信ボタンを押した(postされた)場合にバリデーションチェックを行う
 -1：空のエラー
 0：画面遷移
 1：入力値が正しくないエラー表示
 ---------------------------------------------*/
 if (!empty($_POST)){
    $user_name = $_POST['user_name'];
    //値が空ではない場合に次画面遷移なのでsession変数に値を格納
    $_SESSION["user_name"] = $_POST['user_name'];
    //値の初期化
    $check_flg_result ="";
    $check_flg_result = $name_vaidate->validation($user_name);
 }
 
 
 /*----------------------------------------
 check_flgの値によって画面遷移先を変える
 0⇒message.htmlへ
 1⇒message2.htmlへ
 ----------------------------------------*/
 if ($check_flg_result === "0") {
    header('Location: message.php');
    exit();
 }
 
 if ($check_flg_result === "1") {
    header('Location: message_2.php');
    exit();
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Sass/style.css">
    <title>入力してください</title>
</head>
<body>
    
    <form action="" method="POST">
        <h2>あなたの名前を入力してください</h2>
        <article class="form">
            <form class="content-wrapper">
                <dl class="name">
                <?php if ($check_flg_result === "-1"):?>
                <dt class="error"><?php echo "名前が入力されていません"; ?></dt>
                <?php elseif($check_flg_result === "2") : ?>
                    <dt class="error"><?php echo "お名前が違います"; ?></dt>
                
                <?php endif; ?>
                    <label for="lblname1"><dt>氏名<span>*</span></dt></label>
                    
                    <dd>
                        <input id="lblname1" type="text" name="user_name" placeholder="例：山田太郎" value="<?php echo h($user_name)?>">
                    </dd>
                </dl>
            <!--form-button-->
            <section class="form-button"><input type="submit" value="送信する">
            </section>
            <!--/form-button-->
            </form>
        </article>
    </form>    
    <!--コピーライト-->
    <footer class="footer">
    <div class="copyright">
        <p>&copy;Since 2020 Kyrieee All Rights Reserved</p>
    </div>
    </footer>
</body>
</html>