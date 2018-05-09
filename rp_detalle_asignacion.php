<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_detalle_asignacion.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_detalle_asignacion.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
$id = $_REQUEST['id'];
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM asignacion_articulos WHERE asignacion_id = '$id'");
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
$asignacion_dt = bd_detalle_asignacion($_REQUEST['li'],$id);

$asignacion=sql2row("SELECT entrepersonal_id,recibepers_id,fecha,observacion FROM asignacion WHERE id = '$id' LIMIT 0,1");
$a = $asignacion['entrepersonal_id'];
$asignacion['entrepersonal_id'] = bd_obt_personal_nombre($a);
$b = $asignacion['recibepers_id'];
$asignacion['recibepers_id'] = bd_obt_personal_nombre($b);
$asignacion['fecha'] = f2f($asignacion['fecha']);

foreach ($asignacion_dt as $i=>$c)
{
	$a = $asignacion_dt[$i]['articulo_id'];
	$asignacion_dt[$i]['articulo_id'] = bd_obt_articulosconcat($a);
}
$ss2526->assign('n',$n);
$ss2526->assign('id',$id);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$asignacion_dt);
$ss2526->assign('asignacion',$asignacion);
$ss2526->disp();