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
//textクラスの指定パス変数
$text_valied_path = dirname(__DIR__).'/php_message/class_text/class_text_validation.php';
//氏名バリデーションクラスを読み込む
include($name_valied_path);
//年齢バリデーションクラスを読み込む
include($age_valied_path);
//文章バリデーションクラスを読み込む
include($text_valied_path);

// 企業名\フォルダ\クラスフォルダ as 別名
use vendor\php_message\class_name as n_validate;
//useを使用したクラスの呼び方は、別名\クラスフォルダ\クラス名かっこはなしでnewする。
//namespace nameのvalidationメソッドに接続 
$name_validate = new n_validate\validation\name_validation;

use vendor\php_message\class_age as a_validate;
//namespace ageのvalidationメソッドに接続 
$age_validate = new a_validate\validation\age_validation;

use vendor\php_message\class_text as t_validate;
//namespace ageのvalidationメソッドに接続 
$text_validate = new t_validate\validation\text_validation;

 /*---------------------------------------------
 送信ボタンを押した(postされた)場合にバリデーションチェックを行う
 チェックを行うname属性値
・person_information[user_name]
・person_information[age]]
➡$person_informationの配列変数に格納

・text_information[text_1]～text_information[text_4]
➡$text_informationの配列変数に格納

上記をわける理由
・$person_information➡名前と年齢は一意の値なので、一意の値をclass側に渡せば良い
・$text_information➡文章については1～4の配列の値をclass側に渡したいので、不要な名前と年齢を省く為
 
【エラーの値】
-1：空のエラー
 0：画面遷移
 1：入力値が正しくないエラー表示
 ---------------------------------------------*/
 if (!empty($_POST['person_information']) && !empty($_POST['text_information'])){
    //HTMLのname属性配列変数初期化
    $person_information = [];
    $text_information = [];
    //name属性を配列で受け取り配列変数へ格納
    $person_information = $_POST['person_information'];
    $text_information = $_POST['text_information'];
    //decodeするのであればまずはencodeしてから
    //calss_textに渡す為に、jsonでdecodeする。

    /*
    $_SESSION['user_name'] = $_POST['user_name'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['text'] = $_POST['text'];
    */
    //値の初期化
    $check_flg_name ="";
    $check_flg_age ="";
    $check_flg_text = "";

    $check_flg_name = $name_validate->validation($person_information['user_name']);
    $check_flg_age = $age_validate->validation($person_information['age']);
    $check_flg_text = $text_validate->validation($text_information);
}
 
 
 /*----------------------------------------
 check_flgの値によって画面遷移先を変える
 1⇒confirm.phpへ(確認画面へ)
 ----------------------------------------*/
 if ($check_flg_name === "1" && $check_flg_age === "1" && $check_flg_text === "1") {
    //値が空ではない場合に次画面遷移なのでsession変数に値を格納
    $_SESSION['person_information'] = $person_information;
    $_SESSION['text_information'] = $text_information;
    header('Location: confirm.php');
    exit();
 }
 //戻るボタンが押された場合にsession変数を保持させて、inputに入力値を表示
 if (isset($_SESSION['person_information'],$_SESSION['text_information'])) {
    $person_information = $_SESSION['person_information'];
    $text_information = $_SESSION['text_information'];

 }

 //エラーメッセージの定数
  const ERROR_MESSAGE_1 = "名前が入力されていません。"."<br>"."もしくは名前が10文字以上で入力されています";
  const ERROR_MESSAGE_2 = "不正な入力です。";
  const ERROR_MESSAGE_3 = "年齢が入力されていません。"."<br>"."もしくは年齢が3文字以上で入力されています。";
  const ERROR_MESSAGE_4 = "半角数字以外はエラーです。";
  const ERROR_MESSAGE_5 = "文章の1行目が入力されていません";
  const ERROR_MESSAGE_6 = "120文字以内で入力してください。";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Sass/style.css">
    <title>メッセージ内容入力画面</title>
</head>
<body>
    
    <form action="" method="POST">
        <h2 class="header-text">入力項目を入力してください</h2>
        <article class="form">
            <form class="content-wrapper">
                <!--名前　ここは自分の名前が表示されるところ-->
                <dl class="name">
                <?php if ($check_flg_name === "-1"):?>
                    <p class="error"><?php echo ERROR_MESSAGE_1; ?></p>
                <?php elseif($check_flg_name === "0") : ?>
                    <p class="error"><?php echo ERROR_MESSAGE_2; ?></p>
                <?php endif; ?>
                    <label for="lblname1"><dt>ご自身の名前<span class="red">*</span></dt></label>
                    <dd>
                        <input id="lblname1" type="text"  maxlength="10" name="person_information[user_name]" placeholder="例：山田太郎" value="<?php echo h($person_information['user_name'])?>">
                    </dd>
                </dl>
                <!--/名前-->
                <!--年齢-->
                <!--数値のみ入力-->
                <dl class="age">
                <?php if ($check_flg_age === "-1"):?>
                    <p class="error"><?php echo ERROR_MESSAGE_3; ?></p>
                <?php elseif($check_flg_age === "0") : ?>
                    <p class="error"><?php echo ERROR_MESSAGE_4; ?></p>
                <?php endif; ?>
                    <label for="lblname2"><dt>年齢<span class="red">*</span></dt></label>
                    <dd>
                        <input id="lblname2" type="text" name="person_information[age]" value="<?php echo h($person_information['age']);?>"><span>歳</span>
                    </dd>
                </dl>
                <!--/年齢-->
                <!--文章1-->
                <dl class="text1">
                    <!--1行目-->
                    <?php if ($check_flg_text === "-1"):?>
                        <p class="error"><?php echo ERROR_MESSAGE_5; ?></p>
                    <?php elseif($check_flg_text === "0") : ?>
                        <p class="error"><?php echo ERROR_MESSAGE_2; ?></p>
                    <?php endif; ?>
                    <label for="lblname3"><dt>表示するメッセージ1<span class="red">*</span></dt></label>
                    <dd>
                        1行目：<textarea id="lblname3" type="text" maxlength="120" name="text_information[text_1]" placeholder="" ><?php echo h($text_information['text_1'])?></textarea>
                    </dd>
                    <!--2行目-->
                    <label for="lblname4"><dt>表示するメッセージ2</dt></label>
                    <dd>
                        2行目：<textarea id="lblname4" type="text" maxlength="120" name="text_information[text_2]" placeholder="" ><?php echo h($text_information['text_2'])?></textarea>
                    </dd>
                    <!--3行目-->
                    <label for="lblname5"><dt>表示するメッセージ3</dt></label>
                    <dd>
                        3行目：<textarea id="lblname5" type="text" maxlength="120" name="text_information[text_3]" placeholder="" ><?php echo h($text_information['text_3'])?></textarea>
                    </dd>
                    <!--4行目-->
                    <label for="lblname5"><dt>表示するメッセージ4
                        </dt></label>
                    <dd>
                        4行目：<textarea id="lblname5" type="text" maxlength="120" name="text_information[text_4]" placeholder="" ><?php echo h($text_information['text_4'])?></textarea>
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
        <p>&copy;Since 2020 Yuuki Izumi All Rights Reserved</p>
    </div>
    </footer>
</body>
</html>