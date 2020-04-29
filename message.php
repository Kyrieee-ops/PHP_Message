<?php
//sessionスタート
session_start();

//sessionで値を受け取る
if  (isset($_SESSION['person_information'])) {
  $person_information = $_SESSION['person_information'];
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
          <p class="fadein txt01"><?php echo h($person_information[2]); ?></p>
          <p class="fadein txt02"><?php echo h($person_information[3]); ?></p>
          <p class="fadein txt03"><?php echo h($person_information[4]); ?></p>
          <p class="fadein txt04"><?php echo h($person_information[5]); ?></p>
          <p class="fadein txt05"></p>
          <p class="fadein txt06"></p>
          <p class="fadein txt07">Presented by <?php echo h($user_name); ?></p>
          <p class="fadein txt08"><a href="index.php">戻る</a></p>
        </div>
        </div>   
    
</body>
</html>