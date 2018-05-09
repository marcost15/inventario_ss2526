<?php
function bd_lista_articulos_sinserial($usuario)
{
	return sql2opciones("SELECT id, Concat(articulos.descripcion,', ',articulos.marca,', ',articulos.modelo) AS descripcion1 
						FROM articulos WHERE seria_cant = 'C' ORDER BY id ASC");
}