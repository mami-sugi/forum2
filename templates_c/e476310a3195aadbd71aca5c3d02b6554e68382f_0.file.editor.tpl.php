<?php
/* Smarty version 3.1.30, created on 2017-02-07 10:32:28
  from "C:\xampp2\htdocs\techaca\forum2\templates\editor.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5899942cbadb70_62244287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e476310a3195aadbd71aca5c3d02b6554e68382f' => 
    array (
      0 => 'C:\\xampp2\\htdocs\\techaca\\forum2\\templates\\editor.tpl',
      1 => 1486459945,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5899942cbadb70_62244287 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<title>簡易掲示板</title>
</head>
<body>
<h1><?php echo $_SESSION['name'];?>
さんの編集ページ</h1>
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
<?php if (isset($_smarty_tpl->tpl_vars['items']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'itemdata');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemdata']->value) {
if ($_smarty_tpl->tpl_vars['itemdata']->value['user_id'] == $_SESSION['user_id']) {?>
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['itemdata']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</b><br><!--名前を表示-->
            <form action="" method="post">
            <input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['itemdata']->value['id'];?>
>
		    <textarea cols="50" rows="4" name="new_contents" style="margin-top: 5px"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['itemdata']->value['contents'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</textarea><br><!--投稿内容を表示-->
			<button type="submit" name="action" value="update">変更</button>
			<button type="submit" name="action" value="delete">削除</button>
			</form>
			</div>
<?php } else { ?>
            <div style="margin-left: 30px;margin-bottom: 10px;padding: 5px;" >
            投稿者名:<b><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['itemdata']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</b><br><!--名前を表示-->
            <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['itemdata']->value['contents'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<br><!--投稿内容を表示-->
            <br>
            </div>
<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php }?>
</body>
</html>
<?php }
}
