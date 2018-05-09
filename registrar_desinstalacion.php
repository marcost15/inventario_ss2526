<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_razones.php';
include './modelo/bd_lista_articulos.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_desinstalacion.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
if(!isset($_REQUEST))
{
	unset($_SESSION['desincomercio']);
	unset($_SESSION['desinequipos']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['desinequipos'][$_REQUEST['id']]);
		sort($_SESSION['desinequipos']);
		ir('registrar_desinstalacion.php');
		break;
}
$f1=new FormHandler('comercio',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Seleccione el Comercio');
$f1->textField("Codigo","id",FH_STRING,10,6,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f1->textField("Comercio", "razon_social",FH_STRING,30,255,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f1->textField("Sucursal","sucursal",_FH_STRING,30,100);
$f1->jsDateField('Fecha del Evento','fecha_e','validafecha',1,'d-m-y',"3:00");
$f1->hiddenField('personal_id', $_SESSION['usuario']['id']);
$f1->TextArea('Observacion','observacion',_FH_TEXT,30,2,"onkeyup=\"instalacion.observacion.value=instalacion.observacion.value.toUpperCase();\"");
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_desinstalacion');

$f2=new FormHandler('cambio',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Equipos Desinstalado');
$f2->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f2->textField("Serial","serial",_FH_STRING,15,100);
$f2->textField('Cantidad','cantidad',FH_DIGIT,5,6);
$f2->setValue('cantidad',1);
$f2->checkBox("No Funciona", "funciona",1, null, false);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_desinsequipos');

function proc_desinstalacion($d)
{
	$id=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM comercios INNER JOIN comercios_bancos ON comercios_bancos.banco_id = comercios.banco_id
    AND comercios_bancos.comercio_id = comercios.id WHERE comercios.id LIKE '$id'");
	if ($n==0)
	{
		$_SESSION['mensaje'] = "EL COMERCIO NO EXISTE O NO ESTA AFILIADO... VERIFIQUE"; 
	}
	else
	{
		$_SESSION['desincomercio']=$d;
	}
	return false;
}
function proc_desinsequipos($d)
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
	if(isset($_SESSION['desinequipos']))
	{
		$equipos2 = $_SESSION['desinequipos'];
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
				if (($d['cantidad'] > 1) or ($d['cantidad'] < 1))
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL EQUIPO NO DEBE TENER MULTIPLE EXISTENCIA... VERIFIQUE"; 
				}
				if($equipos2[$r]['serial'] == $d['serial'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL SERIAL YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
		}
	}
	if ($d['serial'] != null)
	{
		if (($d['cantidad'] > 1) or ($d['cantidad'] < 1))
		{
			$enmatriz = true;
			$_SESSION['mensaje'] = "EL EQUIPO NO DEBE TENER MULTIPLE EXISTENCIA... VERIFIQUE"; 
		}
	}
	if($enmatriz == false)
    {
	    $d['articulo_nombre'] = bd_obt_articulosconcat($d['articulo_id']);
		$_SESSION['desinequipos'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['desinequipos']));
$ss2526->assign('items1',@count($_SESSION['desincomercio']));
$ss2526->disp();
unset($_SESSION['mensaje']);