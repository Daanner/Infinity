<?php



function subir_Imagen(){
    if(isset($_FILES["imagen_usuario"])){

        $extension= explode('.', $_FILES["imagen_usuario"]['name']);
        $nuevo_nombre=rand() . '.' . $extension[1];
        $ubicacion='./img/' . $nuevo_nombre;
        move_uploaded_file($_FILES["imagen_usuario"]['tmp_name'],
        $ubicacion);
        return $nuevo_nombre;
    }
}

function obetener_nombre_imagen($id_usario){
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id = '$id_usario'");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
        return $fila["imagen"];
    }
}

function obetener_todos_registros(){
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM usuarios ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}