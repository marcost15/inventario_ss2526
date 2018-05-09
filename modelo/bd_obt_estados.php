<?php
function bd_obt_estados($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM estados ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM estados WHERE id = '$id' LIMIT 1");
	}
}