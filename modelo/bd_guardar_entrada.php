<?php
function bd_guardar_entrada($entrada,$equipos,$total)
{
	$fecha = date('Y-m-d');
	$personal_id = $entrada['personal_id'];
	$deposito_id = $entrada['deposito_id'];
	$observacion = $entrada['observacion'];
	$proveedor_id = $entrada['proveedor_id'];
	enviar_sql("INSERT INTO entradas (id,personal_id,fecha,deposito_id,observacion,proveedor_id,total_art) 
	VALUES ('','$personal_id','$fecha','$deposito_id','$observacion','$proveedor_id','$total');");
	//Buscar el Utimo registro de entrada
	$entrada_id = sql2value("SELECT id FROM entradas ORDER BY id DESC LIMIT 0,1");			
	foreach($equipos as $item)
	{
		$entrada_id  = $entrada_id;
		$articulo_id = $item['articulo_id'];
		$cantidad    = $item['cantidad'];
		$serial      = $item['serial'];
		enviar_sql("
		INSERT INTO articulos_entradas(id,articulo_id,entrada_id,cantidad,serial,estatus_id)
		VALUES ('','$articulo_id','$entrada_id','$cantidad','$serial','1');");
	}
}