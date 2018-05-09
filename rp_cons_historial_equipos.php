<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_proveedores.php';
include './modelo/bd_obt_personal.php';
include './modelo/bd_obt_comercios.php';
include './modelo/bd_obt_depositos.php';
include './modelo/bd_obt_razones.php';
include './modelo/bd_lista_articulos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_historial_equipos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$id = $_REQUEST['id'];
$articulo_id = sql2value("SELECT articulo_id FROM articulos_entradas WHERE serial = '$id'");
if ($articulo_id == null)
{
	$articulo_id = sql2value("SELECT articulo_id FROM asignacion_articulos WHERE serial = '$id'");
}
if ($articulo_id == null)
{
	$articulo_id = sql2value("SELECT articulo_id FROM cambios_articulos WHERE reemplazado = '$id'");
}
if ($articulo_id == null)
{
	$articulo_id = sql2value("SELECT arti_id FROM desintalacion_articulos WHERE serial = '$id'");
}
if ($articulo_id == null)
{
	$articulo_id = sql2value("SELECT arti_id FROM devolucion_articulos WHERE serial = '$id'");
}
if ($articulo_id == null)
{
	$articulo_id = sql2value("SELECT arti_id FROM devolucion_articulos_pro WHERE serial = '$id'");
}
if ($articulo_id == null)
{
	$_SESSION['mensaje'] = "EL ARTICULO NO EXISTE... VERIFIQUE"; 
}

