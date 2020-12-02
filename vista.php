<?php
	class Vista {
		public function show($nombreVista, $data = null) {
			include_once("vistas/header.php");
			include_once("vistas/$nombreVista.php");
			include_once("vistas/footer.php");
		}
	}