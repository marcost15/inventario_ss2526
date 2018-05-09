<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_afiliados.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_afiliados2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
if ($_SESSION['comercio']['estatus'] == 'MODIFICAR')
{
	bd_modificar_afiliados($_SESSION['comercio']);
}
else
{
	bd_guardar_afiliados($_SESSION['comercio']);
}
unset($_SESSION['comercio']);
$ss2526->disp();