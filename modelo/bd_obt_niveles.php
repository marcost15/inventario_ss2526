<?php
function bd_obt_niveles($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM niveles ORDER BY nombre ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM niveles WHERE id = $id LIMIT 1");
	}
}