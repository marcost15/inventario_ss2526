<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_personal.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_lista_depositos.php';
include './modelo/bd_lista_proveedores.php';
include './modelo/bd_obt_personal.php';
include './modelo/bd_obt_depositos.php';
include './modelo/bd_obt_proveedores.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_obt_articulosconcat.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_entrada.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

if(!isset($_REQUEST))
{
    unset($_SESSION['equipos']);
}
function totalizar()
{
    $total=0;
    foreach($_SESSION['equipos'] as $l)
    {
	$total+=$l['cantidad'];
    }
    $_SESSION['total']=$total;
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['equipos'][$_REQUEST['id']]);
		sort($_SESSION['equipos']);
		totalizar();
		ir('registrar_entrada.php');
		break;
}

$f1=new FormHandler('entrada',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Agregar Entrada');
$f1->selectField("Proveedor","proveedor_id",bd_lista_proveedores(),FH_NOT_EMPTY,true);
$f1->hiddenField('personal_id', $_SESSION['usuario']['id']);
$f1->selectField("Deposito","deposito_id",bd_lista_depositos(),FH_NOT_EMPTY,true);
$f1->TextArea('Observacion','observacion',_FH_TEXT,30,2,"onkeyup=\"entrada.observacion.value=entrada.observacion.value.toUpperCase();\"");
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_datos_entrada');

$f2=new FormHandler('equipos',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Agregar Equipo');
$f2->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f2->textField('Cantidad','cantidad',FH_DIGIT,5,6);
$f2->setValue('cantidad',1);
$f2->textField('Serial','serial',_FH_STRING,20,255);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_datos_equipos');


function proc_datos_entrada($d)
{
	$d['proveedor_nombre'] = bd_obt_proveedor($d['proveedor_id']);
	$d['personal_nombre'] = bd_obt_personal($d['personal_id']);
	$d['deposito_nombre'] = bd_obt_depositos($d['deposito_id']);
	$_SESSION['entrada']=$d;
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
		/*$n=sql2value("SELECT COUNT(*) FROM articulos_entradas  WHERE serial LIKE '$probarserial' AND estatus_id = '1'");
		if ($n != 0)
		{
			$bloqueo = true;
			$_SESSION['mensaje'] = "EL SERIAL YA EXISTE EN SS... VERIFIQUE"; 
			return false;
		}*/
	}
	if(isset($_SESSION['equipos']))
	{
		$equipos1 = $_SESSION['equipos'];
		foreach($equipos1 as $i=>$m)
		{
			if ($seria_cant == 'S')
			{
				if($equipos1[$i]['serial'] == "$probarserial")
				{
					$bloqueo = true;
					$_SESSION['mensaje'] = "EL SERIAL YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}	
			}
			else
			{
				if($equipos1[$i]['articulo_id'] == $d['articulo_id'])
				{
					$bloqueo = true;
					$_SESSION['mensaje'] = "EL ARTICULO YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
		}			
	}
	if($bloqueo == false)
    {
	    $d['articulo_nombre'] = bd_obt_articulosconcat($d['articulo_id']);
		$_SESSION['equipos'][]=$d;
		totalizar();
    }
    return false;
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['equipos']));
$ss2526->assign('items1',@count($_SESSION['entrada']));
$ss2526->disp();
unset($_SESSION['mensaje']);