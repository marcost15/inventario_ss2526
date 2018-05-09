<?php
function bd_obt_tipos_articulos($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM tipos_articulos ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM tipos_articulos WHERE id = $id LIMIT 1");
	}
}