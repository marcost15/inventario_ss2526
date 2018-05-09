<?php
function bd_ficha_proveedores($id)
{
	$sql = "SELECT  id,razon_social,rif,direccion,telf_fijo,fax,correo,persona_contacto
					FROM proveedores
					WHERE id = '$id' 
					LIMIT 0,1";
	return sql2row($sql);
}