<?php

include("conexion.php");
include("funciones.php");

if($_POST["operacion"]== "Crear"){
    $imagen = '';
    if($_FILES["imagen_usuario"]["name"] !=''){
        $imagen = subir_imagen();
    }

  $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, imagen, telefono, email) VALUES
   (:nombre, :apellido, :imagen, :telefono, :email)");

    $resultado = $stmt->execute(
        array(
            ':nombre'   => $_POST['nombre'],
            ':apellido'=> $_POST['apellido'],
            ':telefono' => $_POST['telefono'],
            ':email'    => $_POST['email'],
            ':imagen'   => $imagen
        )
    );

    if(!empty($resultado)){
        echo 'Registro creado';
    }
}

if($_POST["operacion"]=="Editar"){
    $imagen='';
    if($_FILES["imagen_usuario"]["name"]!='' ){
        $imagen=subir_imagen();
    }else{
        $imagen=$_POST['imagen_usuario_oculta'];
    }

    $stmt=$conexion->prepare("UPDATE usuarios SET nombre=:nombre,
        telefono=:telefono, apellido=:apellido ,imagen=:imagen,email=:email WHERE id=:id");
    
    $resultado=$stmt->execute(
        array(
            ':nombre' => $_POST["nombre"],
            ':apellido'=> $_POST['apellido'],
            ':telefono' => $_POST["telefono"],
            ':email' => $_POST["email"],
            ':imagen'=> $imagen,
             ':id' => $_POST["id_usuario"]

        )
        );
        
        if(!empty($resultado)){
            echo'Registro Editado';
        }
}

?>