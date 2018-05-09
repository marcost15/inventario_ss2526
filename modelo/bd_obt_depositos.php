<?php
function bd_obt_depositos($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM depositos ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM depositos WHERE id = $id LIMIT 1");
	}
}