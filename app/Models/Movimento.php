<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimento extends Model{
    protected $fillable = ['descricao', 'tipo', 'valor'];

    protected function casts(): array{
        return [
            'valor' => 'decimal:2',
        ];
    }
}
