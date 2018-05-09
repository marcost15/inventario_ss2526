<?php
function bd_obt_tipos_conexiones($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM tipos_conexiones ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM tipos_conexiones WHERE id = $id LIMIT 1");
	}
}