<?php
    class Session {
        public function __Init(){
            session_start();
        }
        public function __Create($index,$value){
            $_SESSION[$index] = $value;
        }
        public function __Status(){
            return session_status();
        }
        public function __Index($index){
            return $_SESSION[$index];
        }
        public function __Close(){
            session_destroy();
        }
    }
?>