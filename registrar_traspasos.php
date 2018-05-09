<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_personal_activo.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_lista_articuloscambio.php';
include './modelo/bd_obt_personal.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_traspasos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
//++++++++++++++++++++++++++++++++++++++DESARROLLADO POR MARCOS OJO QUE ESTA BUENO ESTE CODIGO+++++++ LAS COPIAS SERAN VENGADAS
$articulos = array(
    "0"  => " ",
); 
$articulos1 = bd_lista_articuloscambio($_SESSION['usuario']['id']);
foreach($articulos1 as $i=>$m)
{
	$articulos[$i] = $articulos1[$i];
}
//++++++++++++++++++++++++++++++++++++++DESARROLLADO POR MARCOS OJO QUE ESTA BUENO ESTE CODIGO+++++++ LAS COPIAS SERAN VENGADAS
if(!isset($_REQUEST))
{
	unset($_SESSION['transpasa_equipos']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['transpasa_equipos'][$_REQUEST['id']]);
		sort($_SESSION['transpasa_equipos']);
		ir('registrar_traspasos.php');
		break;
}

$f1=new FormHandler('transpaso',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Agregar Transpaso de Equipos');
$f1->hiddenField('entrega_id', $_SESSION['usuario']['id']);
$f1->selectField("Recibe","recibe_id",bd_lista_personal_activo(),FH_NOT_EMPTY,true);
$f1->TextArea('Observacion','observacion',_FH_TEXT,30,2,"onkeyup=\"entrada.observacion.value=entrada.observacion.value.toUpperCase();\"");
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_datos_asig');

$f2=new FormHandler('equipos',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Agregar Equipo');
$f2->selectField("Articulo","articulo_id",$articulos);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_datos_equipos');


function proc_datos_asig($d)
{
	$d['entrega_nombre'] = bd_obt_personal($_SESSION['usuario']['id']);
	$d['recibe_nombre'] = bd_obt_personal($d['recibe_id']);
	$_SESSION['traspaso']=$d;
	return false;
 }
function proc_datos_equipos($d)
{
	$bloqueo = false;
	if(isset($_SESSION['transpasa_equipos']))
	{
		$equipos1 = $_SESSION['transpasa_equipos'];
		foreach($equipos1 as $i=>$m)
		{
			if($equipos1[$i]['articulo_id'] == $d['articulo_id'] and $d['articulo_id'] != null )
			{
				$bloqueo = true;
				$_SESSION['mensaje'] = "EL SERIAL YA ESTA EN LA LISTA... VERIFIQUE"; 
				break;
			}	
		}
	}
	if($bloqueo == false)
    {
		$d['pinpad_serial'] = sql2value("SELECT asignacion_articulos.serial
				FROM asignacion_articulos INNER JOIN articulos ON articulos.id = asignacion_articulos.articulo_id
				WHERE asignacion_articulos.id = '$d[articulo_id]'");
		$arti = sql2value("SELECT articulo_id FROM asignacion_articulos WHERE id = '$d[articulo_id]'");
		$d['arti'] = $arti;
		$d['articulo'] = bd_obt_articulosconcat($arti);
		$_SESSION['transpasa_equipos'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['transpasa_equipos']));
$ss2526->assign('items1',@count($_SESSION['traspaso']));
$ss2526->disp();
unset($_SESSION['mensaje']);