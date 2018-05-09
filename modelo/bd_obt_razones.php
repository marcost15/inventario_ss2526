<?php
function bd_obt_razones($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM razones_devs ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM razones_devs WHERE id = $id LIMIT 1");
	}
}