<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;

$app = new \Slim\Slim();
$app->database = new medoo([

    'database_type' => 'mysql',
    'database_name' => 'heroku_c9899a9d8ba32ea',
    'server' => 'us-cdbr-iron-east-01.cleardb.net',
    'username' => 'bdfafd99df173d',
    'password' => '7ee8528b',
    'port' => 3306,
    'charset' => 'utf8',
    'option' => [
        //PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
    ]);

$app->mg = new Mailgun("key-76u-fd2ilxwmtid-dm9rgq69dikp6km3");
$app->mandrill = new Mandrill('ltROxFSshMC4RBZpDxXAqQ');  
$app->mg_domain = "expotachira.net";
$body = $app->request->getBody();

$app->get('/', function () {
    echo "Parawebs, C.A";
});
$app->get('/wakeup', function () {
   header("access-control-allow-origin: *");
   echo json_encode("done");
});

$app->get('/tipoempresa', function () use ($app){
	$datas =  $app->database->select("tipo_empresa", ["tipo_id","tipo_des"]);
	header("access-control-allow-origin: *");
	echo json_encode($datas);
});

$app->get('/listclie', function () use ($app){
	$datas =  $app->database->select("preventaweb", "*");
	header("access-control-allow-origin: *");
	echo json_encode($datas);
});

$app->get('/clipre/:id', function ($id) use ($app){
	$datas =  $app->database->select("preventaweb", "*" , [ "pre_id" => $id ]);
	header("access-control-allow-origin: *");
	echo json_encode($datas[0]);
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

   $message = array(
    'subject' => 'Preventa ExpoTachira 2015',
    'from_email' => 'ventas@expotachira.net',
    'html' => '<p>Atencion al Cliente ExpoTachira.</p>',
    'important' => true,
    'track_opens' => true,
    'track_clicks' => true,
    'to' => array(array('email' => $vars['email'], 'name' => $vars['contacto'])),
    'merge_vars' => array(array(
        'rcpt' => $vars['email'],
        'vars' =>
        array(
            array(
                'name' => 'CLINAME',
                'content' => $vars['contacto'])
    ))));

    $template_name = 'expotachira';

    $template_content = array();

    $app->mandrill->messages->sendTemplate($template_name, $template_content, $message);
	  $app->mg->sendMessage($app->mg_domain, array('from'    => 'noreply@expotachira.net', 
                                'to'      => "ventas@expotachira.net", 
                                'subject' => "Nuevo Registro", 
                                'text'    => "Nueva empresa registrada."));
    }else{
    		$guardado = false;
    }

    $respuesta = new stdClass();
    $respuesta->estatus = $guardado;
    $respuesta->error = $errorlog;

    header("access-control-allow-origin: *");
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

    header("access-control-allow-origin: *");
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
	header("access-control-allow-origin: *");
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

	header("access-control-allow-origin: *");
	echo json_encode($datas);

	// Lista DE TAREAS DE UN ID. EN ESPECIFICO
});

$app->run();