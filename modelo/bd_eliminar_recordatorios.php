<?php
function bd_eliminar_recordatorios($id)
{
	$sql="
			UPDATE recordatorios_personal
			SET estado = 'FINALIZADO'
			WHERE id = '$id'
			LIMIT 1
	";
	enviar_sql($sql);
}