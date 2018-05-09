<?php
function bd_opc_niveles()
{
	return sql2opciones("SELECT id,nombre FROM niveles ORDER BY id ASC");
}