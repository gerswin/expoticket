<?php

class session{
	/**
	* Verifica si una direccion de correo es correcta o no.
	*
	* @author azambrano
	* @access 	public
	* @since   04/08/2014
	* @param int $duracion Duracion de la session en segundos
	*/
	public function __construct()
	{
		if(!isset($_SESSION)){
			session_start();
		}
	}

	/**
	* Setea el valor a una session de no existir la registra
	*
	* @author azambrano
	* @access 	public
	* @since   04/08/2014
	* @param String $name nombre del objeto
	* @param String $value Valor de la session.
	*/
	public function __set($name,$value)
	{
		if(isset($name))
			$_SESSION[md5($name)]=self::encrypt($value,get_class($this));
	}

	/**
	* Obtiene el valor de una sesion, de no estar registrada regresa false
	*
	* @author azambrano
	* @access 	public
	* @since   04/08/2014
	* @param String $name nombre del objeto
	* @return $obj con el valor del objeto creado, False en caso de no existir.
	*/
	public function __get($name)
	{
		if(isset($_SESSION[md5($name)]))
			return self::decrypt($_SESSION[md5($name)],get_class($this));
		else
			return false; //no existe la session
	}


	/**
	*  Borra un objeto de session dado.
	*
	* @author azambrano
	* @access 	public
	* @since   04/08/2014
	* @param String $name nombre del objeto
	*/
	public static function borrar($name)
	{
		if(isset($_SESSION[md5($name)]))
			unset($_SESSION[md5($name)]);
		session_regenerate_id(true);
	}

	/**
	*  Elimina todas las sessiones setiadas
	*
	* @access 	public
	* @since   04/08/2014
	* @author azambrano
	*/
	public static function limpiar()
	{
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
	}

	/**
	* Setea el valor a una session de no existir la registra
	*
	* @author azambrano
	* @access 	private
	* @since   04/08/2014
	* @param String $obj objeto a encriptar
	* @param String $key Llave de encriptamiento
	*/
	private function encrypt($obj, $key) {
		$data=serialize($obj);
		$salt = 'DRup7usuDcHretReGu7W6bEUh9THeD2CHPheGE!swe!*ewr4n-@pH39=E@rAsp7c';
		$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
		return $encrypted;
	}

	/**
	* Setea el valor a una session de no existir la registra
	*
	* @author azambrano
	* @access 	private
	* @since   04/08/2014
	* @param String $data valor encriptado
	* @param String $key Llave para desencriptar, debe ser igual a la de ecriptamiento.
	*/
	private function decrypt($data, $key) {
		$salt = 'DRup7usuDcHretReGu7W6bEUh9THeD2CHPheGE!swe!*ewr4n-@pH39=E@rAsp7c';
		$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
		$obj = unserialize($decrypted);
		return $obj;
	}
}

?>