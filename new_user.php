<?php
/**
 * 新規ユーザー登録
 */
mb_language('ja');
mb_internal_encoding('UTF-8');

require(dirname(__FILE__).'/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = dirname(__FILE__).'/templates';
$smarty->compile_dir = dirname(__FILE__).'/templates_c';

session_start();
/*エスケープ処理　クロスサイトスクリプティング用　for XSS*/
function escape($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

/*データベース接続*/
require_once 'db.php';

if(empty($_POST['name']) || empty($_POST['user_id']) || empty($_POST['password'])) {//フォームが空の時
    print "Please input your name,id or password";
}else{
    //XSS　エスケープ処理
    $name = escape($_POST['name']);
    $user_id = escape($_POST['user_id']);
    $password = escape($_POST['password']);
    /* 投稿内容をデータベースに保存 */
    try {
        $db = getDb();//データベースへの接続を確立
        //同じユーザーID&パスワードが無いと確認
        $c_id = $db -> prepare("SELECT * FROM member WHERE id LIKE :user_id");
        $c_id->bindValue(':user_id', $user_id);//ユーザーID set
		$c_id->execute();
        $c_pass = $db -> prepare("SELECT * FROM member WHERE password LIKE :password");
        $c_pass->bindValue(':password', $password);//パスワード set
		$c_pass->execute();
		if($c_id->fetch() != NULL){
			print "Please set another id";	
		}else if($c_pass->fetch() != NULL){
			print "Please set another password";
		}else{//同じユーザーID&パスワードが無い場合
        //INSERT命令の準備
        $stt = $db -> prepare('INSERT INTO member(id, name, password) VALUES(:id, :name, :password)');
        $stt->bindValue(':id', $user_id);//ユーザーid set
        $stt->bindValue(':name', $name);//ユーザー名 set
        $stt->bindValue(':password', $password);//パスワード set
        $stt->execute();//INSERT命令実行
        print "ユーザー登録が完了しました";
		}
        $db = NULL;//データベース接続を切る
    } catch (PDOException $error) {
        die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }
}

$smarty->display('new_user.tpl');
?>