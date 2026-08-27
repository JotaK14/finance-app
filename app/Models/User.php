<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use Notifiable;

    protected $fillable = ['name', 'password', 'phoneNumber'];
    protected $hidden = ['password'];

    public function despesas(): HasMany{
        return $this->hasMany(Despesa::class);
    }

    protected function iniciais(): Attribute{
        return Attribute::get(fn () => collect(explode(' ', trim($this->name)))
            ->filter()
            ->take(2)
            ->map(fn ($parte) => mb_strtoupper(mb_substr($parte, 0, 1)))
            ->implode(''));
    }

    protected function casts(): array{
        return [
            'password' => 'hashed',
            'saldo' => 'decimal:2',
            'despesasMensais' => 'decimal:2',
            'saldoDefinido' => 'boolean',
        ];
    }
}
