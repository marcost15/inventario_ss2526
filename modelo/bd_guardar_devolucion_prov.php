<?php
function bd_guardar_devolucion_prov($dev,$usuario)
{
	$fecha = date('Y-m-d');
	enviar_sql("INSERT INTO devoluciones (id,fecha,personal_id,tipo) 
	VALUES ('','$fecha','$usuario','PROVEEDOR');");
	//Buscar el Utimo registro de entrada
	$devolucion_id = sql2value("SELECT id FROM devoluciones ORDER BY id DESC LIMIT 0,1");			
	foreach($dev as $i=>$m)
	{	
		$serial = $dev[$i]['serial'];
		$art = $dev[$i]['articulo_id'];
		enviar_sql("INSERT INTO devolucion_articulos_pro (id,devolucion_id,arti_id,serial,cantidad)
			VALUES ('','$devolucion_id','$art','$serial','1');");
		$sql16 = "UPDATE articulos_entradas
				SET estatus_id = '7' WHERE serial = '$serial'";
				enviar_sql($sql16);
		$sql17 = "UPDATE asignacion_articulos
					SET estatus_id = '7' WHERE serial = '$serial'";
					enviar_sql($sql17);	
		$sql18 = "UPDATE cambios_articulos
					SET status_id = '7' WHERE reemplazado = '$serial'";
					enviar_sql($sql18);			
		$sql19 = "UPDATE desintalacion_articulos
					SET status_id = '7' WHERE serial = '$serial'";
					enviar_sql($sql19);			
		$sql20 = "UPDATE devolucion_articulos
					SET status_id = '7' WHERE serial = '$serial'";
					enviar_sql($sql20);
	}
}