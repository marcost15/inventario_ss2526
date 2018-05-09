<?php
function bd_guardar_recordatorio($d)
{
	$fecha = date('Y-m-d');
	$hora = date('H:i:s');
	$sql = "INSERT INTO recordatorios_personal (id,fecha,asunto,personal_id,estado,hora,tipo)
	         	VALUES ('','$fecha','$d[asunto]','$d[personal_id]','PENDIENTE','$hora','$d[tipo]');";
	enviar_sql($sql);
}