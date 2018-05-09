<?php
function bd_lista_proveedores()
{
	return sql2opciones("SELECT id,razon_social FROM proveedores ORDER BY id ASC");
}