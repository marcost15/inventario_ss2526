<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_estados.php';
include './modelo/bd_obt_tipos_conexiones.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_comercios_general.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM comercios");
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
function bd_buscar_comercios($li)
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
			nro_tienda	FROM comercios" ."$limite";
	return sql2array($sql);
}
$comercios = bd_buscar_comercios($_REQUEST['li']);
foreach ($comercios as $i=>$c)
{
	$a = $comercios[$i]['ciudad_id'];
	$z = sql2value("SELECT estado_id FROM ciudades WHERE id = '$a' LIMIT 1");
	$comercios[$i]['estado'] = bd_obt_estados($z);
	$m = $comercios[$i]['conexion_id'];
	$comercios[$i]['conexion_id'] = bd_obt_tipos_conexiones($m);
}
$fondoreporte = 1;
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('fondoreporte',$fondoreporte);
$ss2526->assign('datos',$comercios);
$ss2526->disp();