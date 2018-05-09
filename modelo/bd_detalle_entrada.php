<?php
function bd_detalle_entrada($li,$id)
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
	
		$sql="SELECT articulo_id,cantidad,serial FROM articulos_entradas 
						WHERE entrada_id = '$id'" ."$limite";
	return sql2array($sql);
}