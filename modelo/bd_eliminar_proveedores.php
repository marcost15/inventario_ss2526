<?php
function bd_eliminar_proveedores($id)
{
	enviar_sql("DELETE FROM proveedores WHERE id  = '$id' LIMIT 1;");
}