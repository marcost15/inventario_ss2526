<?php
function bd_guardar_cambio($comercio,$cambios)
{
	$fecha = date('Y-m-d');
	enviar_sql("INSERT INTO eventos (id,fecha,comercio_id,personal_id,observacion,tipo,fecha_e) 
	VALUES ('','$fecha','$comercio[id]','$comercio[personal_id]','$comercio[observacion]','CAMBIO','$comercio[fecha_e]');");
	//Buscar el Utimo registro de entrada
	$cambio_id = sql2value("SELECT id FROM eventos ORDER BY id DESC LIMIT 0,1");			
	foreach($cambios as $i=>$m)
	{
		$equipo = $cambios[$i];
		enviar_sql("INSERT INTO cambios_articulos (id,cambio_id,articulo_id,reemplazado,reemplazo,cantidad,razon_id,status_id)
		VALUES ('','$cambio_id','$equipo[articulo_id]','$equipo[reemplazado]','$equipo[reemplazo]','$equipo[cantidad]',
		'$equipo[razon_id]','8');");
		$sql14 = "UPDATE asignacion_articulos SET estatus_id = '4' WHERE id = '$equipo[reemplazo]'";
		enviar_sql($sql14);
	}
}