<?php
function bd_buscar_recordatorio($id)
{
	$sql="
			SELECT id ,fecha,asunto,hora,personal_id
			FROM recordatorios_personal
			WHERE (personal_id = '$id' OR tipo = 'PUBLICO') AND estado = 'PENDIENTE' 
	";
	return sql2array($sql);
}