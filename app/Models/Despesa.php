<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Despesa extends Model{
    protected $fillable = ['data', 'descricao', 'tipo', 'valor'];

    protected function casts(): array{
        return [
            'data' => 'date',
            'valor' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
