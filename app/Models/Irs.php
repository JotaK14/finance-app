<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Irs extends Model{
    protected $table = 'irs';

    protected $fillable = [
        'residencia',
        'emAtividade',
        'incapacidade',
        'casado',
        'conjugeEmAtividade',
        'dependentes',
        'deficientesArmadas',
        'salarioBruto',
        'salarioLiquido',
    ];

    protected function casts(): array{
        return [
            'emAtividade' => 'boolean',
            'incapacidade' => 'boolean',
            'casado' => 'boolean',
            'conjugeEmAtividade' => 'boolean',
            'deficientesArmadas' => 'boolean',
            'dependentes' => 'integer',
            'salarioBruto' => 'decimal:2',
            'salarioLiquido' => 'decimal:2',
        ];
    }
}
