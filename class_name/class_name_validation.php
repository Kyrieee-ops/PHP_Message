<?php
/*---------------------------------------------------------------
【機能】:氏名のバリデーションチェックを行う
        文字数チェックを行う(最大10文字)
【引数】:HTMLから送信されてくるname属性をキーにしたuser_name
【戻り値】:-1 空文字または10文字を超える場合=>エラー
　　　　　  0  日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)以外の場合はエラー
           1 正しい入力値=>入力値を返す
---------------------------------------------------------------*/
//プロパティ設定

//test.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_name\validation;
class name_validation {

    //値の存在チェック
    public function validation($val){
        //値の初期化
        //現状配列でデータを比較しているが、マスタで管理にする。
        /*
        $check_flg = "";
        //入力値と一致させる値を以下に入れてください
        $const_name = [
            "",
            "",
            ""
        ];
        
        $const_name_2 = [
            "",
            "",
            "",
            ""
        ];
        */
        //置き換えする検索文字列　半角空白、全角空白
        $search = [" ","　"];
        $replace = "";
        //str_replaceで空白が存在すれば空白削除
        $val = str_replace($search,$replace,$val);
        
        /*---------------------------------------------
        ・空の場合または10文字を超える場合はエラー:-1
        ・日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)以外の場合はエラー:0
        ・上記以外画面遷移：1
        ---------------------------------------------*/
        if (empty($val)) {
            $check_flg = "-1";
            return $check_flg;
        }

        $text_count = 10;
        if (mb_strlen($val) > $text_count) {
            $check_flg = "-1";
            return $check_flg;
        }
        //日本語のみ許可
        $text_pattern = '/^[ぁ-んァ-ヶーa-zA-Z0-9一０-９、。]|[\p{Han}]+$/u';
        if (!preg_match($text_pattern, $val)) {
            $check_flg = "0";
            return $check_flg;
        }
         //上記以外であればTrue
         return $check_flg = "1";
    }
}
?>