$entradas = sql2array("SELECT observacion, deposito_id, fecha, proveedor_id, personal_id FROM articulos_entradas INNER JOIN
						entradas ON entradas.id = articulos_entradas.entrada_id 
						WHERE articulo_id = '$articulo_id' AND serial = '$id'");
foreach($entradas as $i=>$m)
{
	$fecha = $entradas[$i]['fecha'];	
	$entradas[$i]['fecha'] = f2f($fecha);	
	$entradas[$i]['deposito_id'] = bd_obt_depositos($entradas[$i][deposito_id]);
	$entradas[$i]['proveedor_id'] = bd_obt_proveedor($entradas[$i][proveedor_id]);	
	$entradas[$i]['personal_id'] = bd_obt_personal($entradas[$i][personal_id]);	
}
$asignacion = sql2array("SELECT fecha, observacion, recibepers_id, entrepersonal_id FROM asignacion_articulos INNER JOIN
							asignacion ON asignacion.id = asignacion_articulos.asignacion_id
						WHERE articulo_id = '$articulo_id' AND serial = '$id'");
foreach($asignacion as $i=>$m)
{
	$fecha = $asignacion[$i]['fecha'];	
	$asignacion[$i]['fecha'] = f2f($fecha);	
	$asignacion[$i]['recibepers_id'] = bd_obt_personal($asignacion[$i][recibepers_id]);	
	$asignacion[$i]['entrepersonal_id'] = bd_obt_personal($asignacion[$i][entrepersonal_id]);	
}

$eventosinst = sql2array("SELECT eventos.id,eventos.fecha_e, eventos.tipo, eventos.observacion, eventos.personal_id, eventos.comercio_id,
							eventos.fecha FROM eventos INNER JOIN instalacion_articulos ON instalacion_articulos.instalacion_id
							= eventos.id INNER JOIN asignacion_articulos ON instalacion_articulos.asigart_id = 
							asignacion_articulos.id WHERE asignacion_articulos.articulo_id = '$articulo_id' AND
							asignacion_articulos.serial = '$id'");


$eventoscam = sql2array("SELECT eventos.id,eventos.fecha_e, eventos.tipo, eventos.observacion, eventos.personal_id, eventos.comercio_id,
							eventos.fecha FROM eventos INNER JOIN cambios_articulos ON cambios_articulos.cambio_id = eventos.id
							INNER JOIN asignacion_articulos ON cambios_articulos.reemplazo = asignacion_articulos.id
							WHERE asignacion_articulos.articulo_id = '$articulo_id' AND asignacion_articulos.serial = '$id'
							OR cambios_articulos.reemplazado = '$id'");

$eventosdesint = sql2array("SELECT eventos.id,eventos.fecha_e, eventos.tipo, eventos.observacion, eventos.personal_id, eventos.comercio_id,
							eventos.fecha FROM eventos INNER JOIN desintalacion_articulos ON 
							desintalacion_articulos.evento_id = eventos.id 
							WHERE desintalacion_articulos.serial = '$id'");
$eventos = array_merge($eventosinst, $eventoscam, $eventosdesint);

foreach($eventos as $i=>$m)
{
	$fecha = $eventos[$i]['fecha_e'];
	$fecha2 = $eventos[$i]['fecha'];	
	$eventos[$i]['fecha_e'] = f2f($fecha);
	$eventos[$i]['fecha'] = f2f($fecha2);	
	$eventos[$i]['personal_id'] = bd_obt_personal($eventos[$i][personal_id]);	
	$idt = $eventos[$i]['comercio_id'];
	$eventos[$i]['afiliado'] = sql2value("SELECT comercios_bancos.afiliado FROM comercios INNER JOIN comercios_bancos ON 
											comercios_bancos.comercio_id = comercios.id WHERE comercios.id = '$idt' LIMIT 1");
	$eventos[$i]['comercio_id'] = bd_obt_comercios($eventos[$i][comercio_id]);
	$tipo = $eventos[$i]['tipo']; 
	if($tipo == 'CAMBIO')
	{
		$event = $eventos[$i]['id'];
		$eventos[$i]['reemplazado'] = sql2value("SELECT asignacion_articulos.serial FROM asignacion_articulos INNER JOIN cambios_articulos 
		ON cambios_articulos.reemplazo = asignacion_articulos.id WHERE cambios_articulos.cambio_id = '$event' AND 
		cambios_articulos.reemplazado = '$id' ");
		$vacio = $eventos[$i]['reemplazado'];
		if ($vacio == null);
		{
			$eventos[$i]['reemplazo'] = sql2value("SELECT cambios_articulos.reemplazado FROM asignacion_articulos INNER JOIN cambios_articulos 
			ON cambios_articulos.reemplazo = asignacion_articulos.id WHERE cambios_articulos.cambio_id = '$event' AND 
			asignacion_articulos.serial = '$id' ");
		}
	}
}
$devoluciones_ss = sql2array("SELECT devoluciones.fecha, devoluciones.personal_id, devoluciones.tipo
							FROM devoluciones INNER JOIN devolucion_articulos ON 
							devolucion_articulos.devolucion_id = devoluciones.id WHERE devolucion_articulos.serial = '$id'");

$devoluciones_pro = sql2array("SELECT devoluciones.fecha, devoluciones.personal_id, devoluciones.tipo
							   FROM devoluciones INNER JOIN devolucion_articulos_pro ON 
							   devolucion_articulos_pro.devolucion_id = devoluciones.id 
							   WHERE devolucion_articulos_pro.serial = '$id'");
$devoluciones = array_merge($devoluciones_ss, $devoluciones_pro);
foreach($devoluciones as $i=>$m)
{
	$fecha = $devoluciones[$i]['fecha'];	
	$devoluciones[$i]['fecha'] = f2f($fecha);	
	$devoluciones[$i]['personal_id'] = bd_obt_personal($devoluciones[$i][personal_id]);	
}
$articulo_id = bd_obt_articulosconcat($articulo_id);
$i=2;
$ss2526->assign('id',$id);
$ss2526->assign('fondoreporte',$i);
$ss2526->assign('articulo',$articulo_id);						
$ss2526->assign('entradas',$entradas);
$ss2526->assign('asignacion',$asignacion);
$ss2526->assign('eventos',$eventos);
$ss2526->assign('devoluciones',$devoluciones);
$ss2526->disp();