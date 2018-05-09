<?php
function bd_guardar_personal($d)
{
	enviar_sql("INSERT INTO personal (id,apellido,nombre,login,clave,nivel_id,estado) 
	VALUES ('$d[id]','$d[apellido]','$d[nombre]','$d[login]',MD5('$d[clave]'),'$d[nivel_id]','ACTIVO');");
	
	enviar_sql("INSERT INTO personal_datos (personal_id,direccion,tlf_fijo,tlf_movil,correo,foto,fecha_ing) 
	VALUES ('$d[id]','$d[direccion]','$d[tlf_fijo]','$d[tlf_movil]','$d[email]','$d[foto]','$d[fecha_ing]');");
}