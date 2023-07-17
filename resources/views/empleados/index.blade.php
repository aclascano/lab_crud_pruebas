<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/92ef1ca972.js" crossorigin="anonymous"></script>
    <title>Crud-Empleado</title>
</head>

<body>
    <div class="container">
        <br>
        <div class="text-center">
            <h3>Lista de Empleados</h3>

            <br>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearEmpleadoModal"> <i class="fa-solid fa-plus" style="color: #ffffff;"></i> Crear Empleado</button>

            <br>
            <br>
            <!-- Modal Crear -->
            <div class="modal fade" id="crearEmpleadoModal" tabindex="-1" aria-labelledby="crearEmpleadoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crearEmpleadoModalLabel">Crear Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form id="crearEmpleadoForm" action="{{ route('empleados.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z]+" title="Solo se permiten letras" placeholder="Ingresa el nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="apellido" class="form-label">Apellido:</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" pattern="[A-Za-z]+" title="Solo se permiten letras" placeholder="Ingresa el apellido">
                                </div>
                                <div class="mb-3">
                                    <label for="cedula" class="form-label">Cédula:</label>
                                    <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ingresa la cédula">

                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Telefono:</label>
                                    <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese un número telefónico Ecuatoriano">
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo:</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required placeholder="Ingresa un correo electrónico">
                                </div>
                                <div class="mb-3">
                                    <label for="funcion" class="form-label"> Cargo:</label>
                                    <select class="form-select" id="inputGroupSelect01" name="funcion">
                                        <option selected>Escoja...</option>
                                        <option value="Admistrador">Admistrador</option>
                                        <option value="Tecnico">Técnico</option>
                                        <option value="Operador">Operador</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa-solid fa-xmark" style="color: #ffffff;"></i> Cancelar</button>
                                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#exitoModal"><i class="fa-sharp fa-solid fa-floppy-disk" style="color: #f5f5f5;"></i> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal De Mensajes -->
            <div class="modal fade" id="exitoModal" tabindex="-1" role="dialog" aria-labelledby="exitoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="mensajeExito" style="display: none;">
                                <i class="fa-sharp fa-solid fa-circle-check fa-8x fa-bounce" style="color: #79cb43;"></i>
                                <p class="text-center h5"> EMPLEADO CREADO EXITOSAMENTE</p>
                            </div>
                            <div id="mensajeErrorCedula" style="display: none;">
                                <i class="fa-solid fa-id-card fa-bounce fa-8x" style="color: #d1481a;"></i>
                                <p class="text-center h5"> La cédula ingresada no valida </p>
                                <span class="text-cente">Verifique porfavor</span>
                            </div>
                            <div id="mensajeErrorTelefono" style="display: none;">
                                <i class="fa-solid fa-phone-slash fa-bounce fa-8x" style="color: #f04b14;"></i>
                                <p class="text-center h5"> El telefono ingresado no es valido </p>
                                <span class="text-cente">Verifique porfavor</span>
                            </div>

                            <div id="mensajeErrorGeneral" style="display: none;">
                                <i class="fa-sharp fa-solid fa-circle-exclamation fa-8x  fa-bounce" style="color: #c60c0c;"></i>
                                <p class="text-center h5"> La cédula, telefono o correo eléctronico ya se encuentra registrado </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->apellido }}</td>
                        <td>{{ $empleado->cedula }}</td>
                        <td>{{ $empleado->telefono }}</td>
                        <td>{{ $empleado->correo}}</td>
                        <td>{{ $empleado->funcion }}</td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarEmpleadoModal{{ $empleado->id }}"> <i class="fa-solid fa-pen" style="color: #ffffff;"></i> Editar</button>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="editarEmpleadoModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editarEmpleadoModalLabel{{ $empleado->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarEmpleadoModalLabel">Editar Empleado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulario -->
                                            <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre:</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" required pattern="[A-Za-z]+" title="Solo se permiten letras" placeholder="Ingresa el nombre" value="{{ $empleado->nombre }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="apellido" class="form-label">Apellido:</label>
                                                    <input type="text" class="form-control" id="apellido" name="apellido" required pattern="[A-Za-z]+" title="Solo se permiten letras" placeholder="Ingresa el apellido" value="{{ $empleado->apellido }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cedula" class="form-label">Cédula:</label>
                                                    <input type="number" class="form-control" id="cedula" name="cedula" required pattern="[0-9]{1,10}" placeholder="Ingresa la cédula" value="{{ $empleado->cedula }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefono" class="form-label">Telefono:</label>
                                                    <input type="number" class="form-control" id="telefono" name="telefono" required pattern="[0-9]{1,10}" placeholder="Ingresa el telefono" value="{{ $empleado->telefono }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="correo" class="form-label">Correo:</label>
                                                    <input type="email" class="form-control" id="correo" name="correo" required placeholder="Ingresa un correo electrónico" value="{{ $empleado->correo }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="funcion" class="form-label">Cargo:</label>
                                                    <select class="form-select" id="inputGroupSelect01" name="funcion" value="{{ $empleado->funcion }}">
                                                        <option selected>Escoja...</option>
                                                        <option value="Admistrador">Admistrador</option>
                                                        <option value="Tecnico">Técnico</option>
                                                        <option value="Operador">Operador</option>
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#exitoModalUpdate"> <i class="fa-solid fa-pen" style="color: #ffffff;"></i> Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal De Mensajes de Actualizar -->
                            <div class="modal fade" id="exitoModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exitoModalUpdateLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="mensajeExitoUpdate" style="display: none;">
                                                <i class="fa-sharp fa-solid fa-circle-check fa-8x fa-bounce" style="color: #79cb43;"></i>
                                                <p class="text-center h5"> EMPLEADO ACTUALIZADO EXITOSAMENTE</p>
                                            </div>
                                            <div id="mensajeErrorTelefonoUpdate" style="display: none;">
                                                <i class="fa-solid fa-phone-slash fa-bounce fa-8x" style="color: #f04b14;"></i>
                                                <p class="text-center h5"> El telefono ingresado no es valido </p>
                                                <span class="text-cente">Verifique porfavor</span>
                                            </div>
                                            <div id="mensajeErrorGeneralUpdate" style="display: none;">
                                                <i class="fa-sharp fa-solid fa-circle-exclamation fa-8x  fa-bounce" style="color: #c60c0c;"></i>
                                                <p class="text-center h5"> El teléfono o correo eléctronico ya se encuentra registrado </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confimacionborrarModal"> <i class="fa-solid fa-trash" style="color: #ffffff;"></i> Borrar</button>
                            <!-- Modal Eliminar-->
                            <div class="modal fade" id="confimacionborrarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title " id="exampleModalLabel"> CONFIRMACION</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <i class="fa-sharp fa-solid fa-brake-warning fa-bounce" style="color: #e49e07;"></i>
                                            <p>¿Está seguro que desea borrar?</p>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash" style="color: #ffffff;"></i> Borrar</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal De Mensajes de Borrar-->
                            <div class="modal fade" id="exitoModalDelete" tabindex="-1" role="dialog" aria-labelledby="exitoModalDeleteLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="mensajeExitoDelete" style="display: none;">
                                                <i class="fa-sharp fa-solid fa-circle-check fa-8x fa-bounce" style="color: #D73D1E;"></i>
                                                <p class="text-center h5"> EMPLEADO ELIMINADO EXITOSAMENTE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            var successMessage = "{{ session('success') }}";
            var successMessageUpdate = "{{ session('success_u') }}";
            var successMessageDelete = "{{ session('success_delete') }}";
            //Modal de Creacion
            if (successMessage) {

                mostrarModal('exitoModal', 'mensajeExito', 'EMPLEADO CREADO EXITOSAMENTE');
            } else {

                var errorMessage = "{{ $errors->first('cedula') }}";
                var errorTelephoneMessage = "{{ $errors->first('telefono') }}";
                var errorGeneralMessage = "{{ $errors->first('general') }}";

                if (errorMessage) {

                    mostrarModal('exitoModal', 'mensajeErrorCedula', 'Ingrese una cédula válida');
                } else if (errorGeneralMessage) {

                    mostrarModal('exitoModal', 'mensajeErrorGeneral', 'La cédula, teléfono o correo electrónico ya se encuentra registrado');
                } else if (errorTelephoneMessage) {
                    mostrarModal('exitoModal', 'mensajeErrorTelefono', 'El telefono ingresado no es valido')
                }
            }
            //Modal de Actualización
            if (successMessageUpdate) {

                mostrarModal('exitoModalUpdate', 'mensajeExitoUpdate', 'EMPLEADO ACTUALIZADO EXITOSAMENTE');
            } else {

                var errorTelephoneMessageUpdate = "{{ $errors->first('telefono_u') }}";
                var errorGeneralMessageUpdate = "{{ $errors->first('general_u') }}";

                if (errorTelephoneMessageUpdate) {
                    mostrarModal('exitoModalUpdate', 'mensajeErrorTelefonoUpdate', 'El telefono ingresado no es valido');
                } else if (errorGeneralMessageUpdate) {
                    mostrarModal('exitoModalUpdate', 'mensajeErrorGeneralUpdate', 'El teléfono o correo electrónico ya se encuentra registrado')
                }
            }

            //Modal de Elimincación
            if (successMessageDelete) {
                mostrarModal('exitoModalDelete', 'mensajeExitoDelete', 'EMPLEADO ELIMINADO EXITOSAMENTE');
            } 
        });

        function mostrarModal(modalId, mensajeId, mensaje) {

            $('#mensajeExito').hide();
            $('#mensajeErrorCedula').hide();
            $('#mensajeErrorGeneral').hide();
            $('#mensajeErrorTelefono').hide();

            $('#mensajeErrorCedulaUpdate').hide();
            $('#mensajeErrorGeneralUpdate').hide();
            $('#mensajeErrorTelefonoUpdate').hide();

            // Mostrar el mensaje deseado
            $('#' + mensajeId).show();
            $('#' + mensajeId + ' p').text(mensaje);

            // Mostrar el modal
            $('#' + modalId).modal('show');

            // Cerrar automáticamente el modal después de 3 segundos (3000 ms)
            setTimeout(function() {
                $('#' + modalId).modal('hide');
            }, 3000);
        }
    </script>




</body>

</html>