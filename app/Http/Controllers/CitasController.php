<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CitasService;

class CitasController extends Controller
{
    protected $citasService;

    public function __construct(CitasService $citasService)
    {
        $this->citasService = $citasService;//aplicamos inyección de dependencias
    }
    //método para obtener citas
    public function obtenerCitas($curp) 
    {
        return $this->citasService->obtenerCitas($curp);
    }
    //método para agendar citas
    public function agendarCita(Request $request)
    {
        return $this->citasService->agendarCita($request);
    }
    //método para cancelar citas
    public function cancelarCita($id) 
    {
        return $this->citasService->cancelarCita($id);
    }
}
