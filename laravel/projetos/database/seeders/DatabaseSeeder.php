<?php

namespace Database\Seeders;

use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $paciente = Paciente::firstOrCreate(
            ['cpf' => '123.456.789-00'],
            ['nome' => 'Maria Oliveira', 'telefone' => '(41) 99999-0000']
        );

        $medico = Medico::firstOrCreate(
            ['crm' => 'CRM-PR-12345'],
            ['nome' => 'Dr. Carlos Souza', 'especialidade' => 'Clínica Geral']
        );

        if (! Consulta::exists()) {
            Consulta::create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medico->id,
                'data_hora' => now()->addDay(),
                'status' => 'agendada',
            ]);
        }
    }
}
