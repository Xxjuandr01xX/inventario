<?php
	
	class Routes{
		private $uri,$controller,$method,$param;
		function __construct(){
			$this->setUri();
			$this->setController();
			$this->setMethod();
			$this->setParam();
		}
		public function setUri(){
			$this->uri = explode("/", URI);
		}
		public function setController(){
			$this->controller = $this->uri[2] === '' ? DEFAULT_CONTROLLER : '' ;
		}
		public function setMethod(){
			$this->method = $this->uri[3] === '' ? DEFAULT_ACCION : '';
		}
		public function setParam(){
			if (REQUEST_METHOD == 'POST') {
				$this->param = $_POST;	# code...
			}else if(REQUEST_METHOD == 'GET'){
				$this->param = !empty($this->uri[4]) ? $this->uri[4] : ''; 
			}
		}
		
		public function getUri(){
			return $this->uri;
		}
		public function getController(){
			return $this->controller;
		}
		public function getMethod(){
			return $this->method;
		}
		public function getParam(){
			return $this->param;
		}
	}
?>