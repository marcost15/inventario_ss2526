<?php
function bd_lista_razones()
{
	return sql2opciones("SELECT id,nombre FROM razones_devs ORDER BY id ASC");
}