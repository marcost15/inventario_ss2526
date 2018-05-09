<?php
function bd_lista_status()
{
	return sql2opciones("SELECT id,nombre FROM status_articulos ORDER BY id ASC");
}