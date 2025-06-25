<?php
    
    
    function Insertar($usuario, $email, $pass) :string{
        
        $opciones = ['cost'=>8];
        $pass_encript = password_hash($pass, PASSWORD_DEFAULT, $opciones);

        if ((strlen($usuario) == 0 )||($usuario == "")){
            $usuario = NULL;
        }

        if ((strlen($email) == 0 )||($email == "")){
            $email = NULL;
        }

        if ((strlen($pass) == 0 )||($usuario == "")){
            $pass = NULL;
        }
        
        try{
    
            include("conexion.php");
    
            $query = "INSERT INTO datos_usuarios 
            (nombre, email, pass, pass_hash) VALUES (:usuario, :email, :pass , :pass_en)";
    
            $resultado = $base->prepare($query);
    
            $resultado->execute(array(':usuario'=> $usuario, ':email'=> $email, ':pass'=> $pass, ':pass_en'=> $pass_encript));
    
            $resultado->closeCursor();

            return "correcto";
    
        }catch(PDOException $e){
            return $e->getMessage();

        }
    }
?>