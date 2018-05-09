<?php
function bd_buscar_asignaciones($li)
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
	$sql = "SELECT id, entrepersonal_id, recibepers_id, fecha, observacion, total_art  FROM asignacion 
			ORDER BY fecha DESC" ."$limite";
	return sql2array($sql);
}
