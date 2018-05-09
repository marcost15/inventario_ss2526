<?php
function bd_obt_ciudades($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre,estado_id FROM ciudades ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM ciudades WHERE id = $id LIMIT 1");
	}
}