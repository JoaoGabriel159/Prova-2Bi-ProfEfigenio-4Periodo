<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PacienteController extends Controller
{
    public function index()
    {
        return response()->json(Paciente::with('consultas')->get());
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:150'],
            'cpf' => ['required', 'string', 'max:14', 'unique:pacientes,cpf'],
            'telefone' => ['required', 'string', 'max:20'],
        ]);

        $paciente = Paciente::create($dados);

        return response()->json([
            'mensagem' => 'Paciente cadastrado com sucesso.',
            'paciente' => $paciente,
        ], 201);
    }
}
