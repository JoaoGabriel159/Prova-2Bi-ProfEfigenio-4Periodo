<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    public function resumo()
    {
        $totalConsultas = Consulta::count();
        $consultasAgendadas = Consulta::where('status', 'agendada')->count();

        return response()->json([
            'total_consultas' => $totalConsultas,
            'consultas_agendadas' => $consultasAgendadas,
        ]);
    }
}
