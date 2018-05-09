<?php
function bd_ficha_comercios($id)
{
	$sql = "SELECT  id,razon_social,nombre_fantasia,rif,direccion,sucursal,tlf_local,persona_contacto,ciudad_id,nro_cajas,
					conexion_id,nro_tienda,banco_id
					FROM comercios
					WHERE id = '$id' 
					LIMIT 0,1";
	return sql2row($sql);
}

function bd_ficha_afiliados($id)
{
	$sql = "SELECT  id,banco_id,afiliado
					FROM comercios_bancos
					WHERE comercio_id = '$id'";
	return sql2array($sql);
}