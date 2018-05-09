<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_comerciosxestado.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('consmod_comerciosxestado.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
if (isset($_REQUEST['estado_id']))
{
    $datos15 = bd_buscar_comerciosxestado($_REQUEST['estado_id']);
	$ss2526->assign('datos', $datos15);
}
$ss2526->disp();