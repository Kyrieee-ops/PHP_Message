<?php
//sessionスタート
session_start();

//sessionで値を受け取る
if (isset($_SESSION["user_name"])) {
  $user_name = $_SESSION["user_name"];
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
    <!--フォントの読み込み(Google Fontsを使用)-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&family=Noto+Serif+JP:wght@200;300&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Sass/style_2.css">
    <title>Message</title>
</head>
<body>
    <div class="wrap">
        <div class="content">
          <p class="fadein txt01"><?php echo h($user_name); ?>ちゃん、毎日楽しいですか？</p>
          <p class="fadein txt02">コロナで学校いけなくて、さみしいかな？</p>
          <p class="fadein txt03">パパも家にいるけど、なかなかお勉強も見てあげられなくてごめんね。</p>
          <p class="fadein txt04">お仕事中でも見てあげられるときはちょっとでも見れるようにがんばるね！</p>
          <p class="fadein txt05">いつもお手紙もらってるけど、ちょっと変わった形でお返し出来たらな、と思って書いてみたよ！</p>
          <p class="fadein txt06">これからもよろしくね♪</p>
          <p class="fadein txt07">Presented by Kyrieee</p>
          <p class="fadein txt08"><a href="index.php">戻る</a></p>
        </div>
        </div>   
    
</body>
</html>