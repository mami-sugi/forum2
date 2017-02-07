<?php
/** 
 * 掲示板　ログイン・ログ表示
 */
require_once 'mb_and_for-smarty.php';
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['password'])){//indexに来たら自動ログアウト
	$_SESSION = array();// セッション変数を全て解除する
	session_destroy();
}
/*エスケープ処理　クロスサイトスクリプティング用　for XSS*/
function escape($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

/*データベース接続*/
require_once 'db.php';

    /*「ユーザー名」「本文」データ表示(投稿内容表示)*/
    try{
        $db = getDb();//データベースへの接続を確立
        $post = $db -> prepare('SELECT * FROM post ORDER BY id DESC');//SELECT命令の準備
        $post->execute();//SELECT命令の実行
        $items = array();//表示コンテンツを格納する配列
        $i=0;//item配列の添え字初期化
        while($row = $post->fetch(PDO::FETCH_ASSOC)){//現在格納されているものすべてを
        $item[$i] = $row;//postテーブル内容格納
        //ユーザーIDからユーザー名をとってくる
        $user_id = $row['user_id'];
        $member = $db -> prepare("SELECT * FROM member WHERE id = :user_id");//SELECT命令の準備
        $member->bindValue(':user_id', $user_id);//ユーザーID set
		$member->execute();//SELECT命令の実行
		$user = $member->fetch(PDO::FETCH_ASSOC);
		$item[$i]['name'] = $user['name'];
		$smarty->assign('items',$item);
		$i++;//item配列の添え字インクリメント
        }
        $db = NULL;
    } catch (PDOException $error) {
        die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }

$smarty->display('index.tpl');
?>