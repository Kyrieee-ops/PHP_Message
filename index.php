<?php
session_start();
//セッションの有効期限 60分に設定
session_cache_expire(60);

//htmlspecialchars関数
//エスケープ処理
function h($str) {
    return htmlspecialchars($str,ENT_QUOTES);
  }
//nameクラスの指定パス変数
$name_valied_path = dirname(__DIR__).'/php_message/class_name/class_name_validation.php';
//ageクラスの指定パス変数
$age_valied_path = dirname(__DIR__).'/php_message/class_age/class_age_validation.php';

//氏名バリデーションクラスを読み込む
include($name_valied_path);
//年齢バリデーションクラスを読み込む
include($age_valied_path);

// 企業名\フォルダ\クラスフォルダ as 別名
use vendor\php_message\class_name as n_validate;
//useを使用したクラスの呼び方は、別名\クラスフォルダ\クラス名かっこはなしでnewする。
//namespace nameのvalidationメソッドに接続 
$name_validate = new n_validate\validation\name_validation;

use vendor\php_message\class_age as a_validate;
//namespace ageのvalidationメソッドに接続 
$age_validate = new a_validate\validation\age_validation;

 /*---------------------------------------------
 送信ボタンを押した(postされた)場合にバリデーションチェックを行う
 -1：空のエラー
 0：画面遷移
 1：入力値が正しくないエラー表示
 ---------------------------------------------*/
 if (!empty($_POST)){
    $user_name = $_POST['user_name'];
    $age = $_POST['age'];
    //値が空ではない場合に次画面遷移なのでsession変数に値を格納
    $_SESSION["user_name"] = $_POST['user_name'];
    $_SESSION["age"] = $_POST['age'];
    //値の初期化
    $check_flg_result ="";
    $check_flg_result_2 ="";

    $check_flg_result = $name_validate->validation($user_name);

    $check_flg_result_2 = $age_validate->validation($age);
 }
 
 
 /*----------------------------------------
 check_flgの値によって画面遷移先を変える
 1⇒message.htmlへ
 2⇒message2.htmlへ
 ----------------------------------------*/
 if ($check_flg_result === "1" && $check_flg_result_2 === "1") {
    header('Location: message.php');
    exit();
 }
 
 if ($check_flg_result === "2") {
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
        <h2>入力項目を入力してください</h2>
        <article class="form">
            <form class="content-wrapper">
                <!--名前-->
                <dl class="name">
                <?php if ($check_flg_result === "-1"):?>
                <dt class="error"><?php echo "名前が入力されていません"; ?></dt>
                <?php elseif($check_flg_result === "0") : ?>
                    <dt class="error"><?php echo "不正な入力です。最大文字数は11文字です。また、制御文字は使用できません。"; ?></dt>
                <?php endif; ?>
                    <label for="lblname1"><dt>氏名<span>*</span></dt></label>
                    <dd>
                        <input id="lblname1" type="text" name="user_name" placeholder="例：山田太郎" value="<?php echo h($user_name)?>">
                    </dd>
                </dl>
                <!--/名前-->
                <!--年齢-->
                <!--数値のみ入力-->
                <dl class="age">
                <?php if ($check_flg_result_2 === "-1"):?>
                <dt class="error"><?php echo "年齢が入力されていません"; ?></dt>
                <?php elseif($check_flg_result_2 === "0") : ?>
                    <dt class="error"><?php echo "不正な入力です。最大文字数は3文字です。また、制御文字は使用できません。"; ?></dt>
                <?php endif; ?>
                <label for="lblname2"><dt>年齢<span>*</span></dt></label>
                <dd>
                    <input id="lblname2" type="text" name="age" value="<?php echo h($age);?>">歳
                </dd>
                </dl>
                <!--/年齢-->
            <!--form-button-->
            <section class="form-button"><input type="submit" maxlength="10" value="送信する">
            </section>
            <!--/form-button-->
            </form>
        </article>
    </form>    
    <!--コピーライト-->
    <footer class="footer">
    <div class="copyright">
        <p>&copy;Since 2020 Yuuki Izumi All Rights Reserved</p>
    </div>
    </footer>
</body>
</html>