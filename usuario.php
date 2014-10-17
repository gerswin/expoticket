<?php
include('session.php');
abstract class tipoUsuario{
	const Admin = 1; //usuario Administrador
	const Normal = 2; //usuario Normal
}
abstract class tiempoSession{
	const Admin=7200;  //Segundos de estadia del usuario admin 2h
	const Normal=3600; // Segundos de estadia del usuario normal 1h.
	const Defecto= 1800; //Tiempo por defecto
}
abstract class tipoConsulta{
	const Consulta=0;
	const Creacion=1;
	const Cerrar=2;
}
abstract class tipoLogOut{
	const Estado=2;
	const Pagina=3;
}

class usuario{
	//propiedades privadas de manejo interno
	private $duracion;
	private $tiempoExpiracion;
	private $tipoUser;
	private $tipoLogOut;
	private $isLogged;

	//propiedades publicas de la clase
	public $session;
	public $items;

	//propiedades privadas definidas por el usuario (las conocidas)
	private $sessionID;
	private $nombre;
	/**
	* Constructo de la clase, dos opciones operacionales creacion y consulta.
	*
	* @author azambrano
	* @access 	public
	* @since   04/08/2014
	* @param int $typeConsult Tipo de consulta de la clase, verificar la clase tipoConsulta
	* @param array $arg Parametros para la creacion pasados como argumento para llenar
	*		 las propiedades de las clases. en caso de ser consulta se pasa el valor null.
	*/
	public function __construct($typeConsult,$arg){
		$session= new session();
		$this->session=&$session;
		switch($typeConsult){
			case tipoConsulta::Creacion :
			//cambiar estos argumentos
			foreach ($arg as $clave => $valor)
				$this->$clave=$arg[$clave];
			$this->isLogged=true;
			$this->sessionID=session_id();
			switch($this->tipoUser){
				case tipoUsuario::Admin:
				$this->duracion= tiempoSession::Admin;
				break;
				case tipoUsuario::Normal:
				$this->duracion= tiempoSession::Normal;
				break;
				default:
				$this->duracion=tiempoSession::Defecto;
				break;
			}
			self::actualizarExpiracion();
			$session->usuario=$this;
			break;
			case tipoConsulta::Consulta:
			if($session->usuario==false||(time()-$session->usuario->tiempoExpiracion)>0){
				if($session->usuario)
				$this->tipoLogOut=$session->usuario->tipoLogOut;
				self::sessionExpired();
			}
			else{
				foreach (get_object_vars($this) as $clave => $valor)
					$this->{$clave}=$session->usuario->{$clave};
				self::actualizarExpiracion();
				$session->usuario=$this;
			}
			break;
			case tipoConsulta::Cerrar:
				if($session->usuario)
				$this->tipoLogOut=$session->usuario->tipoLogOut;
				self::logOut();
			break;
			default:
				if($session->usuario)
				$this->tipoLogOut=$session->usuario->tipoLogOut;
				self::logOut();
			break;
		}
	}

  	/**
	* Setea la propiedad de la clase de no existir la registra en la propiedad publica $items
	*
	* @author azambrano
	* @param String $name nombre de la propiedad.
	* @param String $value Valor de la propiedad.
	* @access 	public
	*/
	public function __set($name,$value)
	{
		if(isset($this->{$name}))
			$this->{$name}=$value;
		else
			$this->items[$name]=$value;
		$this->session->usuario=$this;

	}

    /**
	* Obtiene la propidad de la clase, de no existir retorna null
	*
	* @author azambrano
	* @param String $name nombre de la propiedad
	* @return retorna el vaor de la propiedad o null en caso de no estar asignada.
	* @access 	public
	*/
	public function __get($name)
	{
		if(isset($this->$name))
			return $this->$name;
		else
			return null;
	}

	/**
	* Funcion encargada de liberar el espacio de memoria de la session.
	*
	* @autho)r azambrano
	* @since   04/08/2014
	* @access 	public
	*/
	public function logOut(){
		switch($this->tipoLogOut){
			case tipoLogOut::Estado:
				session::borrar(get_class($this));
				return false;
			break;
			case tipoLogOut::Pagina:
				session::borrar(get_class($this));
				header("Location: index.php");
				die();
			break;
			default:
				session::borrar(get_class($this));
				return false;
			break;
		}
	}

		/**
	* Funcion encargada de liberar el espacio de memoria de la session.
	*
	* @author azambrano
	* @since   04/08/2014
	* @access 	public
	*/
	public function sessionExpired(){
		switch($this->tipoLogOut){
			case tipoLogOut::Estado:
				session::borrar(get_class($this));
			return false;
			break;
			case tipoLogOut::Pagina:
				session::borrar(get_class($this));
				header("Location: logout.html");
				die();
			break;
			default:
				session::borrar(get_class($this));
				return false;
			break;
		}
	}

	/**
	* Funcion encargada de actualizar el tiempo de expiración de la sesión, deacuerdo a la duración y el tiempo actual.
	*
	* @author azambrano
	* @since   04/08/2014
	* @access 	public
	*/
	public function actualizarExpiracion(){
		if(isset($this->duracion))
			$this->tiempoExpiracion= time()+$this->duracion;
		else
			$this->tiempoExpiracion=0;
	}
}
?>