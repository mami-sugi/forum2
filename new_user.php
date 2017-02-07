<?php
/**
 * 新規ユーザー登録
 */
require_once 'h_pro.php';
session_start();

/*データベース接続*/
require_once 'db.php';

if(empty($_POST['name']) || empty($_POST['user_id']) || empty($_POST['password'])) {//フォームが空の時
    print "名前とIDとパスワードを入力してください";
}else{
	if(is_numeric($_POST['user_id']) && mb_strlen($_POST['user_id']<=11)  && mb_strlen($_POST['name']<=255) && mb_strlen($_POST['password']<=255)){
    	$name = $_POST['name'];
    	$user_id = $_POST['user_id'];
    	$password = $_POST['password'];
    	/* 投稿内容をデータベースに保存 */
    	try {
    	    $db = getDb();//データベースへの接続を確立
      		//同じユーザーID&パスワードが無いと確認
      	  	$check_id = $db -> prepare("SELECT * FROM member WHERE id = :user_id");
       		$check_id->bindValue(':user_id', $user_id);//ユーザーID set
			$check_id->execute();
        	$check_pass = $db -> prepare("SELECT * FROM member WHERE password LIKE :password");
        	$check_pass->bindValue(':password', $password);//パスワード set
			$check_pass->execute();
			if($check_id->fetch() != NULL || $check_pass->fetch() != NULL){
				print "別のIDまたはパスワードを設定してください";	
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
    }else if(!is_numeric($_POST['user_id'])){
    	print "適切なIDを入力してください";
    }else if(mb_strlen($_POST['user_id']>11)){
    	print "IDが11文字以上です";
    }else if(mb_strlen($_POST['name']>255)){
    	print "名前が255文字を超えています";
	}else if(mb_strlen($_POST['password']>255)){
		print "パスワードが255文字を超えています";
	}
}

$smarty->display('new_user.tpl');
?>