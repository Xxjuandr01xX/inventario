<?php
	class Conexion{
		private $host,$user,$pass,$db,$charset;
		public function __construct(){
			
			$this->host		= "localhost";
			$this->user		= "root";
			$this->pass		= "";
            $this->db		= "invemtario";
			$this->charset  = "utf8";
			
		}
		public function Conectarse(){
			$con = new mysqli($this->host,$this->user,$this->pass,$this->db)or die("ERROR");
			$con->set_charset($this->charset);
			return $con;
		}
	}
?>