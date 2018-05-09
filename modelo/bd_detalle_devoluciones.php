<?php
function bd_detalle_devoluciones($li,$id,$tipo,$res)
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
	if ($res!='')
	{ 
		$limite='';
	}	
	if ($tipo === 'SS')
	{
		$sql="SELECT id,arti_id,serial,cantidad,funciona FROM devolucion_articulos 
						WHERE devolucion_id = '$id'" ."$limite";
	}
	if ($tipo === 'PROVEEDOR')
	{
		$sql="SELECT id,arti_id,serial,cantidad FROM devolucion_articulos_pro WHERE devolucion_id = '$id'" ."$limite";
	}
	return sql2array($sql);
}