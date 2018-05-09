<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_lista_articulosdev.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_dev_prov_manual.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['dev_pro_manual'][$_REQUEST['id']]);
		sort($_SESSION['dev_pro_manual']);
		ir('registrar_dev_prov_manual.php');
		break;
}

$f1=new FormHandler('devo',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Equipos para la Devolución');
$f1->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f1->textField("Serial","serial",_FH_STRING,30,100);
$f1->textField('Cantidad','cantidad',FH_DIGIT,5,6);
$f1->setValue('cantidad',1);
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_devo');

function proc_devo($d)
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
	if(isset($_SESSION['dev_pro_manual']))
	{
		$arti=$d['articulo_id'];
		$personal = $_SESSION['usuario']['id'];
		$func = $d['funciona'];
		$equipos2 = $_SESSION['dev_pro_manual'];
		foreach($equipos2 as $r=>$m)
		{
			if ($d['serial'] == null)
			{
				if($equipos2[$r]['articulo_id'] == $d['articulo_id'] AND $equipos2[$r]['funciona'] == $d['funciona'])
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
		$serial = $d['serial'];
		$c = sql2value("SELECT COUNT(*) FROM articulos_entradas  WHERE serial LIKE '$serial' AND estatus_id LIKE '1' 
						and articulo_id LIKE '$d[articulo_id]'");
		if ($c == 0)
		{
			$enmatriz = true;
			$_SESSION['mensaje'] = "EL EQUIPO NO HA ENTRADO EN DEPOSITO O YA FUE ASIGNADO... VERIFIQUE"; 
		}
		$n=sql2value("SELECT COUNT(*) FROM asignacion_articulos  WHERE serial LIKE '$serial' AND serial <> '' 
		AND estatus_id = '8'");
		if ($n != 0)
		{
			$enmatriz = true;
			$_SESSION['mensaje'] = "EL EQUIPO YA FUE ASIGNADO... VERIFIQUE"; 
		}
	}
	if($enmatriz == false)
    {
	    $d['articulo_nombre'] = bd_obt_articulosconcat($d['articulo_id']);
		$_SESSION['dev_pro_manual'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('items',@count($_SESSION['dev_pro_manual']));
$ss2526->disp();
unset($_SESSION['mensaje']);