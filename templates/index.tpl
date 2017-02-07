<!DOCTYPE html>
<html>
<head>
    <title>簡易掲示板2</title>
	<meta content="text/html;charset=utf-8" http-equiv="content-type">
</head>
<body>
<h1 style="margin: 15px;">掲示板</h1>
<div style="margin-left: 20px;width: 200px;">
	<a href="new_user.php">新規ユーザー登録</a>
</div>
<form action="./editor.php" method="post"style="margin: 10px;">
    <div style="background-color: #c0c0c0;width: 320px;height: 130px;padding: 7px;" align="center">
		ユーザーID:<input type="text" name="user_id" required style="margin: 8px;padding: 3px;"><br>
		パスワード:<input type="password" name="password" required style="margin: 8px;padding: 3px;"><br>
        <input type="submit" value="ログイン" style="padding: 8px">
    </div>
</form>
<hr>
{if isset($items)}
{foreach $items as $itemdata}
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b>{$itemdata.name|escape:'htmlall'}</b><br><!--名前を表示-->
            {$itemdata.contents|escape:'htmlall'}<br><!--投稿内容を表示-->
            <br>
            </div>     
{/foreach}
{/if}
</body>
</html>