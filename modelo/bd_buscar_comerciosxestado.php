<?php
function bd_buscar_comerciosxestado($estado_id)
{
	$sql = "SELECT comercios.id, comercios.razon_social, comercios.sucursal
			FROM comercios INNER JOIN ciudades ON ciudades.id = comercios.ciudad_id INNER JOIN
			estados ON ciudades.estado_id = estados.id
			WHERE estados.id = '$estado_id'
			ORDER BY razon_social ASC";
	return sql2array($sql);
}