<?php
function bd_detalle_instalacion($li,$id)
{
    $delta=$_SESSION['ini']['global']['delta'];
	
	if ($li!='')
	{
		$limite=" LIMIT $li, $delta";
	}
	else
	{
		$limite=" LIMIT 0, $delta";
	}	
	if (isset($_REQUEST['accion']))
	{ 
		$limite='';
	}	
	
	$sql="SELECT instalacion_articulos.cantidad, asignacion_articulos. serial, asignacion_articulos.articulo_id
	FROM asignacion_articulos INNER JOIN instalacion_articulos ON instalacion_articulos.asigart_id = asignacion_articulos.id
	WHERE instalacion_articulos.instalacion_id = '$id'" ."$limite";
	return sql2array($sql);
}
function bd_detalle_desinstalacion($li,$id)
{
	 $delta=$_SESSION['ini']['global']['delta'];
    if ($li!='')
	{
		$limite=" LIMIT $li, $delta";
	}
	else
	{
		$limite=" LIMIT 0, $delta";
	}	
	if (isset($_REQUEST['accion']))
	{ 
		$limite='';
	}	
	
	$sql="SELECT serial, cantidad, arti_id AS articulo_id, funciona	FROM desintalacion_articulos WHERE evento_id = '$id'" ."$limite";
	return sql2array($sql);
}
function bd_detalle_cambio($li,$id)
{
    $delta=$_SESSION['ini']['global']['delta'];
	
	if ($li!='')
	{
		$limite=" LIMIT $li, $delta";
	}
	else
	{
		$limite=" LIMIT 0, $delta";
	}	
	if (isset($_REQUEST['accion']))
	{ 
		$limite='';
	}	
	
	$sql="SELECT asignacion_articulos.serial, cambios_articulos.cantidad, cambios_articulos.razon_id, 
	cambios_articulos.reemplazado, cambios_articulos.articulo_id FROM cambios_articulos INNER JOIN asignacion_articulos 
	ON cambios_articulos.reemplazo = asignacion_articulos.id WHERE cambios_articulos.cambio_id = '$id'" ."$limite";
	return sql2array($sql);
}