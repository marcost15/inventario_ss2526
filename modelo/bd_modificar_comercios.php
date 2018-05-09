<?php
function bd_modificar_comercios($d)
{
	$id  = $d['id'];
	$sql = "UPDATE comercios
			SET razon_social       = '$d[razon_social]',
				nombre_fantasia    = '$d[nombre_fantasia]',
				rif                = '$d[rif]',
				direccion          = '$d[direccion]',
				sucursal           = '$d[sucursal]',
				tlf_local          = '$d[tlf_local]',
				persona_contacto   = '$d[persona_contacto]',
				ciudad_id          = '$d[ciudad_id]',
				nro_cajas          = '$d[nro_cajas]',
				conexion_id        = '$d[conexion_id]',
				nro_tienda         = '$d[nro_tienda]',
				banco_id           = '$d[banco_id]'
				WHERE CONVERT(`comercios`.`id` USING utf8 ) = '$id' LIMIT 1 ;";
	enviar_sql($sql);
 }