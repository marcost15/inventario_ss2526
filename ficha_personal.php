<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_ficha_personal.php';
include './modelo/bd_obt_niveles.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('ficha_personal.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$personal = bd_ficha_personal($_REQUEST['id']);
$personal['nivel_id'] = bd_obt_niveles($personal['nivel_id']);
$personal['fecha_ing'] = f2f("$personal[fecha_ing]");
$ss2526->assign('ficha',$personal);
$ss2526->disp();