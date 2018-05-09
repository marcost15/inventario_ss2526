<?php
function bd_guardar_clientes($d)
{
	enviar_sql("INSERT INTO clientes (id,razon,direccion,tlf_fijo,tlf_movil,correo) 
	VALUES ('$d[rif]','$d[razon_social]','$d[direccion]','$d[tlf_fijo]','$d[tlf_movil]','$d[correo]');");
}