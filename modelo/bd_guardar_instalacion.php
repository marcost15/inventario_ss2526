<?php
function bd_guardar_instalacion($comercio,$accesorios)
{
	$fecha = date('Y-m-d');
	enviar_sql("INSERT INTO eventos (id,fecha,comercio_id,personal_id,observacion,tipo,fecha_e) 
	VALUES ('','$fecha','$comercio[id]','$comercio[personal_id]','$comercio[observacion]','INSTALACION','$comercio[fecha_e]');");
	//Buscar el Utimo registro de entrada
	$instalacion_id = sql2value("SELECT id FROM eventos ORDER BY id DESC LIMIT 0,1");			
	if ($comercio['equipos'] <> null)
	{
		foreach($comercio['equipos'] as $i=>$m)
		{	
			$comer = $comercio['equipos'][$i];
			enviar_sql("INSERT INTO instalacion_articulos (id,instalacion_id,asigart_id,cantidad,tipo)
			VALUES ('','$instalacion_id','$comer','1','EQUIPO');");
			$sql1 = "UPDATE asignacion_articulos
			SET estatus_id = '3' WHERE id = '$comer'";
			enviar_sql($sql1);
		}
	}
	if ($accesorios)
	{
		foreach($accesorios as $f=>$m)
		{
			$articulo_id = $accesorios[$f]['articulo_id'];
			$cant = $accesorios[$f]['cantidad'];
			enviar_sql("INSERT INTO instalacion_articulos (id,instalacion_id,asigart_id,cantidad,tipo)
			VALUES ('','$instalacion_id','$articulo_id','$cant','ACCESORIO');");
			enviar_sql($sql22);
		}
	}
}