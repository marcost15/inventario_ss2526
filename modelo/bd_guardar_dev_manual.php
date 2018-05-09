<?php
function bd_guardar_dev_manual($dev,$usuario)
{
	$fecha = date('Y-m-d');
	enviar_sql("INSERT INTO devoluciones (id,fecha,personal_id,tipo) 
	VALUES ('','$fecha','$usuario','SS');");
	//Buscar el Utimo registro de entrada
	$devolucion_id = sql2value("SELECT id FROM devoluciones ORDER BY id DESC LIMIT 0,1");			
	$paso = true;
	foreach($dev as $i=>$m)
	{	
		$cant = $dev[$i]['cantidad'];
		$serial = $dev[$i]['serial'];
		$art = $dev[$i]['articulo_id'];
		$func = $dev[$i]['funciona'];
		enviar_sql("INSERT INTO devolucion_articulos (id,devolucion_id,arti_id,serial,cantidad,status_id,funciona)
			VALUES ('','$devolucion_id','$art','$serial','$cant','6','$func');");
		if($func == null)
		{
			if($paso == true)
			{
				enviar_sql("INSERT INTO entradas (id,personal_id,fecha,deposito_id,observacion,proveedor_id,total_art) 
				VALUES ('','$usuario','$fecha','1','','2','1');");
				//Buscar el Utimo registro de entrada
				$entrada_id = sql2value("SELECT id FROM entradas ORDER BY id DESC LIMIT 0,1");	
				$paso = false;
			}
			enviar_sql("INSERT INTO articulos_entradas(id,articulo_id,entrada_id,cantidad,serial,estatus_id)
			VALUES ('','$art','$entrada_id','$cant','$serial','1');");
			$sql12 = "UPDATE asignacion_articulos
					SET estatus_id = '6' WHERE serial = '$serial' AND estatus_id = '8'";
					enviar_sql($sql12);
		}
		else
		{
			$sql1 = "UPDATE asignacion_articulos
					SET estatus_id = '6' WHERE serial = '$serial' AND estatus_id = '8'";
					enviar_sql($sql1);
		}
	}
}