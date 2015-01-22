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

require_once 'usuario.php';
require 'vendor/autoload.php';
use Mailgun\Mailgun;

$app = new \Slim\Slim(array(
  'mode' => 'production'));
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

$body = $app->request->getBody();
$usr= new usuario(tipoConsulta::Consulta,null);


$app->get('/', function () use ($app,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  echo json_encode(array("done"=>"Parawebs, C.A"));
});



$app->get('/cerrar', function () use ($app,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $usr= new usuario(tipoConsulta::Cerrar,null);
  $logout["logout"]=true;
  echo json_encode($logout);

});

$app->get('/zonas', function () use ($places,$app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  echo json_encode($places);
});

$app->get('/meters/:id', function ($id) use ($app,$mts,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
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

$app->get('/stands/:id/:mts', function ($idtipo,$mtspos) use ($app,$mts,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  if(isset($mts[$mtspos]))
    $datas =  $app->database->select('stands',['std_id(id)','std_nro(name)'],['AND'=>['std_tipo'=>$idtipo,'std_mts'=>$mts[$mtspos],'std_estatus'=>edoStand::disponible], 'ORDER' => ['std_nro ASC']]);
  else
    $datas=array();
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($datas);
});
$app->get('/wakeup', function () {
 header("access-control-allow-origin: *");
 echo json_encode("done");
});

$app->get('/tipoempresa', function () use ($app){
	$datas =  $app->database->select("tipo_empresa", ["tipo_id","tipo_des"]);
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  echo json_encode($datas);
});

$app->get('/listclie', function () use ($app,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  $datas =  $app->database->select("preventaweb", "*");
  echo json_encode($datas);
});

$app->get('/allclient', function () use ($app,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  $datas =  $app->database->select("clientes", ["cli_rif(rif)","cli_razon(razon)","cli_contacto(contacto)","cli_id(id)","cli_telefono(telefono)","cli_correo(correo)","cli_id(id)"]);
  echo json_encode($datas);
});


$app->get('/clipre/:id', function ($id) use ($app,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  $datas =  $app->database->select("preventaweb", "*" , [ "pre_id" => $id ]);
  echo json_encode($datas[0]);
});

$app->get('/listands/:id', function ($id) use ($app,$usr){
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  validartoken($app->request->get('tokenid'),$usr->sessionID);
  $datas =  $app->database->select("stands",["std_id(id)","std_tipo(tipo)","std_nro(nro)","std_estatus(status)","std_mts(mts)"], ["idCliente"=>$id]);
  echo json_encode($datas);
});

$app->post('/login', function () use ($app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $vars = $app->request->post();
  $resp = new stdClass();
  $data= $app->database->select('user',["nombre","estado"],["AND"=>["usuario"=>$vars["login"],"clave"=>$vars["passwd"]]]);

  if(!empty($data)&&$data[0]["estado"]>0){
    $arg=array();
    $arg['tipoLogOut']=tipoLogOut::Estado;
    $arg['tipoUser']=tipoUsuario::Admin;
    $arg['nombre']=$data[0]["nombre"];
    $usr= new usuario(tipoConsulta::Creacion,$arg);
    $resp->estatus=true;
    $resp->item["token"]=$usr->sessionID;
    $resp->item["user"]=$usr->nombre;
  }
  else{
    $resp->estatus=false;
    $resp->item="Usuario o clave inválida";
  }
  echo json_encode($resp);
});

$app->post('/saveclient', function () use ($app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $vars = $app->request->post();
  validartoken($vars["tokenid"],$usr->sessionID);
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

  if ($status) {
    $id=$app->database->insert('clientes', [
      'cli_rif' => $vars['st_rif'],
      'cli_razon' => $vars['st_razon'],
      'cli_contacto' => $vars['st_contacto'],
      'cli_telefono' => $vars['st_telf'],
      'cli_correo' => $vars['st_correo']
      ]);
    if($id>0)
        $guardado = true;
  }
  $respuesta = new stdClass();
  $respuesta->estatus = $guardado;
  $respuesta->error = $errorlog;
  echo json_encode($respuesta);

});

$app->post('/savestand', function () use ($app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $vars = $app->request->post();
  validartoken($vars["tokenid"],$usr->sessionID);
  $status=true;
  $guardado=false;
  $errorlog=array();

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
   if ($app->database->has( "stands" , ["std_id" => $vars['st_stand']])) {
      $row=$app->database->update('stands', ["std_estatus"=>$vars['st_condi'], "idCliente"=>$vars["id"]], ["std_id" => $vars['st_stand']]);
      if($row>0)
        $guardado = true;
    }
  }
$respuesta = new stdClass();
$respuesta->estatus = $guardado;
$respuesta->error = $errorlog;
echo json_encode($respuesta);

});


$app->post('/savenew', function () use ($app) {
  $vars = $app->request->post();
  $status=true;
  $app->mg = new Mailgun("key-76u-fd2ilxwmtid-dm9rgq69dikp6km3");
  $app->mandrill = new Mandrill('ltROxFSshMC4RBZpDxXAqQ');
  $app->mg_domain = "expotachira.net";

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


$app->post('/update/:tipo/:id', function ($tipo,$id) use ($app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $vars = $app->request->post();
  validartoken($vars["tokenid"],$usr->sessionID);
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

if($tipo=="cliventa"){
 if ($app->database->has( "clientes" , ["cli_id" => $id ] )) {
  $afected=$app->database->update('clientes',["cli_rif"=>$vars["rif"],"cli_razon"=>$vars["razon"],"cli_contacto"=>$vars["contacto"],"cli_telefono"=>$vars["telefono"],"cli_correo"=>$vars["correo"]],["cli_id" => $id ]);
  if($afected>0){
    $respuesta->estatus = true;
  }
  else{
    $respuesta->estatus = false;
  }
}
else{
  $respuesta->estatus = false;
}
}

if($tipo=="freestand"){
 if ($app->database->has( "stands" , ["std_id" => $id ] )) {
  $afected=$app->database->update('stands',["idCliente"=>"0","std_estatus"=>"1"],["std_id" => $id ]);
  if($afected>0){
    $respuesta->estatus = true;
  }
  else{
    $respuesta->estatus = false;
  }
}
else{
  $respuesta->estatus = false;
}
}

if($tipo=="standcond"){
 if ($app->database->has( "stands" , ["std_id" => $id ] )) {
  $afected=$app->database->update('stands',["std_estatus"=>$vars['condi']],["std_id" => $id ]);
  if($afected>0){
    $respuesta->estatus = true;
  }
  else{
    $respuesta->estatus = false;
  }
}
else{
  $respuesta->estatus = false;
}
}

echo json_encode($respuesta);
});



$app->post('/newtask/:id', function ($id) use ($app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $vars = $app->request->post();
  validartoken($vars["tokenid"],$usr->sessionID);
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

 echo json_encode($respuesta);

});

$app->post('/listtask/:tip', function ($tip) use ($app,$usr) {
  header('access-control-allow-origin: *');
  header('Content-Type: application/json', false);
  $vars = $app->request->post();
  validartoken($vars["tokenid"],$usr->sessionID);
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

  echo json_encode($datas);

	// Lista DE TAREAS DE UN ID. EN ESPECIFICO
});

function validartoken($token,$sessionID){
  if(false){
    if($token==''||!isset($token)||($token!=$sessionID)){
      $logout["logout"]=true;
      $logout["token"]=$token;
      $logout["sessionID"]=$sessionID;
      echo json_encode($logout);
      die();
    }
  }
}


$app->run();