<?php
function bd_obt_bancos($id = null)
{
	if($id == NULL)
	{
		return sql2array("SELECT id,nombre FROM bancos ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM bancos WHERE id = $id LIMIT 1");
	}
}