<?php
/*---------------------------------------------------------------
【機能】:文章値のバリデーションチェックを行う
        桁数チェックを行う(最大120バイト)
【引数】:HTMLから送信されてくるtext_1~text_4属性をキーにした値を受け取る
【戻り値】: 空の場合でもエラーとせず、確認画面にてユーザーにてチェックを行ってもらう
           -1 未定義の変数や配列インデックスの値を表示または取得しようとしたとき
              また、120文字を超える場合エラー
            0 日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)以外の場合はエラー
            1 True
---------------------------------------------------------------*/
//プロパティ設定

//index.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_text\validation;
class text_validation {

    //値の存在チェック
    //is_numeric等で数値であるかをチェックする
    public function validation($text_array){
        //検索文字列変数初期化
        $search = [];
        
        //置き換えする検索文字列　半角空白、全角空白
        $search = [" ","　"];
        $replace = "";
        
        /*
        for ($i = 0; $i < count($text_array); $i++) {
            $text_array = str_replace($search,$replace,$text_array);
            //ここに確実に文字列で配列を受け取れているかを判定する
            //(string)filter_input(INPUT_POST, $val);を記述予定
        }
        */
        
        /*---------------------------------------------
        ・空文字の場合エラー、文字数121以上はエラー: -1
　　　　 ・
        ・上記以外画面遷移：1
            }
        ---------------------------------------------*/
        //空文字、0も許容⇒完全にemptyだと0入力しているのに入力されていない判定になるため、一応許容
        foreach (['text_1','text_2','text_3','text_4'] as $i) {
            //未定義の変数や配列の場合にエラーフラグを立てる
            if (!isset($text_array[$i]) && !is_string($text_array[$i])) {
                $check_flg = "-1";
                return $check_flg;
            }
        }
        //文字数制限を設ける⇒一旦変数に代入、const用いて定数に変更する
        $text_count = 120;
        foreach (['text_1','text_2','text_3','text_4'] as $i) {
            //文字数が120以下 かつ 文字列ではない場合エラー
            if (mb_strlen($text_array[$i] > $text_count) && !is_string($text_array[$i])) {
                $check_flg = "-1";
                return $check_flg;
            }
        }

        //日本語のみ許可
        //空白を許可してないのでここでエラーが発生する
        $text_pattern = '/^[ぁ-んァ-ヶーa-zA-Z0-9一０-９、。]|[\p{Han}]+$/u';
        foreach (['text_1','text_2','text_3','text_4'] as $i) {
            if (!preg_match($text_pattern, $text_array[$i])) { 
                $check_flg = "0";
                return $check_flg;
            }
        }
        
         //上記以外であればTrue
         return $check_flg = "1";
    }
}    
?>