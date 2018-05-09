<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_articulosconcat.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_lista_articulosdev.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_en_stock.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$articulos = array(
    "0"  => " ",
); 
$articulos1 = bd_lista_articulosdev($_SESSION['usuario']['id']);
foreach($articulos1 as $i=>$m)
{
	$articulos[$i] = $articulos1[$i];
}

switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['dev'][$_REQUEST['id']]);
		sort($_SESSION['dev']);
		ir('registrar_en_stock.php');
		break;
}

$f1=new FormHandler('devo',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Equipos para la Devolución');
$f1->selectField("Articulo","articulo_id",bd_lista_articulosconcat(),FH_NOT_EMPTY,true);
$f1->selectField("Serial","serial",$articulos);
$f1->textField('Cantidad','cantidad',FH_DIGIT,5,6);
$f1->setValue('cantidad',1);
$f1->checkBox("No Funciona", "funciona",1, null, false);
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_devo');

function proc_devo($d)
{
	$enmatriz = false;
	$probarserial = $d['serial'];
	$seria_cant = sql2value("SELECT seria_cant FROM articulos WHERE id LIKE '$d[articulo_id]'");
	if ($seria_cant == 'C' AND $probarserial <> '0')
	{ 
		$enmatriz = true;
		$_SESSION['mensaje'] = "EL ARTICULO NO DEBE TENER SERIAL... VERIFIQUE"; 
	}
	if ($seria_cant == 'S' AND $probarserial == '0')
	{
		$enmatriz = true;
		$_SESSION['mensaje'] = "EL ARTICULO DEBE TENER SERIAL... VERIFIQUE"; 
	}
	if(isset($_SESSION['dev']))
	{
		$arti=$d['articulo_id'];
		$personal = $_SESSION['usuario']['id'];
		$func = $d['funciona'];
		$equipos2 = $_SESSION['dev'];
		foreach($equipos2 as $r=>$m)
		{
			if ($d['serial'] == '0')
			{
				if($equipos2[$r]['articulo_id'] == $d['articulo_id'] AND $equipos2[$r]['funciona'] == $d['funciona'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL ARTICULO YA SE ENCUENTRA EN LA LISTA... VERIFIQUE"; 
					break;
				}
			}
			if ($d['serial'] != '0')
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
	if ($d['serial'] != '0')
	{
		if (($d['cantidad'] > 1) or ($d['cantidad'] < 1))
		{
			$enmatriz = true;
			$_SESSION['mensaje'] = "EL EQUIPO NO DEBE TENER MULTIPLE EXISTENCIA... VERIFIQUE"; 
		}
		$c = sql2value("SELECT COUNT(*) FROM asignacion_articulos  WHERE serial LIKE '$probarserial' AND estatus_id LIKE '8' 
						and articulo_id LIKE '$d[articulo_id]'");
		if ($c == 0)
		{
			$enmatriz = true;
			$_SESSION['mensaje'] = "EL EQUIPO NO SE ENCUENTRA EN DEPOSITO DEL TECNICO... VERIFIQUE"; 
		}
	}
	
	if($enmatriz == false)
    {
	    $d['articulo_nombre'] = bd_obt_articulosconcat($d['articulo_id']);
		$serial = $d['serial'];
		if ($serial == 0)
		{
		     $d['serial'] = ' ';
		}
		$_SESSION['dev'][]=$d;
    }
    return false;	
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('items',@count($_SESSION['dev']));
$ss2526->disp();
unset($_SESSION['mensaje']);