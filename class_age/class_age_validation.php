<?php
/*---------------------------------------------------------------
【機能】:年齢値のバリデーションチェックを行う
        桁数チェックを行う(最大3桁)
【引数】:HTMLから送信されてくるage属性をキーにしたage
【戻り値】: -1 空文字エラー
            0 改行以外の制御文字及び最大文字数のチェック,3文字以上の場合はエラー
            1 
---------------------------------------------------------------*/
//プロパティ設定

//index.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_age\validation;
class age_validation {

    //値の存在チェック
    //is_numeric等で数値であるかをチェックする
    public function validation($val){
        
        //置き換えする検索文字列　半角空白、全角空白
        $search = array(" ","　");
        $replace = "";
        //str_replaceで空白が存在すれば空白削除
        $val = str_replace($search,$replace,$val);
        
        /*---------------------------------------------
        ・空の場合はエラー:-1
        ・改行以外の制御文字及び最大文字数のチェック(正規表現)
        3文字以内のチェック かつ　文字列が整数であるかをチェック:0
        ・上記以外画面遷移：1
        ---------------------------------------------*/
        if (empty($val)) {    
            $check_flg = "-1";
            return $check_flg;
        } elseif (preg_match('/\A[\r\n[:^cntrl:]]{1,3}\z/u', $val) === 0 && is_numeric($val)) {
            $check_flg = "0";
            return $check_flg;
        } else {
            return $check_flg = "1";
        }
    }
}
?>