<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleados::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $cedula = $request->input('cedula');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');

        if (!$this->validarCedulaEcuatoriana($cedula)) {
            return redirect()->route('empleados.store')->withErrors(['cedula' => 'La cedula ingresada no es válida.']);
        }
        
        if (!$this->validarNumeroTelefono($telefono)) {
            return redirect()->route('empleados.store')->withErrors(['telefono' => 'El numero telefónico no es valido.']);
        }

        // Verificar si ya existe una cédula o un teléfono en la tabla "empleados"
        $empleado = Empleados::where('cedula', $cedula)
            ->orWhere('telefono', $telefono)->orWhere('correo',$correo)
            ->first();

        if ($empleado) {
            // La cédula o el teléfono ya existen en la base de datos
            return redirect()->route('empleados.store')->withErrors(['general' => 'La cedula o el telefono ya existe en la base de datos.']);
        }

        // Crear el nuevo empleado
        $empleado = Empleados::create($request->all());

        // El empleado fue creado exitosamente
        return redirect()->route('empleados.store')->with('success', 'El empleado ha sido creado exitosamente.');
    }



    private function validarCedulaEcuatoriana($cedula)
    {
        // Verificar que la cédula tenga 10 dígitos
        if (strlen($cedula) != 10) {
            return false;
        }

        // Verificar que los primeros dos dígitos sean válidos
        $provincia = substr($cedula, 0, 2);
        if ($provincia < 1 || $provincia > 24) {
            return false;
        }

        // Verificar el último dígito usando el algoritmo de validación
        $digitoVerificador = substr($cedula, 9, 1);
        $coeficientes = array(2, 1, 2, 1, 2, 1, 2, 1, 2);
        $suma = 0;

        for ($i = 0; $i < 9; $i++) {
            $valor = $cedula[$i] * $coeficientes[$i];

            if ($valor >= 10) {
                $valor -= 9;
            }

            $suma += $valor;
        }

        $resultado = 10 - ($suma % 10);
        if ($resultado == 10) {
            $resultado = 0;
        }

        if ($resultado != $digitoVerificador) {
            return false;
        }

        return true;
    }

    public function validarNumeroTelefono($telefono)
    {
        $valido = false;

        // Verificar si el número de teléfono tiene exactamente 10 dígitos
        if (strlen($telefono) === 10) {
            // Verificar si los dos primeros dígitos son "09"
            if (substr($telefono, 0, 2) === "09") {
                $valido = true;
            }
        }

        return $valido;
    }



    public function show($id)
    {
        $empleado = Empleados::find($id);
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Request $request)
    {
        $empleado = Empleados::find($request->input('empleado_id'));
        return view('empleados.index', compact('empleados', 'empleado'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'funcion' => 'required',
        ]);

        $telefono = $request->input('telefono');
        $correo = $request->input('correo');

        if (!$this->validarNumeroTelefono($telefono)) {
            return redirect()->route('empleados.index')->withErrors(['telefono' => 'El número telefónico no es válido.']);
        }

        // Verificar si ya existe una cédula o un teléfono en la tabla "empleados"
        $empleado = Empleados::where(function ($query) use ($telefono, $correo, $id) {
            $query->where('telefono', $telefono)
                ->orWhere('correo', $correo);
        })->where('id', '!=', $id)->first();

        if ($empleado) {
            // La cédula o el teléfono ya existen en la base de datos
            return redirect()->route('empleados.index')->withErrors(['general' => 'La cédula o el teléfono ya existe en la base de datos.']);
        }

        $empleado = Empleados::find($id);
        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success_u', 'El empleado ha sido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $empleado = Empleados::find($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success_delete', 'El empleado ha sido borrado exitosamente.');;
    }
}
