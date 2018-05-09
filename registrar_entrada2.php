<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_entrada.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_entrada2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
bd_guardar_entrada($_SESSION['entrada'],$_SESSION['equipos'],$_SESSION['total']);
unset($_SESSION['entrada']);
unset($_SESSION['equipos']);
unset($_SESSION['total']);
$ss2526->disp();