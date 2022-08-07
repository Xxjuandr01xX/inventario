<?php
	class Querys{
		private $con,$db,$table;
		public function __construct($table){
			$this->con = new Conexion();
			$this->db = $this->con->Conectarse();
			$this->table = (string) $table;
		}
		public function get_db(){
			return $this->db;
		}
		public function getAll(){
			$resultSet = [];
			$res = $this->db->query("SELECT * FROM ".$this->table);
			
			while($rows = $res->fetch_assoc()){
				$resultSet[] = $rows;
			}
			mysqli_free_result($res);
			return $resultSet;
		}
		public function getById($id){
			$resultSet = [];
			$res = $this->db->query("SELECT * FROM ".$this->table." WHERE id = '$id'");
			
			while($rows = $res->fetch_assoc()){
				$resultSet[] = $rows;
			}
			mysqli_free_result($res);
			return $resultSet;
		}
		public function getByColumn($column,$value){
			$resultSet = [];
			$res = $this->db->query("SELECT * FROM ".$this->table." WHERE $column = $value");
			
			while($rows = $res->fetch_assoc()){
				$resultSet[] = $rows;
			}
			mysqli_free_result($res);
			return $resultSet;
		}
		public function getLikeColumn($column,$value){
			$resultSet = [];
			$res = $this->db->query("SELECT * FROM ".$this->table." WHERE ".$column." LIKE '%".$value."%'");
			if($res->num_rows < 1){
				return "NULL ROWS";
			}else{
				while($rows = $res->fetch_assoc()){
					$resultSet[] = $rows;
				}
			}
			return $resultSet;	
		}
		public function EjecutarSql($sql){
			$resultSet = [];
			$res = $this->db->query($sql);
			
			while($rows = $res->fetch_assoc()){
				$resultSet[] = $rows;
			}
			mysqli_free_result($res);
			return $resultSet;
		}
	}
?>