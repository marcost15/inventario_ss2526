<?php
function bd_lista_articulosconcat()
{
	return sql2opciones("SELECT id,CONCAT(descripcion,', ',modelo) AS descripcion FROM articulos 
							ORDER BY id ASC");
}
