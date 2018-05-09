<?php
function bd_buscar_articulos($texto)
{
	$sql = "SELECT id,descripcion,tipo_id,marca,modelo
					FROM articulos
					WHERE id            LIKE '%$texto%' 
 						OR descripcion  LIKE '%$texto%'
						OR tipo_id      LIKE '%$texto%' 
						OR marca        LIKE '%$texto%'
						OR modelo       LIKE '%$texto%'
					 	ORDER BY descripcion ASC";
	return sql2array($sql);
}