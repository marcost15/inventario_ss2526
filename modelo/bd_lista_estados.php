<?php
function bd_lista_estados()
{
	return sql2opciones("SELECT id,nombre FROM estados ORDER BY nombre ASC");
}