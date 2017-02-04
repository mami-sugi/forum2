<?php
mb_language('ja');
mb_internal_encoding('UTF-8');

require(dirname(__FILE__).'/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = dirname(__FILE__).'/templates';
$smarty->compile_dir = dirname(__FILE__).'/templates_c';
