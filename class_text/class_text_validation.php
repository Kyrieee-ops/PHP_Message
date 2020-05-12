<?php
/*---------------------------------------------------------------
【機能】:文章値のバリデーションチェックを行う
        桁数チェックを行う(最大120文字)
【引数】:HTMLから送信されてくるtext_1~text_4属性をキーにした値を受け取る
【戻り値】: 空の場合でもエラーとせず、確認画面にてユーザーにてチェックを行ってもらう
           -1 未定義の変数や配列
            0 120文字を超える場合エラー
            1 True
---------------------------------------------------------------*/
//プロパティ設定

//index.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_text\validation;
class text_validation {
    //文字数制限:120文字まで
    const TEXT_COUNT_MAX = 120;

    public function validation($text_array){      
        /*---------------------------------------------
        ・未定義の変数や配列の場合エラー -1
        ・文字数121以上はエラー:0
        ・上記以外画面遷移：1
        ---------------------------------------------*/
        //空文字、0も許容⇒完全にemptyだと0入力しているのに入力されていない判定になるため、一応許容
        foreach (['text_1','text_2','text_3','text_4'] as $i) {
            //未定義の変数や配列の場合にエラーフラグを立てる
            if (!isset($text_array[$i]) && !is_string($text_array[$i])) {
                $check_flg = "-1";
                return $check_flg;
            }
        }
        foreach (['text_1','text_2','text_3','text_4'] as $i) {
            /* var_dump消し忘れない様に注意！！ */
            //var_dump(count($text_array[$i]));    
            //文字数が120以上
            if (mb_strlen($text_array[$i]) > self::TEXT_COUNT_MAX) {
                $check_flg = "0";
                return $check_flg;
            }
        }

        //日本語のみ許可
        //空白を許可してないのでここでエラーが発生する
        /*
        $text_pattern = '/^[ぁ-んァ-ヶーa-zA-Z0-9一０-９、。]|[\p{Han}]+$/u';
        foreach (['text_1','text_2','text_3','text_4'] as $i) {
            if (!preg_match($text_pattern, $text_array[$i])) { 
                $check_flg = "0";
                return $check_flg;
            }
        }
        */
         //上記以外であればTrue
         return $check_flg = "1";
    }
}    
?>