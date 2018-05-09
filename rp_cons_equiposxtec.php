<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_personal.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_equiposxtec.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$personal_id = $_REQUEST['id']; 
$id = $_REQUEST['id']; 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM asignacion_articulos INNER JOIN asignacion ON 
									asignacion_articulos.asignacion_id = asignacion.id WHERE recibepers_id = '$personal_id' AND
									serial <> ' ' AND estatus_id = 8");
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
function bd_buscar_equipos_tecnico($personal_id,$li)
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
	$sql = "SELECT articulo_id,serial FROM asignacion_articulos INNER JOIN asignacion ON 
					asignacion_articulos.asignacion_id = asignacion.id WHERE recibepers_id = '$personal_id' AND
					serial <> ' ' AND estatus_id = 8 ORDER BY articulo_id" ."$limite";
	return sql2array($sql);
}
$equiposxtecnico = bd_buscar_equipos_tecnico($personal_id,$_REQUEST['li']);
foreach ($equiposxtecnico as $i=>$c)
{
	$a = $equiposxtecnico[$i][articulo_id];
	$equiposxtecnico[$i]['articulo_id'] = bd_obt_articulosconcat($a);
}
$personal_nombre = bd_obt_personal($personal_id);
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('personal_nombre',$personal_nombre);
$ss2526->assign('datos',$equiposxtecnico);
$ss2526->assign('id',$id);
$ss2526->disp();