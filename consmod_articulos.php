<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_articulos.php';
include './modelo/bd_obt_tipos_articulos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('consmod_articulos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$error1 = '0';
$f1  = new formHandler('busqueda_articulos',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1 -> borderStart('Busqueda de Articulos');
$f1 -> textField('Texto a buscar','texto');
$f1 -> submitButton('Continuar');
$f1 -> borderStop();
$f1 ->onCorrect('procesar');

function procesar($d)
{
	global $ss2526;
	$texto=$d['texto'];
	$datos15 = bd_buscar_articulos($texto);
	foreach($datos15 as $i=>$m)
	{
		$datos15[$i]['tipo_id'] = bd_obt_tipos_articulos($datos15[$i]['tipo_id']);
	}
	if (isset($datos15))
	{
		$error1 = '2';
	}
	$ss2526->assign('error1',$error1);
	$ss2526->assign('datos',$datos15);
	return false;
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['datos']);