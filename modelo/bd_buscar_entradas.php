<?php
function bd_buscar_entradas($li)
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
	$sql = "SELECT id, fecha, personal_id, proveedor_id,deposito_id,observacion,total_art  FROM entradas 
			ORDER BY fecha DESC" ."$limite";
	return sql2array($sql);
}
