<?php /* Smarty version 2.6.26, created on 2012-04-07 00:23:09
         compiled from cabecera.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'cabecera.html', 7, false),)), $this); ?>
<html>
	<head>
		<link rel="icon" href="./imagenes/favicon.ico" type="image/x-icon" /> 
		<link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon" /> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex,nofollow" />
		<title><?php echo ((is_array($_tmp=@$this->_tpl_vars['title'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Solutions_Systems_2526') : smarty_modifier_default($_tmp, 'Solutions_Systems_2526')); ?>
</title>
		<script type="text/javascript" src="./js/highlight.js"></script>
		<script type="text/javascript" src="./js/domtableenhance.js"></script>
		<script type="text/javascript" src="../libreriasphp/FH3/FHTML/overlib/overlib.js"></script>
		<link rel="stylesheet" type="text/css" href="./estilo/layout.css"/> 
		<link rel="stylesheet" type="text/css" href="./estilo/layoutprint.css" media="print"/>
		<link rel="stylesheet" type="text/css" href="./estilo/menu.css"/>
	</head> 
	<body background="./imagenes/fondoazul.jpg" topmargin="0" leftmargin="0"> 
		<?php if ($this->_tpl_vars['fondoreporte'] == '1'): ?>
		<div id="fondoreporte">
		<div id="bannereporte"><img src="./imagenes/bannereporte_horizontal.png" align="center" width="1050" height="100"/></div>
		<?php else: ?>
		<div id="fondo">
		<div id="bannereporte"><img src="./imagenes/bannereporte.png" align="center" width="710" height="70"/></div>
		<?php endif; ?>
			<div id="banner1" align="center"><img src="./imagenes/banner.png" width="1050" height="100"/></div><!-- banner1-->
			<div id="titulo">Sistema Administrativo de SS2526 C.A v3.0  <?php if ($_SESSION['usuario']): ?>[Usuario: <?php echo $_SESSION['usuario']['nombre']; ?>
 <?php echo $_SESSION['usuario']['apellido']; ?>
]<?php endif; ?></div><!-- titulo -->				
			<?php if ($_SESSION['usuario']): ?><div id="divmenu"><ul id="css3menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../menu/menu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></ul></div><!-- divmenu --> <?php endif; ?>
		<?php if ($_SESSION['usuario']): ?>
			<?php if ($this->_tpl_vars['fondoreporte'] == '1'): ?>
				<div id="contenido_reporte">
			<?php else: ?>
				<div id="contenido">
			<?php endif; ?>
		<?php else: ?>
			<div id="contenido_sinmenu">
		<?php endif; ?>
<!-- Contenido -->