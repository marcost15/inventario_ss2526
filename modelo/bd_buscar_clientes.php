<?php
function bd_buscar_clientes($tipo,$texto)
{
	switch($tipo)
	{
		case 1: //Busqueda por letra de nombre
			$letra=$texto;
			$sql = "SELECT  id,razon
							FROM clientes
							WHERE razon LIKE '{$letra}%'
							ORDER BY razon ASC";
			break;
		case 2: //Busqueda de texto completo
			$sql = "SELECT id,razon
							FROM clientes 
							WHERE id LIKE '%$texto%' 
								OR (razon       	LIKE '%$texto%' 
								OR direccion        LIKE '%$texto%' 
								OR tlf_fijo         LIKE '%$texto%' 
								OR tlf_movil  		LIKE '%$texto%' 
								OR correo           LIKE '%$texto%')";
			break;
	}
	return sql2array($sql);
}