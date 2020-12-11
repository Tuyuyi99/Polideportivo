<?php
    class Seguridad {

       

        public function cerrarSesion() {
            session_destroy();
        }

        public function get($variable) {
            return $_SESSION[$variable];
        }

        public function haySesionIniciada() {
            if (isset($_SESSION["idUsuario"])) {
                return true;
            } else {
                return false;
            }
        }
    }