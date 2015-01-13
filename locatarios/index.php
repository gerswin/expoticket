<?php
require '../vendor/autoload.php';
require 'class.result.php';

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

$app->get('/', function () {
	echo "Parawebs C,a";
});


$app->get('/solicitud/:tipo/:value', function ($tipo,$value) use($app){
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	switch ($tipo) {
		case segmentoBusqueda::Segmento:
		$elemen = "SELECT * FROM comercio WHERE segmento LIKE '%".$value."%'";
		$r = new searchElements($elemen,$app);
		$resp=$r->result;
		break;
		case segmentoBusqueda::Palabra:
		$elemen = "SELECT * FROM comercio WHERE keyset LIKE '%".$value."%'";
		$r = new searchElements($elemen,$app);
		$resp=$r->result;
		break;
		case segmentoBusqueda::Stand:
		$elemen = "SELECT * FROM comercio WHERE nombre LIKE '%".$value."%'";
		$r = new searchElements($elemen,$app);
		$resp=$r->result;
		break;
		default:
		$resp = new respGeneral();
		$resp->sucess=false;
		$resp->msjError="ruta invalida";
		break;
	}
	echo json_encode($resp);
});

$app->get('/typeahead', function() use($app){
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	$resp=new StdClass();
	$items=array();
	$items=$app->database->select("comercio",["nombre","segmento","keyset"]);
	if(count($items)>0){
		$resp->sucess=true;
		$resp->items=$items;
	}
	else{
		$resp->sucess=false;
		$resp->msjError="No se encontraron resultados";
	}
	echo json_encode($resp);
});

$app->get('/infoclient/:client', function($client) use($app){
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	$resp=new StdClass();
	$items=array();
	$items=$app->database->select("comercio",["nombre","pabellon","stand","credencial"],["id"=>$client]);

	if(count($items)>0){
		$resp->sucess=true;
		$resp->items=$items[0];
		$idact=$app->database->select("activaciones","id",["codigo"=>$client]);
        $resp->activa=count($idact);
    }
	else{
		$resp->sucess=false;
		$resp->msjError="No se encontraron clientes asociados.";
	}
	echo json_encode($resp);
});

$app->get('/eventos', function () use($app){
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	$resp = new searchEvents($app);
	echo json_encode($resp->result);
});

$app->post('/update/:comercio', function ($comercio) use($app){
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	$resp=new StdClass();
	$post =json_decode($app->request->getBody());
    $dat["segmento"]=$post->segmento;
    $dat["keyset"]=$post->fkeyset;
    $dat["detalle"]=$post->fdetalle;
    $dat["nombrecomercial"]=$post->fnombrecomer;
    $dat["urllocal"]=$post->urllocal;
    $updated=$app->database->update("comercio",$dat ,["id"=>$comercio]);
    if($updated>0){
    	$resp->sucess=true;
    	$resp->msg="Actualizado Exitoso";
    }else{
    	$resp->sucess=false;
    	$resp->msg="Actualizado Fallido";
    }
    echo json_encode($resp);
});

$app->run();