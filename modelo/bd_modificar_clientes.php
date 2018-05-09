<?php
function bd_modificar_clientes($d)
{
	$id  = $d['id'];
	$sql = "UPDATE clientes
			SET razon      =  '$d[razon_social]',
				direccion  =  '$d[direccion]',
				tlf_fijo   =  '$d[tlf_fijo]',
				tlf_movil  =  '$d[tlf_movil]',
				correo     =  '$d[correo]'
			WHERE CONVERT(`clientes`.`id` USING utf8 ) = '$id' LIMIT 1 ;";
	enviar_sql($sql);
}