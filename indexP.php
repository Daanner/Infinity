<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <title>CRUD </title>
</head>
<body>
<div class="container" id="fondo">
        <h1 class="text-center">CRUD CON PHP, PDO, AJAX Y DATABASE :D</h1>
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button class="btn btn-primary" data-bs-target="#Usuario" data-bs-toggle="modal" id="botonCrear" type="button">
                        <i class="bi bi-plus-circle-fill"></i>
                        Crear
                    </button>
                </div>
            </div>
        </div>
        <br><br>

        <div class="table-responsive">
            <table id="datos_usuario" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Imagen</th>
                        <th>Fecha Creacion</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabla -->
                </tbody>
              
            </table>
            <a href="http://localhost/Infinity/">Regresar</a>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingrese los Datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formulario" enctype="multipart/form-data">
                    <div class="modal-content">
                        <label for="nombre">Ingrese el nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                        <br />

                        <label for="apellido">Ingrese los Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control">
                        <br />

                        <label for="telefono">Ingrese el Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                        <br />

                        <label for="email">Ingrese el email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <br />

                        <label for="imagen">Seleccione la imagen</label>
                        <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
                        <span id="imagen-subida"></span>
                        <br />
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id_usuario" id="id_usuario">
                        <input type="hidden" name="operacion" id="operacion">
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    
    <script type="text/javascript">

            $(document).ready(function(){
              $("#botonCrear").click(function(){
                    $("#formulario")[0].reset();
                    $(".modal-title").text("Crear Usuario");
                    $("#action").val("Crear");
                    $("#operacion").val("Crear");
                    $("#imagen_subida").html("");
                });
                    
                var dataTable = $('#datos_usuario').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "http://localhost/Infinity/obtener_registros.php",
                            type: "POST"
                        },
                        "columnDefs": [ // Corregido el nombre de la propiedad aquí
                            {
                                "targets": [0, 3, 4],
                                "orderable": false,
                            },
                          ],
                    
                    "language":{
                     "decimal":"",
                     "emptyTable":"No hay registros",
                     "info:":"Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                     "infofiltered": "(Filtrando de _MAX_ total entradas)",
                     "infoPostFlix": "",
                     "thousands": "",
                     "lengthMenu": "Mostrar _MENU_ Entradas",
                     "loadingRecords": "Cargando.....",
                     "processing": "Procesando.....",
                     "search": "Buscar:",
                     "zeroRecords": "Sin resultados encontrados",
                     "paginate":{
                        "firts": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                     }
                    }
                });
               
         
             $(document).on('submit', '#formulario', function(event){
                event.preventDefault();
                var nombre = $("#nombre").val();
                var apellidos = $("#apellido").val();
                var telefono = $("#telefono").val();
                var email = $("#email").val();
                var extension = $("#imagen_usuario").val().split('.').pop().toLowerCase();
                
                if (extension != '') {
                    if ($.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert("Formato de imagen inválido");
                        $("#imagen_usuario").val('');
                        return false;
                    }
                }

                if (nombre != '' && apellidos != '' && email != '') {
                    $.ajax({
                        url: "http://localhost/Infinity/crear.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function (data){
                            alert(data);
                            $('#formulario')[0].reset();
                            $('#modalUsuario').modal();
                            dataTable.ajax.reload();
                        }
                    });
                } else {
                    alert("Algunos campos son obligatorios");
                }
            });
           
             //Editar
            $(document).on('click','.editar',function(){  
            var id_usuario= $(this).attr("id");
            $.ajax({
                url:"http://localhost/Infinity/obtener_registro.php",
                method:"POST",
                data:{id_usuario:id_usuario},
                dataType:"json",
                success:function(data)
                {
                    //consola .log(data)
                    $('#modalUsuario').modal('show');
                    $('#nombre').val(data.nombre);
                    $('#apellidos').val(data.apellidos);
                    $('#telefono').val(data.telefono);
                    $('#email').val(data.email);
                    $('.modal-title').text("Editar Usuario");
                    $('#id_usuario').val(id_usuario);
                    $('#imagen-subida').html(data.imagen_usuario);
                    $('#action').val("Editar");
                    $('#operacion').val("Editar");
                },
                error:function(jqXHR, textStatus, errorThrown){
                    console.log(TextStatus, errorThrown);
                }
            })
            });
                //Borrar
            $(document).on('click','.borrar',function(){
                var id_usuario= $(this).attr("id");
                if(confirm("estas seguro de eliminar este registro?:" + id_usuario))
                {
                    $.ajax({
                        url:"http://localhost/infinity/borrar.php",
                        method:"POST",
                        data:{id_usuario:id_usuario},
                        success:function(data)
                        {
                            alert(data);
                            dataTable.ajax.reload();
                        }
                    });
                }else{
                    return false;
                }
            });
            
        }); 

        

    </script>
    
  </body>
</html>