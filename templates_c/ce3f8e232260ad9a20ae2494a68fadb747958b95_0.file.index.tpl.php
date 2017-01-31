<?php
/* Smarty version 3.1.30, created on 2017-01-26 10:57:57
  from "C:\xampp2\htdocs\techaca\forum2\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5889c8252c7f89_40333014',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce3f8e232260ad9a20ae2494a68fadb747958b95' => 
    array (
      0 => 'C:\\xampp2\\htdocs\\techaca\\forum2\\templates\\index.tpl',
      1 => 1485423599,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5889c8252c7f89_40333014 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'itemdata');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemdata']->value) {
?>
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b><?php echo $_smarty_tpl->tpl_vars['itemdata']->value['name'];?>
</b><br><!--名前を表示-->
            <?php echo $_smarty_tpl->tpl_vars['itemdata']->value['contents'];?>
<br><!--投稿内容を表示-->
            <br>
            </div>     
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</body>
</html><?php }
}
