<?php
    try{
        $base = new PDO('mysql: host=localhost; dbname=pagina_tp;', "root", "");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
        
        echo $e->getMessage();
    }
?>