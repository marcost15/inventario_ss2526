<?php
function bd_lista_articulos()
{
	return sql2opciones("SELECT id,descripcion FROM articulos ORDER BY id ASC");
}