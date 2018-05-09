<?php
function bd_guardar_traspasos($asignacion,$entreg_equipos)
{
	$fecha 				= date('Y-m-d');
	$entrepersonal_id 	= $asignacion['entrega_id'];
	$recibepers_id 		= $asignacion['recibe_id'];
	$observacion 		= $asignacion['observacion'];
	enviar_sql("INSERT INTO asignacion (id,entrepersonal_id,recibepers_id,fecha,observacion,total_art) 
	VALUES ('','$entrepersonal_id','$recibepers_id','$fecha','$observacion','$total_art');");
	//Buscar el Utimo registro de asignacion
	$asignacion_id = sql2value("SELECT id FROM asignacion ORDER BY id DESC LIMIT 0,1");			
	foreach($entreg_equipos as $item)
	{
		$asignacion_id  = $asignacion_id;
		$articulo_id 	= $item['arti'];
		$cantidad    	= 1;
		$serial      	= $item['pinpad_serial'];
		$sql2 = "UPDATE asignacion_articulos SET estatus_id = '10' WHERE serial LIKE '$serial'";
			enviar_sql($sql2);
		enviar_sql("
		INSERT INTO asignacion_articulos (id,articulo_id,asignacion_id,cantidad,serial,estatus_id)
		VALUES ('','$articulo_id','$asignacion_id','$cantidad','$serial','8');");
	}
}