<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_comercios.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('ventana_comercios.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1  = new formHandler('busqueda',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1 -> borderStart('Busqueda de Comercios');
$f1 -> textField('Texto a buscar','texto');
$f1 -> submitButton('Continuar');
$f1 -> borderStop();
$f1->onCorrect('procesar');

$f2  = new formHandler('busqueda_afiliado',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2 -> borderStart('Busqueda por Afiliado');
$f2 -> textField('Afiliado','afiliado');
$f2 -> submitButton('Continuar');
$f2 -> borderStop();
$f2 ->onCorrect('procesarafiliado');

if (isset($_REQUEST['accion']))
{
    $accion = $_REQUEST['accion'];
	switch($accion)
	{
		case 'letra':
		    $datos15 = bd_buscar_comercios(1,$_REQUEST['letra']);
			if (isset($datos15))
			{
				$error1 = '1';
			}
			$ss2526->assign('error1',$error1);
			$ss2526->assign('datos', $datos15);
		break;
	}
}

function procesar($d)
{
	global $ss2526;
	$texto=$d['texto'];
	$datos15 = bd_buscar_comercios(2,$texto);
	if (isset($datos15))
	{
		$error1 = '2';
	}
	$ss2526->assign('error1',$error1);
	$ss2526->assign('datos',$datos15);
	return false;
}
function procesarafiliado($d)
{
	global $ss2526;
	$afiliado=$d['afiliado'];
	$datos15 = bd_buscar_comercios(3,$afiliado);
	if (isset($datos15))
	{
		$error1 = '3';
	}
	$ss2526->assign('error1',$error1);
	$ss2526->assign('datos',$datos15);
	return false;
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->disp();
unset($_SESSION['datos']);