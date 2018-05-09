<?php
function bd_obt_articulosconcat($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,CONCAT(descripcion,', ',modelo) AS descripcion FROM articulos ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT CONCAT(descripcion,', ',modelo) AS descripcion FROM articulos WHERE id = $id LIMIT 1");
	}
}