<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_eventos.php';
include './modelo/bd_obt_comercios.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_eventos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM eventos");
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
$eventos = bd_buscar_eventos($_REQUEST['li']);
foreach ($eventos as $i=>$c)
{
	$a = $eventos[$i]['personal_id'];
	$eventos[$i]['personal_id'] = bd_obt_personal_nombre($a);
	$b = $eventos[$i]['comercio_id'];
	$eventos[$i]['comercio_id'] = bd_obt_comercios($b);
	$eventos[$i]['fecha_e'] = f2f($eventos[$i]['fecha_e']);
}
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$eventos);
$ss2526->assign('fondoreporte',1);
$ss2526->disp();