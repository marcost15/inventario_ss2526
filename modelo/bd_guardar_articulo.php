<?php
function bd_guardar_articulos($d)
{
	enviar_sql("INSERT INTO articulos (id,descripcion,tipo_id,marca,modelo,seria_cant) 
	VALUES ('$d[id]','$d[descripcion]','$d[tipo_id]','$d[marca]','$d[modelo]','$d[seria_cant]');");
}