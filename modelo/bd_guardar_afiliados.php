<?php
function bd_guardar_afiliados($comercio)
{
	foreach($comercio['datos_bancos'] as $item)
	{
		$comercio_id = $comercio['datos_comercio']['id'];
		$banco_id    = $item['banco_id'];
		$afiliado    = $item['afiliado'];
		enviar_sql("
		INSERT INTO comercios_bancos(id,banco_id,comercio_id,afiliado)
		VALUES ('', '$banco_id', '$comercio_id', '$afiliado');");
	}

}

function bd_modificar_afiliados($comercio)
{
	$comercio_id=$comercio['datos_comercio']['id'];   
	enviar_sql("DELETE comercios_bancos.*
	FROM `comercios_bancos` 
	WHERE `comercios_bancos`.`comercio_id` = '$comercio_id'");
	
	foreach($comercio['datos_bancos'] as $item)
	{
		$comercio_id = $comercio_id;
		$banco_id    = $item['banco_id'];
		$afiliado    = $item['afiliado'];
		enviar_sql("
		INSERT INTO comercios_bancos(id,banco_id,comercio_id,afiliado)
		VALUES ('', '$banco_id', '$comercio_id', '$afiliado');");
	}
}