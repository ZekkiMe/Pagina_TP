<?php
session_start();
session_destroy();
session_reset();
header("Location: http://localhost/Pagina_TP/Vista/home.php");
?>