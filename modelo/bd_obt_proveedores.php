<?php
function bd_obt_proveedor($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,razon_social,rif FROM proveedores ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT razon_social FROM proveedores WHERE id = $id LIMIT 1");
	}
}