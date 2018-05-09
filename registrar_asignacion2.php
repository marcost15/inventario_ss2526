<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_asignacion.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_asignacion2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
bd_guardar_asignacion($_SESSION['asignacion'],$_SESSION['entreg_equipos'],$_SESSION['total_art']);
unset($_SESSION['asignacion']);
unset($_SESSION['entreg_equipos']);
unset($_SESSION['total_art']);
$ss2526->disp();