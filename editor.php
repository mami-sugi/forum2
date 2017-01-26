<?php
/**
 * ログイン後　編集ページ
 */
mb_language('ja');
mb_internal_encoding('UTF-8');
session_start();
if(isset($_POST['logout'])){//ログアウト
	session_destroy();
}
/*エスケープ処理　クロスサイトスクリプティング用　for XSS*/
function escape($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
if(!empty($_POST['user_id']) && !empty($_POST['password'])){
/*データベース接続*/
require_once 'db.php';
    //XSS　エスケープ処理
    $user_id = escape($_POST['user_id']);
    $password = escape($_POST['password']);
    /* 投稿内容をデータベースに保存 */
    try {
        $db = getDb();//データベースへの接続を確立
        
        //同じユーザーID&パスワードを確認
        $c_id = $db -> prepare("SELECT * FROM member WHERE id LIKE $user_id");
		$c_id->execute();
		$user = $c_id->fetch(PDO::FETCH_ASSOC);
		if($user['password'] != $password){
			header('Location:login.php');	
        }else{
			$_SESSION['user_id'] = $_POST['user_id'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['name'] = $user['name'];
        	$_SESSION['login'] = 'login';
        }
        $db = NULL;//データベース接続を切る
    } catch (PDOException $error) {
        die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>簡易掲示板</title>
</head>
<body>
<h1><?php print $_SESSION['name']; ?>さんの編集ページ</h1>
<div style="margin: 5px;">
<form action="" method="post">
<button type="submit" name="logout">ログアウト</button>
</form>
<div>
<form action="" method="post" style="margin: 15px" width="500px">
    投稿内容:<br>
    <textarea cols="50" rows="4" name="contents"　style="margin-top: 5px">255字以内</textarea><!--300--><br>
    <input type="submit" value="送信">
</form>
<?php 
/*データベース接続*/
require_once 'db.php';

if(!isset($_POST['contents'])) {//フォームに何もないとき
    print "Please input your name or contents";
}else{
    //XSS　エスケープ処理
    $contents = escape($_POST['contents']);
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
?>
<hr>
<?php
	/* 編集者のUPDATE・DELETE実行 */
if(isset($_POST['id'])){//変更・削除が送られてきたとき
	$id = $_POST['id'];
if($_POST['action'] == "update"){
if(!isset($_POST['new_contents'])) {//フォームに何もないとき
    print "Please input your name or contents";
}else{
    //XSS　エスケープ処理
    $new_contents = escape($_POST['new_contents']);
    try{
        $db = getDb();//データベースへの接続を確立
        $new_contents = $_POST['new_contents'];
        $update = $db -> prepare("UPDATE post SET contents = '$new_contents' WHERE id = $id");//UPDATE命令の準備
        $update->execute();//SELECT命令の実行
        $db = NULL;
		} catch (PDOException $error) {
			die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
		}
}
    }else if($_POST['action'] == "delete"){
	    try{
	        $db = getDb();//データベースへの接続を確立
    	    $delete = $db -> prepare("DELETE FROM post WHERE id = $id");//DELETE命令の準備
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
        $post->execute();//SELECT命令の実行
        while($row = $post->fetch(PDO::FETCH_ASSOC)){//現在格納されているものすべてを
        //ユーザーIDからユーザー名をとる
        $temp_id = $row['user_id'];
        $member = $db -> prepare("SELECT * FROM member WHERE id = $temp_id");//SELECT命令の準備
		$member->execute();//SELECT命令の実行
		$temp = $member->fetch(PDO::FETCH_ASSOC);
if($temp['id'] == $_SESSION['user_id']){//
?>
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b><?php print $temp['name']; ?></b><br><!--名前を表示-->
            <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
		    <textarea cols="50" rows="4" name="new_contents" style="margin-top: 5px"><?php print $row['contents']; ?></textarea><br><!--投稿内容を表示-->
			<button type="submit" name="action" value="update">変更</button>
			<button type="submit" name="action" value="delete">削除</button>
			</form>
<?php
}else{//if none editor
?>
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b><?php print $temp['name']; ?></b><br><!--名前を表示-->
            <?php print $row['contents']; ?><br><!--投稿内容を表示-->
<?php	
} 
?>
            <br>
            </div>
<?php
        }
        $db = NULL;
    } catch (PDOException $error) {
        die('エラーメッセージ' . $error->getMessage());//接続失敗時の出力文
    }
?>
</body>
</html>
