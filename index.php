<?php

abstract class tipoStand{
  const venezuela=1;
  const colombia=2;
  const feriaComida=3;
  const patio3=4;
  const patio4=5;
  const patio5=6;
}
abstract class edoStand{
  const disponible=1;
  const reservado=2;
  const comprado=3;
}
  $places=array();
  $places[tipoStand::venezuela]="Venezuela";
  $places[tipoStand::colombia]="Colombia";

  $mts=array();
  $mts[1]="5.7";
  $mts[2]="6";
  $mts[3]="8";
  $mts[4]="8.5";
  $mts[5]="9";
  $mts[6]="11.5";
  $mts[7]="25";
  $mts[8]="27";
  $mts[9]="35";

require 'vendor/autoload.php';
use Mailgun\Mailgun;

$app = new \Slim\Slim();
$app->database = new medoo([

    'database_type' => 'mysql',
    'database_name' => 'expofiss',
    'server' => '127.0.0.1',
    'username' => 'root',
    'password' => 'root',
    'port' => 3306,
    'charset' => 'utf8',
    'option' => [
        //PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
    ]);

$app->mg = new Mailgun("key-76u-fd2ilxwmtid-dm9rgq69dikp6km3");
$app->mg_domain = "tuquiniela.net";
$app->email = <<<EOF
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Preventa - Expoferia 2015 </title>


<style type="text/css">
img {
max-width: 100%;
}
body {
-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6;
}
body {
background-color: #f6f6f6;
}
@media only screen and (max-width: 640px) {
  h1 {
    font-weight: 600 !important; margin: 20px 0 5px !important;
  }
  h2 {
    font-weight: 600 !important; margin: 20px 0 5px !important;
  }
  h3 {
    font-weight: 600 !important; margin: 20px 0 5px !important;
  }
  h4 {
    font-weight: 600 !important; margin: 20px 0 5px !important;
  }
  h1 {
    font-size: 22px !important;
  }
  h2 {
    font-size: 18px !important;
  }
  h3 {
    font-size: 16px !important;
  }
  .container {
    width: 100% !important;
  }
  .content {
    padding: 10px !important;
  }
  .content-wrapper {
    padding: 10px !important;
  }
  .invoice {
    width: 100% !important;
  }
  .nombre {
  font-size: 24px;
  color: #ff7d33 !important;
  }

}
</style>
</head>

<body style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6; background: #f6f6f6; margin: 0; padding: 0;">

<table class="body-wrap" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background: #f6f6f6; margin: 0; padding: 0;">
    <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
        <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top"></td>
        <td class="container" width="600" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto; padding: 0;" valign="top">
            <div class="content" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background: #fff; margin: 0; padding: 0; border: 1px solid #e9e9e9;">
                    <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                        <td class="content-wrap" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">

                                <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td class="content-block nombre" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;   font-size: 24px; color: #ff7d33 !important;" valign="top">
                                        <img src="https://s3-sa-east-1.amazonaws.com/uploads-br.hipchat.com/97434/713107/dW1oe7t8Czge4SS/logo.png" width="305" height="114">
                                    </td>
                                </tr>


                                <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td class="content-block nombre" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;   font-size: 24px; color: #ff7d33 !important;" valign="top">
                                        Hola $hombreUsuario
                                    </td>
                                </tr>
                                <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td class="content-block" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                        Gracias por registrarte, pronto seras atendido por nuestro servicio de <strong>Atencion al cliente</strong>, mientras tanto te invitamos a conocer en detalle la perimetria y los servicios que ofrecidos por la <strong>ExpoFiss 2015.</strong>
                                    </td>
                                </tr>
                                <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td class="content-block nombre" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;   font-size: 24px; color: #ff7d33 !important;" valign="top">

                                        <a href="http://expotachira.net/planimetria.html"> <img src="https://s3-sa-east-1.amazonaws.com/uploads-br.hipchat.com/97434/713107/00xpCdRCmvJdumm/ver.png" ></a>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                    <table width="100%" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                        <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="aligncenter content-block" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Siguenos en <a href="http://twitter.com/laexpofiss" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0; padding: 0;">@laexpotachira</a> en Twitter.</td>
                        </tr>


                    </table>
                </div></div>
        </td>
        <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top"></td>
    </tr>
</table>

</body>
</html>
EOF;
$body = $app->request->getBody();

$app->get('/', function () {
    echo "Parawebs, C.A";
});

$app->get('/zonas', function () use ($places) {
    header('access-control-allow-origin: *');
    header('Content-Type: application/json', false);
    echo json_encode($places);
});

$app->get('/meters/:id', function ($id) use ($app,$mts) {
    $data= $app->database->select('stands','std_mts',['AND'=>['std_tipo'=>$id,'std_estatus'=>edoStand::disponible]]);
    header("access-control-allow-origin: *");
    $response=array();
    $unic=array_unique($data);
    foreach ($unic as $key => $value) {
     if(in_array($value,$mts)){
      $response[array_search ($value, $mts)]=$value;
     }
    }
    ksort($response);
    header('access-control-allow-origin: *');
    header('Content-Type: application/json', false);
    echo json_encode($response);
});

$app->get('/stands/:id/:mts', function ($idtipo,$mtspos) use ($app,$mts){
  if(isset($mts[$mtspos]))
    $datas =  $app->database->select('stands',['std_id(id)','std_nro(name)'],['AND'=>['std_tipo'=>$idtipo,'std_mts'=>$mts[$mtspos],'std_estatus'=>edoStand::disponible], 'ORDER' => ['std_nro ASC']]);
  else
    $datas=array();
    header('access-control-allow-origin: *');
    header('Content-Type: application/json', false);
    echo json_encode($datas);
});

$app->get('/tipoempresa', function () use ($app){
	$datas =  $app->database->select("tipo_empresa", ["tipo_id","tipo_des"]);
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($datas);
});

$app->get('/listclie', function () use ($app){
	$datas =  $app->database->select("preventaweb", "*");
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($datas);
});

$app->get('/allclient', function () use ($app){
  $datas =  $app->database->select("clientes", ["cli_rif(rif)","cli_razon(razon)","cli_contacto(contacto)","cli_id(id)"]);
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($datas);
});


$app->get('/clipre/:id', function ($id) use ($app){
	$datas =  $app->database->select("preventaweb", "*" , [ "pre_id" => $id ]);
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
	echo json_encode($datas[0]);
});

$app->post('/saveclient', function () use ($app) {

    $vars = $app->request->post();
    $status=true;
    $guardado=false;
    $errorlog=array();
    if (empty($vars['st_rif'])) {
      $errorlog[]= "st_rif";
      $status=false;
    }
    if (empty($vars['st_razon'])) {
      $errorlog[]= "st_razon";
      $status=false;
    }
    if (empty($vars['st_contacto'])) {
      $errorlog[]= "st_contacto";
      $status=false;
    }
    if (empty($vars['st_telf'])) {
      $errorlog[]= "st_telf";
      $status=false;
    }
    if (!filter_var($vars['st_correo'], FILTER_VALIDATE_EMAIL)) {
      $errorlog[]= "st_correo";
      $status=false;
    }
    if (empty($vars['st_condi'])) {
      $errorlog[]= "st_condi";
      $status=false;
    }
    if (empty($vars['st_zona'])) {
      $errorlog[]= "st_zona";
      $status=false;
    }
    if (empty($vars['st_mts'])) {
      $errorlog[]= "st_mts";
      $status=false;
    }
    if (empty($vars['st_stand'])) {
      $errorlog[]= "st_stand";
      $status=false;
    }

    if ($status) {
      $id=$app->database->insert('clientes', [
      'cli_rif' => $vars['st_rif'],
      'cli_razon' => $vars['st_razon'],
      'cli_contacto' => $vars['st_contacto'],
      'cli_telefono' => $vars['st_telf'],
      'cli_correo' => $vars['st_correo']
      ]);
      if($id>0){
        $row=$app->database->update('stands', ["std_estatus"=>$vars['st_condi'], "idCliente"=>$id], ["std_id" => $vars['st_stand']]);
        if($row>0)
        $guardado = true;
        else
          $app->database->delete('clientes',['cli_rif'=>$vars['st_rif']]);
      }
    }else{
        $guardado = false;
    }
    $respuesta = new stdClass();
    $respuesta->estatus = $guardado;
    $respuesta->error = $errorlog;

  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($respuesta);

});


$app->post('/savenew', function () use ($app) {

    $vars = $app->request->post();
    $status=true;
	$errorlog=array();
    if (empty($vars['empresa'])) {
    	$errorlog[]= "empresa";
    	$status=false;
    }
    if (empty($vars['contacto'])) {
    	$errorlog[]= "contacto";
    	$status=false;
    }
    if (empty($vars['telefono'])) {
    	$errorlog[]= "telefono";
    	$status=false;
    }
	if (!filter_var($vars['email'], FILTER_VALIDATE_EMAIL)) {
		$errorlog[]= "email";
		$status=false;
	}
	if (empty($vars['tipo'])) {
    	$errorlog[]= "tipo";
    	$status=false;
    }

    if ($status) {

		$guardado = true;
		$app->database->insert('preventaweb', [
		'pre_emp' => $vars['empresa'],
		'pre_con' => $vars['contacto'],
		'pre_tel' => $vars['telefono'],
		'pre_ema' => $vars['email'],
		'pre_tip' => intval($vars['tipo']),
		'pre_ruta' => intval($vars['pre_ruta']),
		'pre_rutaid' => intval($vars['pre_rutaid'])
		]);
		$guardado = true;
		$app->mg->sendMessage($app->mg_domain, array('from' => 'ventas@tuquiniela.net',
		'to' => $vars['email'],
		'subject' => "Preventa ExpoTachira 2015",
		'html' => $app->email));
    }else{
    		$guardado = false;
    }

    $respuesta = new stdClass();
    $respuesta->estatus = $guardado;
    $respuesta->error = $errorlog;

  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($respuesta);

});


$app->post('/update/:tipo/:id', function ($tipo,$id) use ($app) {

	$vars = $app->request->post();
	$respuesta = new stdClass();

    if ($tipo=="clipre") {
    	if ($app->database->has( "preventaweb" , ["pre_id" => $id ] )) {
    		$updatepre=array();
		   	if (isset($vars['pre_est'])) {
		   		$updatepre['pre_est'] =  $vars['pre_est'];
		   	}
		   	if (isset($vars['pre_int'])) {
		   		$updatepre['pre_int'] =  $vars['pre_int'];
		   	}
		    $app->database->update('preventaweb', $updatepre , ["pre_id" => $id]);

		    $respuesta->estatus = true;

		}else{

			$respuesta->estatus = false;

		}
    }
    if ($tipo=="firth") {
    	if ($app->database->has( "preventaweb" , ["pre_id" => $id ] )) {
		   	$updatepre['pre_est'] =  "1";
		    $app->database->update('preventaweb', $updatepre , ["pre_id" => $id]);
		    $respuesta->estatus = true;
		}else{
			$respuesta->estatus = false;
		}
    }

    if ($tipo=="task") {
    	if ($app->database->has( "tarea_pre" , ["tar_id" => $id ] )) {

	    	$updatetar = [ "tar_est"=>$vars['tar_est'] , "tar_not"=>$vars['tar_not']];
	    	$app->database->update('tarea_pre', $updatetar , ["tar_id" => $id]);

	    	$respuesta->estatus = true;

    	}else{

    		$respuesta->estatus = false;

    	}
    }

  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
	echo json_encode($respuesta);

});


$app->post('/newtask/:id', function ($id) use ($app) {

	$vars = $app->request->post();
	$respuesta = new stdClass();

	if ($app->database->has( "preventaweb" , ["pre_id" => $id ] )) {
		$app->database->insert('tarea_pre', [
			'pre_id' => $id,
			'tar_tip' => $vars['tar_tip'], // 1 Normal / 2 rapida / 3 Urgente
			'tar_des' => $vars['tar_des'],
			'#tar_fechcre' => 'NOW()',
			'#tar_fechrea'  => $vars['tar_fechrea']
			]);
			$respuesta->logsql = $app->database->last_query();
			$respuesta->estatus = true;
	}else{
			$respuesta->estatus = false;
	}
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
	echo json_encode($respuesta);

});

$app->post('/listtask/:tip', function ($tip) use ($app) {

	// Toda la lista de Tareas por Realizar
	$vars = $app->request->post();

	// En este lado construyo - El array del sql.
	switch ($tip) {
		case 'all':
			$sql = "";
			break;
		case 'all-est':
			$valores = explode(",", $vars['est']);
			$sql = ["tar_est" => $valores ];
			break;
		case 'unicper':
			$sql = ["pre_id" => $vars['id']];
			break;
		case 'unictask':
			$sql = ["tar_id" => $vars['id']];
			break;
	}

	$datas =  $app->database->select("tarea_pre", "*" , $sql);

  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
	echo json_encode($datas);

	// Lista DE TAREAS DE UN ID. EN ESPECIFICO
});

$app->run();