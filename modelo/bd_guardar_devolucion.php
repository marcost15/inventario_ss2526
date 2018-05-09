<?php
function bd_guardar_devolucion($dev,$usuario)
{
	$fecha = date('Y-m-d');
	enviar_sql("INSERT INTO devoluciones (id,fecha,personal_id,tipo) 
	VALUES ('','$fecha','$usuario','SS');");
	//Buscar el Utimo registro de entrada
	$devolucion_id = sql2value("SELECT id FROM devoluciones ORDER BY id DESC LIMIT 0,1");			
	foreach($dev as $i=>$m)
	{	
		$serial = $dev[$i]['serial'];
		$art = $dev[$i]['articulo_id'];
		enviar_sql("INSERT INTO devolucion_articulos (id,devolucion_id,arti_id,serial,cantidad,status_id,funciona)
			VALUES ('','$devolucion_id','$art','$serial','1','6','1');");
			$id_g = sql2array("SELECT id FROM cambios_articulos
										WHERE reemplazado = '$serial'");
			$id_g2 = sql2array("SELECT id FROM desintalacion_articulos
									WHERE serial = '$serial'");
		if ($id_g <> null)
		{	
			foreach($id_g as $g=>$m)
			{
				$id1 = $id_g[$g]['id'];
				$sql15 = "UPDATE cambios_articulos SET status_id = '6' WHERE id = '$id1'";
				enviar_sql($sql15);
			}
		}
		if ($id_g2 <> null)
		{	
			foreach($id_g2 as $f=>$m)
			{
				$id2 = $id_g2[$f]['id'];
				$sql16 = "UPDATE desintalacion_articulos SET status_id = '6' WHERE id = '$id2'";
				enviar_sql($sql16);
			}
		}
	}
}