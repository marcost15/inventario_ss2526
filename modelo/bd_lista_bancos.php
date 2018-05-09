<?php
function bd_lista_bancos()
{
	return sql2opciones("SELECT id,nombre FROM bancos ORDER BY nombre ASC");
}