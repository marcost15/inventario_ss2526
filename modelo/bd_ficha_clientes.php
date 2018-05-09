<?php
function bd_ficha_clientes($id)
{
	$sql = "SELECT  id,razon,direccion,tlf_fijo,tlf_movil,correo
					FROM clientes
					WHERE id = '$id'
					LIMIT 0,1";
	return sql2row($sql);
}