<!DOCTYPE html>
<html>
<head>
<title>簡易掲示板</title>
</head>
<body>
<h1>{$smarty.session.name}さんの編集ページ</h1>
<div style="margin: 5px;">
<form action="" method="post">
<button type="submit" name="logout" value="logout">ログアウト</button>
</form>
<div>
<form action="" method="post" style="margin: 15px" width="500px">
    投稿内容:<br>
    <textarea cols="50" rows="4" name="contents"　style="margin-top: 5px">255字以内</textarea><!--300--><br>
    <input type="submit" value="送信">
</form>
<hr>
{foreach $items as $itemdata}
{if $itemdata.user_id eq $smarty.session.user_id}
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b>{$itemdata.name|escape:'htmlall'}</b><br><!--名前を表示-->
            <form action="" method="post">
            <input type="hidden" name="id" value={$itemdata.id}>
		    <textarea cols="50" rows="4" name="new_contents" style="margin-top: 5px">{$itemdata.contents|escape:'htmlall'}</textarea><br><!--投稿内容を表示-->
			<button type="submit" name="action" value="update">変更</button>
			<button type="submit" name="action" value="delete">削除</button>
			</form>
			</div>
{else}{* if none editor *}
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b>{$itemdata.name|escape:'htmlall'}</b><br><!--名前を表示-->
            {$itemdata.contents|escape:'htmlall'}<br><!--投稿内容を表示-->
            <br>
            </div>
{/if}
{/foreach}
</body>
</html>
