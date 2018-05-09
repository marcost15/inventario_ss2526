<?php
function bd_guardar_proveedores($d)
{
	enviar_sql("INSERT INTO proveedores (id,razon_social,rif,direccion,telf_fijo,fax,correo,persona_contacto) 
	VALUES ('','$d[razon_social]','$d[rif]','$d[direccion]','$d[telf_fijo]','$d[fax]','$d[correo]','$d[persona_contacto]');");
}