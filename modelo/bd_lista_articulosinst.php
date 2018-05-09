<?php
function bd_lista_articulosinst($usuario)
{
	return sql2opciones("SELECT asignacion_articulos.id, CONCAT( asignacion_articulos.serial, ', ', articulos.descripcion,
						articulos.modelo ) AS pin_pad
						FROM articulos INNER JOIN asignacion_articulos ON asignacion_articulos.articulo_id = articulos.id
						INNER JOIN asignacion ON asignacion.id = asignacion_articulos.asignacion_id 
						WHERE asignacion_articulos.serial <> '' AND asignacion.recibepers_id = '$usuario' 
						AND asignacion_articulos.estatus_id = 8
						ORDER BY asignacion_articulos.serial ASC");
}