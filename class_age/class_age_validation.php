<?php
/*---------------------------------------------------------------
【機能】:年齢値のバリデーションチェックを行う
        桁数チェックを行う(最大3文字)
【引数】:HTMLから送信されてくるage属性をキーにしたage
【戻り値】: -1 空文字の場合または文字数3文字以上の場合エラー
            (0を許容するか検討)
            0 半角数字以外エラー
            1 True         
---------------------------------------------------------------*/
//プロパティ設定

//index.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_age\validation;
class age_validation {

    //値の存在チェック
    //is_numeric等で数値であるかをチェックする
    public function validation($val){
        //検索文字列 配列変数初期化
        $search = [];

        //置き換えする検索文字列　半角空白、全角空白
        $search = [" ","　"];
        $replace = "";
        //str_replaceで空白が存在すれば空白削除
        $val = str_replace($search,$replace,$val);
        
        /*---------------------------------------------
        ・空の場合または3文字を超える場合エラー:-1
        ・半角数字以外エラー:0
        ・上記以外画面遷移：1
        ---------------------------------------------*/
        if (empty($val)) {
            $check_flg = "-1";
            return $check_flg;
        }

        //3文字を超える場合エラー
        $text_count = 3;
        if (mb_strlen($val) > $text_count) {
            $check_flg = "-1";
            return $check_flg;
        }

        //半角数字以外エラー
        $text_pattern = '/^[0-9]+$/';
        if (!preg_match($text_pattern, $val)) {
            $check_flg = "0";
            return $check_flg;
        }
         //上記以外であればTrue
         return $check_flg = "1";
    }
}
?>