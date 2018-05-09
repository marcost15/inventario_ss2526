<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_traspasos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_traspaso2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
bd_guardar_traspasos($_SESSION['traspaso'],$_SESSION['transpasa_equipos']);
unset($_SESSION['traspaso']);
unset($_SESSION['transpasa_equipos']);
$ss2526->disp();