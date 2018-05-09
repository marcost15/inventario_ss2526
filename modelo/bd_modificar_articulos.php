<?php
function bd_modificar_articulos($d)
{
	$id  = $d['id'];
	$sql = "UPDATE articulos
			SET descripcion = '$d[descripcion]',
				marca       = '$d[marca]',
				tipo_id     = '$d[tipo_id]',
				modelo      = '$d[modelo]',
				seria_cant  = '$d[seria_cant]'
				WHERE CONVERT(`articulos`.`id` USING utf8 ) = '$id' LIMIT 1 ;";
	enviar_sql($sql);
 }