<?php
require 'smarty-4.2.1/libs/Smarty.class.php';

$smarty = new Smarty();

$smarty->assign("nombre",(1+2));
$smarty->display("template.smrt");


