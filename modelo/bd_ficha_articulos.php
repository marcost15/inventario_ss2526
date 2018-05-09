<?php
function bd_ficha_articulos($id)
{
	$sql = "SELECT id,descripcion,tipo_id,marca,modelo,seria_cant
					FROM articulos WHERE id  LIKE '$id' LIMIT 1";
	return sql2row($sql);
}