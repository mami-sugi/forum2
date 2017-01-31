<?php
/* Smarty version 3.1.30, created on 2017-01-26 09:53:05
  from "C:\xampp2\htdocs\techaca\forum2\templates\sample.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5889b8f1ba1b09_34043036',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91ed489dee62b8b8e1a8dcb88ce285ea59def31e' => 
    array (
      0 => 'C:\\xampp2\\htdocs\\techaca\\forum2\\templates\\sample.tpl',
      1 => 1485419891,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5889b8f1ba1b09_34043036 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta content="text/html;charset=utf-8" http-equiv="content-type">
</head>
<body>
<h1 style="width: 300px;display: inline-block;"><?php echo $_smarty_tpl->tpl_vars['title_index']->value;?>
</h1>
<div style="margin-right: 5px;width: 200px;display: inline-block;">
<a href="login.php">ログイン</a>
<a href="new_user.php">新規ユーザー登録</a>
</div>
<hr><?php }
}
