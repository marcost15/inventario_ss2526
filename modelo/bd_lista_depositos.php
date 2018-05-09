<?php
function bd_lista_depositos()
{
	return sql2opciones("SELECT id,nombre FROM depositos ORDER BY id ASC");
}