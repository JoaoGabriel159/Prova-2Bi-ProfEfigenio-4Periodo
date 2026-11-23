<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medico extends Model
{
    protected $fillable = ['nome', 'crm', 'especialidade'];

    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class);
    }
}
