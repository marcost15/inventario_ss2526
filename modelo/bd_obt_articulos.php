<?php
function bd_obt_articulos($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,descripcion FROM articulos ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT descripcion FROM articulos WHERE id = $id LIMIT 1");
	}
}