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
if (bd_verificar_privilegios('registrar_asignacion.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
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
function totalizar()
{
    $total=0;
    foreach($_SESSION['entreg_equipos'] as $l)
    {
	$total+=$l['cantidad'];
    }
    $_SESSION['total_art']=$total;
}
if(!isset($_REQUEST))
{
	unset($_SESSION['entreg_equipos']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['entreg_equipos'][$_REQUEST['id']]);
		sort($_SESSION['entreg_equipos']);
		totalizar();
		ir('registrar_asignacion.php');
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
$f2->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f2->textField('Cantidad','cantidad',_FH_DIGIT,5,6);
$f2->setValue('cantidad',1);
$f2->textField('Serial','serial',_FH_STRING,20,255);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_datos_equipos');


function proc_datos_asig($d)
{
	$d['entrega_nombre'] = bd_obt_personal($_SESSION['usuario']['id']);
	$d['recibe_nombre'] = bd_obt_personal($d['recibe_id']);
	$_SESSION['asignacion']=$d;
	return false;
 }
function proc_datos_equipos($d)
{
	$bloqueo = false;
	$probarserial = $d['serial'];
	$seria_cant = sql2value("SELECT seria_cant FROM articulos WHERE id LIKE '$d[articulo_id]'");
	if ($seria_cant == 'C')
	{
		if ($probarserial <> null)
		{ 
			$bloqueo = true;
			$_SESSION['mensaje'] = "EL ARTICULO NO DEBE TENER SERIAL... VERIFIQUE"; 
		}
	}
	if ($seria_cant == 'S')
	{
		if ($probarserial == null)
		{
			$bloqueo = true;
			$_SESSION['mensaje'] = "EL ARTICULO DEBE TENER SERIAL... VERIFIQUE"; 
			return false;
		}
		if ($d['cantidad'] > 1 or $d['cantidad'] < 1)
		{
			$bloqueo = true;
			$_SESSION['mensaje'] = "EL EQUIPO NO DEBE TENER MULTIPLE EXISTENCIA EN DEPOSITO... VERIFIQUE"; 
			return false;
		}
		$c = sql2value("SELECT COUNT(*) FROM articulos_entradas  WHERE serial LIKE '$probarserial' AND estatus_id LIKE '1' 
						and articulo_id LIKE '$d[articulo_id]'");
		if ($c == 0)
		{
			$bloqueo = true;
			$_SESSION['mensaje'] = "EL EQUIPO NO SE ENCUENTRA EN DEPOSITO O YA FUE ASIGNADO... VERIFIQUE"; 
			return false;
		}
		/*$n=sql2value("SELECT COUNT(*) FROM asignacion_articulos  WHERE serial LIKE '$probarserial' AND estatus_id = '8'");
		if ($n != 0)
		{
			$bloqueo = true;
			$_SESSION['mensaje'] = "EL EQUIPO YA FUE ASIGNADO... VERIFIQUE"; 
		}*/
	}
	if(isset($_SESSION['entreg_equipos']))
	{
		$equipos1 = $_SESSION['entreg_equipos'];
		foreach($equipos1 as $i=>$m)
		{
			if($equipos1[$i]['serial'] == $d['serial'] and $d['serial'] != null )
			{
				$bloqueo = true;
				$_SESSION['mensaje'] = "EL SERIAL YA ESTA EN LA LISTA... VERIFIQUE"; 
				break;
			}	
		}
	}
	else
	{
		if(isset($_SESSION['entreg_equipos']))
		{
			$equipos2 = $_SESSION['entreg_equipos'];
			foreach($equipos2 as $r=>$m)
			{
				if($equipos2[$r]['articulo_id'] == $d['articulo_id'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL ARTICULO YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
		}
	}
	if($bloqueo == false)
    {
	    $d['articulo_nombre'] = bd_obt_articulosconcat($d['articulo_id']);
		$_SESSION['entreg_equipos'][]=$d;
		totalizar();
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['entreg_equipos']));
$ss2526->assign('items1',@count($_SESSION['asignacion']));
$ss2526->disp();
unset($_SESSION['mensaje']);