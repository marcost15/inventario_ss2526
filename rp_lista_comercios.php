<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_lista_articulos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_lista_comercios.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
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
		$limite='';
	}	
	$sql = "SELECT articulo_id,serial FROM comercios ORDER BY razón_social" ."$limite";
	return sql2array($sql);
}
$almacenados = bd_buscar_comercios($_REQUEST['li']);
foreach ($almacenados as $i=>$c)
{
	$a = $almacenados[$i][articulo_id];
	$almacenados[$i]['articulo_id'] = bd_obt_articulosconcat($a);
}
$a = '0';
$ss2526->assign('a',$a);
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$almacenados);
$ss2526->disp();