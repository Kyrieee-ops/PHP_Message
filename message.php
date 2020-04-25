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
          <p class="fadein txt01"><?php echo h($user_name); ?>へ　誕生日おめでとう</p>
          <p class="fadein txt02"><?php echo h($user_name); ?>と出会って、2回目の誕生日だね!!　時間が経つのは早いものですね</p>
          <p class="fadein txt03">いつもご飯作ってくれて、返ってくると笑顔で迎えてくれて、ケンカはよくするけど、<?php echo h($user_name); ?>と出会ってから毎日楽しい生活です</p>
          <p class="fadein txt04">今はコロナで大変な状況だし、なかなかお出かけできる時でもないけど、収束したらまた3人でお出かけしようね</p>
          <p class="fadein txt05">誕生日プレゼント「なんでもいい」っていうからこんなことしかできないけど、せっかくなのでWebのお手紙を作ってみました</p>
          <p class="fadein txt06">これからも末永くよろしくお願いします</p>
          <p class="fadein txt07">Presented by Kyrieee</p>
          <p class="fadein txt08"><a href="index.php">戻る</a></p>
        </div>
        </div>   
    
</body>
</html>