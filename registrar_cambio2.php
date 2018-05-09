<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_cambio.php';
include './modelo/bd_verificar_privilegios.php';
if (bd_verificar_privilegios('registrar_cambio2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
$fecha_e = $_SESSION['comerciocambio']['fecha_e'];
$fecha_e = f2f($fecha_e);
$_SESSION['comerciocambio']['fecha_e'] = $fecha_e;

bd_guardar_cambio($_SESSION['comerciocambio'],$_SESSION['equiposcambio']);
unset($_SESSION['comerciocambio']);
unset($_SESSION['equiposcambio']);
$ss2526->disp();