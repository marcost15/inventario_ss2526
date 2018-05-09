<?php
function bd_guardar_comercio($d)
{
	enviar_sql("INSERT INTO comercios (id,razon_social,nombre_fantasia,rif,direccion,sucursal,tlf_local,
										persona_contacto,ciudad_id,nro_cajas,conexion_id,nro_tienda,banco_id) 
	VALUES ('','$d[razon_social]','$d[nombre_fantasia]','$d[rif]','$d[direccion]','$d[sucursal]','$d[tlf_local]',
			'$d[persona_contacto]','$d[ciudad_id]','$d[nro_cajas]','$d[conexion_id]','$d[nro_tienda]','$d[banco_id]');");
}