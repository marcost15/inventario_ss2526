<?php
function bd_lista_ciudades()
{
	return sql2opciones("SELECT id,nombre,estado_id FROM ciudades ORDER BY nombre ASC");
}