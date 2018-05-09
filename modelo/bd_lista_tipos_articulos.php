<?php
function bd_lista_tipos_articulos()
{
	return sql2opciones("SELECT id,nombre FROM tipos_articulos ORDER BY id ASC");
}