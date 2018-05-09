<?php
function bd_buscar_instalaciones($li)
{
    $delta=$_SESSION['ini']['global']['delta'];
	
	if ($li!='')
	{
		$limite=" LIMIT $li, $delta";
	}
	else
	{
		$limite='';
	}	
	$sql = "SELECT id,comercio_id,fecha_e FROM eventos WHERE tipo = 'INSTALACION'
			ORDER BY fecha DESC" ."$limite";
	return sql2array($sql);
}
