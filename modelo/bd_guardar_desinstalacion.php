<?php
function bd_guardar_desinstalacion($comercio,$equipos)
{
	$fecha = date('Y-m-d');
	$fecha_e = $comercio['fecha_e'];
	enviar_sql("INSERT INTO eventos (id,fecha,comercio_id,personal_id,observacion,tipo,fecha_e) 
	VALUES ('','$fecha','$comercio[id]','$comercio[personal_id]','$comercio[observacion]','DESINSTALACION','$fecha_e');");
	//Buscar el Utimo registro de entrada
	$desinstalacion_id = sql2value("SELECT id FROM eventos ORDER BY id DESC LIMIT 0,1");			
	foreach($equipos as $i=>$m)
	{	
		$arti = $equipos[$i]['articulo_id'];
		$serial = $equipos[$i]['serial'];
		$cant = $equipos[$i]['cantidad'];
		$func = $equipos[$i]['funciona'];
		enviar_sql("INSERT INTO desintalacion_articulos (id,evento_id,arti_id,serial,cantidad,status_id,funciona)
		VALUES ('','$desinstalacion_id','$arti','$serial','$cant','5','$func');");
	}
}