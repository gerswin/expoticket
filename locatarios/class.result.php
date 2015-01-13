<?php

abstract class segmentoBusqueda{
	const Segmento="segmento";
	const Palabra="palabra";
	const Stand="stand";
}

class respGeneral{
	/**
	 * [$sucess Bolean que indica si la respuesta es exitosa o no se pudo realizar, si es exitos se carga el array de items, sino se llegan el mensaje de error.]
	 * @var [Boolean]
	 */
	public $sucess;
	/**
	 * [$items Array de elementos que se generan de la consulta.]
	 * @var [itemBusqueda]
	 */
	public $items;
	/**
	 * [$msjError Mensaje en caso que ocurra una error o excepción.]
	 * @var [String]
	 */
	public $msjError;

	public function __construct(){

	}

}

class itemBusqueda{

	/**
	 * [$nombre Nombre del comercio]
	 * @var [String]
	 */
	public $nombre;

	/**
	 * [$pabellon Lugar del Stand]
	 * @var [String]
	 */
	public $pabellon;
	/**
	 * [$stand Identificador del Stand]
	 * @var [String]
	 */
	public $stand;
	/**
	 * [$segmento Tipo del segmento a utilizar (segmento, palabra, stand)]
	 * @var [segmentoBusqueda]
	 */
	public $segmento;
	/**
	 * [$keys Array de palabras claves]
	 * @var [array]
	 */
	public $keys;
	/**
	 * [$urllocal URL de la foto del Stand]
	 * @var [String]
	 */
	public $urllocal;
	/**
	 * [$urllogo URL del logo]
	 * @var [type]
	 */
	public $urllogo;
	/**
	 * [$detalle Descripción completa del Stand]
	 * @var [String]
	 */
	public $detalle;

	public function __construct(){

	}
}

class evento{

/**
 * [$id Identificador del evento]
 * @var [String]
 */
public $id;
/**
 * [$nombre Nombre del evento ]
 * @var [String]
 */
public $nombre;
/**
 * [$tipo Tipo de evento]
 * @var [String]
 */
public $tipo;
/**
 * [$urlflayer DIreccion url del flayer que representa al evento]
 * @var [String]
 */
public $urlflayer;
/**
 * [$descripcion Descripcion detallada del evento]
 * @var [String]
 */
public $descripcion;
/**
 * [$horario Horario de la ejecucion del evento]
 * @var [String]
 */
public $horario;


public function __construct(){

	}

}



class searchElements{

	/**
	 * [$busqmedoo Array de elementos de la Busqueda.]
	 * @var [busqmydoo]
	 */
	//public $busqmydoo;
    public $result;
	public function __construct($busqmedoo,$app){

		$this->result= $this->resultado($busqmedoo,$app);

	}

	private function resultado($busqmedoo,$app){
		$resp = new respGeneral();
		$array=$app->database->query($busqmedoo)->fetchAll();
	       $items=array();
	       foreach ($array as $row) {
	       		$item=new itemBusqueda();
	       		//s $item->id=$row["id"];
	       		$item->nombre=$row["nombre"];//titulo
	       		// $item->contacto=$row["contacto"];
	       		// $item->nroTelf=$row["nrotelf"];
	       		// $item->mail=$row["mail"];
	       		$item->pabellon=$row["pabellon"];//pabellon
	       		$item->stand=$row["stand"];//nrolocal
	       		// $item->segmento=$row["segmento"];
	       		// $item->keys=$row["keyset"];
	       		$item->urllocal=$row["urllocal"];
	       		$item->urllogo=$row["urllogo"];
	       		$item->detalle=$row["detalle"];//descripcion
				$items[]=$item;
	       }
	       if(count($items)>0){
	       		$resp->sucess=true;
	       		$resp->items=$items;
	       }
	       else{
	       		$resp->sucess=false;
	       		$resp->msjError="No se encontraron resultados";
	       }

	       return $resp;
	}

}



class searchEvents{

	/**
	 * [$busqmedoo Array de elementos de la Busqueda.]
	 * @var [busqmedoo]
	 */
	//public $busqmedoo;
    public $result;

	public function __construct($app){

		$this->result=$this->resultado($app);

	}

	public function resultado($app){

		$resp = new respGeneral();
		$array=$app->database->select("eventos","*");
	       $items=array();
	       foreach ($array as $row) {
	       		$item=new evento();
	       		$item->id=$row["id"];
	       		$item->nombre=$row["nombre"];
	       		$item->tipo=$row["tipo"];
	       		$item->urlflayer=$row["urlflayer"];
	       		$item->descripcion=$row["descripcion"];
			$items[]=$item;
	       }
	       if(count($items)>0){
	       		$resp->sucess=true;
	       		$resp->items=$items;
	       }
	       else{
	       		$resp->sucess=false;
	       		$resp->msjError="No se encontraron resultados";
	       }
	       return $resp;
	}

}

?>