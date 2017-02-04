<!DOCTYPE html>
<html>
<head>
<title>簡易掲示板</title>
</head>
<body>
<h1 align="center">新規ユーザー登録</h1>
<div align="center">
<a href="index.php">トップページへ</a>
<div>
{* 入力フォーム *}
<form action="" method="post" style="margin: 10px;">
    <div style="background-color: #c0c0c0;width: 320px;height: 170px;margin: auto;padding: 7px;" align="center">
		名前:<input type="text" name="name" placeholder="255文字以内" required style="margin: 8px;padding: 3px;"><br>
		ユーザーID:<input type="number" name="user_id"　placeholder="数字" required style="margin: 8px;padding: 3px;"><br>
		パスワード:<input type="password" name="password" placeholder="255文字以内" required style="margin: 8px;padding: 3px;"><br>
        <input type="submit" value="新規登録" style="padding: 8px">
    </div>
</form>
</body>
</html>