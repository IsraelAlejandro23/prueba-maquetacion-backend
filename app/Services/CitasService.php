<?php

namespace App\Services;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

//Servicio que contiene la lógica de negocios para las citas
class CitasService {

    public function obtenerCitas($curp) 
    {
        try {

            $citas = Cita::where('curp', $curp)
                        ->where('cancelado', 0)
                        ->select(
                            'id',
                            'nombre', 
                            'apellido_materno', 
                            'apellido_paterno',
                            'direccion',
                            'ciudad',
                            'estado',
                            DB::raw("DATE_FORMAT(fecha, '%Y-%m-%d %H:%i:%s') AS fecha")
                        )
                        ->get()
                        ->toArray();
            
            return response()->json([
                'ok' => true,
                'message' => 'Citas obtenida con éxito',
                'statusCode' => 200,
                'citas' => $citas
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'ok' => false,
                'message' => 'Surgió un error al obtener las citas del usuario',
                'error' => $exception->getMessage(),
                'statusCode' => 500
            ], 500);
        }
    }

    public function agendarCita($request)
    {
        try {
            $cita = new Cita;
            $cita->nombre = $request->nombre;
            $cita->apellido_paterno = $request->apellidoPaterno;
            $cita->apellido_materno = $request->apellidoMaterno;
            $cita->email = $request->email;
            $cita->direccion = $request->direccion;
            $cita->ciudad = $request->ciudad;
            $cita->estado = $request->estado;
            $cita->codigo_postal = $request->codigoPostal;
            $cita->numero_celular = $request->numeroCelular;
            $cita->fecha = $request->fechaCita;
            $cita->curp = $request->curp;

            if($cita->save()) {
                return response()->json([
                    'ok' => true,
                    'message' => 'Su cita ha sido agendada',
                    'statusCode' => 201
                ], 201);
            }
        } catch (Exception $exception) {
            return response()->json([
                'ok' => false,
                'message' => 'Surgió un erro al agendar la cita',
                'error' => $exception->getMessage(),
                'statusCode' => 500
            ], 500);
        }
    }

    public function cancelarCita($id)
    {
        try {
            Cita::where('id', $id)->update([
                'cancelado' => 1
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'Cita cancelada con éxito',
                'statusCode' => 200
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'ok' => false,
                'message' => 'Surgió un error al cancelar la cita',
                'error' => $exception->getMessage(),
                'statusCode' => 500
            ], 500);
        }
    }
}