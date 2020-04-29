<?php
/*---------------------------------------------------------------
【機能】:文章値のバリデーションチェックを行う
        桁数チェックを行う(最大120バイト)
【引数】:HTMLから送信されてくるtext_1~text_4属性をキーにした値を受け取る
【戻り値】: -1 空文字エラー
            0 改行以外の制御文字及び最大文字数のチェック,120バイトを超える場合はエラー
            1 True
---------------------------------------------------------------*/
//プロパティ設定

//index.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_text\validation;
class text_validation {

    //値の存在チェック
    //is_numeric等で数値であるかをチェックする
    public function validation($val){
        //検索文字列変数初期化
        $search = [];
        
        //置き換えする検索文字列　半角空白、全角空白
        $search = [" ","　"];
        $replace = "";
        //str_replaceで空白が存在すれば空白削除
        //ここで繰り返しで値の空白除去を行う
        for ($i = 0; $i < count($val); $i++) {
            $val = str_replace($search,$replace,$val);
        }

        /*---------------------------------------------
        ・空の場合はエラー:-1
        ・改行以外の制御文字及び最大文字数のチェック(正規表現)
        120文字以内のチェック:0
        ・上記以外画面遷移：1
        ---------------------------------------------*/
        //三項演算子で書いても複雑化しそうなので配列でできるかを考慮
        //$check_flg = (empty($val)) ? "-1":"";
        
        
        if (empty($val)) {    
            $check_flg = "-1";
            return $check_flg;
        } elseif (preg_match('/\A[\r\n[:^cntrl:]]{1,120}\z/u', $val)) {
            $check_flg = "0";
            return $check_flg;
        } else {
            return $check_flg = "1";
        }
    }
}
?>