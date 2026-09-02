<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use Notifiable;

    protected $fillable = ['name', 'password', 'phoneNumber', 'salarioLiquido'];
    protected $hidden = ['password'];

    public function irs(): HasOne{
        return $this->hasOne(Irs::class);
    }

    public function movimentos(): HasMany{
        return $this->hasMany(Movimento::class);
    }

    protected function casts(): array{
        return [
            'password' => 'hashed',
            'saldo' => 'decimal:2',
            'despesasMensais' => 'decimal:2',
            'salarioBruto' => 'decimal:2',
            'salarioLiquido' => 'decimal:2',
            'saldoDefinido' => 'boolean',
        ];
    }
}
