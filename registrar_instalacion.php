<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_articulosinst.php';
include './modelo/bd_lista_articulos_sinserial.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_guardar_instalacion.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_instalacion.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

if(!isset($_REQUEST))
{
	unset($_SESSION['comercio']);
	unset($_SESSION['accesorios']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['accesorios'][$_REQUEST['id']]);
		sort($_SESSION['accesorios']);
		ir('registrar_instalacion.php');
		break;
	case 'borrar':
		unset($_SESSION['comercio']['equipos'][$_REQUEST['id']]);
		sort($_SESSION['comercio']['equipos']);
		unset($_SESSION['comercio']['nombre'][$_REQUEST['id']]);
		sort($_SESSION['comercio']['nombre']);
		ir('registrar_instalacion.php');
		break;
}

$f1=new FormHandler('comercio',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Seleccione el Comercio');
$f1->textField("Codigo","id",FH_STRING,10,6,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f1->textField("Comercio", "razon_social",FH_STRING,30,255,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f1->textField("Sucursal","sucursal",_FH_STRING,30,100);
$f1->jsDateField('Fecha de Instalación','fecha_e','validafecha',1,'d-m-y',"3:00");
$f1->hiddenField('personal_id', $_SESSION['usuario']['id']);
$f1->TextArea('Observacion','observacion',_FH_TEXT,30,2,"onkeyup=\"instalacion.observacion.value=instalacion.observacion.value.toUpperCase();\"");
$f1->borderStop();
$f1->borderStart('Seleccione Los Equipos');
$f1->ListField("","equipos",bd_lista_articulosinst($_SESSION['usuario']['id']),'',true,'','',5);
$f1->borderStop();
$f1->submitButton('Agregar');
$f1->onCorrect('proc_equipos');

$f2=new FormHandler('accesorios',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Seleccione Accesorios');
$f2->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%title%</td>\n".
   "   <td>%field%</td>\n".
   "   <td>%error%</td>\n".
   "   <td>%title%</td>\n".
   "   <td>%field%</td>\n".
   "   <td>%error%</td>\n".
   " </tr>\n"
);
$f2->selectField("Articulo", "articulo_id",bd_lista_articulos_sinserial($_SESSION['usuario']['id']));
$f2->textField("Cantidad", "cantidad",_FH_DIGIT,5,3);
$f2->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%title%</td>\n".
   "   <td>%field%</td>\n".
   "   <td>%error%</td>\n".
   " </tr>\n"
);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_accesorios');

function proc_equipos($d)
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
		$_SESSION['comercio']=$d;
		if ($d['equipos'] <> null)
		{
			$equipos = $d['equipos'];
			foreach($equipos as $t=>$z)
			{
				$_SESSION['comercio']['nombre'][$t] = sql2row("SELECT CONCAT(articulos.descripcion, articulos.modelo) 
							AS descripcion ,asignacion_articulos.serial
							FROM asignacion_articulos INNER JOIN articulos ON articulos.id = asignacion_articulos.articulo_id
							WHERE asignacion_articulos.id = '$equipos[$t]'");
			}
		}
	}
	return false;
}
function proc_accesorios($d)
{
	$enmatriz = false;
	$arti=$d['articulo_id'];
	$personal = $_SESSION['usuario']['id'];
	if(isset($_SESSION['accesorios']))
	{
		$equipos2 = $_SESSION['accesorios'];
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
	if($enmatriz == false)
    {
	    $d['articulo_nombre'] = bd_obt_articulosconcat($d['articulo_id']);
		$_SESSION['accesorios'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['comercio']));
$ss2526->disp();
unset($_SESSION['mensaje']);