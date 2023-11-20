<?php 
class conexion{
	private $datos;

	protected function conexion ()
	{
		$this->datos = array(
			'local'		=> "localhost",
			'user'		=> "root",
			'password'	=> '',
			'base'		=> 'base_jeans'
		);
	}

	protected function getData ()
	{
		return $this->datos;
	}
}