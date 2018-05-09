<?php
function bd_buscar_proveedores($tipo,$texto)
{
	switch($tipo)
	{
		case 1: //Busqueda por letra de nombre
			$letra=$texto;
			$sql = "SELECT  id,razon_social,rif
							FROM proveedores
							WHERE razon_social LIKE '{$letra}%'
							ORDER BY razon_social ASC";
			break;
		case 2: //Busqueda de texto completo
			$sql = "SELECT id,razon_social,rif
							FROM proveedores 
							WHERE id LIKE '%$texto%' 
								OR (razon_social 	LIKE '%$texto%' 
								OR rif              LIKE '%$texto%' 
								OR direccion        LIKE '%$texto%' 
								OR telf_fijo        LIKE '%$texto%' 
								OR fax        		LIKE '%$texto%' 
								OR persona_contacto LIKE '%$texto%')";
			break;
	}
	return sql2array($sql);
}