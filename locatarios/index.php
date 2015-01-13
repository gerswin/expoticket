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
	echo "Parawebs, C.A";
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
	$items=$app->database->select("comercio",["id","nombre","pabellon","stand","credencial"],["token"=>$client]);

	if(count($items)>0){
		$resp->sucess=true;
		$resp->items=$items[0];
		$idact=$app->database->select("activaciones","id",["codigo"=>$items[0]['id']]);
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

$app->post('/create/stand/:idclient', function ($idclient) use($app){
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	$resp=new StdClass();
	$post =json_decode($app->request->getBody());
	$insert=array();

	$last_acti = $app->database->insert("activaciones", ["codigo"=>$idclient,"tipo"=>1,"status"=>2,"fecha"=>(new DateTime())->format('Y-m-d H:i:s')]);


    foreach($post->ci as $key => $value) {
        $insert[]=["fk_activaciones"=>$last_acti,"nombre"=>$post->nombrs[$key],"urlimage"=>($post->img[$key]|""),"movil"=>$post->telef[$key],"cedula"=>$post->ci[$key]];
    }
	$last_credencial_id = $app->database->insert("credenciales", $insert);

    if($last_credencial_id>0){
    	$resp->sucess=true;
    	$resp->msg="Actualizado Exitoso";
    }else{
    	$resp->sucess=false;
    	$resp->msg="Actualizado Fallido";
    }
    echo json_encode($resp);
});


$app->get('/mail', function() use($app){

	$timtok = time();
	$valtok = 3443000;

	$resp=new StdClass();
	$items=array();
	$phone = "";
	$items=$app->database->select("comercio",["id","nrotelf","mail"]);

	foreach ($items as $item) {
		if ($item["nrotelf"]) {
			$phone = $phone.",". $item["nrotelf"];
		}
		if ($item["mail"]) {
			$mail = $mail.",". $item["mail"];
		}
		$token = dechex($timtok);
		//$app->database->update("comercio", ["token" => $token], ["id" =>$item["id"]]);
		$timtok = $timtok + $valtok;
	}
	 $resp->phone = $phone;
	 $resp->mail = $mail;
	
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);
	echo json_encode($resp);
});




$app->get('/credenciales/:idcliente', function($idcliente) use($app){

	// Mando el id del cliente
	$values = array();
	$resp=new StdClass();
	$getcredencial =  array();
	
	$items=$app->database->select("activaciones", ["[>]credenciales" => ["id" => "fk_activaciones"]], ["activaciones.id(ids)","credenciales.nombre","credenciales.cedula","credenciales.urlimage"], ["AND" => [ "activaciones.codigo" => $idcliente , "credenciales.id[!]" => null ]]);

	if (count($items)) {
		$i= 0;
		$cliente = $items[0]['ids'];
		$getcredencial =  array();
		$getcredencial[] = "?sclient=".$cliente."&numinit=".$i."";

		$vuelta = 0;
		foreach ($items as $value) {	
			if ($vuelta==3) {
				$i= $i + 1;
				$getcredencial[] = "?sclient=".$cliente."&numinit=".$i."";
				$vuelta = 0;
			}
			$vuelta++;
			$i++;
		}
		$resp->sucess=true;
    	$resp->items=$getcredencial;
	}else{
		$resp->sucess=false;
		$resp->msg="Sin credenciales generados Fallido";
	}
	echo json_encode($resp);
});


$app->get('/credenciales/:fkactiva/:numini', function($fkactiva,$numini) use($app){

	// $fkactiva es el numero de activacion.
	// $numini es el numero desde donde inicia.
	header('access-control-allow-origin: *');
	header('Content-Type: application/json', false);

	$items=$app->database->select("activaciones", ["[>]credenciales" => ["id" => "fk_activaciones"] , "[>]comercio" => ["codigo" => "id"]], ["credenciales.id","credenciales.nombre","credenciales.cedula","credenciales.urlimage","comercio.nombre(razon)","comercio.nombrecomercial","comercio.pabellon","comercio.stand"],["LIMIT" => [$numini, 4],"fk_activaciones" => $fkactiva]);
	$is=0;
	$bg = "bg.png";
	foreach ($items as $key => $value) {
	
		switch ($value["pabellon"]) {
			case 'Venezuela':
				$bg = "bgv.jpg";
				break;
			case 'Colombia':
				$bg = "bgc.jpg";
				break;
			default:
				$bg = "bg.png";
				break;
		}
		$value["bg"] = $bg;
		$value["idtk"] = str_pad($value["id"], 5, "0", STR_PAD_LEFT);

		if ($is>=2) {
			$value["clase"] = "title2";
		}
		$items[$key]= $value;
	$is++; 
	}
	$credenciales = ['credenciales' => $items];
	echo json_encode($credenciales);
});

$app->run();