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
        ・空の場合はエラー:-1
        ・改行以外の制御文字及び最大文字数のチェック(正規表現)
        120文字以内のチェック:0
        ・上記以外画面遷移：1
        ---------------------------------------------*/
       
        //str_replaceで空白が存在すれば空白削除
        //ここで繰り返しで値の空白除去を行う
        //値が空判定➡入力されていない旨のエラー
        foreach ($text_array as $text) {
            $text = str_replace($search,$replace,$text);
            if (empty($text)) {
                $check_flg = "-1";
                return $check_flg;
            }
        }
        //値が改行以外の制御文字が入っている及び最大文字数121文字以上➡エラー
        $text_pattern = '/\A[\r\n[:^cntrl:]]{1,120}\z/u';
        foreach ($text_array as $text) {
            if (preg_match($text_pattern, $text)) { 
                $check_flg = "0";
                return $check_flg;
            }
        }
        
         //上記以外であればTrue
         return $check_flg = "1";
        }
    }
?>