<?php
function bd_obt_comercios($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,razon_social FROM comercios ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT CONCAT(razon_social,' ',sucursal) AS nombre FROM comercios WHERE id = $id LIMIT 1");
	}
}