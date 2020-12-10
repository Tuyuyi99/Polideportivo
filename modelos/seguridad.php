<?php
    class Seguridad {

        public function abrirSesion($usuario) {
            $_SESSION["idUsuario"] = $usuario->idUsuario;
            $_SESSION["email"] = $usuario->email;
            $_SESSION["imagen"] = $usuario->imagen;
            $_SESSION["rol"] = $usuario->rol;
        }

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