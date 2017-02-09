<?php
/**
 * ログイン後　編集ページ
 */
require_once 'mb_and_for-smarty.php';
session_start();

if(isset($_POST['logout'])){//ログアウト
	$_SESSION = array();// セッション変数を全て解除する
	session_destroy();
	header('Location:index.php');
}

/*データベース接続*/
require_once 'db.php';

if(isset($_POST['user_id']) && isset($_POST['password'])){//indexから来た
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    /* 投稿内容をデータベースに保存 */
    try {
	$db = getDb();//データベースへの接続を確立
	//同じユーザーID&パスワードを確認
	$check = $db -> prepare("SELECT * FROM member WHERE id = :user_id AND password LIKE :password");
	$check->bindValue(':user_id', $user_id);//ユーザーID set
	$check->bindValue(':password', $password);//パスワード set
	$check->execute();
	if(!$user = $check->fetch(PDO::FETCH_ASSOC)){
		header('Location:index.php');
        }else{
		$_SESSION['user_id'] = $user_id;
		$_SESSION['name'] = $user['name'];
		$_SESSION['login'] = 'login';	
        }
        $db = NULL;//データベース接続を切る
    } catch (PDOException $error) {
        die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }
}else if($_SESSION['login'] != 'login'){//loginがなかった時(url入力で無理やり来た)　強制送還
		header('Location:index.php');	
}

if(!isset($_POST['contents'])) {//フォームに何もないとき
    print "投稿内容を入力してください";
}else{
    $contents = $_POST['contents'];
    /* 投稿内容をデータベースに保存 */
    try {
        $db = getDb();//データベースへの接続を確立
        //INSERT命令の準備
        $stt = $db -> prepare('INSERT INTO post(contents, user_id) VALUES(:contents, :user_id)');
        $stt->bindValue(':contents', $contents);//投稿内容 set
        $stt->bindValue(':user_id', $_SESSION['user_id']);//ユーザーid set
        $stt->execute();//INSERT命令実行
        $db = NULL;
    } catch (PDOException $error) {
        die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }
}
	/* 編集者のUPDATE・DELETE実行 */
if(isset($_POST['id'])){//変更・削除が送られてきたとき
	$id = $_POST['id'];
if($_POST['action'] == "update"){
if(!isset($_POST['new_contents'])) {//フォームに何もないとき
    print "投稿内容を入力してください";
}else{
    $new_contents = $_POST['new_contents'];
    try{
        $db = getDb();//データベースへの接続を確立
        $new_contents = $_POST['new_contents'];
        $update = $db -> prepare("UPDATE post SET contents = :contents WHERE id = :id");//UPDATE命令の準備
        $update->bindValue(':contents',$new_contents);//投稿内容 set
        $update->bindValue(':id', $id);//ユーザーID set
        $update->execute();//SELECT命令の実行
        $db = NULL;
		} catch (PDOException $error) {
			die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
		}
}
    }else if($_POST['action'] == "delete"){
	    try{
	        $db = getDb();//データベースへの接続を確立
    	    $delete = $db -> prepare("DELETE FROM post WHERE id = :id");//DELETE命令の準備
        	$delete->bindValue(':id', $id);//ID set
        	$delete->execute();//DELETE命令の実行
        	$db = NULL;
		} catch (PDOException $error) {
			die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
		}	
	}
}
        
    /*「ユーザー名」「本文」データ表示(投稿内容表示)*/
    try{
	$db = getDb();//データベースへの接続を確立
	$post = $db -> prepare('SELECT * FROM post ORDER BY id DESC');//SELECT命令の準備
	$post->execute();//SELECT命令の実行$items = array();//表示コンテンツを格納する配列
	$i=0;//item配列の添え字初期化
	while($row = $post->fetch(PDO::FETCH_ASSOC)){//現在格納されているものすべてを
	$item[$i] = $row;//postテーブル内容格納
	//ユーザーIDからユーザー名をとる
	$temp_id = $row['user_id'];
	$member = $db -> prepare("SELECT * FROM member WHERE id = :temp_id");//SELECT命令の準備
	$member->bindValue(':temp_id', $temp_id);//ユーザーID set
	$member->execute();//SELECT命令の実行
	$temp = $member->fetch(PDO::FETCH_ASSOC);
	$item[$i]['name'] = $temp['name'];
	$smarty->assign('items',$item);
	$i++;//item配列の添え字インクリメント
        }
        $db = NULL;
    } catch (PDOException $error) {
	die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }

$smarty->display('editor.tpl');
?>
