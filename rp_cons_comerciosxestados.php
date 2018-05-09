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
if (bd_verificar_privilegios('rp_cons_comerciosxestados.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$estado_id = $_REQUEST['id']; 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT Count(*) FROM comercios INNER JOIN ciudades ON ciudades.id = comercios.ciudad_id INNER JOIN
			estados ON ciudades.estado_id = estados.id
			WHERE estados.id = '$estado_id'
			ORDER BY razon_social ASC");
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
function bd_buscar_comercios_estados($estado_id,$li)
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
			nro_tienda FROM comercios INNER JOIN ciudades ON ciudades.id = comercios.ciudad_id INNER JOIN
			estados ON ciudades.estado_id = estados.id
			WHERE estados.id = '$estado_id'
			ORDER BY razon_social ASC"."$limite";
	return sql2array($sql);
}
$comerciosxestados = bd_buscar_comercios_estados($estado_id,$_REQUEST['li']);
foreach ($comerciosxestados as $i=>$c)
{
	$z = $comerciosxestados[$i]['conexion_id'];
	$comerciosxestados[$i]['conexion_id'] = bd_obt_tipos_conexiones($z);
}
$estado_nombre = bd_obt_estados($estado_id);
$fondoreporte = 1;
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('estado_nombre',$estado_nombre);
$ss2526->assign('fondoreporte',$fondoreporte);
$ss2526->assign('datos',$comerciosxestados);
$ss2526->assign('id',$estado_id);
$ss2526->disp();