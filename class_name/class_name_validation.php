<?php
/*---------------------------------------------------------------
【機能】:氏名のバリデーションチェックを行う
【引数】:HTMLから送信されてくるname属性をキーにしたuser_name
【戻り値】:入力値がない場合=>エラー
　　　　　 正しい入力値=>入力値を返す
---------------------------------------------------------------*/
//プロパティ設定

//test.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_name\validation;
class name_validation {

    //値の存在チェック
    public function validation($user_name){
        //値の初期化
        //現状配列でデータを比較しているが、マスタで管理にする。
        $check_flg = "";
        /*-------------------------------------
        入力値と一致させる値を以下に入れてください
        -------------------------------------*/
        //妻へ
        $const_name = [
            "",
            "",
            ""
        ];
        //娘へ
        $const_name_2 = [
            "",
            "",
            "",
            ""
        ];
        
        //置き換えする検索文字列　半角空白、全角空白
        $search = array(" ","　");
        $replace = "";
        //str_replaceで空白が存在すれば空白削除
        $user_name = str_replace($search,$replace,$user_name);
        //var_dump();
        if (empty($user_name) ) {
            //空の場合エラー
            $check_flg = "-1";
            return $check_flg;
            //$const_nameと値が一致すれば次画面遷移
        } elseif (in_array($user_name,$const_name)){
            $check_flg = "0";
            return $check_flg;
            
        } elseif ((in_array($user_name,$const_name_2))) {
            $check_flg = "1";
            return $check_flg;
        //名前が異なるエラーを表示
        } else {
            $check_flg = "2";
            return $check_flg;
        }
    }
}
?>