<?php
function bd_detalle_asignacion($li,$id)
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
	
		$sql="SELECT articulo_id,cantidad,serial FROM asignacion_articulos 
						WHERE asignacion_id = '$id'" ."$limite";
	return sql2array($sql);
}