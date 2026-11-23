<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        return response()->json(Medico::with('consultas')->get());
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:150'],
            'crm' => ['required', 'string', 'max:30', 'unique:medicos,crm'],
            'especialidade' => ['required', 'string', 'max:100'],
        ]);

        $medico = Medico::create($dados);

        return response()->json([
            'mensagem' => 'Médico cadastrado com sucesso.',
            'medico' => $medico,
        ], 201);
    }
}
