<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_guardar_dev_manual.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_en_stock2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
bd_guardar_dev_manual($_SESSION['dev'],$_SESSION['usuario']['id']);
unset($_SESSION['dev']);
$ss2526->disp();