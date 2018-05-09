<?php
function bd_buscar_eventos($li)
{
    $delta=$_SESSION['ini']['global']['delta'];
	if ($li!='')
	{
		$limite=" LIMIT $li, $delta";
	}
	else
	{
		$limite=" LIMIT 0, $delta";
	}	
	if (isset($_REQUEST['accion']))
	{ 
		$limite='';
	}	
	$sql = "SELECT id,fecha,comercio_id,personal_id,observacion,tipo,fecha_e FROM eventos 
			ORDER BY fecha DESC" ."$limite";
	return sql2array($sql);
}
