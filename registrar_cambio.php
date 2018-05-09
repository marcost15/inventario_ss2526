<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_razones.php';
include './modelo/bd_lista_articuloscambio.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_razones.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_cambio.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
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
	unset($_SESSION['comercio']);
	unset($_SESSION['equipos']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['equiposcambio'][$_REQUEST['id']]);
		sort($_SESSION['equiposcambio']);
		ir('registrar_cambio.php');
		break;
}
$f1=new FormHandler('comercio',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Seleccione el Comercio');
$f1->textField("Codigo","id",FH_STRING,10,6,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f1->textField("Comercio", "razon_social",FH_STRING,30,255,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f1->textField("Sucursal","sucursal",_FH_STRING,30,100);
$f1->jsDateField('Fecha de Cambio','fecha_e','validafecha',1,'d-m-y',"3:00");
$f1->hiddenField('personal_id', $_SESSION['usuario']['id']);
$f1->TextArea('Observacion','observacion',_FH_TEXT,30,2,"onkeyup=\"instalacion.observacion.value=instalacion.observacion.value.toUpperCase();\"");
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_comercio');

$f2=new FormHandler('cambio',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Equipos Cambiados');
$f2->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f2->textField("Reemplazado","reemplazado",_FH_STRING,15,100);
$f2->selectField("Reemplazo","reemplazo",$articulos);
$f2->textField('Cantidad','cantidad',FH_DIGIT,5,6);
$f2->setValue('cantidad',1);
$f2->selectField("Motivo","razon_id",bd_lista_razones(),FH_NOT_EMPTY,true);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_cambio');

function proc_comercio($d)
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
		$_SESSION['comerciocambio']=$d;
	}
	return false;
}
function proc_cambio($d)
{
	$enmatriz = false;
	$probarserial = $d['reemplazado'];
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
	if(isset($_SESSION['equiposcambio']))
	{
		$equipos2 = $_SESSION['equiposcambio'];
		foreach($equipos2 as $r=>$m)
		{
			if ($d['reemplazado'] == null)
			{
				if($equipos2[$r]['articulo_id'] == $d['articulo_id'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL ARTICULO YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
			if ($d['reemplazado'] != null)
			{
				if($equipos2[$r]['reemplazado'] == $d['reemplazado'] OR $equipos2[$r]['reemplazado'] == $d['reemplazo'] 
					OR $equipos2[$r]['reemplazo'] == $d['reemplazo'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL SERIAL YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
		}
	}
	if (($d['reemplazado'] == null AND $d['reemplazo'] != 0) OR ($d['reemplazado'] != null AND $d['reemplazo'] == 0))
	{
		$enmatriz = true;
		$_SESSION['mensaje'] = "DEBE INGRESAR EL SERIAL EN LOS DOS CAMPOS... VERIFIQUE"; 
	}
	if($enmatriz == false)
    {
	    $d['descripcion'] = bd_obt_articulosconcat($d['articulo_id']);
		$d['razon_nombre'] = bd_obt_razones($d['razon_id']);
		$d['reemplazo_serial'] = sql2value("SELECT asignacion_articulos.serial
				FROM asignacion_articulos INNER JOIN articulos ON articulos.id = asignacion_articulos.articulo_id
				WHERE asignacion_articulos.id = '$d[reemplazo]'");
		$_SESSION['equiposcambio'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['equiposcambio']));
$ss2526->assign('items1',@count($_SESSION['comerciocambio']));
$ss2526->disp();
unset($_SESSION['mensaje']);