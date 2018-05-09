<?php
function bd_modificar_proveedores($d)
{
	$id  = $d['id'];
	$sql = "UPDATE proveedores
			SET razon_social     = '$d[razon_social]',
				rif              = '$d[rif]',
				direccion        = '$d[direccion]',
				telf_fijo        = '$d[telf_fijo]',
				fax              = '$d[fax]',
				correo           = '$d[correo]',
				persona_contacto = '$d[persona_contacto]'
				WHERE CONVERT(`proveedores`.`id` USING utf8 ) = '$id' LIMIT 1;";
	enviar_sql($sql);
}