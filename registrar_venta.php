<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_venta.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

if(!isset($_REQUEST))
{
	unset($_SESSION['cliente']);
	unset($_SESSION['ventaequipos']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['ventaequipos'][$_REQUEST['id']]);
		sort($_SESSION['ventaequipos']);
		ir('registrar_venta.php');
		break;
}
$f1=new FormHandler('cliente',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Seleccione el Cliente');
$f1->textField("Codigo","id",FH_STRING,10,6,"onDblClick=\"window.open('ventana_clientes.php','sopa');\"");
$f1->textField("Cliente", "razon_social",FH_STRING,30,255,"onDblClick=\"window.open('ventana_clientes.php','sopa');\"");
$f1->hiddenField('personal_id', $_SESSION['usuario']['id']);
$f1->TextArea('Observacion','observacion',_FH_TEXT,30,2,"onkeyup=\"cliente.observacion.value=cliente.observacion.value.toUpperCase();\"");
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_venta');

$f2=new FormHandler('venta',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Equipos');
$f2->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f2->textField('Cantidad','cantidad',FH_DIGIT,5,6);
$f2->setValue('cantidad',1);
$f2->textField('Serial','serial',_FH_STRING,20,255);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_equipo');

function proc_venta($d)
{
	$id=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM clientes WHERE id LIKE '$id'");
	if ($n==0)
	{
		$_SESSION['mensaje'] = "EL CLIENTE NO EXISTE... VERIFIQUE"; 
	}
	else
	{
		$_SESSION['cliente']=$d;
	}
	return false;
}
function proc_equipo($d)
{
	$enmatriz = false;
	$probarserial = $d['serial'];
	$seria_cant = sql2value("SELECT seria_cant FROM articulos WHERE id LIKE '$d[articulo_id]'");
	if ($seria_cant == 'C' AND $probarserial <> null)
	{ 
		$enmatriz = true;
		$_SESSION['mensaje'] = "EL ARTICULO NO DEBE TENER SERIAL... VERIFIQUE"; 
	}
	if ($seria_cant == 'S' AND $probarserial == null)
	{
		$enmatriz = true;
		$_SESSION['mensaje'] = "EL ARTICULO DEBE TENER SERIAL... VERIFIQUE"; 
	}
	$arti=$d['articulo_id'];
	$f=sql2value("SELECT cantidad FROM existenciaS  WHERE articulo_id LIKE '$arti' ");
	if ($d['cantidad'] > $f)
	{
		$enmatriz = true;
		$_SESSION['mensaje'] = "CANTIDAD EN DEPOSITO INSUFICIENTE... VERIFIQUE"; 
	}
	if(isset($_SESSION['ventaequipos']))
	{
		$equipos2 = $_SESSION['ventaequipos'];
		foreach($equipos2 as $r=>$m)
		{
			if ($d['serial'] == null)
			{
				if($equipos2[$r]['articulo_id'] == $d['articulo_id'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL ARTICULO YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
			if ($d['serial'] != null)
			{
				if($equipos2[$r]['serial'] == $d['serial'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL SERIAL YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
		}
	}
	if($enmatriz == false)
    {
	    $d['descripcion'] = bd_obt_articulosconcat($d['articulo_id']);
		$_SESSION['ventaequipos'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['cliente']));
$ss2526->assign('items1',@count($_SESSION['ventaequipos']));
$ss2526->disp();
unset($_SESSION['mensaje']);