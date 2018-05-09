<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_bancos.php';
include './modelo/bd_obt_tipos_conexiones.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_comerciosxbancos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$banco_id = $_REQUEST['id']; 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM comercios INNER JOIN comercios_bancos ON comercios_bancos.comercio_id = comercios.id
			WHERE comercios_bancos.banco_id = '$banco_id'");
$indice=array();
$li=0;
while($li<$n)
{
	$ls=$li+$delta-1;
	if($ls>$n)
	{
		$ls=$n;
	}
	$indice[]=array('li'=>$li,'ls'=>$ls);
	$li=$ls+1;
}
function bd_buscar_comercios_bancos($banco_id,$li)
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
	$sql = "SELECT razon_social,nombre_fantasia,rif,sucursal,persona_contacto,tlf_local,nro_cajas,ciudad_id,conexion_id,
			nro_tienda,afiliado	FROM comercios INNER JOIN comercios_bancos ON comercios_bancos.comercio_id = comercios.id
			WHERE comercios_bancos.banco_id = '$banco_id'" ."$limite";
	return sql2array($sql);
}
$comerciosxbancos = bd_buscar_comercios_bancos($banco_id,$_REQUEST['li']);
foreach ($comerciosxbancos as $i=>$c)
{
	$z = $comerciosxbancos[$i]['conexion_id'];
	$comerciosxbancos[$i]['conexion_id'] = bd_obt_tipos_conexiones($z);
}
$banco_nombre = bd_obt_bancos($banco_id);
$fondoreporte = 1;
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('banco_nombre',$banco_nombre);
$ss2526->assign('fondoreporte',$fondoreporte);
$ss2526->assign('id',$banco_id);
$ss2526->assign('datos',$comerciosxbancos);
$ss2526->disp();