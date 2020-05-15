<?php
/***************************************************
機能 入力画面で入力した値を確認する画面
     入力値の表示
     戻るボタン⇒入力値を保持したまま入力画面へ戻る
     確定ボタン⇒入力値をメッセージとして表示
     (出来ればgif動画としてファイル生成して保存できるタイプにしたい)
 
メモ いきなりconfirm.phpにいけないように、初めてこのファイルに来る場合には
     $_SESSIONで名前の入力値がない場合には、入力画面に戻る仕様にする
     header('Location: index.php);

引数 @person_information[user_name],[age]
     @text_information[text_1～4]

***************************************************/

//sessionスタート
session_start();
//セッションの有効期限 60分に設定
session_cache_expire(60);
//直接この画面を呼び出した場合は、index.phpに戻す処理を記述
//!isset($_SESSION['person_information'],$_SESSION['text_information']))
//値がセットされているかをチェックしてセットされていなかった(null)の場合、戻す
if (!isset($_SESSION['person_information'],$_SESSION['text_information'])){
    header('Location: index.php');
    exit();
}

//sessionで値を受け取る
//index.phpから入力値はsession変数に保持しているので、その変数をpost変数に保持させる？
if (isset($_SESSION['person_information'],$_SESSION['text_information'])) {
  $person_information = $_SESSION['person_information'];
  $text_information = $_SESSION['text_information'];
}

//戻るボタンが押された場合inex.php画面に戻る
$backbtn = $_POST['backbtn'];
if (isset($backbtn)) {
    header('Location: index.php');
    exit();
}
//確定ボタンが押された場合message.phpへ遷移
$confirm = $_POST['confirm'];
if (isset($confirm)) {
    header('Location: message.php');
    exit();
}

//htmlspecialchars関数
//エスケープ処理
function h($str) {
  return htmlspecialchars($str,ENT_QUOTES);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Sass/style.css">
    <title>確認画面</title>
</head>
<body>
    <form action="" method="POST">
        <!--ヘッダー文字-->
        <h2 class="confirm-text">確認画面</h2>
        <!--/ヘッダー文字-->
        <article class="form-text">
            <!--確認内容form-wrap-->
                <!--確認内容content-->
            <div class="from-wrap">
                <div class="confirm-contens">
                    <p class="msg-confirm">以下の内容でよろしいですか？</p>
                    <!--受け取った表示メッセージ-->
                    <dl class="msg-name">
                        <!--名前-->
                        <dt>メッセージを送る相手：</dt>
                        <dd><?php echo h($person_information['user_name']); ?></dd>
                    </dl>
                    <dl class="msg-text1">
                        <!--メッセージ1-->
                        <dt>メッセージ内容1：</dt>
                        <dd><?php echo h($text_information['text_1']); ?></dd>
                    </dl>
                    <dl class="msg-text2">
                        <!--メッセージ2-->
                        <dt>メッセージ内容2：</dt>
                        <dd><?php echo h($text_information['text_2']); ?></dd>
                    </dl>
                    <dl class="msg-text3">
                        <!--メッセージ3-->
                        <dt>メッセージ内容3：</dt>
                        <dd><?php echo h($text_information['text_3']); ?></dd>
                    </dl>
                    <dl class="msg-text4">
                        <!--メッセージ4-->
                        <dt>メッセージ内容4：</dt>
                        <dd><?php echo h($text_information['text_4']); ?></dd>
                    </dl>
                </div>
            </div>
        </article>
            <!--/確認内容wrapper-->
        <!--/確認内容form-->

        <div class="btn-wrap">
            <!--戻るボタン-->
            <!--hiddenでinputへ戻す為のname属性-->
            <!--
            <input type="hidden" name="return">
            -->
            <div class="btn"><input type="submit" name="backbtn" value="戻る"></div>
            <!--確定ボタン-->
            <div class="btn"><input type="submit" name="confirm" value="確定"></div>
        </div>
    </form>
    <!--コピーライト-->
    <footer class="footer">
    <div class="copyright">
        <p>&copy;Since 2020 Yuuki Izumi All Rights Reserved</p>
    </div>
    </footer>
</body>
</html>