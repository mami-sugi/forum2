<?php
/* Smarty version 3.1.30, created on 2017-01-31 09:12:06
  from "C:\xampp2\htdocs\techaca\forum2\templates\new_user.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_589046d6a5c9d8_17640009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fdc1c94af3f16a8fd8ed9e17ab06e8bfce604cd' => 
    array (
      0 => 'C:\\xampp2\\htdocs\\techaca\\forum2\\templates\\new_user.tpl',
      1 => 1485850257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_589046d6a5c9d8_17640009 (Smarty_Internal_Template $_smarty_tpl) {
?>
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

<form action="" method="post" style="margin: 10px;">
    <div style="background-color: #c0c0c0;width: 320px;height: 170px;margin: auto;padding: 7px;" align="center">
		名前:<input type="text" name="name" placeholder="255文字以内" required style="margin: 8px;padding: 3px;"><br>
		ユーザーID:<input type="number" name="user_id"　placeholder="数字" required style="margin: 8px;padding: 3px;"><br>
		パスワード:<input type="password" name="password" placeholder="255文字以内" required style="margin: 8px;padding: 3px;"><br>
        <input type="submit" value="新規登録" style="padding: 8px">
    </div>
</form>
</body>
</html><?php }
}
