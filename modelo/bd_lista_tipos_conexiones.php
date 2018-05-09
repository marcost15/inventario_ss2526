<?php
function bd_lista_tipos_conexiones()
{
	return sql2opciones("SELECT id,nombre FROM tipos_conexiones  ORDER BY id ASC");
}