<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_asignaciones.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_asignaciones.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM asignacion");
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
$asignacion = bd_buscar_asignaciones($_REQUEST['li']);
foreach ($asignacion as $i=>$c)
{
	$a = $asignacion[$i]['entrepersonal_id'];
	$asignacion[$i]['entrepersonal_id'] = bd_obt_personal_nombre($a);
	$b = $asignacion[$i]['recibepers_id'];
	$asignacion[$i]['recibepers_id'] = bd_obt_personal_nombre($b);
	$asignacion[$i]['fecha'] = f2f($asignacion[$i]['fecha']);	
}
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$asignacion);
$ss2526->assign('fondoreporte',1);
$ss2526->disp();