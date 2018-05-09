<?php
function bd_buscar_comercios($tipo,$texto)
{
	switch($tipo)
	{
		case 1: //Busqueda por letra de nombre
			$letra=$texto;
			$sql = "SELECT  id,razon_social,sucursal
							FROM comercios
							WHERE razon_social LIKE '{$letra}%'
							ORDER BY razon_social ASC";
			break;
		case 2: //Busqueda de texto completo
			$sql = "SELECT DISTINCT id,razon_social,sucursal
							FROM comercios
							WHERE id LIKE '%$texto%' 
								OR (rif           	LIKE '%$texto%' 
								OR razon_social 	LIKE '%$texto%' 
								OR sucursal         LIKE '%$texto%' 
								OR nombre_fantasia  LIKE '%$texto%' 
								OR direccion        LIKE '%$texto%' 
								OR nro_tienda       LIKE '%$texto%')";
			break;
		case 3: //Busqueda de AFILIADO
			$sql = "SELECT DISTINCT comercios.id,razon_social,sucursal
					FROM comercios INNER JOIN comercios_bancos ON comercios_bancos.comercio_id = comercios.id
					WHERE comercios_bancos.afiliado = '$texto'";
			break;
	}
	return sql2array($sql);
}
