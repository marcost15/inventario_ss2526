<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_detalle_devoluciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_obt_comercios.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_detalle_devoluciones.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
$fondo = 31;
$id = $_REQUEST['id'];
$tipo_i = $_REQUEST['tipo'];
if (isset($_REQUEST['pos'])){
  $inicio=$_REQUEST['pos'];}
else {$inicio=0;}
$delta=$_SESSION['ini']['global']['delta'];
if ($tipo_i === 'SS')
{
	$n=sql2value("SELECT COUNT(*) FROM devolucion_articulos WHERE devolucion_id = '$id'");
}
if ($tipo_i === 'PROVEEDOR')
{
	$n=sql2value("SELECT COUNT(*) FROM devolucion_articulos_pro WHERE devolucion_id = '$id'");
}
$indice=array();
$li=0;
while($li<$n)
{
	$ls=$li+$delta-1;
	if($ls>$n)
	{
		$ls=$n;
	}
	$indice[]=array('li'=>$li,'ls'=>$ls);
	$li=$ls+1;
}
$devoluciones_dt = bd_detalle_devoluciones($_REQUEST['li'],$id,$tipo_i,$_REQUEST['accion']);
$devolucion=sql2row("SELECT fecha, personal_id, tipo FROM devoluciones WHERE id = '$id' LIMIT 0,1");
$a = $devolucion['personal_id'];
$devolucion['personal_id'] = bd_obt_personal_nombre($a);
$devolucion['fecha'] = f2f($devolucion['fecha']);
if ($tipo_i === 'PROVEEDOR')
{
	$fondo=1;
	foreach ($devoluciones_dt as $i=>$c)
	{
		$serial = $devoluciones_dt[$i]['serial'];
		$articulo_id = $devoluciones_dt[$i]['arti_id'];
		$eventoscam[$i] = sql2row("SELECT eventos.id, eventos.fecha_e, eventos.tipo, eventos.comercio_id 
							FROM eventos INNER JOIN cambios_articulos ON cambios_articulos.cambio_id = eventos.id
							INNER JOIN asignacion_articulos ON cambios_articulos.reemplazo = asignacion_articulos.id
							WHERE asignacion_articulos.articulo_id = '$articulo_id' AND asignacion_articulos.serial = '$serial'
							OR cambios_articulos.reemplazado = '$serial' ORDER BY eventos.fecha_e DESC LIMIT 0,1");

		$eventosdesint[$i] = sql2row("SELECT eventos.id, eventos.fecha_e, eventos.tipo, eventos.comercio_id
							FROM eventos INNER JOIN desintalacion_articulos ON 
							desintalacion_articulos.evento_id = eventos.id 
							WHERE desintalacion_articulos.serial = '$serial' ORDER BY eventos.fecha_e DESC LIMIT 0,1");
		if ($eventoscam[$i] <> null AND $eventosdesint[$i] <> NULL)
		{
			if ($eventoscam[$i]['fecha_e'] > $eventosdesint[$i]['fecha_e'])
			{
				$eventos[$i] = $eventoscam[$i];
			}
			else
			{
				$eventos[$i] = $eventosdesint[$i];
			}
		}
		else
		{
			if ($eventoscam[$i] == null)
			{
				$eventos[$i] = $eventosdesint[$i];
			}
			else
			{
				$eventos[$i] = $eventoscam[$i];
			}
		}
		$devoluciones_dt[$i]['arti_id'] = bd_obt_articulosconcat($articulo_id);
	}
	foreach($eventos as $i=>$m)
	{
		$idt = $eventos[$i]['comercio_id'];
		$eventos[$i]['afiliado'] = sql2value("SELECT comercios_bancos.afiliado FROM comercios INNER JOIN comercios_bancos ON 
												comercios_bancos.comercio_id = comercios.id WHERE comercios.id = '$idt' LIMIT 1");
		$eventos[$i]['comercio_id'] = bd_obt_comercios($eventos[$i]['comercio_id']);
		$tipo_m = $eventos[$i]['tipo']; 
		$id2 = $devoluciones_dt[$i]['serial'];
		if($tipo_m == 'CAMBIO')
		{
			$event = $eventos[$i]['id'];
			$eventos[$i]['reemplazado'] = sql2value("SELECT asignacion_articulos.serial FROM asignacion_articulos INNER JOIN cambios_articulos 
			ON cambios_articulos.reemplazo = asignacion_articulos.id WHERE cambios_articulos.cambio_id = '$event' AND 
			cambios_articulos.reemplazado = '$id2' ");
			$vacio = $eventos[$i]['reemplazado'];
			if ($vacio == null);
			{
				$eventos[$i]['reemplazo'] = sql2value("SELECT cambios_articulos.reemplazado FROM asignacion_articulos INNER JOIN cambios_articulos 
				ON cambios_articulos.reemplazo = asignacion_articulos.id WHERE cambios_articulos.cambio_id = '$event' AND 
				asignacion_articulos.serial = '$id2' ");
			}
		}
	}
	foreach ($devoluciones_dt as $i=>$c)
	{
		$devoluciones_dt[$i]['fecha_e'] = $eventos[$i]['fecha_e'];
		$devoluciones_dt[$i]['tipo']    = $eventos[$i]['tipo'];
		$devoluciones_dt[$i]['comercio'] = $eventos[$i]['comercio_id'];
		$devoluciones_dt[$i]['afiliado'] = $eventos[$i]['afiliado'];
		$devoluciones_dt[$i]['reemplazado'] = $eventos[$i]['reemplazado'];	
	}
}
else
{
	foreach ($devoluciones_dt as $i=>$c)
	{
		$devoluciones_dt[$i]['arti_id'] = bd_obt_articulosconcat($devoluciones_dt[$i]['arti_id']);
	}
}
$ss2526->assign('n',$n);
$ss2526->assign('id',$id);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$devoluciones_dt);
$ss2526->assign('devolucion',$devolucion);
$ss2526->assign('tipo',$tipo_i);
$ss2526->assign('fondoreporte',$fondo);
$ss2526->disp();