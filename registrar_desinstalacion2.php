<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_guardar_desinstalacion.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_desinstalacion2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$fecha_e = $_SESSION['desincomercio']['fecha_e'];
$fecha_e = f2f($fecha_e);
$_SESSION['desincomercio']['fecha_e'] = $fecha_e;
bd_guardar_desinstalacion($_SESSION['desincomercio'],$_SESSION['desinequipos']);
unset($_SESSION['desincomercio']);
unset($_SESSION['desinequipos']);
$ss2526->disp();