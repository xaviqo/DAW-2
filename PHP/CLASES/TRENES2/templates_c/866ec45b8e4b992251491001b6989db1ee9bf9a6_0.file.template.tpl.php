<?php
/* Smarty version 4.2.1, created on 2022-11-29 18:30:53
  from '/home/xavi/Desktop/TRABAJOS/DAW2/PHP/CLASES/TRENES2/template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638641cd6acc39_41123075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '866ec45b8e4b992251491001b6989db1ee9bf9a6' => 
    array (
      0 => '/home/xavi/Desktop/TRABAJOS/DAW2/PHP/CLASES/TRENES2/template.tpl',
      1 => 1669644773,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638641cd6acc39_41123075 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .vagon {
            display: inline-block;
        }
        img{
            width: 65px;
        }
    </style>
</head>
<body>
    <h1>Estación Xavi</h1>
    <h3>VIAJEROS: <?php echo $_smarty_tpl->tpl_vars['pasajeros']->value;?>
</h3>
    <br>
    <form action="index.php" method="get">
    <div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['estacion']->value, 'tren');
$_smarty_tpl->tpl_vars['tren']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tren']->value) {
$_smarty_tpl->tpl_vars['tren']->do_else = false;
?>
            <a href="index.php?salir=<?php echo $_smarty_tpl->tpl_vars['tren']->value->getId();?>
"><<<</a>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tren']->value->getVagones(), 'vagon');
$_smarty_tpl->tpl_vars['vagon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['vagon']->value) {
$_smarty_tpl->tpl_vars['vagon']->do_else = false;
?>
                <div class="vagon">
                    <div>
                        <a href="index.php?tren=<?php echo $_smarty_tpl->tpl_vars['tren']->value->getId();?>
&vagon=<?php echo $_smarty_tpl->tpl_vars['vagon']->value->getId();?>
">
                            <img src="vagon.jpg">
                        </a>
                    </div>
                    <div>
                        <?php echo $_smarty_tpl->tpl_vars['vagon']->value->getLibre();?>

                    </div>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <br>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
        <input type="submit" value="reset" name="reset" style="margin-top: 15px">
    </form>
</body>
</html><?php }
}
