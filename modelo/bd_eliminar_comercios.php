<?php
function bd_eliminar_comercios($id)
{
	enviar_sql("DELETE FROM comercios WHERE id  = '$id' LIMIT 1;");
	enviar_sql("DELETE FROM comercios_bancos WHERE comercio_id  = '$id'");
}