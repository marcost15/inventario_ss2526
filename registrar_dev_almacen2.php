<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './modelo/bd_verificar_privilegios.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_devolucion.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_dev_almacen2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$devoluciones = $_REQUEST['devolucion'];
foreach($devoluciones as $i=>$m)
{
	$dev[$i]['serial'] = $devoluciones[$i];
	$dev[$i]['articulo_id'] = sql2value("SELECT articulo_id FROM cambios_articulos
										WHERE reemplazado = '$devoluciones[$i]'");
	$a = $dev[$i]['articulo_id'];
	if ($a == null)
	{
		$dev[$i]['articulo_id'] = sql2value("SELECT arti_id FROM desintalacion_articulos
										WHERE serial = '$devoluciones[$i]'");
	}
}
$personal_id = $_SESSION['usuario']['id'];
bd_guardar_devolucion($dev,$personal_id);
$ss2526->disp();